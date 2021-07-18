<!--? Preloader Start -->
{{-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
                <img src="{{ asset('frontend/assets/img/logo/logo.png') }}" alt="">
            </div>
        </div>
    </div>
</div> --}}
<!-- Preloader Start -->
<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('frontend/logo/logo_pkopi2.png') }}" height="60px"
                                alt=""></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                    @endif
                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">Daftar</a></li>
                                    @endif
                                @else
                                    <li><a href="/products">Products</a></li>
                                    <li><a href="/account">Akun </a></li>
                                    <li><a href="/cart">Cart
                                            <livewire:frontend.carts.button-carts />
                                        </a></li>
                                    <li><a href="blog.html">{{ Auth::user()->name }}</a>
                                        <ul class="submenu">
                                            <li><a href="/orders">Orders</a></li>
                                            <li><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                                                                                                    document.getElementById('logout-form').submit();">Logout</a>
                                            </li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
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
                            <li>
                                <div class="nav-search search-switch">
                                    <span class="flaticon-search"></span>
                                </div>
                            </li>
                            <li> <a href="login.html"><span class="flaticon-user"></span></a></li>
                            <li><a href="/cart"><span class="flaticon-shopping-cart">
                                        {{-- <livewire:frontend.carts.button-carts /> --}}
                                    </span>
                                </a>
                            </li>
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
