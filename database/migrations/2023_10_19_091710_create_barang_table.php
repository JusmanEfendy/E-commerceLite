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
        Schema::create('barang', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('KodeBarang')->unique();
            $table->string('NamaBarang');
            $table->string('Gambar');
            $table->text('DeskripsiBarang')->nullable();
            $table->decimal('HargaBarang', 10, 2);
            $table->integer('StokBarang');
            $table->string('Satuan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
