<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $title = 'Transaksi';

        $transaksies = Pesanan::orderBy('id', 'DESC')->paginate(10);
        return view('admin.transaksi.index', compact('title', 'transaksies'));
    }
}
