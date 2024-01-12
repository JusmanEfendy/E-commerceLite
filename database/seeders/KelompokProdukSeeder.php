<?php

namespace Database\Seeders;

use App\Models\KelompokProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelompokProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KelompokProduk::create([
            'kode_kelompok' => 'KLPM001',
            'kelompok' => 'Makanan Ringan'
        ]);
        
        KelompokProduk::create([
            'kode_kelompok' => 'KLPM002',
            'kelompok' => 'Makanan Sedang'
        ]);

        KelompokProduk::create([
            'kode_kelompok' => 'KLPM003',
            'kelompok' => 'Makanan Berat'
        ]);
    }
}
