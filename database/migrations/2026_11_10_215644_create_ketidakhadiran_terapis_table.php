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
        Schema::create('ketidakhadiran_terapis', function (Blueprint $table) {
    $table->id();

    $table->foreignId('terapis_id')
        ->constrained('terapis')
        ->cascadeOnDelete();

    $table->date('tanggal');

    $table->enum('alasan', ['Sakit', 'Izin']);

    $table->timestamps();

    // Satu terapis hanya boleh memiliki satu catatan
    // ketidakhadiran pada tanggal yang sama
    $table->unique(['terapis_id', 'tanggal']);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketidakhadiran_terapis');
    }
};
