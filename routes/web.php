<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LayananController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\TerapisController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\AntrianAdminController;
use App\Http\Controllers\Admin\PembayaranAdminController;
use App\Http\Controllers\Admin\DiskonController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\ProfileController;
// =====================
// PUBLIC ROUTES
// =====================
Route::get('/', [AuthController::class, 'landing'])->name('landing');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/cek-email', [AuthController::class, 'cekEmail']);
// LUPA PASSWORD
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])
    ->name('password.email');

    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])
    ->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])
    ->name('password.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Midtrans webhook (tidak perlu auth)
Route::post('/midtrans/callback', [MidtransController::class, 'callback'])
     ->name('midtrans.callback');

// =====================
// PELANGGAN ROUTES
// =====================
Route::middleware(['auth', 'pelanggan'])->group(function () {
        // Profil Pelanggan
    Route::get('/profil', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profil', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::get('/booking', [BookingController::class, 'index'])
         ->name('booking.index');
    Route::post('/booking/cek-ketersediaan', [BookingController::class, 'cekKetersediaan'])
         ->name('booking.cek');
    Route::post('/booking', [BookingController::class, 'store'])
         ->name('booking.store');
         Route::post('/booking/cek-promo', [BookingController::class, 'cekPromo'])
         ->name('booking.cekPromo');
    Route::get('/booking/riwayat', [BookingController::class, 'riwayat'])
         ->name('booking.riwayat');
    Route::get('/booking/antrian/{kd_booking}', [AntrianController::class, 'show'])
         ->name('antrian.show');
    Route::post('/booking/{id}/batalkan', [BookingController::class, 'batalkan'])
         ->name('booking.batalkan');
    Route::get('/booking/{id}/lunasi', [MidtransController::class, 'lunasiForm'])
         ->name('booking.lunasi');
    Route::post('/booking/{id}/lunasi', [MidtransController::class, 'lunasiProses'])
         ->name('booking.lunasi.proses');
         Route::get('/payment/{id}', [MidtransController::class, 'form'])
     ->name('midtrans.form');
Route::get('/booking/{id}/lunasi', [MidtransController::class, 'lunasiForm'])
     ->name('booking.lunasi');
Route::post('/booking/{id}/lunasi', [MidtransController::class, 'lunasiProses'])
     ->name('booking.lunasi.proses');
     Route::delete('/booking/{id}/hapus', [BookingController::class, 'destroy'])
    ->name('booking.destroy');
});

// =====================
// ADMIN ROUTES
// =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('admin.dashboard');

    // Users
    Route::resource('users', UserController::class);

    // Layanan
    Route::resource('layanan', LayananController::class);

    // Terapis
    Route::resource('terapis', TerapisController::class);
    // Ketersediaan Terapis
Route::post('/terapis/{id}/unavailable', [TerapisController::class, 'unavailable'])
    ->name('admin.terapis.unavailable');

Route::post('/terapis/{id}/available', [TerapisController::class, 'available'])
    ->name('admin.terapis.available');

    // Booking
    Route::get('/booking', [BookingAdminController::class, 'index'])
         ->name('admin.booking.index');
    Route::post('/booking/{id}/setujui', [BookingAdminController::class, 'setujui'])
         ->name('admin.booking.setujui');
    Route::post('/booking/{id}/batalkan', [BookingAdminController::class, 'batalkan'])
         ->name('admin.booking.batalkan');
    Route::get('/booking/{id}/detail', [BookingAdminController::class, 'detail'])
         ->name('admin.booking.detail');

         Route::post('/booking/{id}/ganti-terapis', [BookingAdminController::class, 'gantiTerapis'])
    ->name('admin.booking.ganti_terapis');
    Route::post('/booking/{id}/tambah-item', [BookingAdminController::class, 'tambahItem'])
         ->name('admin.booking.tambah_item');
    Route::post('/booking/{id}/konfirmasi-cash', [BookingAdminController::class, 'konfirmasiCash'])
         ->name('admin.booking.konfirmasi_cash');
    Route::delete('/booking/{id}/hapus', [BookingController::class, 'destroy'])
        ->name('booking.destroy');


    // Antrian
    Route::get('/antrian', [AntrianAdminController::class, 'index'])
         ->name('admin.antrian.index');

         // Antrian
Route::get('/antrian', [AntrianAdminController::class, 'index'])
    ->name('admin.antrian.index');

// Panggil antrean berikutnya berdasarkan terapis
Route::post('/antrian/{terapisId}/panggil-berikutnya',
    [AntrianAdminController::class, 'panggilBerikutnya'])
    ->name('admin.antrian.panggilBerikutnya');
    Route::post('/antrian/{id}/panggil', [AntrianAdminController::class, 'panggil'])
         ->name('admin.antrian.panggil');
    Route::post('/antrian/{id}/layani', [AntrianAdminController::class, 'layani'])
     ->name('admin.antrian.layani');

    Route::post('/antrian/{id}/selesai', [AntrianAdminController::class, 'selesai'])
        ->name('admin.antrian.selesai');

    Route::post('/antrian/{id}/keterlambatan', [AntrianAdminController::class, 'prosesKeterlambatan'])
        ->name('admin.antrian.keterlambatan');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranAdminController::class, 'index'])
         ->name('admin.pembayaran.index');
    Route::get('/pembayaran/{id}', [PembayaranAdminController::class, 'detail'])
         ->name('admin.pembayaran.detail');

         Route::delete('/booking/{id}', [BookingAdminController::class, 'destroy'])
     ->name('admin.booking.destroy');

     // Diskon
    Route::resource('diskon', DiskonController::class);

    // laporan
    Route::get('/laporan', [LaporanController::class, 'index'])
    ->name('admin.laporan.index');

    Route::get('/laporan/pdf', [LaporanController::class, 'cetakPdf'])
    ->name('admin.laporan.pdf');
});

Route::middleware('auth')->group(function () {

    Route::get('/review/{booking}', [ReviewController::class, 'create']);
    Route::post('/review/{booking}', [ReviewController::class, 'store']);

});
