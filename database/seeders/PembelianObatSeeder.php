<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Obat;
use App\Models\PembelianObat;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PembelianObatSeeder extends Seeder
{
    public function run(): void
    {
        $obatList = Obat::all();

        $staffList = Akun::where('role', 'staff')->get();

        if (
            $obatList->isEmpty() ||
            $staffList->isEmpty()
        ) {
            return;
        }

        $statusList = [
            'pending',
        ];

        for ($i = 1; $i <= 15; $i++) {

            $tanggalPembelian = Carbon::now()
                ->subDays(rand(1, 90));

            PembelianObat::create([
                'id_obat' => $obatList->random()->id,

                'jumlah' => rand(20, 300),

                'status' => $statusList[array_rand($statusList)],

                'tanggal_pembelian' => $tanggalPembelian,

                'tanggal_expired' => $tanggalPembelian
                    ->copy()
                    ->addMonths(rand(6, 36)),

                'id_akun' => $staffList->random()->id,
            ]);
        }
    }
}