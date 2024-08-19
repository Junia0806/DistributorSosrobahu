<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_barang_sales')->insert([
            [
                'id_master_barang' => 1,
                'id_user_sales' => 1,
                'harga_sales' => 170000,
                'stok_slop' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 2,
                'id_user_sales' => 1,
                'harga_sales' => 160000,
                'stok_slop' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 3,
                'id_user_sales' => 2,
                'harga_sales' => 155000,
                'stok_slop' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 4,
                'id_user_sales' => 2,
                'harga_sales' => 165000,
                'stok_slop' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 5,
                'id_user_sales' => 3,
                'harga_sales' => 150000,
                'stok_slop' => 85,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 6,
                'id_user_sales' => 3,
                'harga_sales' => 175000,
                'stok_slop' => 65,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 7,
                'id_user_sales' => 4,
                'harga_sales' => 160000,
                'stok_slop' => 75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 8,
                'id_user_sales' => 4,
                'harga_sales' => 170000,
                'stok_slop' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 9,
                'id_user_sales' => 5,
                'harga_sales' => 185000,
                'stok_slop' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 10,
                'id_user_sales' => 5,
                'harga_sales' => 140000,
                'stok_slop' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
