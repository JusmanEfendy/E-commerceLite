<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pegawai;
use App\Models\Pesanan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        $barang = Barang::count();
        $pegawai = Pegawai::count();

        // total transaksi dan pemasukan berdasarkan bulan ini 
        $pemasukanBulanan = Pesanan::whereYear('tanggal', Carbon::now()->year)->whereMonth('tanggal', Carbon::now()->month)->sum('total_harga');
        $totalTransaksi = Pesanan::count();

        return view('admin.dashboard.dashboard', compact('title', 'barang', 'pegawai', 'pemasukanBulanan', 'totalTransaksi'));
    }
}
