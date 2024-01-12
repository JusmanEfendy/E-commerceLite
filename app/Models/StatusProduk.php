<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusProduk extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $table = 'statusproduk';
    protected $primaryKey = 'id';

    protected $fillable = ['kode_status', 'status'];

    public function produk() 
    {
        return $this->hasMany('App\Models\Produk', 'kode_status', 'kode_status');
    }
}
