<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            $table->string('gambar')->nullable()->after('durasi');

            $table->text('deskripsi_singkat')->nullable()->after('gambar');

            $table->boolean('landing')->default(true)->after('deskripsi_singkat');

            $table->integer('urutan')->default(1)->after('landing');

        });
    }

    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {

            $table->dropColumn([
                'gambar',
                'deskripsi_singkat',
                'landing',
                'urutan'
            ]);

        });
    }
};
