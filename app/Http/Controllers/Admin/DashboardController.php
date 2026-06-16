<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Antrian;
use App\Models\Terapis;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $totalPelanggan = User::where('role', 'pelanggan')->count();

    // ✅ FIX: Layanan selesai HARI INI saja
    $layananSelesaiHariIni = Booking::where('status', 'selesai')
       ->whereDate('created_at', Carbon::today())
        ->count();

    // ✅ FIX: Antrian hari ini saja, tanpa yang dibatalkan
$antrians = Antrian::with(['booking.user', 'booking.layanan', 'terapis'])
    ->whereHas('booking', function ($q) {
        $q->whereDate('tgl_booking', today());
    })
    ->whereNotIn('status', ['dibatalkan'])
    ->orderBy('terapis_id')
    ->orderBy('nomor_antrian')
    ->get()
    ->groupBy('terapis_id');

    $terapisList = Terapis::where('status', 'aktif')->get();

    return view('admin.dashboard', compact(
    'totalPelanggan',
    'layananSelesaiHariIni',
    'antrians',
    'terapisList'
));
}
}
