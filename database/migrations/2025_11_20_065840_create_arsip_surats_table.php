<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_surat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->string('jenis'); // 'pemutihan' atau 'spbkb'
            $table->string('nomor_surat');
            $table->date('tanggal_surat');
            $table->string('sekretaris');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            // foreign key optional (hapus jika ingin simple)
            $table->foreign('kendaraan_id')->references('id')->on('kendaraan')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_surat');
    }
};
