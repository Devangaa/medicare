<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with([
                'staff',
                'detailTransaksi.detailObat.obat'
            ])
            ->where('id_akun', Auth::id())
            ->latest('tanggal_transaksi')
            ->get();

        return view(
            'staff.transaksi',
            compact('transaksi')
        );
    }
}