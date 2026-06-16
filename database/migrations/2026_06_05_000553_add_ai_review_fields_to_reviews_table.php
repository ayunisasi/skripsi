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
    Schema::table('reviews', function (Blueprint $table) {

        $table->boolean('ramah')->default(false);
        $table->boolean('rapi')->default(false);
        $table->boolean('profesional')->default(false);
        $table->boolean('bersih')->default(false);
        $table->boolean('tepat_waktu')->default(false);

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            //
        });
    }
};
