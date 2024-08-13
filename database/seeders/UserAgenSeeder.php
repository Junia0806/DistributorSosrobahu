<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_agen')->insert([
            [
            'nama_lengkap' => 'Alikhazain Ilmi', 
            'username' => 'AgenSidoarjo',
            'password' => '123456',
            'no_telp' => '08123456',
            'status' => 1,
            'level' => 2,
            'gambar_ktp' => 'ktpAli.jpg',
            ],
            // Tambahkan data sesuai kebutuhan
        ]);
    }
}
