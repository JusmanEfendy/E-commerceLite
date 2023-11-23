@include('home.layouts.navigation')
<div class="container mt-3 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="d-flex justify-content-end align-items-center">
                        <span class="text-success"><i class="bi bi-check-circle-fill"></i> Completed</span>
                    </div>
                    <div class="text-center my-4">
                        <div class="bg-success rounded-circle p-4" style="width: 100px; height: 100px; margin: 0 auto;">
                            {{-- <i class="fas fa-check text-white" style="font-size: 48px;"></i> --}}
                            <i class="bi bi-check-circle-fill text-white py-5" style="font-size:48px"></i>
                        </div>
                        <h3 class="mt-3 font-weight-bold">Pembayaran Selesai!</h3>
                        <p class="text-muted">Mohon menunggu pesanan anda, segera kami kirimkan. Klik Kembali untuk mulai berbelanja.</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('homepage') }}" class="btn btn-primary">Kembali ke Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@include('home.layouts.footer')
