{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Konfirmasi Pembayaran</title>
    <link rel="stylesheet" href="{{ asset('bootstrap5/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="" class="btn btn-danger">kembali</a>
            </div>
        </div>
    </div>
    <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html> --}}

<title>{{ $title }}</title>

@include('home.layouts.navigation')

<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('checkout') }}" class="btn btn-danger"><i class="bi bi-arrow-90deg-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-header">
                    <h3>Informasi Pembayaran <i class="bi bi-cart4"></i></h3>
                </div>
                <div class="card-body col-md-12">
                    <p class="mb-1"><strong>Nama Pelanggan:</strong> <span class="text-right">{{ Auth::user()->name }}</span></p>
                    <p class="mb-1"><strong>Alamat Pengiriman:</strong> <span class="text-right">{{ $request->alamat }}</span></p>
                    <p class="mb-1"><strong>Produk:</strong> <span class="text-right">
                            <ul>
                                @foreach ($detailPesanan as $i => $data)
                                    @if ($data->pesanan->user_id === Auth::user()->id)
                                    <li style="list-style: none">{{ ++$i }}. {{ $data->barang->NamaBarang }}</li>
                                    @endif
                                @endforeach                              
                            </ul>
                        </span>
                    </p>
                    <p class="mb-3"><strong>Nomor Telepon:</strong> <span class="text-right">{{ $request->telepon }}</span></p>
                    <h4 class="mb-2"><strong>Total Pembayaran  : <span style="color: green">Rp. {{ isset($pesanan->total_harga) ? number_format($pesanan->total_harga) : 0 }}</span> </strong></strong></h4>

                    <div class="col-md-12">
                        <a href="{{ route('checkout') }}" class="btn btn-success"><i class="bi bi-cash"></i> Bayar</a>
                    </div>
                </div>                
            </div>
        </div>       
    </div>
</div>

<script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
