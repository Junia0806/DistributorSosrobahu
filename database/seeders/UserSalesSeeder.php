<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_sales')->insert([
            [
                'nama_lengkap' => 'Andi Kusuma',
                'username' => 'andikusuma',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456780',
                'status' => 1,
                'level' => 1,
                'gambar_ktp' => 'ktp_andi_kusuma.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Budi Santoso',
                'username' => 'budisantoso',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456781',
                'status' => 1,
                'level' => 2,
                'gambar_ktp' => 'ktp_budi_santoso.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Citra Dewi',
                'username' => 'citradewi',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456782',
                'status' => 0,
                'level' => 1,
                'gambar_ktp' => 'ktp_citra_dewi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Dedi Setiawan',
                'username' => 'dedisetiawan',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456783',
                'status' => 1,
                'level' => 3,
                'gambar_ktp' => 'ktp_dedi_setiawan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Eka Putri',
                'username' => 'ekaputri',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456784',
                'status' => 0,
                'level' => 2,
                'gambar_ktp' => 'ktp_eka_putri.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
