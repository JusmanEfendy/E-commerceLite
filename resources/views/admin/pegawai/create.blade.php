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

                    <form class="forms-sample" action="{{ route('pegawai.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="KodePegawai" class="col-sm-3 col-form-label">Kode Pegawai</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="KodePegawai" name="KodePegawai"
                                    placeholder="Kode Barang" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NamaPegawai" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="NamaPegawai" name="NamaPegawai"
                                    placeholder="Nama Lengkap...">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="Jabatan" class="col-sm-3 col-form-label">Jabatan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="Jabatan" name="Jabatan"
                                    placeholder="Jabatan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="NoTeleponPegawai" class="col-sm-3 col-form-label" >No. Telp</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="NoTeleponPegawai" name="NoTeleponPegawai" placeholder="ex: 628xxxxxx">
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
                        <a href="{{ route('pegawai') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let kodeBarang = 'PGW' + Math.floor(Math.random() * 10000).toString().padStart(5, '0');
        document.getElementById('KodePegawai').value = kodeBarang;
    })
</script>