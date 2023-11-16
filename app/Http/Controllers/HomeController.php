<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home | Happy Shoping';
        
        $barangs = Barang::orderBy('id', 'desc')->paginate(10);
        return view('home.index', compact('barangs', 'title'));
    }
}
