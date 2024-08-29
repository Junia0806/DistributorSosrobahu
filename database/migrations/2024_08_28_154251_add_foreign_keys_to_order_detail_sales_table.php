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
        Schema::table('order_detail_sales', function (Blueprint $table) {
            $table->foreign(['id_order'], 'order_detail_sales_ibfk_1')->references(['id_order'])->on('order_sales')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_user_agen'], 'order_detail_sales_ibfk_2')->references(['id_user_agen'])->on('user_agen')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_user_sales'], 'order_detail_sales_ibfk_3')->references(['id_user_sales'])->on('user_sales')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_master_barang'], 'order_detail_sales_ibfk_4')->references(['id_master_barang'])->on('master_barang')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_barang_agen'], 'order_detail_sales_ibfk_5')->references(['id_barang_agen'])->on('tbl_barang_agen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_detail_sales', function (Blueprint $table) {
            $table->dropForeign('order_detail_sales_ibfk_1');
            $table->dropForeign('order_detail_sales_ibfk_2');
            $table->dropForeign('order_detail_sales_ibfk_3');
            $table->dropForeign('order_detail_sales_ibfk_4');
            $table->dropForeign('order_detail_sales_ibfk_5');
        });
    }
};
