<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\DetailObat;
use App\Models\Obat;
use App\Models\PembuanganObat;

class PembuanganObatController extends Controller
{
    public function index()
    {
        $pendingPembuangan = PembuanganObat::with([
            'staff',
            'detailObat.obat',
        ])
            ->where('status', 'pending')
            ->latest()
            ->get();

        $riwayatPembuangan = PembuanganObat::with([
            'staff',
            'detailObat.obat',
        ])
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
            'owner.pembuangan-obat',
            compact(
                'pendingPembuangan',
                'riwayatPembuangan',
                'obatAktif',
                'detailObat'
            )
        );
    }

    public function approve($id)
    {
        $pembuangan = PembuanganObat::with(
            'detailObat'
        )->findOrFail($id);

        if ($pembuangan->status !== 'pending') {
            return back();
        }

        $detailObat = $pembuangan->detailObat;

        if (
            $detailObat->jumlah_stok <
            $pembuangan->jumlah
        ) {
            return back()->with(
                'error',
                'Stok batch tidak mencukupi.'
            );
        }

        $detailObat->decrement(
            'jumlah_stok',
            $pembuangan->jumlah
        );

        $pembuangan->update([
            'status' => 'approved',
        ]);

        return back()->with(
            'success',
            'Pembuangan obat berhasil disetujui.'
        );
    }

    public function reject($id)
    {
        $pembuangan = PembuanganObat::findOrFail($id);

        $pembuangan->update([
            'status' => 'rejected',
        ]);

        return back()->with(
            'success',
            'Pembuangan obat berhasil ditolak.'
        );
    }
}
