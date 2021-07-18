<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Galeri Foto</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->

    <section class="new-product-area section-padding">
        <div class="container">
            <!-- Section tittle -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-tittle mb-70">
                        <h2>Galeri Terbaru</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($gallery as $galeri )
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="single-new-pro mb-30 text-center">
                            <div class="product-img">
                                <img src="{{ asset('storage/gallery/' . $galeri->gambar) }}" alt="">
                            </div>
                            <div class="product-caption">
                                <h3><a href="product_details.html">{{ $galeri->judul_gambar }}</a></h3>
                                <span
                                    style="display: inline-block;overflow: hidden !important;width: 70%;white-space: nowrap;text-overflow: ellipsis;color: grey;">
                                    {{ $galeri->deskripsi }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <h1>Empty Galery Foto</h1>
                @endforelse


            </div>
        </div>
    </section>
</main>
