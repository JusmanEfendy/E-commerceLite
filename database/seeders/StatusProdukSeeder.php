<?php

namespace Database\Seeders;

use App\Models\StatusProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StatusProduk::create([
            'kode_status' => 'STS001',
            'status' => 'Tunai'
        ]);

        StatusProduk::create([
            'kode_status' => 'STS002',
            'status' => 'Kredit'
        ]);

        StatusProduk::create([
            'kode_status' => 'STS003',
            'status' => 'Konsinyasi'
        ]);
    }
}
