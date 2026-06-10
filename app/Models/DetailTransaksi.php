<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'jumlah_obat',
        'total_harga',
        'id_detail_obat',
        'id_transaksi',
    ];

    public function transaksi()
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi'
        );
    }

    public function detailObat()
    {
        return $this->belongsTo(
            DetailObat::class,
            'id_detail_obat'
        );
    }
}