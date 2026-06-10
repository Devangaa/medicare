<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\DetailObat;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        $staffs = Akun::all();

        $detailObatList = DetailObat::with('obat')->get();

        if (
            $staffs->isEmpty() ||
            $detailObatList->isEmpty()
        ) {
            return;
        }

        for ($i = 1; $i <= 50; $i++) {

            $transaksi = Transaksi::create([
                'tanggal_transaksi' => now()
                    ->subDays(rand(0, 90))
                    ->subHours(rand(0, 23))
                    ->subMinutes(rand(0, 59)),

                'metode_pembayaran' => collect([
                    'Tunai',
                    'QRIS',
                    'Transfer',
                    'Debit'
                ])->random(),

                'id_akun' => $staffs
                    ->random()
                    ->id,
            ]);

            $jumlahItem = rand(1, 5);

            $selectedObat = $detailObatList
                ->random($jumlahItem);

            foreach ($selectedObat as $detailObat) {

                $jumlahBeli = rand(1, 5);

                $hargaSatuan =
                    $detailObat
                        ->obat
                        ->harga;

                DetailTransaksi::create([
                    'id_transaksi' => $transaksi->id,

                    'id_detail_obat' =>
                        $detailObat->id,

                    'jumlah_obat' =>
                        $jumlahBeli,

                    'total_harga' =>
                        $hargaSatuan *
                        $jumlahBeli,
                ]);
            }
        }
    }
}