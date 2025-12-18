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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pegawai_id')->constrained('pegawai')->cascadeOnDelete();
            $table->foreignId('kendaraan_id')->constrained('kendaraan')->cascadeOnDelete();

            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali')->nullable();

            $table->text('keterangan')->nullable();

            $table->enum('status', ['dipinjam','selesai','dibatalkan'])->default('dipinjam');

            $table->foreignId('user_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
