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
        Schema::table('tbl_barang_sales', function (Blueprint $table) {
            $table->foreign(['id_user_sales'], 'tbl_barang_sales_ibfk_1')->references(['id_user_sales'])->on('user_sales')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_master_barang'], 'tbl_barang_sales_ibfk_2')->references(['id_master_barang'])->on('master_barang')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_barang_sales', function (Blueprint $table) {
            $table->dropForeign('tbl_barang_sales_ibfk_1');
            $table->dropForeign('tbl_barang_sales_ibfk_2');
        });
    }
};
