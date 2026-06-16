<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Booking;
use App\Models\Terapis;
use App\Services\AntrianService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AntrianAdminController extends Controller
{
    protected AntrianService $antrianService;
    public function __construct(AntrianService $antrianService)
    {
        $this->antrianService = $antrianService;
    }

    public function index(Request $request)
{
    // ✅ FIX: Selalu hari ini, tidak ada filter tanggal lagi
    $tgl     = Carbon::today()->format('Y-m-d');
    $terapis = Terapis::where('status', 'aktif')->get();

$antrians = Antrian::with(['booking.user', 'booking.layanan', 'terapis'])
    ->whereHas('booking', function ($q) {
        $q->whereDate('tgl_booking', today());
    })
    ->whereNotIn('status', ['dibatalkan'])
    ->orderBy('terapis_id')
    ->orderBy('nomor_antrian')
    ->get()
    ->groupBy('terapis_id');

    $sesi = null; // tidak dipakai lagi
    return view('admin.antrian.index', compact('antrians', 'terapis', 'tgl', 'sesi'));
}

    // Panggil antrian — tandai sedang dilayani
    public function panggil(int $id)
    {
        $antrian = Antrian::with('booking.user')->findOrFail($id);

        // Validasi: hanya bisa panggil jika status menunggu
        if ($antrian->status !== 'menunggu') {
        return back()->with('error', 'Antrian ini tidak bisa dipanggil.');
        }

        $antrian->update(['status' => 'dilayani']);
        $antrian->booking->update([
        'status_kehadiran' => 'hadir',
        'checkin_at'       => now(),
        ]);

        return back()->with('success',
        "Antrian #{$antrian->nomor_antrian} — {$antrian->booking->user->nama_lengkap} dipanggil!"
        );
    }

    // Tandai selesai dilayani
    public function selesai(int $id)
{
    $antrian = Antrian::with('booking')->findOrFail($id);

    if ($antrian->status !== 'dilayani') {
        return back()->with('error', 'Antrian belum dipanggil/dilayani.');
    }

    // ✅ FIX: Update antrian jadi selesai
    $antrian->update(['status' => 'selesai']);

    // ✅ FIX: Update booking jadi selesai SELALU
    $antrian->booking->update([
        'status'           => 'selesai', // langsung selesai
        'status_kehadiran' => 'hadir',
    ]);

    return back()->with('success',
        "Antrian #{$antrian->nomor_antrian} selesai dilayani! Status booking diperbarui."
    );
}

    // Proses keterlambatan pelanggan
    public function prosesKeterlambatan(Request $request, int $id)
{
    $antrian = Antrian::with('booking')->findOrFail($id);
    $booking = $antrian->booking;

    // Hanya bisa proses keterlambatan jika status masih menunggu
    if ($antrian->status !== 'menunggu') {
        return back()->with('error', 'Antrian ini sudah ' . $antrian->status . '.');
    }

    $sekarang      = Carbon::now();
    $estimasiMulai = Carbon::parse(
        $booking->tgl_booking . ' ' . $antrian->estimasi_jam_mulai
    );

    $terlambatMenit = max(0, $sekarang->diffInMinutes($estimasiMulai, false) * -1);

    if ($terlambatMenit === 0) {
        return back()->with('error', 'Pelanggan belum terlambat. Gunakan tombol Panggil.');
    }

    if ($terlambatMenit <= 15) {
        // Terlambat ≤15 menit → masih bisa, update estimasi
        $jamMulaiBaru   = $sekarang->copy();
        $jamSelesaiBaru = $jamMulaiBaru->copy()->addMinutes($antrian->total_durasi);

        $antrian->update([
            'estimasi_jam_mulai'   => $jamMulaiBaru->format('H:i'),
            'estimasi_jam_selesai' => $jamSelesaiBaru->format('H:i'),
            'status'               => 'menunggu', // Tetap menunggu, bukan dilayani
        ]);

        $booking->update([
            'status_kehadiran' => 'terlambat',
            'checkin_at'       => $sekarang,
        ]);

        $this->antrianService->recalculate(
    $booking->tgl_booking, $booking->terapis_id
);

        return back()->with('success',
            "Terlambat {$terlambatMenit} mnt. Estimasi diperbarui ke {$jamMulaiBaru->format('H:i')}."
        );

    } else {

    $antrian->update([
        'status' => 'dibatalkan'
    ]);

    $booking->update([
        'status'           => 'dibatalkan_sistem',
        'status_kehadiran' => 'tidak_hadir',
        'alasan_batal'     => "Auto-cancel: terlambat {$terlambatMenit} menit.",
        'dibatalkan_at'    => $sekarang,
    ]);

    $this->antrianService->recalculate(
        $booking->tgl_booking,
        $booking->terapis_id
    );

    return back()->with(
        'error',
        "Booking dibatalkan otomatis. Terlambat {$terlambatMenit} menit (>15 mnt). Pembayaran hangus."
    );
}
    }
}

