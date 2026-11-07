<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function edit()
    {
        return view('pelanggan.profil');
    }

    // Menyimpan perubahan profil
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_lengkap' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'no_telp' => 'nullable|string|max:15',

            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'password_lama' => 'nullable|required_with:password|string',

            'password' => 'nullable|required_with:password_lama|string|min:6|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan akun lain.',
            'no_telp.max' => 'Nomor HP maksimal 15 karakter.',
            'foto_profil.image' => 'File harus berupa gambar.',
            'foto_profil.mimes' => 'Foto harus berformat JPG, JPEG, PNG, atau WEBP.',
            'foto_profil.max' => 'Ukuran foto maksimal 2 MB.',
            'password_lama.required_with' => 'Password lama wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password baru minimal 6 karakter.',
        ]);

        // Validasi password lama jika ingin mengganti password
        if ($request->filled('password')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()
                    ->withErrors(['password_lama' => 'Password lama tidak sesuai.'])
                    ->withInput();
            }

            $user->password = Hash::make($request->password);
        }

        // Upload foto profil
        if ($request->hasFile('foto_profil')) {

            // Hapus foto lama jika ada
            if ($user->foto_profil &&
                \Storage::disk('public')->exists($user->foto_profil)) {

                \Storage::disk('public')->delete($user->foto_profil);
            }

            $foto = $request->file('foto_profil')
                ->store('foto-profil', 'public');

            $user->foto_profil = $foto;
        }

        // Simpan data profil
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;

        $user->save();

        return redirect()
            ->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}