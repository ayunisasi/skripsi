<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Diskon;
use App\Models\Layanan;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

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

    public function showForgotPassword()
{
    return view('auth.forgot-password');
}

    public function cekEmail(Request $request)
{
    $email = $request->email;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return response()->json([
            'status' => 'invalid',
            'message' => 'Format email tidak valid.'
        ]);
    }

    $exists = User::where('email', $email)->exists();

    return response()->json([
        'status' => $exists ? 'exists' : 'available',
        'message' => $exists
            ? 'Email sudah terdaftar.'
            : ''
    ]);
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

    public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    if ($status === Password::RESET_LINK_SENT) {
        return back()->with('success', 'Link reset password berhasil dikirim ke email Anda.');
    }

    return back()->withErrors([
        'email' => 'Email tidak ditemukan dalam sistem.'
    ]);
}

public function showResetPassword(Request $request, $token)
{
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email
    ]);
}

public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        }
    );

    if ($status === Password::PASSWORD_RESET) {
        return redirect()->route('login')
            ->with('success', 'Password berhasil diubah. Silakan login kembali.');
    }

    return back()->withErrors([
        'email' => 'Link reset password tidak valid atau sudah kedaluwarsa.'
    ]);
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
