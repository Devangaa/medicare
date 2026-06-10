<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailObat extends Model
{
    protected $table = 'detail_obat';

    protected $fillable = [
        'id_obat',
        'batch',
        'jumlah_stok',
        'tanggal_kadaluwarsa',
    ];

    public function obat()
    {
        return $this->belongsTo(
            Obat::class,
            'id_obat'
        );
    }

    public function detailTransaksi()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_detail_obat'
        );
    }

    public function pembuanganObat()
    {
        return $this->hasMany(
            PembuanganObat::class,
            'id_detail_obat'
        );
    }
}