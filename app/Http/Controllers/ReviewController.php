<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function create(Booking $booking)
    {
        if ($booking->status !== 'selesai') {
            abort(403);
        }

        return view('pelanggan.review', compact('booking'));
    }

    public function store(Request $request, Booking $booking)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string'
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => Auth::id(),
            'terapis_id' => $booking->terapis_id,

            'rating' => $request->rating,
            'komentar' => $request->komentar,

            'ramah' => $request->has('ramah'),
            'rapi' => $request->has('rapi'),
            'profesional' => $request->has('profesional'),
            'bersih' => $request->has('bersih'),
            'keterampilan' => $request->has('keterampilan'),
        ]);

        return redirect('/booking/riwayat')
            ->with('success', 'Review berhasil dikirim');
    }
}
