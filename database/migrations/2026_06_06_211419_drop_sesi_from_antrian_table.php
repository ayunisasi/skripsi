<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up() {
    Schema::table('antrian', function (Blueprint $table) {
        $table->dropColumn('sesi');
    });
}

public function down() {
    Schema::table('antrian', function (Blueprint $table) {
        $table->string('sesi')->nullable();
    });
}
};
