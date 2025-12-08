<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->string('jenis_kendaraan')->nullable()->after('tipe');
            $table->string('nomor_rangka')->nullable()->after('tahun');
            $table->string('nomor_mesin')->nullable()->after('nomor_rangka');
            $table->string('fungsi')->nullable()->after('nomor_mesin');
            $table->text('ket')->nullable()->after('fungsi');
        });
    }

    public function down(): void
    {
        Schema::table('kendaraan', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kendaraan',
                'nomor_rangka',
                'nomor_mesin',
                'fungsi',
                'ket'
            ]);
        });
    }
};
