{{-- @extends('layouts.app') --}}

@if (empty(Auth::user()) || Auth::user()->level == 'pelanggan')
    @section('content')
        <main>
            <!--? slider Area Start -->
            <div class="slider-area ">
                <div class="slider-active">
                    <!-- Single Slider -->
                    <div class="single-slider slider-height d-flex align-items-center slide-bg">
                        <div class="container">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                    <div class="hero__caption">
                                        <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Jember Coffe
                                            Center
                                        </h1>
                                        <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Menikmati
                                            kopi dengan
                                            penuh kemewahan dengan produk dari Jember Coffe Center
                                        </p>
                                        <!-- Hero-btn -->
                                        <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s"
                                            data-duration="2000ms">
                                            <a href="/products" class="btn hero-btn">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                                    <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                        <img src="{{ asset('frontend/banner/banner12.png') }}" alt="" class=" heartbeat">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Single Slider -->

                </div>
            </div>
            <!-- slider Area End-->

            <!-- ? New Product Start -->
            <section class="new-product-area section-padding30">
                <div class="container">
                    <!-- Section tittle -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="section-tittle mb-70">
                                <h2>Produk Terbaru</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                <div class="single-new-pro mb-30 text-center">
                                    <div class="product-img">
                                        <img src="{{ asset('storage/product/' . $product->gambar) }}" alt="">
                                    </div>
                                    <div class="product-caption">
                                        <h3><a href="products/{{ $product->id }}">{{ $product->nama_produk }}</a></h3>
                                        <span>New Produts</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <!--  New Product End -->
            <!--? Gallery Area Start -->
            <div class="gallery-area">
                <div class="container-fluid p-0 fix">
                    <div class="row">
                        <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img big-img"
                                    style="background-image: url({{ asset('frontend/banner/banner4.jpg') }});">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img big-img"
                                    style="background-image: url({{ asset('frontend/banner/banner3.jpg') }});">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-12">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6">
                                    <div class="single-gallery mb-30">
                                        <div class="gallery-img small-img"
                                            style="background-image: url({{ asset('frontend/produk/arabica.jpg') }});">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12  col-md-6 col-sm-6">
                                    <div class="single-gallery mb-30">
                                        <div class="gallery-img small-img"
                                            style="background-image: url({{ asset('frontend/produk/robusta.jpg') }});">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Gallery Area End -->

            <section class="section-padding30">
                <!-- partial:index.partial.html -->
                <div class="gtco-testimonials">
                    <h2>Testimonials</h2>
                    <div class="owl-carousel owl-carousel1 owl-theme">
                        @foreach ($testi as $data)

                            <div>
                                <div class="card text-center"><img class="card-img-top"
                                        src="{{ asset('storage/img-users/' . $data->image) }}" alt="">
                                    <div class="card-body">
                                        <h5>{{ $data->name }} <br />
                                        </h5>
                                        <p class="card-text">{{ $data->kesan }}</p>
                                        <span class="d-flex justify-content-end text-secondary"><i>
                                                {{ date('d M Y', strtotime($data->tgl_testi)) }}</i> </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <!-- partial -->
            </section>

            <!--? Video Area Start -->
            <div class="video-area" style="background-image:url({{ asset('frontend/logo/JCCCoklat.png') }});">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="video-wrap">
                                <div class="play-btn "><a class="popup-video"
                                        href="https://www.youtube.com/watch?v=KMc6DyEJp04"><i class="fas fa-play"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Arrow -->
                    <div class="thumb-content-box">
                        <div class="thumb-content">
                            <h3>Profile Video</h3>
                            {{-- <a href="#"> <i class="flaticon-arrow"></i></a> --}}
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!--? Search model Begin -->
        <div class="search-model-box">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-btn">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Searching key.....">
                </form>
            </div>
        </div>
        <!-- Search model end -->

    @endsection
@else
    @section('content')
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-1">
                                <i class="menu-icon fa fa-user"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $jumPelanggan }}</span></div>
                                    <div class="stat-heading">Pelanggan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-2">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $pesananBaru }}</span></div>
                                    <div class="stat-heading">Pesanan Baru</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-3">
                                <i class="fa fa-list-alt"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $semuaPesanan }}</span></div>
                                    <div class="stat-heading">Semua Pesanan</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="stat-widget-five">
                            <div class="stat-icon dib flat-color-4">
                                <i class="fa fa-smile-o"></i>
                            </div>
                            <div class="stat-content">
                                <div class="text-left dib">
                                    <div class="stat-text"><span class="count">{{ $jumlahTestimoni }}</span></div>
                                    <div class="stat-heading">Testimoni</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
