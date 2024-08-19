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
        Schema::table('order_detail_distributor', function (Blueprint $table) {
            $table->foreign(['id_order'], 'order_detail_distributor_ibfk_1')->references(['id_order'])->on('order_distributor')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['id_user_distributor'], 'order_detail_distributor_ibfk_2')->references(['id_user_distributor'])->on('user_distributor')->onUpdate('cascade')->onDelete('no action');
            $table->foreign(['id_master_barang'], 'order_detail_distributor_ibfk_3')->references(['id_master_barang'])->on('master_barang')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_detail_distributor', function (Blueprint $table) {
            $table->dropForeign('order_detail_distributor_ibfk_1');
            $table->dropForeign('order_detail_distributor_ibfk_2');
            $table->dropForeign('order_detail_distributor_ibfk_3');
        });
    }
};
