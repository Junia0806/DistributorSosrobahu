<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserPabrikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_pabrik')->insert([
            [
                'nama_lengkap' => 'John Doe',
                'username' => 'johndoe',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456789',
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Jane Smith',
                'username' => 'janesmith',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456788',
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Robert Johnson',
                'username' => 'robertjohnson',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456787',
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Emily Davis',
                'username' => 'emilydavis',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456786',
                'level' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_lengkap' => 'Michael Brown',
                'username' => 'michaelbrown',
                'password' => Hash::make('password123'),
                'no_telp' => '08123456785',
                'level' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
