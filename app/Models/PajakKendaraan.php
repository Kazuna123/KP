<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kendaraan;

class PajakKendaraan extends Model
{
    use HasFactory;

    protected $table = 'pajak_kendaraan';

    protected $fillable = [
        'kendaraan_id',
        'jenis',      // tahunan / 5 tahunan
        'tanggal_bayar',
        'tanggal_jatuh_tempo'
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // Pajak dimiliki oleh satu kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }
}
