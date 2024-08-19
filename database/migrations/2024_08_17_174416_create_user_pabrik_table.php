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
        Schema::create('user_pabrik', function (Blueprint $table) {
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
            $table->integer('id_user_pabrik', true);
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('password');
            $table->string('no_telp', 100);
            $table->integer('level');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_pabrik');
    }
};
