<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PembelianObat extends Model
{
    protected $table = 'pembelian_obat';

    protected $fillable = [
        'id_obat',
        'jumlah',
        'status',
        'tanggal_pembelian',
        'tanggal_expired',
        'id_akun',
    ];

    protected $casts = [
        'tanggal_pembelian' => 'date',
        'tanggal_expired' => 'date',
    ];

    public function obat()
    {
        return $this->belongsTo(
            Obat::class,
            'id_obat'
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