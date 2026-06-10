<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Menampilkan Halaman Utama Dashboard Owner
     */
    public function index()
    {
        // Contoh Pengambilan Data Statistik Riil dari Database Medicare untuk ditampilkan di Dashboard
        // Kamu bisa menyesuaikan nama tabelnya nanti sesuai dengan migrasimu
        $statistik = [
            'total_staff'      => DB::table('akun')->where('role', 'staff')->where('is_delete', false)->count(),
            'total_obat'       => DB::table('obat')->count(), // Contoh jika sudah ada tabel obat
            'total_transaksi'  => DB::table('transaksi')->count(), // Contoh jika sudah ada tabel transaksi
            'pendapatan_bulan_ini' => DB::table('transaksi')->whereMonth('created_at', now()->month)->sum('total_harga') ?? 0
        ];

        // Memanggil view owner.dashboard dan mengirimkan data statistik ke dalamnya
        return view('owner.dashboard', compact('statistik'));
    }
}