@extends('layout.master')

@section('title', 'Giỏ hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/giohang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
@endpush

@section('content')
@if(count($carts )> 0)
    <div class="container p-3">
        <div class="row">
            <div class="col-xl-9 col-sm-12 col-12 ">
                <div class="product-cart">
                    <div class="product-title">
                        <h3>Giỏ hàng </h3>
                        <span>- {{ count($carts) }} sản phẩm</span>
                    </div>
                    <hr>
                    @foreach ($carts as $row)

                        <div class="product-main">
                            <div class="product-main-item">
                                <div class="product-main-item-box">
                                    <div class="product-main-item-box-img ">
                                        <a href="{{ route('san-pham.show', $row->model->slug)}}">
                                            <img src="{{ asset('assets/image/product-cart2.jpeg') }}" alt=""
                                                class="product-main-item-box-img-item">
                                        </a>
                                    </div>
                                    <div class="product-main-item-box-detail">
                                        <div class="product-main-item-box-detail-title">
                                            <a href="{{ route('san-pham.show', $row->model->slug)}}">{{ $row->name }}</a>
                                        </div>
                                        <div class="product-main-item-box-detail-btn-delete"><a class="remove"
                                                onclick="removeRowCart(this)" data-url="{{ route('cart.delete') }}"
                                                data-rowid="{{ $row->rowId }}" aria-label="Xóa sản phẩm">Xóa</a> </div>
                                    </div>
                                    <span
                                        class="product-main-item-box-price">{{ formatPrice($row->price * $row->qty) }}</span>
                                    <div class="product-main-item-box-add-delete">
                                        {{-- <button class="btn-giam">-</button> --}}
                                        <input type="number"
                                            class="product-qty soluong form-control form-control-sm text-center"
                                            value="{{ $row->qty }}" step="1" min="1" max="" name="qty"
                                            value="{{ $row->qty }}" data-rowid="{{ $row->rowId }}"
                                            data-url="{{ route('cart.update') }}" title="SL" size="3" pattern="[0-9]*"
                                            inputmode="numeric">
                                        {{-- <button class="btn-tang">+</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
            <div class="col-xl-3 col-sm-12 col-12 ">
                <div class="cart-right">
                    <div class="cart-body">
                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                class="tamtinh-price cart-subtotal"><span
                                    class="amount">{{ $cart_subtotal }}</span></span> </p>
                        <hr>
                        <p class="total"> <span>Tổng cộng:</span> <span class="total-price cart-total"><span
                                    class="amount">{{ $cart_total }}</span></span>
                        </p>
                    </div>
                    <a class="btn-dathang" href="{{route('checkout.index')}}">Đặt hàng</a>
                </div>
            </div>

        </div>
    </div>
@else
    <!-- -----------CHƯA CÓ SẢN PHẨM TRONG GIỎ HÀNG--------- -->
    <div class="no-product">
                            <div class="cart-img">
                                <img src="{{ asset('assets/image/cart.png') }}" alt="">
                                <p class="cart-img-text" >Bạn chưa có sản phẩm nào trong giỏ hàng. Vui lòng quay lại chọn thêm sản phẩm.</p>
                            </div>
                            <div class="btn">
                                <button class="btn-primary btn-a">
                                    Xem khuyến mãi
                                </button>
                                <a class="btn-primary btn-b" href="{{route('san-pham.index')}}">
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
