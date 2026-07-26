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
    Schema::table('bookings', function (Blueprint $table) {

        $table->foreignId('diskon_id')
              ->nullable()
              ->constrained('diskons')
              ->nullOnDelete();

        $table->decimal('potongan', 12, 2)
              ->default(0);

        $table->decimal('total_bayar', 12, 2)
              ->default(0);

    });
}
    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('bookings', function (Blueprint $table) {

        $table->dropForeign(['diskon_id']);

        $table->dropColumn([
            'diskon_id',
            'potongan',
            'total_bayar',
        ]);

    });
}
};
