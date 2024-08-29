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
        Schema::create('master_barang', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('id_master_barang', true);
            $table->string('nama_rokok', 100);
            $table->integer('harga_karton_pabrik');
            $table->integer('stok_karton');
            $table->string('gambar');
            $table->integer('stok_slop');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_barang');
    }
};
