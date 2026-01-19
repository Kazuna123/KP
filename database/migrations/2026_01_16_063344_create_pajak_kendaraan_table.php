<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pajak_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')
                  ->constrained('kendaraan')
                  ->onDelete('cascade');

            $table->enum('jenis', ['tahunan','lima_tahunan']);
            $table->date('tanggal_bayar');
            $table->date('tanggal_jatuh_tempo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pajak_kendaraan');
    }
};
