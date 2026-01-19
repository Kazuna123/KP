<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kendaraan_maintenance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kendaraan_id')
                  ->constrained('kendaraan')
                  ->onDelete('cascade');

            $table->date('tanggal');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kendaraan_maintenance');
    }
};
