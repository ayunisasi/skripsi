<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terapis;
use Illuminate\Http\Request;

class TerapisController extends Controller
{
public function index()
{
    $terapis = Terapis::with(['reviews', 'bookings'])
        ->latest()
        ->paginate(10);

    foreach ($terapis as $t) {

        // Rating rata-rata
        $t->rating = round($t->reviews->avg('rating') ?? 0, 1);

        // Total review
        $t->total_review = $t->reviews->count();

        // Booking selesai
        $t->booking_selesai = $t->bookings
            ->where('status', 'selesai')
            ->count();

        // Jumlah setiap kriteria
        $t->ramah = $t->reviews->where('ramah', true)->count();
        $t->rapi = $t->reviews->where('rapi', true)->count();
        $t->profesional = $t->reviews->where('profesional', true)->count();
        $t->bersih = $t->reviews->where('bersih', true)->count();
        $t->keterampilan = $t->reviews->where('tepat_waktu', true)->count();

        // Hitung Score
        $reviewPositif =
            $t->ramah +
            $t->rapi +
            $t->profesional +
            $t->bersih +
            $t->keterampilan;

        $t->ai_score =
            ($t->rating * 0.5) +
            ($reviewPositif * 0.3) +
            ($t->booking_selesai * 0.2);
    }

    // Urutkan berdasarkan Score tertinggi
    $collection = $terapis->getCollection()
        ->sortByDesc('ai_score')
        ->values();

    // Terapis unggulan
    $terapisUnggulan = $collection->first();

    // Ganti isi paginator dengan collection yang sudah diurutkan
    $terapis->setCollection($collection);

    return view('admin.terapis.index', compact(
        'terapis',
        'terapisUnggulan'
    ));
}

    public function create()
    {
        return view('admin.terapis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_terapis' => 'required|string|max:100',
            'status'       => 'required|in:aktif,nonaktif',
        ]);
        Terapis::create($request->all());
        return redirect('/admin/terapis')
            ->with('success', 'Terapis berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $terapis = Terapis::findOrFail($id);
        return view('admin.terapis.edit', compact('terapis'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_terapis' => 'required|string|max:100',
            'status'       => 'required|in:aktif,nonaktif',
        ]);
        Terapis::findOrFail($id)->update($request->all());
        return redirect('/admin/terapis')
            ->with('success', 'Terapis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Terapis::findOrFail($id)->delete();
        return redirect('/admin/terapis')
            ->with('success', 'Terapis berhasil dihapus!');
    }
}
