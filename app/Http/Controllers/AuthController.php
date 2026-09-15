<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Diskon;
use App\Models\Layanan;

class AuthController extends Controller
{
    // =====================
    // LANDING PAGE
    // =====================
   public function landing()
{
   $diskons = Diskon::where('status', true)
    ->where(function ($query) {
        $query->whereNull('tanggal_mulai')
              ->orWhere('tanggal_mulai', '<=', now());
    })
    ->where(function ($query) {
        $query->whereNull('tanggal_selesai')
              ->orWhere('tanggal_selesai', '>=', now());
    })
    ->orderBy('created_at', 'desc')
    ->get();

    $layananLanding = Layanan::where('landing', true)
        ->orderBy('urutan')
        ->get();

    return view('landing', [
    'diskons' => $diskons,
    'layananLanding' => $layananLanding,
]);
}

    // =====================
    // LOGIN
    // =====================
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // 2. Coba autentikasi pengguna
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role user
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }

            return redirect()->intended('/booking');
        }

        // 3. Jika gagal autentikasi
        return back()->with('error', 'Email atau password salah!')->withInput($request->only('email'));
    }

    // =====================
    // REGISTER
    // =====================
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email'        => 'required|email|unique:users,email',
            'no_telp'      => 'required|digits_between:10,15',
            'password'     => 'required|min:6|confirmed',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'email.required'        => 'Email wajib diisi.',
            'email.unique'          => 'Email sudah terdaftar.',
            'no_telp.required'      => 'Nomor telepon wajib diisi.',
            'password.required'     => 'Password wajib diisi.',
            'password.confirmed'    => 'Konfirmasi password tidak cocok.',
            'password.min'          => 'Password minimal 6 karakter.',
        ]);

        // Simpan data pelanggan baru
        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
            'password'     => Hash::make($request->password),
            'role'         => 'pelanggan',
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
