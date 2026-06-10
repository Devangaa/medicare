<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'kode_obat',
        'deskripsi',
        'harga',
        'foto_obat',
        'berat',
        'kategori',
        'total_terjual',
        'unit_satuan',
        'status',
        'is_delete',
        'id_akun',
    ];

    public function detailObat()
    {
        return $this->hasMany(
            DetailObat::class,
            'id_obat'
        );
    }

    public function creator()
    {
        return $this->belongsTo(
            Akun::class,
            'id_akun'
        );
    }

    public function getTotalStokAttribute()
    {
        return $this->detailObat
            ->sum('jumlah_stok');
    }
}