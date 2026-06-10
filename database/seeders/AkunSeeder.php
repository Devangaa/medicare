<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('akun')->insert([
            [
                'username' => 'owner',
                'password' => Hash::make('owner123'), // Password untuk login owner
                'role' => 'owner',
                'nama_lengkap' => 'Dr. Derrick Timothy, M.Kes',
                'email' => 'owner@medicare.com',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Raya Jember No. 45, Jember',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'staff',
                'password' => Hash::make('staff123'), // Password untuk login staff
                'role' => 'staff',
                'nama_lengkap' => 'Siti Aminah, A.Md.Farm',
                'email' => 'staff@medicare.com',
                'no_hp' => '089876543210',
                'alamat' => 'Jl. Mastrip No. 12, Jember',
                'is_delete' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
