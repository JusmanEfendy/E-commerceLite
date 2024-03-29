<title>{{ $title }}</title>
@include('home.layouts.navigation')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            {{-- <h3>{{ $barang->NamaBarang }}</h3> --}}
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0 rounded shadow" src="{{ asset('storage/' . $barang->Gambar) }}"
                    alt="..." /></div>
            <div class="col-md-6">
                <div class="small mb-1">Kode : {{ $barang->KodeBarang }}</div>
                <h1 class="display-5 fw-bolder">{{ $barang->NamaBarang }}</h1>
                <div class="fs-5 mb-5">
                    <span>Rp. {{ number_format($barang->HargaBarang, 0, ',', '.') }}</span>
                    <span>| Stok: {{ $barang->StokBarang <= 0 ? '0' : $barang->StokBarang }}</span>
                </div>
                <p class="lead">{{ $barang->DeskripsiBarang }}</p>
                <div class="d-flex">
                    @if ($barang->StokBarang == 0)
                        <h2 style="color: black; opacity: 30%"><strong><i>Habis Terjual</i></strong></h2>
                    @else
                        <form action="" method="post">
                            @csrf
                            <input name="jumlahPesan" class="form-control text-center me-3" id="inputQuantity"
                                type="number" value="1" style="max-width: 5rem" min="1"
                                max="{{ !empty($pesananDetail) ? $barang->StokBarang - $pesananDetail->jumlah : $barang->StokBarang }}" required autofocus />
                            <button class="btn btn-outline-dark flex-shrink-0 mt-3" type="submit" id="addToCartBtn">
                                <i class="bi-cart-fill me-1"></i>
                                Masukkan Keranjang
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Related products</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            @foreach ($barangs as $barang)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        @if ($barang->StokBarang == 0)
                            <div class="badge bg-danger text-white position-absolute"
                                style="top: 0.5rem; right: 0.5rem">Habis</div>
                        @else
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                New</div>
                        @endif
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ asset('storage/' . $barang->Gambar) }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $barang->NamaBarang }}</h5>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                Rp. {{ number_format($barang->HargaBarang, 0, ',', '.') }}
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent row">
                            <div class="col text-center">
                                <a class="btn btn-outline-dark mt-auto"
                                    href="{{ route('detail.pesanan', $barang->KodeBarang) }}"><i
                                        class="bi-cart-fill me-1"></i> pesan</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@include('home.layouts.footer')
