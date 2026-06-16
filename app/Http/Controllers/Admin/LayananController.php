<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanan = Layanan::latest()->paginate(10);
        return view('admin.layanan.index', compact('layanan'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'harga'        => 'required|integer|min:1000',
            'durasi'       => 'required|integer|min:5',
        ]);
        Layanan::create($request->all());
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
            'nama_layanan' => 'required|string|max:100',
            'harga'        => 'required|integer|min:1000',
            'durasi'       => 'required|integer|min:5',
        ]);
        Layanan::findOrFail($id)->update($request->all());
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
