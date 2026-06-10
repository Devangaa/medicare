<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\PembelianObat;
use App\Models\DetailObat;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembelianObatController extends Controller
{
    public function index()
    {
        $pendingPembelian = PembelianObat::with([
                'obat',
                'staff'
            ])
            ->where('id_akun', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        $riwayatPembelian = PembelianObat::with([
                'obat',
                'staff'
            ])
            ->whereIn('status', [
                'approved',
                'rejected'
            ])
            ->where('id_akun', Auth::id())
            ->latest()
            ->get();

         $obatAktif = Obat::where('status', 'approved')->get();

        return view(
            'staff.pembelian-obat',
            compact(
                'pendingPembelian',
                'riwayatPembelian',
                'obatAktif'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_obat' => 'required|exists:obat,id',
            'jumlah_stok' => 'required|integer|min:1',
            'tanggal_kadaluwarsa' => 'required|date|after:today',
        ]);

        PembelianObat::create([
            'id_obat' => $request->id_obat,
            'jumlah' => $request->jumlah_stok,
            'tanggal_expired' => $request->tanggal_kadaluwarsa,
            'tanggal_pembelian' => now(),
            'id_akun' => Auth::id(),
        ]);

        return back()->with(
            'success',
            'Stok obat berhasil ditambahkan.'
        );
    }
}