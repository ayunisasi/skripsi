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
    Schema::create('diskons', function (Blueprint $table) {
        $table->id();

        $table->string('nama_diskon');

        $table->enum('jenis', [
            'diskon',
            'event',
            'langganan'
        ]);

        $table->enum('tipe_potongan', [
            'persen',
            'nominal'
        ]);

        $table->decimal('nilai', 10, 2);

        $table->decimal('minimal_transaksi', 10, 2)->nullable();

        $table->integer('minimal_kunjungan')->nullable();

        $table->date('tanggal_mulai')->nullable();

        $table->date('tanggal_selesai')->nullable();

        $table->boolean('status')->default(true);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskons');
    }
};
