<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template') }}/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">E-Kasir | Jussy</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header">Toko</li>
                <li class="nav-item">
                    <a href="{{ url('barang') }}" class="nav-link {{ request()->is('barang*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-shopping-basket"></i>
                        <p>
                            Barang
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pegawai') }}" class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}">
                        <i class=" nav-icon fa fa-users"></i>
                        <p>
                            Pegawai
                        </p>
                    </a>
                </li>
                <li class="nav-header">Keluar</li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="nav-link d-inline" href="keluar"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </form>                 
                </li>
            </ul>
        </nav>
    </div>
</aside>
