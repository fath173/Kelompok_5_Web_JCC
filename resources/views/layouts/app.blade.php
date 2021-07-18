<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- @if (empty(Auth::user()))
        @include('layouts.frontend.css') --}}
    @if (empty(Auth::user()) || Auth::user()->level == 'pelanggan')
        @include('layouts.frontend.css')
    @elseif (Auth::user()->level == 'admin' && !empty(Auth::user()) )
        @include('layouts.backend.css')
    @endif
    @livewireStyles
    @stack('style-custom')
</head>

<body>


    {{-- Frontend --}}

    @if (empty(Auth::user()) || Auth::user()->level == 'pelanggan')
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="{{ asset('frontend/logo/logo_pkopi1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div id="app">

            <header>
                <!-- Header Start -->
                <div class="header-area">
                    <div class="main-header header-sticky">
                        <div class="container-fluid">
                            <div class="menu-wrapper">
                                <!-- Logo -->
                                <div class="logo">
                                    <a href="index.html"><img src="{{ asset('frontend/logo/JCCCoklat.png') }}"
                                            height="60px" alt=""></a>
                                </div>
                                <!-- Main-menu -->
                                <div class="main-menu d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="{{ url('/') }}">Home</a></li>
                                            <li><a href="/products">Produk</a></li>
                                            <li><a href="/gallery">Galeri</a></li>
                                            @guest
                                                @if (Route::has('login'))
                                                    <li><a href="{{ route('loginn') }}">Login</a></li>
                                                @endif
                                                @if (Route::has('register'))
                                                    <li><a href="{{ route('registerr') }}">Daftar</a></li>
                                                @endif
                                            @else
                                                {{-- <li><a href="/cart">Keranjang</a></li> --}}
                                                <li><a href="/">{{ Auth::user()->name }}</a>
                                                    <ul class="submenu">
                                                        <li><a href="/account">Akun Saya</a></li>
                                                        <li><a href="/orders">Pesanan</a></li>
                                                        <li><a href="{{ route('logout') }}"
                                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                                        </li>
                                                        <form id="logout-form" action="{{ route('logout') }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </ul>
                                                </li>
                                            @endguest
                                        </ul>
                                    </nav>
                                </div>
                                <!-- Header Right -->
                                <div class="header-right">
                                    <ul>
                                        <li> <a href="/account"><span class="flaticon-user"></span></a></li>
                                        @if (!empty(Auth::user()))
                                            <li><a href="/cart">
                                                    <span class="flaticon-shopping-cart">
                                                        <livewire:frontend.carts.button-carts />
                                                    </span>

                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header End -->
            </header>


            {{-- @include('layouts.frontend.navbar') --}}
            @yield('content')
            {{ isset($slot) ? $slot : null }}
            @include('layouts.frontend.footer')
        </div>
        @include('layouts.frontend.js')
        @include('layouts.swal')

        {{-- Backend --}}
    @elseif (Auth::user()->level == 'admin' && !empty(Auth::user()))
        @include('layouts.backend.navbar')

        <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
            <!-- Header-->
            <header id="header" class="header">
                <div class="top-left">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                        <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
                        <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
                <div class="top-right">
                    <div class="header-menu">
                        <div class="header-left">
                            <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                        aria-label="Search">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div>

                        </div>

                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="images/admin.jpg" alt="User Avatar">
                            </a>

                        </div>

                    </div>
                </div>
            </header>
            <!-- /#header -->

            <!-- Content -->
            <div class="content">
                <!-- Animated -->
                <div class="animated fadeIn">
                    @yield('content')

                    {{ isset($slot) ? $slot : null }}
                </div>
                <!-- .animated -->
            </div>
            <!-- /.content -->
            <div class="clearfix"></div>

            <!-- Footer -->
            <footer class="site-footer">
                <div class="footer-inner bg-white">
                    <div class="row">
                        <div class="col-sm-6">
                            Copyright &copy; 2018 Ela Admin
                        </div>
                        <div class="col-sm-6 text-right">
                            Designed by <a href="https://colorlib.com">Colorlib</a>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- /.site-footer -->
        </div>
        <!-- /#right-panel -->

        @include('layouts.backend.js')
        @include('layouts.swal')
    @endif

    @livewireScripts
    @stack('script-custom')

</body>

</html>
