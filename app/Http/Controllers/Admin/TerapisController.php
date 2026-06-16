<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Terapis;
use Illuminate\Http\Request;

class TerapisController extends Controller
{
    public function index()
    {
        $terapis = Terapis::latest()->paginate(10);
        return view('admin.terapis.index', compact('terapis'));
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
