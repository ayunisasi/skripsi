<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LayananController extends Controller
{
    public function index(Request $request)
{
    $query = Layanan::query();

    if ($request->filled('search')) {

        $query->where('nama_layanan', 'like', '%' . $request->search . '%');

    }

    $layanan = $query
        ->latest()
        ->paginate(10)
        ->withQueryString();

    return view('admin.layanan.index', compact('layanan'));
}

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_layanan'       => 'required|string|max:100',
        'harga'              => 'required|integer|min:1000',
        'durasi'             => 'required|integer|min:5',
        'gambar'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'deskripsi_singkat'  => 'nullable|string',
        'landing'            => 'required|boolean',
    ]);

    $gambar = null;

if ($request->hasFile('gambar')) {

    $gambar = $request->file('gambar')
        ->store('layanan', 'public');

}

    Layanan::create([
        'nama_layanan'      => $request->nama_layanan,
        'harga'             => $request->harga,
        'durasi'            => $request->durasi,
        'gambar'            => $gambar,
        'deskripsi_singkat' => $request->deskripsi_singkat,
        'landing'           => $request->landing,
    ]);

    return redirect('/admin/layanan')
        ->with('success', 'Layanan berhasil ditambahkan!');
}

    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'nama_layanan'       => 'required|string|max:100',
        'harga'              => 'required|integer|min:1000',
        'durasi'             => 'required|integer|min:5',
        'gambar'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'deskripsi_singkat'  => 'nullable|string',
        'landing'            => 'required|boolean',
    ]);

    $layanan = Layanan::findOrFail($id);

    $gambar = $layanan->gambar;

if ($request->hasFile('gambar')) {

    if ($layanan->gambar) {

        Storage::disk('public')->delete($layanan->gambar);

    }

    $gambar = $request->file('gambar')
        ->store('layanan', 'public');

}

    $layanan->update([
        'nama_layanan'      => $request->nama_layanan,
        'harga'             => $request->harga,
        'durasi'            => $request->durasi,
        'gambar'            => $gambar,
        'deskripsi_singkat' => $request->deskripsi_singkat,
        'landing'           => $request->landing,
    ]);

    return redirect('/admin/layanan')
        ->with('success', 'Layanan berhasil diperbarui!');
}

    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();
        return redirect('/admin/layanan')
            ->with('success', 'Layanan berhasil dihapus!');
    }
}
