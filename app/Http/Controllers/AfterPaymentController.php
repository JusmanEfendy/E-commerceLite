<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AfterPaymentController extends Controller
{
    public function afterPayment(Request $request) 
    {
        $title = "Konfirmasi Pembayaran";
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

        return view('home.confirm-checkout', compact('title', 'request', 'snapToken', 'detailPesanan', 'pesanan'));
    }

    public function callback(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        // $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        // dd($request->transaction_status);
            if($request->transaction_status == 'capture' || $request->transaction_status == 'settlement'){
                $pesanan = Pesanan::where('id', $request->order_id)->where('status', 'Unpaid')->first();
                $pesanan->update(['status' => 'Paid']);
            }
        }
}
