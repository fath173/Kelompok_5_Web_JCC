@push('style-custom')
    <style>
        .card {
            background: transparent;
            z-index: 0;
            padding-bottom: 20px;
            border: 0px;
        }

        .top {
            padding-top: 40px;
            padding-left: 13% !important;
            padding-right: 13% !important
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: #455A64;
            padding-left: 0px;
            margin-top: 30px
        }

        #progressbar li {
            list-style-type: none;
            font-size: 13px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar .step0:before {
            font-family: FontAwesome;
            content: "\f05a";
            color: #fff
        }

        #progressbar li:before {
            width: 40px;
            height: 40px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            background: #C5CAE9;
            border-radius: 50%;
            margin: auto;
            padding: 0px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 12px;
            background: #C5CAE9;
            position: absolute;
            left: 0;
            top: 16px;
            z-index: -1
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            position: absolute;
            left: -50%
        }

        #progressbar li:nth-child(2):after,
        #progressbar li:nth-child(3):after {
            left: -50%
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px;
            position: absolute;
            left: 50%
        }

        #progressbar li:last-child:after {
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px
        }

        #progressbar li:first-child:after {
            border-top-left-radius: 10px;
            border-bottom-left-radius: 10px
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: red
        }


        #progressbar li.active:before {
            font-family: FontAwesome;
            content: "\f00c"
        }

        .icon {
            width: 60px;
            height: 60px;
            margin-right: 15px
        }

        .icon-content {
            padding-bottom: 20px
        }

        @media screen and (max-width: 992px) {
            .icon-content {
                width: 50%
            }
        }

    </style>
@endpush

<main>
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding ">
        <div class="container mb-5 pb-5">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="blog-author m-0 shadow-sm">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <div class="container-fluid mx-auto">
                                    <div class="card">
                                        <!-- Add class 'active' to progress -->
                                        <div class="row d-flex justify-content-center">
                                            <div class="col-12">
                                                <ul id="progressbar" class="text-center">
                                                    @if ($orders[0]->status == 'belum bayar')
                                                        <li id="li1" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class=" step0">
                                                            <p class="font-weight-bold ">
                                                                <span id="li2i"> Pesanan<br>Belum Bayar </span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @elseif ($orders[0]->status == 'verifikasi')
                                                        <li id="li1" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class=" step0">
                                                            <p class="font-weight-bold ">
                                                                <span id="li2i"> Proses<br>Verifikasi</span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @elseif ($orders[0]->status == 'sudah bayar')
                                                        <li id="li1" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class="step0  active">
                                                            <p class="font-weight-bold">
                                                                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @elseif ($orders[0]->status == 'sedang dikirim')
                                                        <li id="li1" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class="step0 active">
                                                            <p class="font-weight-bold">
                                                                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @elseif ($orders[0]->status == 'selesai')
                                                        <li id="li1" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class="step0 active">
                                                            <p class="font-weight-bold">
                                                                <span id="li2i"> Pesanan<br>Sudah Dibayar</span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0 active">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @else
                                                        <li id="li1" class="step0 ">
                                                            <p class="font-weight-bold">Pesanan<br>Dibuat</p>
                                                        </li>
                                                        <li id="li2" class="step0 ">
                                                            <p class="font-weight-bold">
                                                                <span id="li2i" class="text-danger">
                                                                    Pesanan<br>Dibatalkan</span>
                                                            </p>
                                                        </li>
                                                        <li id="li3" class="step0 ">
                                                            <p class="font-weight-bold">Pesanan<br>Dikirim</p>
                                                        </li>
                                                        <li id="li4" class="step0 ">
                                                            <p class="font-weight-bold">Pesanan<br>Diterima</p>
                                                        </li>
                                                    @endif


                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="blog-author mt-3 shadow-sm">
                        <div class="media align-items-center">
                            <div class="media-body">
                                <h3>Alamat Pengiriman</h3> <br>
                                <b>{{ $orders[0]->user->name }}</b>
                                <p>{{ $orders[0]->alamat_kirim }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author mt-3 shadow-sm">
                        <table class="table table-borderless ">
                            <tbody>
                                @foreach ($ordersDetail['detail'] as $detail)
                                    <tr>
                                        <td colspan="3">
                                            <div class="row">
                                                <div class="col-3">
                                                    <img class="m-0"
                                                        src="{{ asset('storage/product/' . $detail->gambar) }}"
                                                        alt="Produk">
                                                </div>
                                                <div class="col">
                                                    {{ $detail->nama_produk }} <br>
                                                    <span>
                                                        {{ $detail->nama_variasi }}
                                                        {{ $detail->berat }}gr <br> <span
                                                            class="text-lowercase">x</span>
                                                        {{ $detail->qty }} <br>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4"> <span>Rp {{ $detail->harga }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="border-top">
                                    <td class="text-right border-right" scope="col" colspan="3">
                                        Subtotal Produk
                                    </td>
                                    <td scope="col">Rp {{ number_format($ordersDetail['subTotal'], 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-top">
                                    <td class="text-right border-right" scope="col" colspan="3">
                                        Ongkos Kirim
                                    </td>
                                    <td scope="col">Rp {{ number_format($orders[0]->ongkir, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-top border-bottom">
                                    <td class="text-right border-right" scope="col" colspan="3">
                                        Total Produk
                                    </td>
                                    <td scope="col">Rp {{ number_format($orders[0]->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar shadow-sm">
                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Informasi Pesanan</h3>
                            <div class="media post_item">
                                <div class="media-body d-flex justify-content-center">
                                    @if ($orders[0]->status == 'belum bayar')
                                        <button wire:click="cancelOrders()"
                                            class="genric-btn danger-border medium">Batalkan Pesanan</button>
                                    @elseif ($orders[0]->status == 'sedang dikirim')
                                        <button wire:click="confirmOrders()" class="genric-btn info medium">
                                            Konfirmasi Diterima</button>
                                    @elseif ($orders[0]->status == 'dibatalkan')
                                        <b class="bg-danger text-light">Pesanan Dibatalkan</b>
                                    @elseif (empty($testi) && $orders[0]->status == 'selesai' )
                                        <div class="container">
                                            <div class="row mb-3 d-flex justify-content-center">
                                                <b class="bg-success text-light">Selesai</b>
                                            </div>
                                            <div class="row d-flex justify-content-center">
                                                <button data-toggle="modal" data-target="#updateTesti"
                                                    class="genric-btn danger radius">Berikan
                                                    Testimoni</button>
                                            </div>
                                        </div>
                                    @elseif ($orders[0]->status == 'selesai')
                                        <b class="bg-success text-light">Selesai</b>
                                    @endif
                                    {{-- <a href="/orders-purchase/{{ $orders[0]->id }}"class="genric-btn primary-border medium">Nota</a> --}}
                                </div>
                            </div>

                            {{-- awal modal Kontak --}}
                            <div wire:ignore.self class="modal fade" id="updateTesti" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Testimoni</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                <div class="form-group">
                                                    <input type="hidden" wire:model="user_id">
                                                    <label for="exampleFormControlInput1">Tulis Testimoni Anda
                                                        Disini:</label>
                                                    <textarea class="form-control" aria-required="true"
                                                        aria-invalid="false" wire:model.lazy="kesan"> </textarea>
                                                    @error('kesan')<small
                                                        class="text-danger">{{ $message }}</small>@enderror
                                                </div>
                                            </form>
                                            <h1>{{ $kesan }}</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" wire:click="cancel()" class="genric-btn primary"
                                                data-dismiss="modal">Close</button>
                                            <button type="button" wire:click="updateTesti()" class="genric-btn danger"
                                                data-dismiss="modal">Kirim</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- akhir modal Kontak --}}


                            <div class="media post_item mt-5">
                                <div class="media-body">
                                    <div class="row d-flex justify-content-center">
                                        <h6 class="mb-4">Bukti Pembayaran</h6>
                                        <img src="{{ asset('files/payment/' . $orders[0]->bukti_bayar) }}"
                                            class="img-fluid" alt="">
                                    </div>

                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
</main>
<input type="hidden" class="form-input" id="status" value="{{ $orders[0]->status }}">

{{-- @push('script-custom')
    <script>
        var status = document.getElementById('status').value
        if (status == 'belum bayar') {
            document.getElementById('li1').classList.add("active")
        } else if (status == 'verifikasi') {
            document.getElementById('li1').classList.add("active")
            document.getElementById('li2i').innerText = "Verifikasi"
        } else if (status == 'sudah bayar') {
            document.getElementById('li1').classList.add("active")
            document.getElementById('li2').classList.add("active")
            // document.getElementById('li2i').innerText = "Dibayar"
        } else if (status == 'sedang dikirim') {
            document.getElementById('li1').classList.add("active")
            document.getElementById('li2').classList.add("active")
            document.getElementById('li3').classList.add("active")
            document.getElementById('li2i').innerText = "Dibayar"
        } else if (status == 'selesai') {
            document.getElementById('li1').classList.add("active")
            document.getElementById('li2').classList.add("active")
            document.getElementById('li3').classList.add("active")
            document.getElementById('li4').classList.add("active")
            document.getElementById('li2i').innerText = "Dibayar"
        } else if (status == 'dibatalkan') {
            document.getElementById('li1').classList.remove("active")
            document.getElementById('li2i').classList.add("text-danger")
            document.getElementById('li2i').innerText = "Dibatalkan"

        }

    </script>
@endpush --}}
