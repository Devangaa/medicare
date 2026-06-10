<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Akun;
use App\Models\DetailObat;
use App\Models\Obat;
use App\Models\PembelianObat;
use App\Models\PembuanganObat;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalObat = Obat::count();

        $totalBatch = DetailObat::count();

        $totalStaff = Akun::where(
            'role',
            'staff'
        )->where(
            'is_delete',
            false
        )->count();

        $totalTransaksi = Transaksi::count();

        $totalStok = DetailObat::sum(
            'jumlah_stok'
        );

        $pendapatan = DB::table('detail_transaksi')
            ->sum('total_harga');

        $pendingPembelian = PembelianObat::where(
            'status',
            'pending'
        )->count();

        $pendingPembuangan = PembuanganObat::where(
            'status',
            'pending'
        )->count();

        $stokMenipis = DetailObat::where(
            'jumlah_stok',
            '<=',
            20
        )->count();

        $expired30Hari = DetailObat::whereBetween(
            'tanggal_kadaluwarsa',
            [
                now(),
                now()->addDays(30)
            ]
        )->count();

        $expired = DetailObat::where(
            'tanggal_kadaluwarsa',
            '<',
            now()
        )->count();

        $user = Auth::user();

        return view(
            'owner.dashboard',
            compact(
                'totalObat',
                'totalBatch',
                'totalStaff',
                'totalTransaksi',
                'totalStok',
                'pendapatan',
                'pendingPembelian',
                'pendingPembuangan',
                'stokMenipis',
                'expired30Hari',
                'expired',
                'user'
            )
        );
    }
}