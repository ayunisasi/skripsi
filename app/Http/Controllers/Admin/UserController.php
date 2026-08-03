<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'pelanggan')->latest();
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('username', 'like', '%'.$request->search.'%')
                  ->orWhere('nama_lengkap', 'like', '%'.$request->search.'%');
            });
        }
        $users = $query->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username'      => 'required|string|max:50|unique:users,username,' . $id,
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email,'.$id,
            'no_telp'      => 'required|string|max:15',
        ]);
        User::findOrFail($id)->update(
            $request->only( 'username', 'nama_lengkap', 'email', 'no_telp')
        );
        return redirect('/admin/users')
            ->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect('/admin/users')
            ->with('success', 'User berhasil dihapus!');
    }
}
