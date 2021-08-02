 <main>
     <!-- Hero Area Start-->
     <div class="slider-area ">
         <div class="single-slider slider-height2 d-flex align-items-center">
             <div class="container">
                 <div class="row">
                     <div class="col-xl-12">
                         <div class="hero-cap text-center">
                             <h2>Orders</h2>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!--================ confirmation part start =================-->
     <section class="confirmation_part section_padding">
         <div class="container">
             @foreach ($orders as $key => $order)
                 <div class="row ">
                     <div class="col-lg-12">
                         <div class="order_details_iner rounded shadow bg-light">

                             <table class="table table-borderless ">
                                 <thead>
                                     <tr>
                                         <th scope="col" colspan="2">
                                             <h3>Tanggal Pesan |
                                                 <span class="text-danger">
                                                     {{ date('d - m - Y', strtotime($order->tgl_pesan)) }}
                                                 </span>
                                             </h3>
                                         </th>
                                         <th scope="col"></th>
                                         <th scope="col">
                                             <h3 class="text-right">Status Pesanan |
                                                 <b class="text-danger">{{ $order->status }}</b>
                                             </h3>
                                         </th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     @foreach ($orderz[$key] as $detail)
                                         <tr>
                                             <td colspan="3">
                                                 <div class="row">
                                                     <div class="col-2">
                                                         <img src="{{ asset('storage/product/' . $detail->gambar) }}"
                                                             alt="Produk" style="width:68px">
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
                                             <td> <span>Rp {{ $detail->harga }}</span></td>
                                         </tr>
                                     @endforeach
                                 </tbody>
                                 <tfoot>
                                     <tr>
                                         <th scope="col" colspan="3">
                                             <a href="/orders-detail/{{ $order->id }}"
                                                 class="genric-btn primary-border">Rincian Pesanan</a>
                                             @if (empty($order->bukti_bayar) && $order->status != 'dibatalkan')
                                                 <a href="/orders-payment/{{ $order->id }}"
                                                     class="genric-btn danger-border">Bayar Sekarang</a>
                                             @elseif (!empty($order->bukti_bayar) && $order->status == 'verifikasi')
                                                 <a href="/orders-payment/{{ $order->id }}"
                                                     class="genric-btn danger-border">Upload Ulang Bukti</a>
                                             @endif

                                         </th>
                                         <th scope="col">Total : {{ $order->total }}</th>
                                     </tr>
                                 </tfoot>
                             </table>
                         </div>
                     </div>
                 </div>
             @endforeach
         </div>
     </section>
     <!--================ confirmation part end =================-->
 </main>
