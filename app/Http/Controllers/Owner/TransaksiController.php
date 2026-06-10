<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with([
                'staff',
                'detailTransaksi.detailObat.obat'
            ])
            ->latest('tanggal_transaksi')
            ->get();

        return view(
            'owner.transaksi',
            compact('transaksi')
        );
    }
}