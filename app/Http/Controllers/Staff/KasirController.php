<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\DetailObat;
use App\Models\DetailTransaksi;
use App\Models\Obat;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        $obat = Obat::where('status', 'approved')
            ->where('is_delete', false)
            ->latest()
            ->get();

        return view('staff.kasir', compact('obat'));
    }

    public function getBatch($id)
    {
        $batch = DetailObat::where('id_obat', $id)
            ->where('jumlah_stok', '>', 0)
            ->whereDate('tanggal_kadaluwarsa', '>', now())
            ->orderBy('tanggal_kadaluwarsa', 'asc')
            ->get();

        return response()->json($batch);
    }

    public function checkout(Request $request)
    {
        /*
        request format:
        items: [
            { id_obat, qty }
        ],
        payment_method: 'cash|transfer|qris'
        */

        $request->validate([
            'items' => 'required|array',
            'payment_method' => 'required|in:cash,transfer,qris',
        ]);

        DB::transaction(function () use ($request) {

            $transaksi = Transaksi::create([
                'tanggal_transaksi' => now(),
                'metode_pembayaran' => $request->payment_method,
                'id_akun' => Auth::id(),
            ]);

            foreach ($request->items as $item) {

                $sisa = $item['qty'];

                $batchList = DetailObat::where('id_obat', $item['id_obat'])
                    ->where('jumlah_stok', '>', 0)
                    ->whereDate('tanggal_kadaluwarsa', '>', now())
                    ->orderBy('tanggal_kadaluwarsa', 'asc')
                    ->lockForUpdate()
                    ->get();

                foreach ($batchList as $batch) {
                    if ($sisa <= 0) {
                        break;
                    }

                    $ambil = min($batch->jumlah_stok, $sisa);

                    $batch->decrement('jumlah_stok', $ambil);

                    DetailTransaksi::create([
                        'id_transaksi' => $transaksi->id,
                        'id_detail_obat' => $batch->id,
                        'jumlah_obat' => $ambil,
                        'total_harga' => $ambil * $batch->obat->harga,
                    ]);

                    $sisa -= $ambil;
                }

                if ($sisa > 0) {
                    throw new \Exception("Stok tidak cukup untuk obat ID {$item['id_obat']}");
                }
            }
        });

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil',
        ]);
    }
}
