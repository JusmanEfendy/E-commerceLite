<div class="sidebar-body">
    <ul class="nav">
        <li class="nav-item nav-category">Menu Utama</li>
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="link-icon" data-feather="box"></i>
                <span class="link-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item nav-category">Data Toko</li>
        <li class="nav-item">
            <a href="{{ route('barang') }}" class="nav-link">
                <i class="link-icon" data-feather="shopping-cart"></i>
                <span class="link-title">Product</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('pegawai') }}" class="nav-link">
                <i class="link-icon" data-feather="users"></i>
                <span class="link-title">Pegawai</span>
            </a>
        </li>
        <li class="nav-item nav-category">Transaction</li>
        <li class="nav-item">
            <a href="{{ route('transaksi') }}" class="nav-link">
                <i class="link-icon" data-feather="dollar-sign"></i>
                <span class="link-title">Transaksi</span>
            </a>
        </li>
    </ul>
</div>