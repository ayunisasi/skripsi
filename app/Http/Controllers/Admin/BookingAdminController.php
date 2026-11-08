<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\ProdukTambahan;
use App\Models\Pembayaran;
use App\Models\Terapis;
use App\Services\AntrianService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Antrian;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingAdminController extends Controller
{
    protected AntrianService $antrianService;

    public function __construct(AntrianService $antrianService)
    {
        $this->antrianService = $antrianService;
    }

public function index(Request $request)
{
    $query = Booking::with(['user', 'layanan', 'terapis', 'antrian']);

    if ($request->filled('terapis_id')) {
        $query->where('terapis_id', $request->terapis_id);
    }

    $bookings = $query
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    $terapis = Terapis::where('status', 'aktif')->get();

    return view('admin.booking.index', compact('bookings', 'terapis'));
}

    public function detail(int $id)
{
    $booking = Booking::with([
        'user', 'layanan', 'terapis',
        'antrian', 'pembayaran', 'produkTambahan'
    ])->findOrFail($id);

    $layananList = Layanan::all();

    $terapisList = Terapis::where('status', 'aktif')
    ->where('id', '!=', $booking->terapis_id)
    ->get()
    ->filter(function ($terapis) use ($booking) {
        $cek = $this->antrianService->cekKetersediaan(
            $booking->tgl_booking,
            $terapis->id,
            $booking->total_durasi
        );

        return $cek['tersedia'];
    });

    return view('admin.booking.detail', compact(
        'booking',
        'layananList',
        'terapisList'
    ));
}

    public function setujui(int $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'aktif']);

        return back()->with('success', 'Booking disetujui!');
    }

    public function batalkan(Request $request, int $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'status'       => 'dibatalkan',
            'alasan_batal' => $request->alasan ?? 'Dibatalkan oleh admin',
            'dibatalkan_at' => now(),
        ]);

        // Update antrian jika ada
        if ($booking->antrian) {
            $booking->antrian->update(['status' => 'dibatalkan']);
            $this->antrianService->recalculate(
                $booking->tgl_booking,
                $booking->terapis_id
            );
        }

        return back()->with('success', 'Booking dibatalkan!');
    }

    // Tambah layanan atau produk di lokasi
    public function tambahItem(Request $request, int $id)
    {
        $request->validate([
            'nama_item' => 'required|string|max:100',
            'harga'     => 'required|integer|min:0',
            'tipe'      => 'required|in:layanan,produk',
            'durasi'    => 'nullable|integer|min:0',
        ]);

        $booking = Booking::with('antrian')->findOrFail($id);
        $durasi  = intval($request->durasi ?? 0);

        // Cek konflik jika ada durasi tambahan
        if ($durasi > 0 && $booking->antrian) {
            $cek = $this->antrianService->cekKonflikTambahan($booking, $durasi);
            if ($cek['konflik']) {
                return back()->with('error', $cek['pesan']);
            }
        }

        // Simpan produk/layanan tambahan
        ProdukTambahan::create([
            'booking_id' => $booking->id,
            'nama_item'  => $request->nama_item,
            'harga'      => $request->harga,
            'tipe'       => $request->tipe,
            'catatan'    => $request->catatan,
        ]);

        // Update total harga booking
        $totalHargaBaru = $booking->total_harga + $request->harga;
        $totalBayarBaru = $booking->total_bayar + $request->harga;

        $booking->update([
            'total_harga' => $totalHargaBaru,
            'total_bayar' => $totalBayarBaru,
        ]);

        // Update durasi dan jam selesai antrian jika ada durasi tambahan
        if ($durasi > 0 && $booking->antrian) {
            $antrian = $booking->antrian;
            $jamSelesaiBaru = \Carbon\Carbon::parse($antrian->estimasi_jam_selesai)
                                ->addMinutes($durasi);

            $antrian->update([
                'estimasi_jam_selesai' => $jamSelesaiBaru->format('H:i'),
                'total_durasi'         => $antrian->total_durasi + $durasi,
            ]);

            $booking->update([
                'total_durasi' => $booking->total_durasi + $durasi,
                'jam_selesai'  => $jamSelesaiBaru->format('H:i'),
            ]);

            // Recalculate antrian berikutnya
            $this->antrianService->recalculate(
                $booking->tgl_booking,
                $booking->terapis_id
            );
        }

        return back()->with('success', 'Item berhasil ditambahkan!');
    }

    // Konfirmasi pelunasan tunai di lokasi
    public function konfirmasiCash(int $id)
    {
        $booking = Booking::findOrFail($id);
        $sisa    = $booking->sisaBayar();

        if ($sisa <= 0) {
            return back()->with('error', 'Pembayaran sudah lunas!');
        }

        // Buat record pembayaran pelunasan
        Pembayaran::create([
            'booking_id'    => $booking->id,
            'kd_pembayaran' => 'PAY-' . strtoupper(Str::random(8)),
            'jumlah'        => $sisa,
            'tipe'          => 'pelunasan',
            'metode'        => 'tunai',
            'status'        => 'lunas',
            'tgl_bayar'     => now(),
            'catatan'       => 'Pelunasan tunai di lokasi',
        ]);

        // Pelunasan tunai → status booking tetap aktif sampai antrian selesai
        $total = (int) ($booking->total_bayar ?? $booking->total_harga);

$booking->update([
    'jumlah_dibayar'    => $total,
    'status_pembayaran' => 'lunas',
]);

        // Update antrian jadi selesai
        if ($booking->antrian) {
            $booking->antrian->update(['status' => 'selesai']);
        }

        return back()->with('success', 'Pelunasan tunai berhasil dikonfirmasi!');
    }


public function gantiTerapis(Request $request, int $id)
{
    $request->validate([
        'terapis_id' => 'required|exists:terapis,id',
        'alasan' => 'required|in:Sakit,Izin',
    ]);

    $hasil = DB::transaction(function () use ($request, $id) {

        $booking = Booking::with(['terapis', 'user'])
            ->lockForUpdate()
            ->findOrFail($id);

        $antrian = $booking->antrian()
            ->lockForUpdate()
            ->first();

        if (!$antrian || $antrian->status !== 'menunggu') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'terapis_id' => 'Booking tidak memiliki antrean menunggu atau sudah diproses.',
            ]);
        }
        if (!in_array($booking->status, ['menunggu_pembayaran', 'aktif'])) {
    throw \Illuminate\Validation\ValidationException::withMessages([
        'terapis_id' => 'Booking tidak dapat diganti karena statusnya sudah tidak aktif.',
    ]);
}

if ($booking->status_kehadiran !== 'menunggu') {
    throw \Illuminate\Validation\ValidationException::withMessages([
        'terapis_id' => 'Booking tidak dapat diganti karena status kehadirannya sudah berubah.',
    ]);
}

        $terapisLamaId = $booking->terapis_id;
        $namaTerapisLama = $booking->terapis->nama_terapis ?? '-';

        $terapisBaru = Terapis::where('status', 'aktif')
            ->findOrFail($request->terapis_id);

        if ($terapisBaru->id == $terapisLamaId) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'terapis_id' => 'Pilih terapis yang berbeda.',
            ]);
        }

        // Periksa ketersediaan terapis pengganti
        $cek = $this->antrianService->cekKetersediaan(
            $booking->tgl_booking,
            $terapisBaru->id,
            $booking->total_durasi
        );

        if (!$cek['tersedia']) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'terapis_id' => 'Terapis pengganti tidak tersedia pada tanggal tersebut.',
            ]);
        }

        // Pindahkan booking ke terapis baru
        $booking->update([
            'terapis_id' => $terapisBaru->id,
            'nomor_antrian' => $cek['nomor_antrian'],
            'estimasi_jam' => $cek['estimasi_mulai'],
            'jam_mulai' => $cek['estimasi_mulai'],
            'jam_selesai' => $cek['estimasi_selesai'],
        ]);
// Perbarui antrean sesuai antrean terapis pengganti
$antrian->update([
    'terapis_id' => $terapisBaru->id,
    'tgl_antrian' => $booking->tgl_booking,
    'nomor_antrian' => $cek['nomor_antrian'],
    'estimasi_jam_mulai' => $cek['estimasi_mulai'],
    'estimasi_jam_selesai' => $cek['estimasi_selesai'],
    'total_durasi' => $booking->total_durasi,
]);

        return [
            'booking' => $booking,
            'terapis_lama_id' => $terapisLamaId,
            'nama_lama' => $namaTerapisLama,
            'nama_baru' => $terapisBaru->nama_terapis,
            'nomor' => $cek['nomor_antrian'],
            'mulai' => $cek['estimasi_mulai'],
            'selesai' => $cek['estimasi_selesai'],
        ];
    });

    // Hitung ulang antrean terapis lama
    $this->antrianService->recalculate(
        $hasil['booking']->tgl_booking,
        $hasil['terapis_lama_id']
    );

    // Kirim email pemberitahuan kepada pelanggan
    $emailGagal = false;
    $booking = $hasil['booking']->load('user');

    if ($booking->user && $booking->user->email) {
        try {
            Mail::raw(
               "Halo {$booking->user->nama_lengkap},\n\n"
                . "Mohon maaf atas ketidaknyamanan yang mungkin terjadi. Kami ingin menginformasikan bahwa terdapat perubahan terapis untuk booking Anda karena terapis sebelumnya berhalangan hadir.\n\n"
                . "Berikut adalah informasi perubahan booking Anda:\n\n"
                . "Kode Booking: {$booking->kd_booking}\n"
                . "Terapis sebelumnya: {$hasil['nama_lama']}\n"
                . "Terapis pengganti: {$hasil['nama_baru']}\n"
                . "Alasan: {$request->alasan}\n"
                . "Tanggal: {$booking->tgl_booking}\n"
                . "Nomor antrean baru: {$hasil['nomor']}\n"
                . "Estimasi mulai: {$hasil['mulai']}\n"
                . "Estimasi selesai: {$hasil['selesai']}\n\n"
                . "Terima kasih telah menggunakan layanan SalonQu.",
                function ($message) use ($booking) {
                    $message->to($booking->user->email)
                        ->subject('Pemberitahuan Perubahan Terapis - SalonQu');
                }
            );
        } catch (\Throwable $e) {
            $emailGagal = true;
        }
    }

    if ($emailGagal) {
        return back()->with('warning',
            'Terapis berhasil diganti, tetapi email pemberitahuan gagal dikirim.');
    }

    return back()->with('success',
        'Terapis berhasil diganti dan email pemberitahuan telah diproses.');
}


    public function destroy(int $id)
{
    $booking = Booking::findOrFail($id);

    // Batalkan antrian dulu jika ada
    if ($booking->antrian) {
        $booking->antrian->update(['status' => 'dibatalkan']);
    }

    $booking->delete();

    return redirect('/admin/booking')
        ->with('success', 'Data booking berhasil dihapus!');
}
}
