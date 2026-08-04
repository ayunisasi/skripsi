<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Layanan;
use App\Models\Terapis;
use App\Services\AntrianService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Services\PromoService;
use App\Models\Diskon;

class BookingController extends Controller
{
    protected $antrianService;

    public function __construct(AntrianService $antrianService)
    {
        $this->antrianService = $antrianService;
    }

  public function index()
{
    $layanan = Layanan::all();

    $terapis = Terapis::with(['reviews', 'bookings'])
        ->where('status', 'aktif')
        ->get();

       foreach ($terapis as $t) {

    $rating = round($t->reviews->avg('rating') ?? 0, 1);
    $t->rating = $rating;
    $t->jumlah_review = $t->reviews->count();
    $t->booking_selesai =
        $t->bookings
          ->where('status', 'selesai')
          ->count();

         // Jumlah booking aktif hari ini
$t->booking_hari_ini = $t->bookings
    ->where('tgl_booking', now()->toDateString())
    ->whereIn('status', [
        'menunggu_pembayaran',
        'aktif',
        'menunggu',
        'dipanggil',
        'dilayani'
    ])
    ->count();

// Maksimal 5 pelanggan
$t->maksimal_booking = 5;

// Status tersedia
$t->tersedia = $t->booking_hari_ini < $t->maksimal_booking;

    // kriteria
    $t->ramah = $t->reviews->where('ramah', true)->count();

    $t->rapi = $t->reviews->where('rapi', true)->count();

    $t->bersih = $t->reviews->where('bersih', true)->count();

    $t->profesional = $t->reviews->where('profesional', true)->count();

    $t->keterampilan = $t->reviews->where('keterampilan', true)->count();

// Hitung total review positif yang diberikan pelanggan
// Semakin banyak review positif, semakin tinggi nilai terapis

    $reviewPositif =
        $t->ramah +
        $t->rapi +
        $t->bersih +
        $t->profesional +
        $t->keterampilan;


        $bobotRating  = 0.5; // 50% pengaruh rating
        $bobotReview  = 0.3; // 30% pengaruh review positif
        $bobotBooking = 0.2; // 20% pengaruh booking selesai

}

$maxRating = $terapis->max('rating');

$maxReview = $terapis->max(function ($t) {
    return
        $t->ramah +
        $t->rapi +
        $t->bersih +
        $t->profesional +
        $t->keterampilan;
});

$maxBooking = $terapis->max('booking_selesai');

foreach ($terapis as $t) {

    $reviewPositif =
        $t->ramah +
        $t->rapi +
        $t->bersih +
        $t->profesional +
        $t->keterampilan;

    $ratingNormal =
        $maxRating > 0
            ? $t->rating / $maxRating
            : 0;

    $reviewNormal =
        $maxReview > 0
            ? $reviewPositif / $maxReview
            : 0;

    $bookingNormal =
        $maxBooking > 0
            ? $t->booking_selesai / $maxBooking
            : 0;

    $t->score =
        ($ratingNormal * 0.5) +
        ($reviewNormal * 0.3) +
        ($bookingNormal * 0.2);
}



    $terapis = $terapis->sortByDesc('score')->values();

    $tanggalTersedia = AntrianService::getTanggalTersedia();

    $diskons = Diskon::where('status', true)
    ->where(function ($query) {
        $query->whereNull('tanggal_mulai')
              ->orWhere('tanggal_mulai', '<=', now());
    })
    ->where(function ($query) {
        $query->whereNull('tanggal_selesai')
              ->orWhere('tanggal_selesai', '>=', now());
    })
    ->get();

    return view('pelanggan.booking', compact(
    'layanan',
    'terapis',
    'tanggalTersedia',
    'diskons'
));
}


    public function cekKetersediaan(Request $request)
    {
        $request->validate([
            'tgl_booking' => 'required|date',
            'terapis_id'  => 'required|exists:terapis,id',
            'layanan_ids' => 'required|array|min:1',
        ]);

        // Cek apakah terapis sudah penuh
        $booking_selesai = Booking::where('terapis_id', $request->terapis_id)
            ->where('tgl_booking', $request->tgl_booking)
            ->whereNotIn('status', ['dibatalkan', 'dibatalkan_sistem'])
            ->count();

        if ($booking_selesai >= 5) {

        return back()
            ->with('error', 'Terapis ini sudah penuh. Silakan pilih terapis lain.')
            ->withInput();
}

        $layananList = Layanan::whereIn('id', $request->layanan_ids)->get();
        $totalDurasi = $layananList->sum('durasi');

        $hasil = $this->antrianService->cekKetersediaan(
            $request->tgl_booking,
            $request->terapis_id,
            $totalDurasi
        );

        return response()->json($hasil);
    }

    public function store(Request $request)
{
    $request->validate([
        'layanan_ids'      => 'required|array|min:1',
        'layanan_ids.*'    => 'exists:layanan,id',
        'terapis_id'       => 'required|exists:terapis,id',
        'tgl_booking'      => 'required|date',
        'jenis_pembayaran' => 'required|in:dp,full',
    ]);

    $layananList = Layanan::whereIn('id', $request->layanan_ids)->get();
    $totalHarga  = $layananList->sum('harga');
    $totalDurasi = $layananList->sum('durasi');
    // Cek promo
$promo = PromoService::cekPromo(
    Auth::user(),
    $totalHarga
);

$potongan = $promo['potongan'] ?? 0;
$totalBayar = max(0, $totalHarga - $potongan);

$cek = $this->antrianService->cekKetersediaan(
    $request->tgl_booking,
    $request->terapis_id,
    $totalDurasi
);

if (!$cek['tersedia']) {
    return back()
        ->with('error', $cek['pesan'])
        ->withInput();
}

    $booking = Booking::create([
        'kd_booking'       => 'BK-' . strtoupper(Str::random(8)),
        'user_id'          => Auth::id(),
        'terapis_id'       => $request->terapis_id,
        'tgl_booking'      => $request->tgl_booking,
        'total_harga' => $totalHarga,
        'potongan'    => $potongan,
        'total_bayar' => $totalBayar,
        'diskon_id'   => $promo['id'] ?? null,
        'total_durasi'     => $totalDurasi,
        'jenis_pembayaran' => $request->jenis_pembayaran,
        'status'           => 'menunggu_pembayaran',
        'status_pembayaran'=> 'belum_bayar',
    ]);

    $booking->layanan()->attach($request->layanan_ids);
    // $this->antrianService->assignAntrian($booking);

    return redirect()->route('midtrans.form', $booking->id);
}

public function cekPromo(Request $request)
{
    $layanan = Layanan::whereIn(
        'id',
        $request->layanan_ids ?? []
    )->get();

    $subtotal = $layanan->sum('harga');

    $promo = PromoService::cekPromo(
        Auth::user(),
        $subtotal
    );

    $potongan = $promo['potongan'] ?? 0;

    return response()->json([
        'subtotal' => $subtotal,
        'potongan' => $potongan,
        'nama_promo' => $promo['nama'] ?? '',
        'total_bayar' => max(0, $subtotal - $potongan),
    ]);
}

    public function riwayat()
    {
        $bookings = Booking::with(['layanan', 'terapis', 'antrian'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pelanggan.riwayat', compact('bookings'));
    }

    public function batalkan(Request $request, int $id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if (!$booking->bisaDibatalkan()) {
            return back()->with('error',
                'Booking tidak dapat dibatalkan. Pembatalan hanya bisa dilakukan minimal H-1 sebelum jadwal.'
            );
        }

        $booking->update([
            'status'        => 'dibatalkan',
            'alasan_batal'  => $request->alasan ?? 'Dibatalkan oleh pelanggan',
            'dibatalkan_at' => now(),
        ]);

        // Batalkan antrian & recalculate
        if ($booking->antrian) {
            $booking->antrian->update(['status' => 'dibatalkan']);
            $this->antrianService->recalculate(
                $booking->tgl_booking,
                $booking->terapis_id
            );
        }

        return back()->with('success',
            'Booking berhasil dibatalkan.'
        );
    }

    public function destroy(int $id)
{
    $booking = Booking::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    // Hanya bisa hapus jika sudah selesai atau dibatalkan
    if (!in_array($booking->status, ['selesai', 'dibatalkan', 'dibatalkan_sistem'])) {
        return back()->with('error', 'Booking aktif tidak bisa dihapus dari riwayat.');
    }

    $booking->delete();
    return back()->with('success', 'Riwayat booking berhasil dihapus.');
}


}
