<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokProduk extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'kelompokproduk';
    protected $primaryKey = 'id';

    protected $fillable = ['kode_kelompok', 'kelompok'];

    public function produk() 
    {
        return $this->hasMany('App\Models\Produk', 'kode_kelompok', 'kode_kelompok');
    }
}
