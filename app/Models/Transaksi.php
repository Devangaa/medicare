<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal_transaksi',
        'metode_pembayaran',
        'id_akun',
    ];

    protected $casts = [
        'tanggal_transaksi' => 'datetime',
    ];

    public function staff()
    {
        return $this->belongsTo(
            Akun::class,
            'id_akun'
        );
    }

    public function detailTransaksi()
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_transaksi'
        );
    }

    public function getTotalHargaAttribute()
    {
        return $this->detailTransaksi
            ->sum('total_harga');
    }
}