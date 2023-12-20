@extends('layouts.main')

@section('content')

    <div class="page-content">
        @if (session('success'))
            <div class="alert alert-success" id="success-alert">
                {{ session('success') }}
            </div>
        @endif
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pegawai</a></li>
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
                    <h6 class="card-title">Tabel pegawai</h6>
                    <a href="{{ route('pegawai.create') }}" class="btn btn-primary btn-icon-text">
                        <i class="btn-icon-prepend" data-feather="file-plus"></i>
                        Tambah Pegawai
                    </a>
                    <div class="table-responsive">
                        @if (count($pegawaies) > 0)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>No Telp</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pegawaies as $i => $pegawai)
                                        <tr>
                                            <td>{{ $i + $pegawaies->firstItem() }}</td>
                                            <td>{{ $pegawai->KodePegawai }}</td>
                                            <td>{{ $pegawai->NamaPegawai }}</td>
                                            <td>{{ $pegawai->Jabatan }}</td>
                                            <td>{{ $pegawai->NoTeleponPegawai }}</td>
                                            <td>
                                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-info btn-icon btn-sm ">
                                                    <i class="link-icon " data-feather="edit-3"></i>
                                                </a>
                                                <a href="#" type="button"
                                                    class="detailModal btn btn-primary btn-icon btn-sm"
                                                    data-bs-toggle="modal" data-bs-target="#detailModal"
                                                    data-kodepegawai="{{ $pegawai->KodePegawai }}"
                                                    data-namapegawai="{{ $pegawai->NamaPegawai }}"
                                                    data-jabatan="{{ $pegawai->Jabatan }}"
                                                    data-gambar="{{ $pegawai->Gambar }}"
                                                    data-telp="{{ $pegawai->NoTeleponPegawai }}"
                                                    data-created="{{ $pegawai->created_at }}">
                                                    <i class="link-icon " data-feather="info"></i>
                                                </a>
                                                <form action="{{ route('pegawai.delete', $pegawai->id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger delete btn-icon btn-sm"
                                                        data-namapegawai="{{ $pegawai->NamaPegawai }}">
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
            // sweetalert ketika inign menghapus data
            $('.delete').click(function(e) {
                e.preventDefault()
                const namaPegawai = $(this).data('namapegawai')
                let button = $(this)
                let form = button.parent('form')
                let ok = false
                Swal.fire({
                    title: 'Apakah anda yakin ingin menghapus?',
                    text: `${namaPegawai} akan dihapus permanent`,
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
                console.log(gambar)
                $gambarElement.attr('src', `storage/${gambar}`);
    
                $('#kode').text($(this).data('kodepegawai'))
    
                $('#nama').text($(this).data('namapegawai'))
    
                $('#jabatan').text($(this).data('jabatan'))
    
                $('#telp').text($(this).data('telp'))
    
                $('#created').text($(this).data('created'))
            });
        });
    </script>

@endsection
