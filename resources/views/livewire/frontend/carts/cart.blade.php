<main>
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center" style="min-height: 200px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="hero-cap text-center">
                            <h2>Cart List</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================Cart Area =================-->
    <p class="text-danger font-weight-bold">
        @if (session()->has('error'))
            {{ session('error') }}
        @endif
        @if (session('success_message'))
            <div class="alert alert-success">
                {{ session('success_message') }}
            </div>
        @endif
    </p>

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
                                <th scope="col">Aksi</th>
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
                                        <div class="product_count">
                                            <span class="input-number-decrement"> <i
                                                    wire:click="decreaseItem('{{ $cart['rowId'] }}')" class="ti-minus"
                                                    style="cursor:pointer"></i></span>
                                            <input class="input" type="text" value="{{ $cart['qty'] }}"
                                                style="height: 60px;">
                                            <span class="input-number-increment"> <i
                                                    wire:click="increaseItem('{{ $cart['rowId'] }}')" class="ti-plus"
                                                    style="cursor:pointer"></i></span>
                                        </div>
                                    </td>
                                    <td style="width: 15%">
                                        <h5>Rp {{ number_format($cart['price'], 2, ',', '.') }}</h5>
                                    </td>
                                    <td style="width: 15%">
                                        <button class="genric-btn primary-border small"
                                            wire:click="removeItem('{{ $cart['rowId'] }}')">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="5">
                                    <h5 class="text-center">Empty Cart!</h5>
                                </td>
                            @endforelse
                        </tbody>


                        {{-- <tr class="bottom_button">
                            <td>
                                <a class="btn_1" href="#">Products</a>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="cupon_text float-right">
                                    <a class="btn_1" href="/checkout">Checkout</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Subtotal</h5>
                            </td>
                            <td>
                                <h5>$2160.00</h5>
                            </td>
                        </tr>
                        <tr class="shipping_area">
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Shipping</h5>
                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li>
                                            Flat Rate: $5.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li>
                                            Free Shipping
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li>
                                            Flat Rate: $10.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                        <li class="active">
                                            Local Delivery: $2.00
                                            <input type="radio" aria-label="Radio button for following text input">
                                        </li>
                                    </ul>
                                    <h6>
                                        Calculate Shipping
                                        <i class="fa fa-caret-down" aria-hidden="true"></i>
                                    </h6>
                                    <select class="shipping_select">
                                        <option value="1">Bangladesh</option>
                                        <option value="2">India</option>
                                        <option value="4">Pakistan</option>
                                    </select>
                                    <select class="shipping_select section_bg">
                                        <option value="1">Select a State</option>
                                        <option value="2">Select a State</option>
                                        <option value="4">Select a State</option>
                                    </select>
                                    <input class="post_code" type="text" placeholder="Postcode/Zipcode" />
                                    <a class="btn_1" href="#">Update Details</a>
                                </div>
                            </td>
                        </tr> --}}

                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        {{-- <a class="btn_1" href="#">Continue Shopping</a> --}}
                        <a class="btn_1 checkout_btn_1" href="/checkout">Checkout</a>
                    </div>
                </div>
            </div>
    </section>
    <!--================End Cart Area =================-->
</main>
