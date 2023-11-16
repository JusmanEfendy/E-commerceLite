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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->integer('NoTransaksi')->uniqie();
            $table->date('Tanggal');
            $table->string('KodeBarang');
            $table->string('KodePegawai');
            $table->timestamps();

            $table->foreign('KodeBarang')->references('KodeBarang')->on('barang');
            $table->foreign('KodePegawai')->references('KodePegawai')->on('pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
