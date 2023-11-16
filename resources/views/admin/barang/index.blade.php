@include('layouts.header')

{{-- @include('layouts.preloader') --}}

@include('layouts.navbar')

@include('layouts.sidemenu')

<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Data Barang</h1>
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('barang.create') }}" class="btn btn-success">
                            Tambah Barang +
                        </a>
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
                            @if(count($barangs) > 0)
                            <table class="table table-hover text-nowrap">
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
                                                <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-info">
                                                    <span class="fa fa-edit"></span>
                                                </a>
                                                <a href="#" class="detailModal btn btn-primary" data-toggle="modal"
                                                    data-target="#detailModal" data-kodebarang="{{ $barang->KodeBarang }}"
                                                    data-hargabarang="{{ number_format($barang->HargaBarang, 0, ',', '.') }}"
                                                    data-stokbarang="{{ $barang->StokBarang }}"
                                                    data-satuanbarang="{{ $barang->Satuan }}"
                                                    data-gambar={{ $barang->Gambar }}
                                                    data-deskripsibarang="{{ $barang->DeskripsiBarang }}"
                                                    data-created="{{ $barang->created_at->format('d-M-Y , H:m:s') }}"
                                                    data-namabarang="{{ $barang->NamaBarang }}">
                                                    <span class="fa fa-eye"></span>
                                                </a>
                                                <form action="{{ route('barang.delete', $barang->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete"
                                                        data-namabarang="{{ $barang->NamaBarang }}">
                                                        <span class="fa fa-trash"></span>
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
                    <!-- /.card-body -->
                    <div class="card-footer clearfix d-flex justify-content-end">
                        {{ $barangs->links() }}
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
                                        <img id="gambar" src="" alt="barang" class="img-fluid" data-gambar="">
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
                                                <strong>Harga:</strong>
                                                <i id="harga"></i>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>stok:</strong>
                                                <i id="stok"></i>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Satuan:</strong>
                                                <i id="satuan"></i>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>dibuat:</strong>
                                                <i id="createdat"></i>
                                            </li>
                                            {{-- <li id="createdat" class="list-group-item"><br></li> --}}
                                            <li id="deskripsi" class="list-group-item"><br></li>
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

<script>
    $(document).ready(function() {
        // sweetalert ketika inign menghapus data
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
