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
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
        </nav>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Tambah Product</h6>

                    <form class="forms-sample" action="{{ route('barang.update', $barang->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="row mb-3">
                            <label for="KodeBarang" class="col-sm-3 col-form-label">Kode Barang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="KodeBarang" name="KodeBarang"
                                    placeholder="Kode Barang" value="{{ $barang->KodeBarang }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NamaBarang" class="col-sm-3 col-form-label">Product</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang"
                                    placeholder="Product..." value="{{ $barang->NamaBarang }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="HargaBarang" class="col-sm-3 col-form-label">Harga</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="HargaBarang" name="HargaBarang"
                                    placeholder="Harga Product" value="{{ $barang->HargaBarang }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="StokBarang" class="col-sm-3 col-form-label" >Stok </label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="StokBarang" name="StokBarang" placeholder="pcs" value="{{ $barang->StokBarang }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="DeskripsiBarang" class="col-sm-3 col-form-label">Deskripsi Barang</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="DeskripsiBarang" placeholder="Deskripsi..." name="DeskripsiBarang" rows="4">{{ $barang->DeskripsiBarang }}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label" for="Gambar">Masukkan Gambar</label>
                            <div class="col-sm-9">
                                <img class="img-view img-fluid col-sm-5 mb-3" alt="">
                                <input class="form-control" type="file" id="Gambar" name="Gambar" onchange="viewGambar()">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <a href="{{ route('barang') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
</script>
