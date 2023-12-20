@section('title', 'Login')
@include('layouts.header')

<body>
    <div class="main-wrapper">
        <div class="page-wrapper full-page">
            <div class="page-content d-flex align-items-center justify-content-center">

                <div class="row w-100 mx-0 auth-page">
                    <div class="col-md-8 col-xl-6 mx-auto">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <img class="auth-side-wrapper img-fluid d-none d-sm-block"
                                        src="{{ asset('admin/assets/images/online_shopping.gif') }}" alt="">
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <a href="#"
                                            class="noble-ui-logo logo-light d-block mb-2">Toko<span>Jussy</span></a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                        <form class="forms-sample" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div>
                                                <x-input-label class="form-label" for="email" :value="__('Email')" />
                                                <x-text-input id="email" class="block mt-1 w-full form-control" type="email" name="email" required autofocus autocomplete="username" />
                                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                            </div>
                                    
                                            <!-- Password -->
                                            <div class="mt-4">
                                                <x-input-label class="form-label" for="password" :value="__('Password')" />
                                    
                                                <x-text-input id="password" class="block mt-1 w-full form-control"
                                                                type="password"
                                                                name="password"
                                                                required />
                                    
                                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                            </div>
                                            <div class="form-check mb-3 mt-4">
                                                <input type="checkbox" class="form-check-input" id="authCheck">
                                                <label class="form-check-label" for="authCheck">
                                                    Remember me
                                                </label>
                                            </div>
                                            <div>
                                                <button type="submit"
                                                    class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Login</button>
                                                <button type="button"
                                                    class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0">
                                                    <i class="btn-icon-prepend" data-feather="globe"></i>
                                                    Login with google
                                                </button>
                                            </div>
                                            <a href="{{ route('register') }}" class="d-block mt-3 text-muted">Not a user? Sign
                                                up</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
@include('layouts.scripts')
