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

    protected $fillable = ['user_id', 'tanggal', 'total_harga', 'status'];
}
