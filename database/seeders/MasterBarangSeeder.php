<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('master_barang')->insert([
            [
                'nama_rokok' => 'Original Sosrobahu',
                'harga_karton_pabrik' => 150000,
                'stok_karton' => 50,
                'gambar' => 'original_sosrobahu.png',
                'stok_slop' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Kupu Biru Sosrobahu',
                'harga_karton_pabrik' => 140000,
                'stok_karton' => 70,
                'gambar' => 'kupubiru_sosrobahu.jpg',
                'stok_slop' => 420,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Bahamas Sosrobahu',
                'harga_karton_pabrik' => 135000,
                'stok_karton' => 60,
                'gambar' => 'bahamas_sosrobahu.jpg',
                'stok_slop' => 360,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'D&H Kretek Sosrobahu',
                'harga_karton_pabrik' => 145000,
                'stok_karton' => 55,
                'gambar' => 'dhkretek_sosrobahu.jpg',
                'stok_slop' => 330,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
