{{-- @include('layouts.header')

@include('layouts.navbar')

@include('layouts.sidemenu')

<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Data Transaksi</h1>
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <form action="{{ route('barang') }}" method="get">
                                    <input type="search" id="search" name="search" class="form-control float-right"
                                        placeholder="Search">
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <div class="card-body table-responsive p-0">
                            @if (count($transaksies) > 0)
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Pembeli</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksies as $i => $transaksi)
                                            <tr>
                                                <td>{{ $i + $transaksies->firstItem() }}</td>
                                                <td>TRNKS0{{ $transaksi->id }}</td>
                                                <td>{{ date('d M Y', strtotime($transaksi->tanggal)) }}</td>
                                                <td>Rp. {{ number_format($transaksi->total_harga) }}</td>
                                                <td>
                                                    @if ($transaksi->status === 'Paid')
                                                        <label class="badge badge-success">{{ $transaksi->status === 'Paid' ? 'Terbayar' : 'Belum Bayar' }}</label>
                                                        @else
                                                        <label class="badge badge-warning">{{ $transaksi->status === 'Unpaid' ? 'Belum Bayar' : 'Terbayar' }}</label>
                                                    @endif
                                                </td>
                                                <td>{{ $transaksi->user->name }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center mx-auto">Belum ada data.</p>
                            @endif
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix d-flex justify-content-end">
                        {{ $transaksies->links() }}
                    </div>
                </div>
                <!-- /.card -->
            </div>
            {{-- modal --}}
{{-- <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <img id="gambar" src="" alt="barang" class="img-fluid"
                                            data-gambar="">
                                    </div>
                                    <div class="col-md">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <h4><strong id="kode"></strong></h4>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Nama:</strong>
                                                <i id="nama"></i>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Jabatan:</strong>
                                                <i id="jabatan"></i>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Telp:</strong>
                                                <i id="telp"></i>
                                            </li>
                                            <li id="created" class="list-group-item"><br></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- endmodal --}}
{{-- </div>
    </div>
</div> --}}

{{-- @include('layouts.footer') --}}

@extends('layouts.main')

@section('title', 'Admin | Product')

@section('content')
    <div class="page-content">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Transaction
                </li>
            </ol>
            <div class="ml-auto">
                <form action="{{ route('barang') }}" method="get">
                    <input type="search" id="search" name="search" class="form-control float-right"
                        placeholder="Search" autofocus>
                </form>
            </div>
        </nav>

        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Transaksi Detail</h6>
                    <div class="table-responsive">
                        @if (count($transaksies) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Order ID</th>
                                        <th>Tanggal</th>
                                        <th>Total Harga</th>
                                        <th>Status</th>
                                        <th>Pembeli</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksies as $i => $transaksi)
                                    <tr>
                                        <td>{{ $i + $transaksies->firstItem() }}</td>
                                        <td>{{ $transaksi->order_id }}</td>
                                        <td>{{ date('d M Y', strtotime($transaksi->tanggal)) }}</td>
                                        <td>Rp. {{ number_format($transaksi->total_harga) }}</td>
                                        <td>
                                            @if ($transaksi->status === 'Paid')
                                                <label class="badge rounded-pill bg-success">{{ $transaksi->status === 'Paid' ? 'Terbayar' : 'Belum Bayar' }}</label>
                                                @else
                                                <label class="badge rounded-pill bg-danger">{{ $transaksi->status === 'Unpaid' ? 'Belum Bayar' : 'Terbayar' }}</label>
                                            @endif
                                        </td>
                                        <td>{{ $transaksi->user->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center mx-auto">Belum ada data.</p>
                        @endif
                    </div>
                </div>
                <div class="card-footer clearfix d-flex justify-content-end">
                    {{ $transaksies->links() }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="detailModalLabel">Detail Product</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-2">
                            <div class="col-12 ">
                                <img src="" class="img-fluid rounded" alt="Gambar Product" id="gambar"
                                    style="max-width: 100%;">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Nama Product</b>
                            </div>
                            <div class="col-6" id="nama"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Stok Product</b>
                            </div>
                            <div class="col-6" id="stok"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Harga Product</b>
                            </div>
                            <div class="col-6" id="harga"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Satuan</b>
                            </div>
                            <div class="col-6" id="satuan"></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-6">
                                <b>Ditambahkan pada</b>
                            </div>
                            <div class="col-6" id="createdat"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('.delete').click(function(e) {
                e.preventDefault()
                const namaBarang = $(this).data('namabarang')
                let button = $(this)
                let form = button.parent('form')
                let ok = false
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus?',
                    text: `${namaBarang} akan dihapus permanent`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        ok = true; // Setel ok ke true jika pengguna mengklik "Yes"
                        form.submit(); // Kirim formulir

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

            $('.detailModal').on('click', function() {
                console.log('test')

                const $gambarElement = $('#gambar');
                let gambar = $(this).data('gambar')

                $gambarElement.attr('src', `storage/${gambar}`);

                $('#kode').text($(this).data('kodebarang'))

                $('#nama').text($(this).data('namabarang'))

                $('#harga').text($(this).data('hargabarang'))

                $('#gambar').text($(this).data('gambar'))

                $('#stok').text($(this).data('stokbarang'))

                $('#satuan').text($(this).data('satuanbarang'))

                $('#createdat').text($(this).data('created'))

                $('#deskripsi').text($(this).data('deskripsibarang'))
            });
        });
    </script>

@endsection
