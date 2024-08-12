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
        Schema::create('order_distributor', function (Blueprint $table) {
            $table->integer('id_order', true);
            $table->integer('id_user_distributor')->index('id_user_distributor');
            $table->integer('jumlah');
            $table->integer('total');
            $table->date('tanggal');
            $table->string('bukti_transfer');
            $table->integer('status_pemesanan');
            $table->string('nota');

            $table->index(['id_user_distributor'], 'id_user_distributor_2');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_distributor');
    }
};
