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
    Schema::create('antrian', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')
              ->constrained('bookings')->onDelete('cascade');
        $table->foreignId('terapis_id')
              ->constrained('terapis')->onDelete('cascade');
        $table->date('tgl_antrian');
        $table->enum('sesi', ['pagi', 'siang', 'sore']);
        $table->integer('nomor_antrian');
        $table->time('estimasi_jam_mulai');
        $table->time('estimasi_jam_selesai');
        $table->integer('total_durasi'); // menit
        $table->enum('status', [
            'menunggu', 'dilayani', 'selesai', 'dibatalkan'
        ])->default('menunggu');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian');
    }
};
