<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangDistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tbl_barang_disitributor')->insert([
            [
                'id_master_barang' => 1,
                'id_user_distributor' => 1,
                'harga_distributor' => 160000,
                'stok_karton' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 2,
                'id_user_distributor' => 1,
                'harga_distributor' => 150000,
                'stok_karton' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 3,
                'id_user_distributor' => 2,
                'harga_distributor' => 145000,
                'stok_karton' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 4,
                'id_user_distributor' => 2,
                'harga_distributor' => 155000,
                'stok_karton' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 5,
                'id_user_distributor' => 3,
                'harga_distributor' => 140000,
                'stok_karton' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 6,
                'id_user_distributor' => 3,
                'harga_distributor' => 165000,
                'stok_karton' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 7,
                'id_user_distributor' => 4,
                'harga_distributor' => 150000,
                'stok_karton' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 8,
                'id_user_distributor' => 4,
                'harga_distributor' => 160000,
                'stok_karton' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 9,
                'id_user_distributor' => 5,
                'harga_distributor' => 175000,
                'stok_karton' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_master_barang' => 10,
                'id_user_distributor' => 5,
                'harga_distributor' => 130000,
                'stok_karton' => 55,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
