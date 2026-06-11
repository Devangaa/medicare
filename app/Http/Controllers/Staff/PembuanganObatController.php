<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\DetailObat;
use App\Models\Obat;
use App\Models\PembuanganObat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembuanganObatController extends Controller
{
    public function index()
    {
        $pendingPembuangan = PembuanganObat::with([
            'staff',
            'detailObat.obat',
        ])
            ->where('id_akun', Auth::id())
            ->where('status', 'pending')
            ->latest()
            ->get();

        $riwayatPembuangan = PembuanganObat::with([
            'staff',
            'detailObat.obat',
        ])
            ->where('id_akun', Auth::id())
            ->whereIn('status', [
                'approved',
                'rejected',
            ])
            ->latest()
            ->get();

        $obatAktif = Obat::where('status', 'approved')
            ->where('is_delete', false)
            ->latest()
            ->get();

        $detailObat = DetailObat::with('obat')
            ->whereHas('obat')
            ->where('jumlah_stok', '>', 0)
            ->get();

        return view(
            'staff.pembuangan-obat',
            compact(
                'pendingPembuangan',
                'riwayatPembuangan',
                'obatAktif',
                'detailObat'
            )
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_detail_obat' => 'required|exists:detail_obat,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $detail = DetailObat::findOrFail($request->id_detail_obat);

        // VALIDASI STOK
        if ($request->jumlah > $detail->jumlah_stok) {
            return back()->withErrors([
                'jumlah' => 'Jumlah melebihi stok yang tersedia',
            ]);
        }

        // CREATE PEMBUANGAN
        PembuanganObat::create([
            'id_detail_obat' => $detail->id,
            'jumlah' => $request->jumlah,
            'status' => 'pending', // bisa langsung approve kalau mau
            'tanggal_pembuangan' => now(),
            'id_akun' => Auth::id(),
        ]);

        return back()->with('success', 'Pembuangan obat berhasil diajukan.');
    }

    public function getBatchByObat($id_obat)
    {
        $batch = DetailObat::where('id_obat', $id_obat)
            ->where('jumlah_stok', '>', 0)
            ->get(['id', 'batch', 'jumlah_stok', 'tanggal_kadaluwarsa']);

        return response()->json($batch);
    }
}
