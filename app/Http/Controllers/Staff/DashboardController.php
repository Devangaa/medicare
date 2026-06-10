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
        $staffId = Auth::id();

        $totalTransaksi = Transaksi::where(
            'id_akun',
            $staffId
        )->count();

        $totalPembelian = PembelianObat::where(
            'id_akun',
            $staffId
        )->count();

        $totalPembuangan = PembuanganObat::where(
            'id_akun',
            $staffId
        )->count();

        $user = Auth::user();

        return view(
            'staff.dashboard',
            compact(
                'totalTransaksi',
                'totalPembelian',
                'totalPembuangan',
                'user'
            )
        );
    }
}