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
        Schema::create('order_sales', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('id_order', true);
            $table->integer('id_user_sales')->index('id_user_sales');
            $table->integer('jumlah');
            $table->integer('total');
            $table->date('tanggal');
            $table->string('bukti_transfer');
            $table->integer('status_pemesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_sales');
    }
};
