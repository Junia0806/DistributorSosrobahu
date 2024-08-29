<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_detail_agen', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('id_detail_agen', true);
            $table->integer('id_order')->unique('id_order');
            $table->integer('id_user_distributor')->unique('id_user_distributor');
            $table->integer('id_user_agen')->unique('id_user_agen');
            $table->integer('id_master_barang')->unique('id_master_barang');
            $table->integer('id_barang_distributor')->unique('id_barang_distributor');
            $table->integer('jumlah_produk');
            $table->integer('jumlah_harga_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail_agen');
    }
};
