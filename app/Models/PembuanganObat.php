<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembuanganObat extends Model
{
    protected $table = 'pembuangan_obat';

    protected $fillable = [
        'id_detail_obat',
        'jumlah',
        'status',
        'tanggal_pembuangan',
        'id_akun',
    ];

    protected $casts = [
        'tanggal_pembuangan' => 'date',
    ];

    public function detailObat()
    {
        return $this->belongsTo(
            DetailObat::class,
            'id_detail_obat'
        );
    }

    public function staff()
    {
        return $this->belongsTo(
            Akun::class,
            'id_akun'
        );
    }
}