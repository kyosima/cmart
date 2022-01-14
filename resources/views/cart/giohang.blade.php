@extends('layout.master')

@section('title', 'Giỏ hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/giohang.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    @if ($count_cart > 0)
        <div class="container p-3">
            <div class="row">
                <div class="col-xl-9 col-md-9 col-sm-12 col-12 ">
                    <div class="check-all-store store-title">
                        <input type="checkbox" id="checkall-store" data-url="{{route('cart.updateCheckout')}}">
                        <label for="checkall-store">
                            <span>Chọn tất cả</span>
                        </label>
                    </div>
                    <div class="list-stores">
                        @foreach ($stores as $store)
                            @php
                                $cart = Cart::instance($store->id);
                            @endphp
                            @if ($cart->count() > 0)
                                <div class="cart-block">
                                    <div class="store-title">
                                        <input type="checkbox" id="store-{{$store->id}}" value="{{$store->id}}">
                                        <label for="store-{{$store->id}}">
                                            <span>{{$store->name}}</span> <span>- {{ $cart->count() }}</span> sản phẩm</span>
                                        </label>

                                    </div>
                                    <hr>
                                    <div id="store_cart">
                                        <ul class="cart_head">
                                            <li class="cart_head_title">
                                                Ảnh
                                            </li>
                                            <li class="cart_head_product">
                                                Tên sản phẩm
                                            </li>
                                            <li class="cart_head_options">
                                                Số lượng
                                            </li>
                                            <li class="cart_head_price">
                                                Tổng tiền
                                            </li>
                                        </ul>
                                        @foreach ($cart->content() as $row)
                                            <ul class="cart_item">

                                                <li class="cart_img_col">
                                                    <a href="{{ route('san-pham.show', $row->model->slug) }}">

                                                        <img src="{{ asset($row->model->feature_img) }}">
                                                    </a>
                                                </li>

                                                <li class="cart_product_col">
                                                    <a
                                                        href="{{ route('san-pham.show', $row->model->slug) }}">{{ $row->name }}</a>
                                                </li>

                                                <li class="cart_options_col">
                                                    <input type="number"
                                                        class="product-qty soluong form-control form-control-sm text-center"
                                                        value="{{ $row->qty }}" step="1" min="1" max="" name="qty"
                                                        value="{{ $row->qty }}" data-rowid="{{ $row->rowId }}"
                                                        data-url="{{ route('cart.update') }}" data-storeid="{{$store->id}}" title="SL" size="3"
                                                        pattern="[0-9]*" inputmode="numeric">
                                                </li>

                                                <li class="cart_price_col">
                                                    <h2>{{ formatPrice($row->price * $row->qty) }}</h2>
                                                </li>
                                                <li class="cart_del_col">
                                                    <img src="https://i.imgur.com/bI4oD5C.png" class="remove"
                                                        onclick="removeRowCart(this)"
                                                        data-url="{{ route('cart.delete') }}"
                                                        data-rowid="{{ $row->rowId }}" data-storeid="{{$store->id}}" aria-label="Xóa sản phẩm">
                                                </li>
                                            </ul>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>


                </div>
                <div class="col-xl-3 col-md-3 col-sm-12 col-12 ">
                    <div class="form-checkout">
                        <div class="form-cart-title">
                            <h3>Thanh toán </h3>
                        </div>
                        <div class="cart-right">
                            <form action="{{route('cart.checkout')}}" method="post">
                                @csrf
                                <input type="hidden" name="store_ids" value="">
                                <div class="cart-body">
                                    <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                            class="tamtinh-price cart-subtotal"><span class="amount">0 đ</span></span> </p>
                                    <hr>
                                    <p class="total"> <span>Giá trị giao dịch:</span> <span
                                            class="total-price cart-total"><span class="amount">0 đ</span></span>
                                    </p>
                                </div>
                                <button class="btn-dathang" type="submit" disabled>Chọn cửa hàng cần thanh toán</button>
                            </form>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    @else
        <!-- -----------CHƯA CÓ SẢN PHẨM TRONG GIỎ HÀNG--------- -->
        <div class="no-product">
            <div class="cart-img">
                <img src="{{ asset('assets/image/cart.png') }}" alt="">
                <p class="cart-img-text">Bạn chưa có sản phẩm nào trong giỏ hàng. Vui lòng quay lại chọn thêm sản phẩm.</p>
            </div>
            <div class="btn">
                <button class="btn-primary btn-a">
                    Xem khuyến mãi
                </button>
                <a class="btn-primary btn-b" href="{{ url('/danh-muc-san-pham') }}">
                    Tiếp tục mua sắm
                </a>
            </div>
        </div>
    @endif
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
@endsection

@push('scripts')
    <script>
        window.addEventListener("load", function() {
            const slider = document.querySelector(".slider");
            const sliderMain = document.querySelector(".slider-product");
            const sliderItems = document.querySelectorAll(".slider-product-item");
            const nextBtn = document.querySelector(".slide-btn-next");
            const prevBtn = document.querySelector(".slide-btn-prev");
            const slideritemWidth = sliderItems[0].offsetWidth;
            console.log("slideritemWidth", slideritemWidth);
        });
    </script>
@endpush
