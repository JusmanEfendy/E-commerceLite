@extends('layouts.main')

@section('title', 'Admin | Tambah Data')

@section('content')
    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pencarian kode produk
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
                    <h6 class="card-title">Total Pencarian</h6>
                    <div class="table-responsive">
                        @if (count($produk) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($produk as $data)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $data->kode_produk }}</td>
                                        <td>{{ $data->nama_produk }}</td>
                                        <td>
                                            <a href="{{ route('produk.edit', $data->kode_produk) }}" class="btn btn-info btn-icon btn-sm">
                                                <i class="link-icon " data-feather="edit-3"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        @else
                            <p class="text-center mx-auto">Tidak Ada Hasil Pencarian .</p>
                            <a href="{{ route('produk.create') }}">Tambahkan Data Baru</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
