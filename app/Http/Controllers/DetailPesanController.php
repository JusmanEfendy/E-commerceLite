<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailPesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $title = 'Detail Pesanan';

        $barangs = Barang::paginate(10);
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
        $cekPesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'Unpaid')->first();
        if(empty($cekPesanan)) {
            // simpan data ke tabel pesanan
            Pesanan::create([
                'user_id' => Auth::user()->id,
                'tanggal' => Carbon::now(),
                'status' => 'Unpaid',
                'total_harga' => 0
            ]);
        }   

        // simpan ke pesanan detail
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'Unpaid')->first();

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
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'Unpaid')->first();

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

    public function confirm(Request $request)
    {
        $title = 'Konfirmasi Pembayaran';

        // jika alamat dan telepon user tidak sama dengan di db maka perbarui
        if(($request->alamat != Auth::user()->alamat) || ($request->telepon != Auth::user()->telepon)) {
            $user = User::find(Auth::user()->id);

            $datas = $request->validate([
                'telepon' => 'required|numeric',
                'alamat' => 'required'
            ]);

            $user->update([
                'telepon' => $datas['telepon'],
                'alamat' => $datas['alamat']
            ]);
        }

        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 'Unpaid')->first();
        $detailPesanan = PesananDetail::where('pesan_id', $pesanan->id)->get();

        //SAMPLE REQUEST START HERE
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $pesanan->id,
                'gross_amount' => $pesanan->total_harga,
            ),
            'customer_details' => array(
                'first_name' => $pesanan->user->name,
                'email' => $pesanan->user->email,
                'phone' => $request->telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('home.confirm-checkout', compact('title', 'pesanan', 'detailPesanan', 'request', 'snapToken'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        // dd($serverKey);
        $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $pesanan = Pesanan::where('id', $request->order_id)->where('status', 'Unpaid')->first();
                $pesanan->update(['status' => 'Paid']);
            }
        }
    }
}