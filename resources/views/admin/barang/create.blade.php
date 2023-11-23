@include('layouts.header')

{{-- @include('layouts.preloader') --}}

@include('layouts.navbar')

@include('layouts.sidemenu')


<div class="content-wrapper">
    <div class="content-header">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-2">Tambah Barang</h1>
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
                        <h3 class="card-title">Masukkan Barang</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('barang.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="KodeBarang">Kode Barang</label>
                                <input type="text" class="form-control" id="KodeBarang" name="KodeBarang"
                                    placeholder="Kode Barang" readonly>
                            </div>
                            <div class="form-group">
                                <label for="NamaBarang">Barang</label>
                                <input type="text" class="form-control" id="NamaBarang" name="NamaBarang"
                                    placeholder="Nama Barang" required autofocus    >
                            </div>
                            <div class="form-group">
                                <label for="HargaBarang">Harga</label>
                                <input type="number" class="form-control" id="HargaBarang" name="HargaBarang"
                                    placeholder="Rp..." required>
                            </div>
                            <div class="form-group">
                                <label for="Satuan" hidden>Satuan</label>
                                <input type="text" class="form-control" id="Satuan" name="Satuan"
                                    placeholder="" hidden>
                            </div>
                            <div class="form-group">
                                <label for="StokBarang">Stok</label>
                                <input type="number" class="form-control" id="StokBarang" name="StokBarang" min="0"
                                    placeholder="pcs/kg/box/dll" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea name="DeskripsiBarang" class="form-control" rows="3" name="DeskripsiBarang" placeholder="Deskripsi ..."></textarea>
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
        let kodeBarang = 'BRG' + Math.floor(Math.random() * 10000).toString().padStart(5, '0');
        document.getElementById('KodeBarang').value = kodeBarang;
    })
    
</script>

