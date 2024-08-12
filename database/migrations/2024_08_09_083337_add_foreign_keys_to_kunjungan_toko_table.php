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
        Schema::table('kunjungan_toko', function (Blueprint $table) {
            $table->foreign(['id_daftar_toko'], 'kunjungan_toko_ibfk_1')->references(['id_daftar_toko'])->on('daftar_toko')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kunjungan_toko', function (Blueprint $table) {
            $table->dropForeign('kunjungan_toko_ibfk_1');
        });
    }
};
