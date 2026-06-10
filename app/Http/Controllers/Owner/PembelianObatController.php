<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PembelianObat;
use App\Models\DetailObat;
use Illuminate\Http\Request;

class PembelianObatController extends Controller
{
    public function index()
    {
        $pendingPembelian = PembelianObat::with([
                'obat',
                'staff'
            ])
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
            ->latest()
            ->get();

        return view(
            'owner.pembelian-obat',
            compact(
                'pendingPembelian',
                'riwayatPembelian'
            )
        );
    }

    public function approve($id)
    {
        $pembelian = PembelianObat::with('obat')
            ->findOrFail($id);

        if ($pembelian->status !== 'pending') {
            return back();
        }

        $batch = $this->generateBatch(
            $pembelian->obat->kode_obat
        );

        DetailObat::create([
            'id_obat' => $pembelian->id_obat,
            'batch' => $batch,
            'jumlah_stok' => $pembelian->jumlah,
            'tanggal_kadaluwarsa' => $pembelian->tanggal_expired,
        ]);

        $pembelian->update([
            'status' => 'approved'
        ]);

        return back()->with(
            'success',
            'Pembelian obat berhasil disetujui.'
        );
    }

    public function reject($id)
    {
        $pembelian = PembelianObat::findOrFail($id);

        $pembelian->update([
            'status' => 'rejected'
        ]);

        return back()->with(
            'success',
            'Pembelian obat berhasil ditolak.'
        );
    }

    private function generateBatch($kodeObat)
    {
        return strtoupper(
            $kodeObat .
            '-' .
            now()->format('ymdHis')
        );
    }
}