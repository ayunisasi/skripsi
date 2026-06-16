<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->string('kd_booking')->unique();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('terapis_id')->nullable()
              ->constrained('terapis')->onDelete('set null');
        $table->date('tgl_booking');
        $table->enum('sesi', ['pagi', 'siang', 'sore'])->nullable();
        $table->integer('nomor_antrian')->nullable();
        $table->time('estimasi_jam')->nullable();
        $table->time('jam_mulai')->nullable();
        $table->time('jam_selesai')->nullable();
        $table->integer('total_harga')->default(0);
        $table->integer('total_durasi')->default(0);
        $table->enum('jenis_pembayaran', ['dp', 'full'])->default('dp');
        $table->enum('status_pembayaran', [
            'belum_bayar', 'dp_lunas', 'lunas', 'refund'
        ])->default('belum_bayar');
        $table->integer('jumlah_dibayar')->default(0);
        $table->string('midtrans_order_id')->nullable();
        $table->string('snap_token', 500)->nullable();
        $table->enum('status', [
            'menunggu_pembayaran', 'aktif', 'dibatalkan',
            'dibatalkan_sistem', 'selesai'
        ])->default('menunggu_pembayaran');
        $table->enum('status_kehadiran', [
            'menunggu', 'hadir', 'terlambat', 'tidak_hadir'
        ])->default('menunggu');
        $table->text('alasan_batal')->nullable();
        $table->timestamp('dibatalkan_at')->nullable();
        $table->timestamp('checkin_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
