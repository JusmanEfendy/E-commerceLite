<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            'KodeBarang' => 'BRG00001',
            'NamaBarang' => 'Gamis',
            'HargaBarang' => 50000,
            'Gambar' => 'gambar-barang/3qza144w8fcvxVsgqhAAOYnUDVJhGe5JOEqbxCcU.jpg',
            'StokBarang' => 7,
            'DeskripsiBarang' => 'Berdemage ketika dipakai wanita cantik',
            'Satuan' => 'Lima Puluh Ribu',
            'created_at' => Carbon::now()
        ]);
    }
}
