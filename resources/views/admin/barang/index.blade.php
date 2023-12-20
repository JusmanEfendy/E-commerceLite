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
                <li class="breadcrumb-item"><a href="#">Product</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Data Toko
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
                    <h6 class="card-title">Tabel PRODUCT</h6>
                    <a href="{{ route('barang.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="btn-icon-prepend" data-feather="file-plus"></i>
                        Tambah Product
                    </a>
                    <div class="table-responsive">
                        @if (count($barangs) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode</th>
                                        <th>Barang</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($barangs as $i => $barang)
                                        <tr>
                                            <td>{{ $i + $barangs->firstItem() }}</td>
                                            <td>{{ $barang->KodeBarang }}</td>
                                            <td>{{ $barang->NamaBarang }}</td>
                                            <td>{{ number_format($barang->HargaBarang, 0, ',', '.') }}</td>
                                            <td>{{ $barang->StokBarang }}</td>
                                            <td>
                                                <a href="{{ route('barang.edit', $barang->id) }}"
                                                    class="btn btn-info btn-icon btn-sm">
                                                    <i class="link-icon " data-feather="edit-3"></i>
                                                </a>
                                                <a href="#" type="button"
                                                    class="detailModal btn btn-primary btn-icon btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-kodebarang="{{ $barang->KodeBarang }}"
                                                    data-hargabarang="{{ number_format($barang->HargaBarang, 0, ',', '.') }}"
                                                    data-stokbarang="{{ $barang->StokBarang }} pcs"
                                                    data-satuanbarang="{{ $barang->Satuan }}"
                                                    data-gambar={{ $barang->Gambar }}
                                                    data-deskripsibarang="{{ $barang->DeskripsiBarang }}"
                                                    data-created="{{ $barang->created_at->format('d-M-Y , H:m:s') }}"
                                                    data-namabarang="{{ $barang->NamaBarang }}">
                                                    <i class="link-icon " data-feather="info"></i>
                                                </a>
                                                <form action="{{ route('barang.delete', $barang->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger btn-icon btn-sm delete"
                                                        data-namabarang="{{ $barang->NamaBarang }}">
                                                        <i class="link-icon " data-feather="trash-2"></i>
                                                    </button>
                                                </form>
                                            </td>
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
                        {{ $barangs->links() }}
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