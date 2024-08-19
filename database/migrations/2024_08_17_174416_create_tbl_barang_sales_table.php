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
        Schema::create('tbl_barang_sales', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
            $table->integer('id_barang_sales', true);
            $table->integer('id_master_barang')->index('id_master_barang');
            $table->integer('id_user_sales')->index('id_user_sales');
            $table->integer('harga_sales');
            $table->integer('stok_slop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_barang_sales');
    }
};
