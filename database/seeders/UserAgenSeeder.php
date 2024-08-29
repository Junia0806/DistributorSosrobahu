<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_agen')->insert([
            [
                'nama_lengkap' => 'Fajar Pratama',
                'username' => 'fajarpratama',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456790',
                'status' => 1,
                'level' => 2,
                'gambar_ktp' => 'ktp_fajar_pratama.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Gilang Ramadhan',
                'username' => 'gilangramadhan',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456791',
                'status' => 0,
                'level' => 1,
                'gambar_ktp' => 'ktp_gilang_ramadhan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Hendra Wijaya',
                'username' => 'hendrawijaya',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456792',
                'status' => 1,
                'level' => 3,
                'gambar_ktp' => 'ktp_hendra_wijaya.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Indah Lestari',
                'username' => 'indahlestari',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456793',
                'status' => 1,
                'level' => 2,
                'gambar_ktp' => 'ktp_indah_lestari.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Joko Susanto',
                'username' => 'jokosusanto',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456794',
                'status' => 0,
                'level' => 1,
                'gambar_ktp' => 'ktp_joko_susanto.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
