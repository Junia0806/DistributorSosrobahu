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
        Schema::create('user_sales', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('id_user_sales', true);
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('password');
            $table->string('no_telp', 100);
            $table->integer('status');
            $table->integer('level');
            $table->string('gambar_ktp', 200);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_sales');
    }
};
