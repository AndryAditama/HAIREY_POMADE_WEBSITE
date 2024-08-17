<ul class="navbar-nav">
    <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
        <a href="/home" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
    </li>
    @if(session()->get('logged_in') == true)
    <li class="nav-item {{ Request::is('customer/data_keranjang') ? 'active' : '' }}">
        <a href="/customer/data_keranjang" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Keranjang</span></a>
    </li>
    <li class="nav-item {{ Request::is('customer/transaksi') ? 'active' : '' }}">
        <a href="/customer/transaksi" class="nav-link"><i class="fas fa-shopping-bag"></i><span>Transaksi</span></a>
    </li>
    <li class="nav-item {{ Request::is('customer/histori_transaksi') ? 'active' : '' }}">
        <a href="/customer/histori_transaksi" class="nav-link"><i class="fas fa-history"></i><span>Histori Transaksi</span></a>
    </li>
    @endif
</ul>