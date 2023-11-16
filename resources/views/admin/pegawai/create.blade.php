@include('layouts.header')

@include('layouts.navbar')

@include('layouts.sidemenu')

<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Tambah Pegawai</h1>
                @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Masukkan Data Pegawai</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('pegawai.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="KodePegawai">Kode Pegawai</label>
                                <input type="text" class="form-control" id="KodePegawai" name="KodePegawai"
                                    placeholder="Kode Pegawai" readonly>
                            </div>
                            <div class="form-group">
                                <label for="NamaPegawai">Nama</label>
                                <input type="text" class="form-control" id="NamaPegawai" name="NamaPegawai"
                                    placeholder="Nama Pegawai" required autofocus    >
                            </div>
                            <div class="form-group">
                                <label for="Jabatan">Jabatan</label>
                                <input type="text" class="form-control" id="Jabatan" name="Jabatan"
                                    placeholder="Jabatan" required>
                            </div>
                            <div class="form-group">
                                <label for="NoTeleponPegawai">No Telp</label>
                                <input type="number" class="form-control" id="NoTeleponPegawai" name="NoTeleponPegawai"
                                    placeholder="example: 6283123456789" required>
                            </div>
                            <div class="mb-3">
                                <label for="Gambar" class="form-label">Masukkan Gambar</label>
                                <img class="img-view img-fluid col-sm-5 mb-3" alt="">
                                <input class="form-control" type="file" id="Gambar" name="Gambar" onchange="viewGambar()">
                            </div>
                        </div>
                        <!-- /.card-body -->                     

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let kodeBarang = 'PGW' + Math.floor(Math.random() * 10000).toString().padStart(5, '0');
        document.getElementById('KodePegawai').value = kodeBarang;
    })
</script>