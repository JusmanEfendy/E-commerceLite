<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $barang = Barang::count();
        $totalSemuaHarga = Barang::sum('HargaBarang');
        $pegawai = Pegawai::count();

        return view('admin.dashboard.dashboard', compact('title', 'barang', 'pegawai', 'totalSemuaHarga'));
    }
}
