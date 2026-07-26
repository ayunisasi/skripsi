<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index()
{
    $diskons = Diskon::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.diskon.index', compact('diskons'));
}

    public function create()
    {
        return view('admin.diskon.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'nama_diskon' => 'required|max:255',
        'jenis' => 'required',
        'tipe_potongan' => 'required',
        'nilai' => 'required|numeric|min:1',
        'status' => 'required',
    ]);

    Diskon::create([
        'nama_diskon' => $request->nama_diskon,
        'jenis' => $request->jenis,
        'tipe_potongan' => $request->tipe_potongan,
        'nilai' => $request->nilai,
        'minimal_transaksi' => $request->minimal_transaksi,
        'minimal_kunjungan' => $request->minimal_kunjungan,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('diskon.index')
        ->with('success', 'Data diskon berhasil ditambahkan.');
}

    public function show(Diskon $diskon)
    {

    }

public function edit(Diskon $diskon)
{
    return view('admin.diskon.edit', compact('diskon'));
}

   public function update(Request $request, Diskon $diskon)
{
    $request->validate([
        'nama_diskon' => 'required|max:255',
        'jenis' => 'required|in:diskon,event,langganan',
        'tipe_potongan' => 'required|in:persen,nominal',
        'nilai' => 'required|numeric|min:1',
        'minimal_transaksi' => 'nullable|numeric|min:0',
        'minimal_kunjungan' => 'nullable|integer|min:0',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
        'status' => 'required|boolean',
    ]);

    $diskon->update([
        'nama_diskon' => $request->nama_diskon,
        'jenis' => $request->jenis,
        'tipe_potongan' => $request->tipe_potongan,
        'nilai' => $request->nilai,
        'minimal_transaksi' => $request->minimal_transaksi,
        'minimal_kunjungan' => $request->minimal_kunjungan,
        'tanggal_mulai' => $request->tanggal_mulai,
        'tanggal_selesai' => $request->tanggal_selesai,
        'status' => $request->status,
    ]);

    return redirect()
        ->route('diskon.index')
        ->with('success', 'Data promo berhasil diperbarui.');
}

   public function destroy(Diskon $diskon)
{
    $diskon->delete();

    return redirect()
        ->route('diskon.index')
        ->with('success', 'Data promo berhasil dihapus.');
}
}
