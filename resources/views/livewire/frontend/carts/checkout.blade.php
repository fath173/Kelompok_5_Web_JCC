<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="hero-cap text-center">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Cart Area =================-->

    <section class="cart_area pt-4">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="{{ asset('storage/product/' . $cart['attributes']->image) }}"
                                                    alt="" width="80px" />
                                            </div>
                                            <div class="media-body">
                                                <p>{{ $cart['name'] }} <br>
                                                    Berat : {{ $cart['attributes']->weight }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>Rp {{ number_format($cart['pricesingle'], 2, ',', '.') }}</h5>
                                    </td>
                                    <td>
                                        {{ $cart['qty'] }}
                                    </td>
                                    <td style="width: 15%">
                                        <h5>Rp {{ number_format($cart['price'], 2, ',', '.') }}</h5>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="5">
                                    <h5 class="text-center">Empty Cart!</h5>
                                </td>
                            @endforelse
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total Pembayaran :</h5>
                                </td>
                                <td>
                                    <h3 id="totalbayar">Rp </h3>
                                </td>
                            </tr>
                            <tr class="shipping_area">
                                <td>
                                    <h4>Alamat Pengiriman</h4>
                                    <b>{{ $name }}</b>
                                    {{ $address }}
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button data-toggle="modal" data-target="#updateOngkir"
                                        class="btn btn-danger btn-sm">Ongkir</button>
                                    @include('livewire.frontend.carts.modal-ongkir')

                                </td>
                            </tr>

                        </tbody>
                    </table>

                    <h4>Total : Rp {{ number_format($summary['total'], 2, ',', '.') }}</h4>
                    <h5 id="hongkir">Ongkir: Rp </h5>

                    <div id="hasil"></div>

                    <div class="mt-3" id="alert"></div>
                    @if (session()->has('error'))
                        <div class="alert alert-danger fade show">
                            <span type="button" class="close" data-dismiss="alert">&times;</span>
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="checkout_btn_inner float-right">
                        <button class="btn btn-danger btn-block" id="buatPesanan">Buat pesanan</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->
</main>

<input type="hidden" id="isubtotal" value="{{ $summary['total'] }}">

@push('script-custom')
    <script>
        var selectongkiri = document.getElementById('xongkiri')
        var selectongkir = document.getElementById('xongkir')
        var hongkir = document.getElementById('hongkir')
        var totalbayar = document.getElementById('totalbayar')
        var buatPesanan = document.getElementById('buatPesanan')
        var iSubTotal = document.getElementById('isubtotal').value
        var ongkir, total, keterangan


        function coba() {
            var ongkos = document.querySelector('input[name="pengiriman"]:checked').getAttribute('harga')
            var jasa = document.querySelector('input[name="pengiriman"]:checked').getAttribute('jasa')
            document.getElementById('hasil').innerHTML = "hasil: " + jasa + " dan " + ongkos

            ongkir = ongkos
            keterangan = jasa
            hongkir.innerHTML = 'Ongkir: Rp ' + ongkos

            var grandtotal = parseInt(ongkos) + parseInt(iSubTotal)
            total = grandtotal
            totalbayar.innerHTML = 'Rp ' + grandtotal
        }

        buatPesanan.addEventListener('click', function() {
            // alert(ongkir + ' ' + total +' ' + keterangan)
            if (ongkir === undefined || total === undefined || keterangan === undefined) {
                $('#alert').empty();
                $('#alert').append(
                    `<div class="alert alert-warning fade show"><span type="button" class="close" data-dismiss="alert">&times;</span>Silahkan pilih <b>Jasa Pengiriman!</b></div>`
                );
            } else {
                // alert(ongkir + total + keterangan)
                Livewire.emit('btnBuatPesanan', ongkir, total, keterangan)
            }
        })
        // selectongkir.addEventListener("change", function() {
        //     var ongkos = this.options[this.selectedIndex].getAttribute('ongkir');
        //     var jasa = this.options[this.selectedIndex].getAttribute('jasa');
        //     ongkir = ongkos
        //     keterangan = jasa
        //     hongkir.innerHTML = 'Ongkir: Rp ' + ongkos

        //     var grandtotal = parseInt(ongkos) + parseInt(iSubTotal)
        //     total = grandtotal
        //     totalbayar.innerHTML = 'Rp ' + grandtotal
        // })
    </script>

@endpush
