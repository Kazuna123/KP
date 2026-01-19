<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->enum('kondisi', ['baik','rusak_ringan','rusak_berat'])
                  ->default('baik');

            $table->string('foto_kendaraan')->nullable();
            $table->string('foto_stnk')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn(['kondisi','foto_kendaraan','foto_stnk']);
        });
    }
};
