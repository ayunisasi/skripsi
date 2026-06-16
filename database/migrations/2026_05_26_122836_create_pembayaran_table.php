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
    Schema::create('pembayaran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')
              ->constrained('bookings')->onDelete('cascade');
        $table->string('kd_pembayaran')->unique();
        $table->integer('jumlah');
        $table->enum('tipe', ['dp', 'pelunasan', 'full'])->default('dp');
        $table->enum('metode', [
            'midtrans', 'tunai'
        ])->default('midtrans');
        $table->enum('status', [
            'menunggu', 'lunas', 'gagal', 'refund'
        ])->default('menunggu');
        $table->string('midtrans_order_id')->nullable();
        $table->string('snap_token', 500)->nullable();
        $table->timestamp('tgl_bayar')->nullable();
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
