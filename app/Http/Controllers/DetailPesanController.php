<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\FuncCall;

class DetailPesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $title = 'Detail Pesanan';

        $barangs = Barang::paginate(4);
        $barang = Barang::where('KodeBarang', $id)->first();
        return view('home.detail', compact('barangs', 'barang', 'title'));
    }

    public function pesan( Request $request, $id)
    {
        $barang = Barang::where('KodeBarang', $id)->first();

        // validasi ketika jumlah pesanan melebihi stok
        if($request->jumlahPesan > $barang->StokBarang) {
            return redirect('detail-pesanan/'. $id);
        }

        // cek validasi ketika user dengan id {id} dan sudah ada data dengan status 0
        $cekPesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        if(empty($cekPesanan)) {
            // simpan data ke tabel pesanan
            Pesanan::create([
                'user_id' => Auth::user()->id,
                'tanggal' => Carbon::now(),
                'status' => 0,
                'total_harga' => 0
            ]);
        }   

        // simpan ke pesanan detail
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // cek detail pesanan
        $cekDetailPesanan = PesananDetail::where('kode_barang', $barang->KodeBarang)->where('pesan_id', $pesanan->id)->first();
        if(empty($cekDetailPesanan)) {
            PesananDetail::create([
                'kode_barang' => $barang->KodeBarang,
                'pesan_id' => $pesanan->id,
                'jumlah' => $request->jumlahPesan,
                'total_harga' => $barang->HargaBarang * $request->jumlahPesan
            ]);
        }else {
            $detailPesanan = PesananDetail::where('kode_barang', $barang->KodeBarang)->where('pesan_id', $pesanan->id)->first();
            $hargaBaru = $barang->HargaBarang * $request->jumlahPesan;

            $detailPesanan->update([
                'jumlah' => $detailPesanan->jumlah + $request->jumlahPesan,
                'total_harga' => $detailPesanan->total_harga + $hargaBaru
            ]);
        }

        $pesanan->update([
            'total_harga' => $pesanan->total_harga + $barang->HargaBarang * $request->jumlahPesan
        ]);
        
        return redirect()->route('checkout')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function checkout()
    {
        $title = 'Checkout barang Sekarang' ;
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // validasi ketika pesanandetail kosong
        $detailPesanan = PesananDetail::get();
        if(empty($detailPesanan)) {
            $detailPesanan = PesananDetail::where('pesan_id', $pesanan->id)->where('pesan_id', $pesanan->id)->get();
        }
        
        return view('home.keranjang', compact('pesanan', 'detailPesanan', 'title'));
    }

    public function delete($id)
    {
        $pesananDetail = PesananDetail::where('id', $id)->first();
        $pesanan = Pesanan::where('id', $pesananDetail->pesan_id)->first();

        $pesanan->total_harga -= $pesananDetail->total_harga;
        $pesanan->update();

        $pesananDetail->delete();

        return redirect()->route('checkout')->with('success', 'produk dihapus');
    }
}
