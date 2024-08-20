<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangAgenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_barang_agen')->insert([
            [
                'id_master_barang' => 1,
                'id_user_agen' => 1,
                'harga_agen' => 155000,
                'stok_karton' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 2,
                'id_user_agen' => 1,
                'harga_agen' => 145000,
                'stok_karton' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 3,
                'id_user_agen' => 2,
                'harga_agen' => 140000,
                'stok_karton' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 4,
                'id_user_agen' => 2,
                'harga_agen' => 150000,
                'stok_karton' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 5,
                'id_user_agen' => 3,
                'harga_agen' => 130000,
                'stok_karton' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 6,
                'id_user_agen' => 3,
                'harga_agen' => 160000,
                'stok_karton' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 7,
                'id_user_agen' => 4,
                'harga_agen' => 135000,
                'stok_karton' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 8,
                'id_user_agen' => 4,
                'harga_agen' => 165000,
                'stok_karton' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 9,
                'id_user_agen' => 5,
                'harga_agen' => 170000,
                'stok_karton' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 10,
                'id_user_agen' => 5,
                'harga_agen' => 120000,
                'stok_karton' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
