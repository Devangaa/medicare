<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PembelianObat;
use App\Models\PembuanganObat;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $akun = Auth::user();

        $totalTransaksi = Transaksi::where(
            'id_akun',
            $akun->id
        )->count();

        $totalPembelian = PembelianObat::where(
            'id_akun',
            $akun->id
        )->count();

        $totalPembuangan = PembuanganObat::where(
            'id_akun',
            $akun->id
        )->count();

        return view(
            'staff.dashboard',
            compact(
                'akun',
                'totalTransaksi',
                'totalPembelian',
                'totalPembuangan'
            )
        );
    }
}