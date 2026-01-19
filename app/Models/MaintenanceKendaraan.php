<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceKendaraan extends Model
{
    protected $table = 'kendaraan_maintenance'; // ⬅️ WAJIB

    protected $fillable = [
        'kendaraan_id',
        'tanggal',
        'keterangan',
        'jenis',
        'biaya',
        'status',
        'bukti',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }
}
