@include('layouts.header')

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
            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
        </div>
    </div>
</div>

@include('layouts.footer')
