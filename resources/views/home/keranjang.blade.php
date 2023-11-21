<title>{{ $title }}</title>
@include('home.layouts.navigation')
@if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
<div class="untree_co-section before-footer-section mt-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-info" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Image</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total</th>
                                <th scope="col">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailPesanan as $data)
                            {{-- validasi user hanya bisa mengakses keranjangnya sendiri --}}
                                @if ($data->pesanan->user_id === Auth::user()->id)
                                <tr>
                                    <th>
                                        <img class="img-fluid" src="{{ asset('storage/' . $data->barang->Gambar) }}"
                                            alt="" style="max-width: 80">
                                    </th>
                                    <td>{{ $data->barang->NamaBarang }}</td>
                                    <td>Rp. {{ number_format($data->barang->HargaBarang) }}</td>
                                    <td>{{ $data->jumlah }}</td>
                                    <td>Rp. {{ number_format($data->total_harga) }}</td>
                                    <td class="px-3">
                                        <form action="{{ route('checkout.delete', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="bi bi-trash-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @endif                               
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 pl-md-5">
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12 text-right border-bottom mb-5">
                            <h3 class="text-black h4 text-uppercase">Lengkapi Dan CheckOut</h3>
                        </div>
                    </div>
                    <form method="post" action="{{ route('confirm.checkout') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="Telepon"><strong>No.Telp <span style="color: red">*</span></strong></label>
                                <input type="number" name="telepon" class="form-control" id="Telepon"
                                    aria-describedby="emailHelp" value="{{ !empty(Auth::user()->telepon) ? Auth::user()->telepon : '' }}" placeholder="ex:628xxxxxxxx"  autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="alamat"><strong>Alamat <span style="color: red">*</span></strong></label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="alamat" name="alamat" rows="2" >{{ !empty(Auth::user()->alamat) ? Auth::user()->alamat : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <span class="text-black">Subtotal</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">Rp.
                                    {{ isset($pesanan->total_harga) ? number_format($pesanan->total_harga) : 0 }}</strong>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <span class="text-black">Total</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <strong class="text-black">Rp.
                                    {{ isset($pesanan->total_harga) ? number_format($pesanan->total_harga) : 0 }}</strong>
                                    {{-- {{ $pesana->total_harga }} --}}
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-outline-dark btn-lg py-3 mb-2">Checkout</button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@include('home.layouts.footer')
