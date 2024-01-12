<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'produk';
    protected $primaryKey = 'id';

    protected $fillable = ['kode_produk', 'nama_produk', 'harga_beli', 'harga_jual', 'kode_status', 'kode_kelompok', 'stok'];

    
    public function kelompok()
    {
        return $this->belongsTo('App\Models\KelompokProduk', 'kode_kelompok', 'kode_kelompok');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\StatusProduk', 'kode_status', 'kode_status');
    }

}
