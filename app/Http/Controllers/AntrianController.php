<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Antrian;
use Illuminate\Support\Facades\Auth;

class AntrianController extends Controller
{
    public function show($kd_booking)
    {
        $booking = Booking::with(['layanan', 'terapis', 'antrian'])
            ->where('kd_booking', $kd_booking)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $antrian = $booking->antrian;

        // Hitung antrian di depan
        $antrianDidepan = 0;
        $sedangDilayani = null;

        if ($antrian) {
            $antrianDidepan = Antrian::where('terapis_id', $booking->terapis_id)
                ->where('tgl_antrian', $booking->tgl_booking)
                ->where('nomor_antrian', '<', $antrian->nomor_antrian)
                ->whereIn('status', ['menunggu'])
                ->count();

            $sedangDilayani = Antrian::with('booking.user')
                ->where('terapis_id', $booking->terapis_id)
                ->where('tgl_antrian', $booking->tgl_booking)
                ->where('status', 'dilayani')
                ->first();
        }

        return view('pelanggan.antrian', compact(
            'booking', 'antrian',
            'antrianDidepan', 'sedangDilayani'
        ));
    }
}
