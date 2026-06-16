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
  Schema::create('review_terapis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('booking_id')
          ->constrained('bookings')
          ->onDelete('cascade');

    $table->foreignId('user_id')
          ->constrained('users')
          ->onDelete('cascade');

    $table->foreignId('terapis_id')
          ->constrained('terapis')
          ->onDelete('cascade');

    $table->integer('rating');

    $table->boolean('ramah')->default(false);
    $table->boolean('rapi')->default(false);
    $table->boolean('profesional')->default(false);
    $table->boolean('bersih')->default(false);
    $table->boolean('tepat_waktu')->default(false);

    $table->text('komentar')->nullable();

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
