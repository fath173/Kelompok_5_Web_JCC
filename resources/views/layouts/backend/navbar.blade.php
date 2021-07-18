<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="{{ Nav::isResource('.') }}">
                    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="{{ Nav::isResource('admin-petugas') }}">
                    <a href="/admin-petugas"><i class="menu-icon fa fa-user"></i>Petugas </a>
                </li>
                <li class="{{ Nav::isResource('admin-pelanggan') }}">
                    <a href="/admin-pelanggan"><i class="menu-icon fa fa-users"></i>Pelanggan </a>
                </li>
                <li class="{{ Nav::isResource('admin-orders') }}">
                    <a href="/admin-orders"><i class="menu-icon fa fa-tasks"></i>Pesanan </a>
                </li>
                <li class="{{ Nav::isResource('admin-products') }}">
                    <a href="/admin-products"><i class="menu-icon fa fa-laptop"></i>Produk </a>
                </li>
                <li class="{{ Nav::isResource('admin-galeri') }}">
                    <a href="/admin-galeri"><i class="menu-icon fa fa-th"></i>Galeri </a>
                </li>
                <li class="{{ Nav::isResource('admin-testimoni') }}">
                    <a href="/admin-testimoni"><i class="menu-icon fa fa-smile-o"></i>Testimoni </a>
                </li>
                <li class="{{ Nav::isResource('admin-laporan') }}">
                    <a href="/admin-laporan"><i class="menu-icon fa fa-file-o"></i>Laporan Pesanan </a>
                </li>
                <li><a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                {{-- INI yang di edit --}}

            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
<!-- /#left-panel -->
