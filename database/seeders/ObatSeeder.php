<?php

namespace Database\Seeders;

use App\Models\Akun;
use App\Models\Obat;
use App\Models\DetailObat;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        $staff = Akun::where('role', 'staff')->first();

        if (!$staff) {
            return;
        }

        $obatList = [

            [
                'nama_obat' => 'Paracetamol 500mg',
                'kode_obat' => 'OBT001',
                'harga' => 5000,
                'berat' => 100,
                'kategori' => 'Analgesik',
                'unit_satuan' => 'Strip',
                'status' => 'approved',
                'is_delete' => false,
            ],

            [
                'nama_obat' => 'Amoxicillin 500mg',
                'kode_obat' => 'OBT002',
                'harga' => 12000,
                'berat' => 100,
                'kategori' => 'Antibiotik',
                'unit_satuan' => 'Strip',
                'status' => 'approved',
                'is_delete' => false,
            ],

            [
                'nama_obat' => 'Vitamin C',
                'kode_obat' => 'OBT003',
                'harga' => 15000,
                'berat' => 200,
                'kategori' => 'Vitamin',
                'unit_satuan' => 'Botol',
                'status' => 'approved',
                'is_delete' => false,
            ],

            [
                'nama_obat' => 'Antasida Doen',
                'kode_obat' => 'OBT004',
                'harga' => 8000,
                'berat' => 120,
                'kategori' => 'Lambung',
                'unit_satuan' => 'Strip',
                'status' => 'pending',
                'is_delete' => false,
            ],

            [
                'nama_obat' => 'Ibuprofen 400mg',
                'kode_obat' => 'OBT005',
                'harga' => 10000,
                'berat' => 100,
                'kategori' => 'Analgesik',
                'unit_satuan' => 'Strip',
                'status' => 'pending',
                'is_delete' => false,
            ],

            [
                'nama_obat' => 'Cetirizine',
                'kode_obat' => 'OBT006',
                'harga' => 9000,
                'berat' => 80,
                'kategori' => 'Antihistamin',
                'unit_satuan' => 'Strip',
                'status' => 'approved',
                'is_delete' => true,
            ],
        ];

        foreach ($obatList as $item) {

            $obat = Obat::create([
                'nama_obat' => $item['nama_obat'],
                'kode_obat' => $item['kode_obat'],
                'deskripsi' => 'Deskripsi contoh untuk '.$item['nama_obat'],
                'harga' => $item['harga'],
                'foto_obat' => null,
                'berat' => $item['berat'],
                'kategori' => $item['kategori'],
                'total_terjual' => rand(10, 500),
                'unit_satuan' => $item['unit_satuan'],
                'status' => $item['status'],
                'is_delete' => $item['is_delete'],
                'id_akun' => $staff->id,
            ]);

            if (!$item['is_delete']) {

                DetailObat::create([
                    'id_obat' => $obat->id,
                    'batch' => 'BATCH-'.rand(1000, 9999),
                    'jumlah_stok' => rand(20, 100),
                    'tanggal_kadaluwarsa' => now()->addMonths(rand(6, 24)),
                ]);

                DetailObat::create([
                    'id_obat' => $obat->id,
                    'batch' => 'BATCH-'.rand(1000, 9999),
                    'jumlah_stok' => rand(20, 100),
                    'tanggal_kadaluwarsa' => now()->addMonths(rand(6, 24)),
                ]);

                DetailObat::create([
                    'id_obat' => $obat->id,
                    'batch' => 'BATCH-'.rand(1000, 9999),
                    'jumlah_stok' => rand(20, 100),
                    'tanggal_kadaluwarsa' => now()->addMonths(rand(6, 24)),
                ]);
            }
        }
    }
}