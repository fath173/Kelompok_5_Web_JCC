<main>
    <!--================Single Product Area =================-->
    <div class="product_image_area" style="margin-top: 0px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="product_img_slide owl-carousel">
                        <div class="single_product_img">
                            <img src="{{ asset('storage/product/' . $details[0]->gambar) }}" alt="#" class="img-fluid"
                                style="width:600px">
                        </div>
                        <div class="single_product_img">
                            <img src="{{ asset('storage/product/' . $details[0]->gambar) }}" alt="#" class="img-fluid"
                                style="width:600px">
                        </div>
                        <div class="single_product_img">
                            <img src="{{ asset('storage/product/' . $details[0]->gambar) }}" alt="#" class="img-fluid"
                                style="width:600px">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="single_product_text text-center">
                        <h3>{{ $details[0]->nama_produk }}</h3>
                        <p>
                            {{ $details[0]->deskripsi }}
                        </p>
                        <div class="card_area">
                            <div class="product_count_area">
                                <p>Pilih Variasi : </p>
                                <p class="text-danger font-weight-bold">
                                    @if (session()->has('error'))
                                        <div class="alert alert-danger fade show">
                                            <span type="button" class="close" data-dismiss="alert">&times;</span>
                                            {{ session('error') }}
                                        </div>
                                    @endif
                                </p>
                                {{-- <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="product_count_item input-number" type="text" value="1" min="0"
                                        max="10">
                                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span> --}}

                                <div id="myDiv">
                                    @forelse ($details[0]->variasi as $detail)

                                        <button id="btnproduk" type="button" idvariasi="{{ $detail->id }}"
                                            stok="{{ $detail->stok }}" harga="{{ $detail->harga }}"
                                            {{-- wire:click="addItems({{ $detail->id }})" --}} class="btn btn_3 btn-sm" data-toggle="modal"
                                            data-target="#myModa">
                                            {{ $detail->nama_variasi }}
                                            {{ $detail->berat }}gr
                                            id:{{ $detail->id }}
                                        </button>
                                    @empty
                                        <h6>Empty Variations</h6>
                                    @endforelse
                                </div>
                            </div>
                            <p class="mt-3">Harga: <b id="price"></b><br>Stok Tersisa: <b
                                    id="stock">{{ $totalStok }}</b> buah</p>
                            <input type="hidden" value="0" id="idVariation">
                            {{-- <button id="btnKeranjang" class="btn btn-success">+Masukkan Keranjang</button>
                            <button id="btnKeranjang2" class="btn btn-secondary">Beli Sekarang</button> --}}
                            <div class="add_to_cart">
                                <button id="btnKeranjang" class="btn btn-primary">add to cart</button>
                            </div>
                            <div class="mt-3" id="alert" style="width: 50%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->
    <!-- subscribe part here -->
    <section class="subscribe_part section_padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="subscribe_part_content">
                        <h2>Get promotions & updates!</h2>
                        <p>Seamlessly empower fully researched growth strategies and interoperable internal or “organic”
                            sources credibly innovate granular internal .</p>
                        <div class="subscribe_form">
                            <input type="email" placeholder="Enter your mail">
                            <a href="#" class="btn_1">Subscribe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- subscribe part end -->
</main>
@push('script-custom')
    <script>
        var price = document.getElementById('price')
        var stock = document.getElementById('stock')
        var idVariation = document.getElementById('idVariation')
        var btnKeranjang = document.getElementById('btnKeranjang')
        var myDiv = document.querySelector('#myDiv')
        var buttonSm = myDiv.querySelectorAll('.btn-sm')
        for (i = 0; i < buttonSm.length; i++) {
            btnReady()
        }

        btnKeranjang.addEventListener('click', function() {
            var id = idVariation.value
            if (id <= 0) {
                $('#alert').empty();
                $('#alert').append(
                    `<div class="alert alert-warning fade show"><span type="button" class="close" data-dismiss="alert">&times;</span><b>Silahkan pilih <b>Variasi!</b></div>`
                );
            } else {
                Livewire.emit('btnKeranjang', id)
            }
        })

        function btnReady() {
            buttonSm[i].addEventListener("click", function() {
                var stok = this.getAttribute('stok')
                var harga = this.getAttribute('harga')
                var idvariasi = this.getAttribute('idvariasi')
                price.innerText = formatRupiah(harga, 'Rp')
                stock.innerText = stok
                idVariation.value = idvariasi
                // console.log(stok + "dan" + harga)
                // document.querySelector('.btn-sm').classList.remove("active")
                // this.classList.add("active")
            })
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>

@endpush
