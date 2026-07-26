<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Diskon;

class AuthController extends Controller
{
    // =====================
    // LANDING PAGE
    // =====================
   public function landing()
{
    $diskon = Diskon::where('status', true)
        ->where(function ($query) {
            $query->whereNull('tanggal_mulai')
                ->orWhere('tanggal_mulai', '<=', now());
        })
        ->where(function ($query) {
            $query->whereNull('tanggal_selesai')
                ->orWhere('tanggal_selesai', '>=', now());
        })
        ->first();

    return view('landing', compact('diskon'));
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
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/booking');
        }

        return back()->with('error', 'Username atau password salah!');
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
        $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'username'     => 'required|string|unique:users|max:50',
            'email'        => 'required|email|unique:users',
            'no_telp'      => 'required|string|max:15',
            'password'     => 'required|min:6|confirmed',
        ], [
            'username.unique'    => 'Username sudah digunakan.',
            'email.unique'       => 'Email sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'email'        => $request->email,
            'no_telp'      => $request->no_telp,
            'password'     => Hash::make($request->password),
            'role'         => 'pelanggan',
        ]);

        return redirect('/login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // =====================
    // LOGOUT
    // =====================
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
