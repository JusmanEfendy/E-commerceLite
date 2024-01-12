@extends('layouts.main')

@section('title', 'Admin | Tambah Data')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Tambah Product
                </li>
            </ol>
            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }} (Wajib Isi)</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        </nav>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Tambah Product</h6>
                    <div class="row mb-3">
                        <label for="kode_produk2" class="col-sm-2 col-form-label">Kode Produk</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="kode_produk2" name="kode_produk2"
                                placeholder="kode produk" readonly>
                        </div>
                        <div class="col-sm-3">
                            <form class="search-form" action="{{ route('produk.search') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="search" class="form-control" id="search" name="search" placeholder="Cari Kode Produk...">
                                    <button type="submit" class="input-group-text"><i data-feather="search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form class="forms-sample" action="{{ route('produk.create') }}" method="post">
                        @csrf
                        <div class="row mb-3">
                            <label for="kode_produk" class="col-sm-2 col-form-label" hidden>Kode Produk</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                                    placeholder="kode produk" readonly hidden>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    placeholder="Nama Produk..." autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="harga_beli" class="col-form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli Product">
                            </div>
                            <div class="col-sm-6">
                                <label for="harga_jual" class="col-form-label">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual Product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="kode_status" class="col-form-label">Status Produk</label>
                                <select name="kode_status" id="kode_status" class="form-control">
                                    <option selected disabled>Pilih Status Produk</option>
                                    @if (isset($status))
                                        @foreach ($status as $data)
                                            <option value="{{ $data->kode_status }}">
                                                {{ $data->status }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label for="kode_kelompok" class="col-form-label">Kelompok Produk</label>
                                <select name="kode_kelompok" id="kode_kelompok" class="form-control">
                                    <option selected disabled>Pilih Kelompok Produk</option>
                                    @if (isset($kelompok))
                                        @foreach ($kelompok as $data)
                                            <option
                                                value="{{ $data->kode_kelompok }}">
                                                {{ $data->kelompok }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stok" class="col-sm-2 col-form-label" >Stok </label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="stok" name="stok" placeholder="pcs">
                            </div>
                            <div class="col-sm-6 mt-2 d-none d-sm-inline">
                                /pcs
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('produk') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        let kode_produk = 'PRDK' + Math.floor(Math.random() * 10000).toString().padStart(8, '01');
        document.getElementById('kode_produk').value = kode_produk;
        document.getElementById('kode_produk2').value = kode_produk;
    })

</script>
