<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'pesanan';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'tanggal', 'order_id', 'total_harga', 'status'];

    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function pesanan_detail()
    {
        return $this->hasMany('\App\Models\PesananDetail', 'pesan_id', 'id');
    }

    public function order_detail()
    {
        return $this->hasMany('\App\Models\PesananDetail', 'order_id', 'order_id');
    }
}
