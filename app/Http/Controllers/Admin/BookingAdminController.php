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

        return view('admin.booking.detail', compact('booking', 'layananList'));
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
        $booking->increment('total_harga', $request->harga);

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
        $booking->update([
        'jumlah_dibayar'    => $booking->total_harga,
        'status_pembayaran' => 'lunas',
        // Jangan ubah status booking di sini
        // Status booking hanya berubah jadi 'selesai' ketika admin klik Selesai di antrian
        ]);

        // Update antrian jadi selesai
        if ($booking->antrian) {
            $booking->antrian->update(['status' => 'selesai']);
        }

        return back()->with('success', 'Pelunasan tunai berhasil dikonfirmasi!');
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
