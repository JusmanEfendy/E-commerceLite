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
        Schema::create('pesanan_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kode_barang');
            $table->string('order_id');
            $table->unsignedBigInteger('pesan_id');
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->timestamps();

            $table->foreign('kode_barang')->references('KodeBarang')->on('barang');
            $table->foreign('pesan_id')->references('id')->on('pesanan');
            $table->foreign('order_id')->references('order_id')->on('pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan_detail');
    }
};
