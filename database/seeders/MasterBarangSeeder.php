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
                'nama_rokok' => 'Marlboro Red',
                'harga_karton_pabrik' => 150000,
                'stok_karton' => 50,
                'gambar' => 'marlboro_red.jpg',
                'stok_slop' => 300,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Djarum Super',
                'harga_karton_pabrik' => 140000,
                'stok_karton' => 70,
                'gambar' => 'djarum_super.jpg',
                'stok_slop' => 420,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Gudang Garam Filter',
                'harga_karton_pabrik' => 135000,
                'stok_karton' => 60,
                'gambar' => 'gg_filter.jpg',
                'stok_slop' => 360,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Sampoerna Mild',
                'harga_karton_pabrik' => 145000,
                'stok_karton' => 55,
                'gambar' => 'sampoerna_mild.jpg',
                'stok_slop' => 330,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'LA Lights',
                'harga_karton_pabrik' => 125000,
                'stok_karton' => 80,
                'gambar' => 'la_lights.jpg',
                'stok_slop' => 480,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Wismilak Diplomat',
                'harga_karton_pabrik' => 160000,
                'stok_karton' => 40,
                'gambar' => 'wismilak_diplomat.jpg',
                'stok_slop' => 240,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Surya 16',
                'harga_karton_pabrik' => 130000,
                'stok_karton' => 75,
                'gambar' => 'surya_16.jpg',
                'stok_slop' => 450,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Lucky Strike',
                'harga_karton_pabrik' => 155000,
                'stok_karton' => 45,
                'gambar' => 'lucky_strike.jpg',
                'stok_slop' => 270,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Camel',
                'harga_karton_pabrik' => 165000,
                'stok_karton' => 35,
                'gambar' => 'camel.jpg',
                'stok_slop' => 210,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_rokok' => 'Dji Sam Soe',
                'harga_karton_pabrik' => 120000,
                'stok_karton' => 90,
                'gambar' => 'dji_sam_soe.jpg',
                'stok_slop' => 540,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
