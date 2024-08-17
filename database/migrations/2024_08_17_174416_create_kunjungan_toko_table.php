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
        Schema::create('kunjungan_toko', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
            $table->integer('id_kunjungan_toko', true);
            $table->integer('id_daftar_toko')->index('id_daftar_toko');
            $table->date('tanggal');
            $table->integer('sisa_produk');
            $table->string('gambar');

            $table->index(['id_daftar_toko'], 'id_daftar_toko_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_toko');
    }
};
