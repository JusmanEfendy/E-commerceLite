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
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Pelanggan -->
                        <div class="col-md-6">
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
                            <h4 class="mb-2"><strong>Total Pembayaran : <span style="color: green">Rp. {{ isset($pesanan->total_harga) ? number_format($pesanan->total_harga) : 0 }}</span></strong></h4>
                            <button id="pay-button" class="btn btn-success"><i class="bi bi-cash"></i> Bayar</button>
                        </div>
                        <!-- Snap Container -->
                        <div class="col-md-6 mt-3">                        
                            <div style="border-radius: 10px;" id="snap-container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function() {
        console.log('{{ $snapToken }}')
        // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
        // Also, use the embedId that you defined in the div above, here.
        window.snap.embed('{{ $snapToken }}', {
            embedId: 'snap-container',
            onSuccess: function(result) {
                /* You may add your own implementation here */
                window.location.href = '/info-pembayaran'
                alert("payment success!");
                console.log(result);
            },
            onPending: function(result) {
                /* You may add your own implementation here */
                alert("wating your payment!");
                console.log(result);
            },
            onError: function(result) {
                /* You may add your own implementation here */
                alert("payment failed!");
                console.log(result);
            },
            onClose: function() {
                /* You may add your own implementation here */
                alert('you closed the popup without finishing the payment');
            }
        });
    });
</script>
