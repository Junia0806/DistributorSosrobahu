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
        Schema::create('tbl_barang_disitributor', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('id_barang_distributor', true);
            $table->integer('id_master_barang')->index('id_master_barang');
            $table->integer('id_user_distributor')->index('id_user_distributor');
            $table->integer('harga_distributor');
            $table->integer('stok_karton');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barang_disitributor');
    }
};
