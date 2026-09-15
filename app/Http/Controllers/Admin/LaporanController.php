<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
   public function index(Request $request)
{
    $query = Booking::with(['user', 'terapis', 'layanan'])
        ->whereIn('status_pembayaran', ['dp_lunas', 'lunas']);

    if ($request->filled('tanggal_awal')) {
        $query->whereDate('tgl_booking', '>=', $request->tanggal_awal);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('tgl_booking', '<=', $request->tanggal_akhir);
    }

    // 1. HITUNG TOTAL DULU dari seluruh data (sebelum dipaginasi)
    $totalBooking = (clone $query)->count();
    $totalPendapatan = (clone $query)->sum('jumlah_dibayar');

    // 2. AMBIL 10 DATA PER HALAMAN untuk tabel
    $booking = $query
        ->orderByDesc('tgl_booking')
        ->paginate(10)
        ->withQueryString();

    return view('admin.laporan.index', compact(
        'booking',
        'totalBooking',
        'totalPendapatan'
    ));
}

public function cetakPdf(Request $request)
{
    $query = Booking::with(['user', 'terapis', 'layanan'])
        ->whereIn('status_pembayaran', ['dp_lunas', 'lunas']);

    if ($request->filled('tanggal_awal')) {
        $query->whereDate('tgl_booking', '>=', $request->tanggal_awal);
    }

    if ($request->filled('tanggal_akhir')) {
        $query->whereDate('tgl_booking', '<=', $request->tanggal_akhir);
    }

    $booking = $query
        ->orderByDesc('tgl_booking')
        ->get();

    $totalBooking = $booking->count();

    $totalPendapatan = $booking->sum('jumlah_dibayar');

    $pdf = Pdf::loadView('admin.laporan.pdf', compact(
        'booking',
        'totalBooking',
        'totalPendapatan'
    ));

    $pdf->setPaper('A4', 'portrait');

    return $pdf->stream('laporan-pendapatan.pdf');
}
}
