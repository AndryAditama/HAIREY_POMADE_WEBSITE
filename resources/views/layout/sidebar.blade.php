<aside id="sidebar-wrapper">
    <div class="sidebar-brand d-flex align-items-center justify-content-center">
        <h6>HAIREY POMADE</h6>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="/dashboard"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        </li>
        <li class="menu-header">Data Master</li>
        <li class="{{ Request::is('data_product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('data_product.index') }}"><i class="fas fa-box"></i> <span>Data Produk</span></a>
        </li>
        <li class="{{ Request::is('kategori_product*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('kategori_product.index') }}"><i class="fas fa-list"></i> <span>Kategori Produk</span></a>
        </li>
        <li class="{{ Request::is('customer*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('customer.index') }}"><i class="fas fa-users"></i> <span>Data Customer</span></a>
        </li>
        <li class="menu-header">Invoice</li>
        <li class="{{ Request::is('data_transaksi') ? 'active' : '' }}">
            <a class="nav-link" href="/data_transaksi"><i class="fas fa-shopping-cart"></i> <span>Data Transaksi</span></a>
        </li>
    </ul>

</aside>