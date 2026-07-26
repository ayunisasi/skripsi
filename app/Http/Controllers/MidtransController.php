<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Services\AntrianService;

class MidtransController extends Controller
{
    protected $antrianService;
    public function __construct(AntrianService $antrianService)
{
    $this->antrianService = $antrianService;

    \Midtrans\Config::$serverKey    = config('services.midtrans.server_key');
    \Midtrans\Config::$clientKey    = config('services.midtrans.client_key');
    \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
    \Midtrans\Config::$isSanitized  = true;
    \Midtrans\Config::$is3ds        = true;
}

    // Halaman form pembayaran
    public function form( int $id)
    {
        $booking = Booking::with(['layanan', 'terapis', 'user', 'antrian'])
            ->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $total = $booking->total_bayar ?? $booking->total_harga;

$jumlahBayar = $booking->jenis_pembayaran === 'dp'
    ? round($total * 0.3)
    : $total;

        // Buat snap token Midtrans
        $snapToken = $this->buatSnapToken($booking, $jumlahBayar);

        return view('pelanggan.pembayaran', compact(
            'booking', 'jumlahBayar', 'snapToken'
        ));
    }

    private function buatSnapToken(Booking $booking, int $jumlah): string
    {
        $orderId = 'ORDER-' . $booking->kd_booking . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $jumlah,
            ],
            'customer_details' => [
                'first_name' => $booking->user->nama_lengkap,
                'email'      => $booking->user->email,
                'phone'      => $booking->user->no_telp,
            ],
            'item_details' => $this->buildItemDetails($booking),
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Simpan order_id & snap_token ke booking
        $booking->update([
            'midtrans_order_id' => $orderId,
            'snap_token'        => $snapToken,
        ]);

        return $snapToken;
    }

    private function buildItemDetails(Booking $booking): array
    {
        $items = [];

        if ($booking->jenis_pembayaran === 'dp') {
            $items[] = [
                'id'       => 'DP-' . $booking->kd_booking,
                'price'    => $booking->jumlahDP(),
                'quantity' => 1,
                'name'     => 'DP 30% - ' . $booking->layanan->pluck('nama_layanan')->join(', '),
            ];
        } else {
            foreach ($booking->layanan as $l) {
                $items[] = [
                    'id'       => 'LAY-' . $l->id,
                    'price'    => $l->harga,
                    'quantity' => 1,
                    'name'     => $l->nama_layanan,
                ];
            }
        }

        return $items;
    }

    // Webhook dari Midtrans
    public function callback(Request $request)
{
    $serverKey    = config('services.midtrans.server_key');
    $orderId      = $request->order_id;
    $statusCode   = $request->status_code;
    $grossAmount  = $request->gross_amount;
    $signatureKey = $request->signature_key;

    // Verifikasi signature
    $mySignature = hash('sha512',
        $orderId . $statusCode . $grossAmount . $serverKey
    );
    if ($mySignature !== $signatureKey) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $transactionStatus = $request->transaction_status;
    $paymentType       = $request->payment_type;

    // Cari booking berdasarkan order_id
    $booking = Booking::where('midtrans_order_id', $orderId)->first();
    if (!$booking) {
        return response()->json(['message' => 'Booking not found'], 404);
    }

    if (in_array($transactionStatus, ['capture', 'settlement'])) {
    $jumlah = intval($request->gross_amount);

    if (str_starts_with($orderId, 'LUNASI-')) {
        $tipe             = 'pelunasan';
        $newStatusBayar   = 'lunas';
        $newStatusBooking = 'aktif'; // ✅ tetap aktif, selesai oleh admin
    } elseif ($booking->jenis_pembayaran === 'full') {
        $tipe             = 'full';
        $newStatusBayar   = 'lunas';
        $newStatusBooking = 'aktif'; // ✅ FIX: bukan selesai!
    } else {
        $tipe             = 'dp';
        $newStatusBayar   = 'dp_lunas';
        $newStatusBooking = 'aktif';
    }

    Pembayaran::create([
        'booking_id'        => $booking->id,
        'kd_pembayaran'     => 'PAY-' . strtoupper(Str::random(8)),
        'jumlah'            => $jumlah,
        'tipe'              => $tipe,
        'metode'            => 'midtrans',
        'status'            => 'lunas',
        'midtrans_order_id' => $orderId,
        'tgl_bayar'         => now(),
        'catatan'           => 'Via Midtrans - ' . $paymentType,
    ]);

    $totalDibayar = $booking->jumlah_dibayar + $jumlah;
    $booking->update([
        'jumlah_dibayar'    => $totalDibayar,
        'status_pembayaran' => $newStatusBayar,
        'status'            => $newStatusBooking,
    ]);
    // Buat nomor antrean hanya jika belum punya antrean
if (!$booking->antrian) {
    $this->antrianService->assignAntrian($booking);
}

    } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
        $booking->update(['status' => 'menunggu_pembayaran']);
    }

    return response()->json(['message' => 'OK']);
}

    // Form lunasi sisa pembayaran via Midtrans
    public function lunasiForm(int $id)
    {
        $booking = Booking::with(['layanan', 'terapis', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $sisaBayar = $booking->sisaBayar();
        if ($sisaBayar <= 0) {
            return redirect()->route('booking.riwayat')
                ->with('error', 'Pembayaran sudah lunas!');
        }

        // Buat snap token untuk pelunasan
        $snapToken = $this->buatSnapTokenLunasi($booking, $sisaBayar);

        return view('pelanggan.lunasi', compact('booking', 'sisaBayar', 'snapToken'));
    }

    private function buatSnapTokenLunasi(Booking $booking, int $jumlah): string
    {
        $orderId = 'LUNASI-' . $booking->kd_booking . '-' . time();

        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $jumlah,
            ],
            'customer_details' => [
                'first_name' => $booking->user->nama_lengkap,
                'email'      => $booking->user->email,
                'phone'      => $booking->user->no_telp,
            ],
            'item_details' => [[
                'id'       => 'LUNASI-' . $booking->kd_booking,
                'price'    => $jumlah,
                'quantity' => 1,
                'name'     => 'Pelunasan Booking ' . $booking->kd_booking,
            ]],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $booking->update([
            'midtrans_order_id' => $orderId,
            'snap_token'        => $snapToken,
        ]);

        return $snapToken;
    }

    public function lunasiProses(Request $request, int $id)
    {
        // Ini akan dihandle oleh webhook callback
        return redirect()->route('antrian.show', [
            'kd_booking' => Booking::findOrFail($id)->kd_booking
        ])->with('success', 'Menunggu konfirmasi pembayaran...');
    }
}
