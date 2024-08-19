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
        Schema::table('order_distributor', function (Blueprint $table) {
            $table->foreign(['id_user_distributor'], 'order_distributor_ibfk_1')->references(['id_user_distributor'])->on('user_distributor')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_distributor', function (Blueprint $table) {
            $table->dropForeign('order_distributor_ibfk_1');
        });
    }
};
