<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserDistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_distributor')->insert([
            [
                'nama_lengkap' => 'Agus Setiawan',
                'username' => 'agussetiawan',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456795',
                'status' => 1,
                'level' => 2,
                'gambar_ktp' => 'ktp_agus_setiawan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Bambang Sutrisno',
                'username' => 'bambangsutrisno',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456796',
                'status' => 1,
                'level' => 1,
                'gambar_ktp' => 'ktp_bambang_sutrisno.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Cahyono Prasetyo',
                'username' => 'cahyonoprasetyo',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456797',
                'status' => 0,
                'level' => 3,
                'gambar_ktp' => 'ktp_cahyono_prasetyo.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Dewi Ayu',
                'username' => 'dewiayu',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456798',
                'status' => 1,
                'level' => 2,
                'gambar_ktp' => 'ktp_dewi_ayu.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Erik Suhendar',
                'username' => 'eriksuhendar',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456799',
                'status' => 0,
                'level' => 1,
                'gambar_ktp' => 'ktp_erik_suhendar.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
