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
        Schema::table('order_sales', function (Blueprint $table) {
            $table->foreign(['id_user_sales'], 'order_sales_ibfk_1')->references(['id_user_sales'])->on('user_sales')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_sales', function (Blueprint $table) {
            $table->dropForeign('order_sales_ibfk_1');
        });
    }
};
