<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    {{-- MIDTRANS SNAP --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- JIKA AKSES DILOKAL  --}}
    @if (request()->getHost() == 'localhost' && request()->getPort() == 8000)
        <link href="{{ asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('home/css/styles.css') }}" rel="stylesheet" />
    @else
        <link href="{{ secure_asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ secure_asset('home/css/styles.css') }}" rel="stylesheet" />
    @endif

    <!-- jQuery -->
    <script src="{{ asset('template') }}/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('template') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="{{ route('homepage') }}">Toko Jussy</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('homepage') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <form action="{{ route('logout') }}" method="post" class="d-flex gap-2">
                    @csrf
                    @php
                        $pesanan = \App\Models\Pesanan::where('user_id', optional(Auth::user())->id)
                            ->where('status', 'Unpaid')
                            ->first();

                        if ($pesanan && $pesanan->exists()) {
                            $notif = \App\Models\PesananDetail::where('pesan_id', $pesanan->id)->count();
                        }
                    @endphp


                    <a href="{{ route('checkout') }}" class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ isset($notif) ? $notif : 0 }}
                        </span>
                    </a>
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Welcome, {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @if (Auth::user()->role === 'admin')
                                        <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i
                                                    class="bi bi-speedometer"></i> Dashboard</a></li>
                                    @endif
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i
                                                class="bi bi-person"></i> Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="LogOut"
                                            onclick="event.preventDefault();
                                                    this.closest('form').submit();"><i
                                                class="bi bi-box-arrow-right"></i> Logout
                                        </a></li>
                                </ul>
                            </li>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-dark" type="submit" target="_blank">
                                <i class="bi bi-box-arrow-in-right"></i>
                                Login
                            </a>
                        @endauth
                    </ul>
                </form>
            </div>
        </div>
    </nav>
