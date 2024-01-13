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

                    <form class="forms-sample" action="{{ route('produk.update', $produk->kode_produk) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row mb-3">
                            <label for="kode_produk" class="col-sm-2 col-form-label">Kode Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kode_produk" name="kode_produk"
                                    placeholder="kode produk" value="{{ $produk->kode_produk }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                                    placeholder="Nama Produk..." value="{{ $produk->nama_produk }}" autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="harga_beli" class="col-form-label">Harga Beli</label>
                                <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ $produk->harga_beli }}" placeholder="Harga Beli Product">
                            </div>
                            <div class="col-sm-6">
                                <label for="harga_jual" class="col-form-label">Harga Jual</label>
                                <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ $produk->harga_jual }}" placeholder="Harga Jual Product">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="kode_status" class="col-form-label">Status Produk</label>
                                <select name="kode_status" id="kode_status" class="form-control">
                                    <option selected disabled>Pilih Status Produk</option>
                                    @if (isset($status))
                                        @foreach ($status as $data)
                                        <option {{ $produk->kode_status == $data->kode_status ? 'selected' : '' }} value="{{ $data->kode_status }}">
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
                                        <option {{ $produk->kode_kelompok == $data->kode_kelompok ? 'selected' : '' }} value="{{ $data->kode_kelompok }}">
                                            {{ $data->kelompok }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stok" class="col-sm-2 col-form-label" >Stok </label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="stok" name="stok" value="{{ $produk->stok }}" placeholder="pcs">
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