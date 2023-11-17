<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananDetail extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'pesanan_detail';
    protected $primaryKey = 'id';

    protected $fillable = ['kode_barang', 'pesan_id', 'jumlah', 'total_harga'];

    public function barang() 
    {
        return $this->belongsTo('App\Models\Barang', 'kode_barang', 'KodeBarang');
    }

    public function pesanan() 
    {
        return $this->belongsTo('App\Models\Pesanan', 'pesan_id', 'id');
    }
}
