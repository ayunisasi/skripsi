<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pembayaran;
use App\Models\Booking;

class PembayaranAdminController extends Controller
{
    public function index()
    {
       $bookings = Booking::with([
    'user',
    'layanan',
    'pembayaran'
])->latest()->paginate(15);

        $totalDP       = Pembayaran::where('tipe', 'dp')->where('status', 'lunas')->sum('jumlah');
        $totalPelunasan= Pembayaran::where('tipe', 'pelunasan')->where('status', 'lunas')->sum('jumlah');
        $totalFull     = Pembayaran::where('tipe', 'full')->where('status', 'lunas')->sum('jumlah');
        $pendapatanHariIni = Pembayaran::where('status', 'lunas')
    ->whereDate('created_at', today())
    ->sum('jumlah');
    $pendapatanBulanIni = Pembayaran::where('status', 'lunas')
    ->whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->sum('jumlah');
        $totalPendapatan = $totalDP + $totalPelunasan + $totalFull;

      return view('admin.pembayaran.index', compact(
    'bookings',
    'totalDP',
    'totalPelunasan',
    'totalFull',
    'totalPendapatan',
    'pendapatanHariIni',
    'pendapatanBulanIni'
));
    }

    public function detail(int $id)
    {
        $booking = Booking::with([
            'user', 'layanan', 'terapis',
            'pembayaran', 'produkTambahan', 'antrian'
        ])->findOrFail($id);

        return view('admin.pembayaran.detail', compact('booking'));
    }
}
