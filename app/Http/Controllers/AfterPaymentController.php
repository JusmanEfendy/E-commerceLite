<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfterPaymentController extends Controller
{
    public function afterPayment(Request $request) 
    {
        $title = "Konfirmasi Pembayaran";

        // dd($request->telepon);
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
        $detailPesanan = PesananDetail::where('order_id', $pesanan->order_id)->get();

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
                'order_id' => $pesanan->order_id,
                'gross_amount' => $pesanan->total_harga,
            ),
            'customer_details' => array(
                'first_name' => $pesanan->user->name,
                'email' => $pesanan->user->email,
                'phone' => $request->telepon,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('home.confirm-checkout', compact('title', 'request', 'snapToken', 'detailPesanan', 'pesanan'));
    }

    public function callback(Request $request)
    {
        // dd($request);
        if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){

            // dd('berhasil');
            $pesanan = Pesanan::where('order_id', $request->order_id)->where('status', 'Unpaid')->first();
            // dd($pesanan);
            $detailPesanan = PesananDetail::where('order_id', $pesanan->order_id)->get();
            
            foreach ($detailPesanan as $datas){
                $barang = Barang::where('KodeBarang', $datas->kode_barang)->first();
                $stokBaru = $barang->StokBarang - $datas->jumlah;
                $stokBaru = max($stokBaru, 0);
            
                $barang->update(['StokBarang' => $stokBaru]);
            }
            // dd($detailPesanan);

            $pesanan->update(['status' => 'Paid']);
        }
    }
}
