<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'barang';
    protected $primaryKey = 'id';

    protected $fillable = ['KodeBarang', 'NamaBarang', 'HargaBarang', 'StokBarang', 'Gambar', 'DeskripsiBarang', 'Satuan'];
}
