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
        Schema::table('order_agen', function (Blueprint $table) {
            $table->foreign(['id_user_agen'], 'order_agen_ibfk_1')->references(['id_user_agen'])->on('user_agen')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_agen', function (Blueprint $table) {
            $table->dropForeign('order_agen_ibfk_1');
        });
    }
};
