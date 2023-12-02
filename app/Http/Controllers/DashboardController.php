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
        $jumlahPemasukanBulanan = Pesanan::whereYear('tanggal', Carbon::now()->year)->whereMonth('tanggal', Carbon::now()->month)->sum('total_harga');       
        $totalTransaksi = Pesanan::count();

        // chart menghitung pendapatan harian
        $pemasukanBulanan = Pesanan::whereYear('tanggal', Carbon::now()->year)->whereMonth('tanggal', 11)->get();

        $dailyRevenue = $pemasukanBulanan->groupBy(function ($date) {
            return $date->created_at->format('d M');
        })->map(function ($pemasukanBulanan) {
            return $pemasukanBulanan->sum('total_harga');
        });

        $dailyRevenueLabels = $dailyRevenue->keys()->toJson();
        $dailyRevenueData = $dailyRevenue->values()->toJson();

        return view('admin.dashboard.dashboard', compact('title', 'barang', 'pegawai', 'jumlahPemasukanBulanan', 'totalTransaksi','dailyRevenueLabels', 'dailyRevenueData'));
    }
}
