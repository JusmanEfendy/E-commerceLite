@include('layouts.header')

@include('layouts.navbar')

@include('layouts.sidemenu')

<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Data Pegawai</h1>
                @if (session('success'))
                    <div class="alert alert-success" id="success-alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-success">
                            Tambah Pegawai +
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
                            @if (count($pegawaies) > 0)
                                <table class="table table-hover text-nowrap">
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
                                                    <a href="{{ route('pegawai.edit', $pegawai->id) }}"
                                                        class="btn btn-info">
                                                        <span class="fa fa-edit"></span>
                                                    </a>
                                                    <a href="#" class="detailModal btn btn-primary"
                                                        data-toggle="modal" data-target="#detailModal"
                                                        data-kodepegawai="{{ $pegawai->KodePegawai }}"
                                                        data-namapegawai="{{ $pegawai->NamaPegawai }}"
                                                        data-jabatan="{{ $pegawai->Jabatan }}"
                                                        data-gambar="{{ $pegawai->Gambar }}"
                                                        data-telp="{{ $pegawai->NoTeleponPegawai }}"
                                                        data-created="{{ $pegawai->created_at }}">
                                                        <span class="fa fa-eye"></span>
                                                    </a>
                                                    <form action="{{ route('pegawai.delete', $pegawai->id) }}"
                                                        method="post" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger delete"
                                                            data-namapegawai="{{ $pegawai->NamaPegawai }}">
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
                        {{ $pegawaies->links() }}
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
