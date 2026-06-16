<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Untuk mencatat produk/layanan yang ditambah admin di lokasi
public function up(): void
{
    Schema::create('produk_tambahan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('booking_id')
              ->constrained('bookings')->onDelete('cascade');
        $table->string('nama_item');
        $table->integer('harga');
        $table->enum('tipe', ['layanan', 'produk'])->default('produk');
        $table->text('catatan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk_tambahan');
    }
};
