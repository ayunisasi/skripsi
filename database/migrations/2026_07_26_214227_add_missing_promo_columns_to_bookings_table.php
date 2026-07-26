<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            if (!Schema::hasColumn('bookings', 'diskon_id')) {
                $table->foreignId('diskon_id')
                    ->nullable()
                    ->constrained('diskons')
                    ->nullOnDelete();
            }

            if (!Schema::hasColumn('bookings', 'potongan')) {
                $table->decimal('potongan', 12, 2)->default(0);
            }

            if (!Schema::hasColumn('bookings', 'total_bayar')) {
                $table->decimal('total_bayar', 12, 2)->default(0);
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {

            if (Schema::hasColumn('bookings', 'diskon_id')) {
                $table->dropForeign(['diskon_id']);
                $table->dropColumn('diskon_id');
            }

            if (Schema::hasColumn('bookings', 'potongan')) {
                $table->dropColumn('potongan');
            }

            if (Schema::hasColumn('bookings', 'total_bayar')) {
                $table->dropColumn('total_bayar');
            }
        });
    }
};
