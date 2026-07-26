<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedInteger('jumlah_kunjungan')
                ->default(0)
                ->after('role');

            $table->unsignedInteger('voucher_langganan')
                ->default(0)
                ->after('jumlah_kunjungan');

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'jumlah_kunjungan',
                'voucher_langganan'
            ]);

        });
    }
};
