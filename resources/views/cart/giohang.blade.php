@extends('layout.master')

@section('title', 'Giỏ hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/giohang.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
@endpush

@section('content')
    <div class="container p-3">
        <div class="row">
            <div class="col-xl-9 col-sm-12 col-12 ">
                <div class="product-cart">
                    <div class="product-title">
                        <h3>Giỏ hàng </h3>
                        <span>- 4 sản phẩm</span>
                    </div>
                    <hr>
                    <div class="product-main">
                        <div class="product-main-item">
                            <div class="product-main-item-box">
                                <div class="product-main-item-box-img ">
                                    <a href="#"><img src="{{ asset('assets/image/product-cart2.jpeg') }}" alt=""
                                            class="product-main-item-box-img-item"></a>
                                </div>
                                <div class="product-main-item-box-detail">
                                    <div class="product-main-item-box-detail-title">
                                        <a href=""> Combo 2 hộp nước uống Collagen & Hyaluron Fine Japan Plus 5250mg (Hộp 10
                                            chai x 50ml) </a>
                                    </div>
                                    <div class="product-main-item-box-detail-btn-delete"><a href="">Xóa</a> </div>
                                </div>
                                <span class="product-main-item-box-price">3.998.000 đ</span>
                                <div class="product-main-item-box-add-delete">
                                    <button class="btn-giam">-</button>
                                    <input type="number" class="soluong form-control form-control-sm">
                                    <button class="btn-tang">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-main">
                        <div class="product-main-item">
                            <div class="product-main-item-box">
                                <div class="product-main-item-box-img">
                                    <a href="#"><img src="{{ asset('assets/image/product-cart2.jpeg') }}" alt=""
                                            class="product-main-item-box-img-item"></a>
                                </div>
                                <div class="product-main-item-box-detail">
                                    <div class="product-main-item-box-detail-title">
                                        <a href=""> Combo 2 hộp nước uống Collagen & Hyaluron Fine Japan Plus 5250mg (Hộp 10
                                            chai x 50ml) </a>
                                    </div>
                                    <div class="product-main-item-box-detail-btn-delete"><a href="">Xóa</a> </div>
                                </div>
                                <span class="product-main-item-box-price">3.998.000 đ</span>
                                <div class="product-main-item-box-add-delete">
                                    <button class="btn-giam">-</button>
                                    <input type="number" class="soluong form-control form-control-sm">
                                    <button class="btn-tang">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-main">
                        <div class="product-main-item">
                            <div class="product-main-item-box">
                                <div class="product-main-item-box-img">
                                    <a href="#"><img src="{{ asset('assets/image/product-cart2.jpeg') }}" alt=""
                                            class="product-main-item-box-img-item"></a>
                                </div>
                                <div class="product-main-item-box-detail">
                                    <div class="product-main-item-box-detail-title">
                                        <a href=""> Combo 2 hộp nước uống Collagen & Hyaluron Fine Japan Plus 5250mg (Hộp 10
                                            chai x 50ml) </a>
                                    </div>
                                    <div class="product-main-item-box-detail-btn-delete"><a href="">Xóa</a> </div>
                                </div>
                                <span class="product-main-item-box-price">3.998.000 đ</span>
                                <div class="product-main-item-box-add-delete">
                                    <button class="btn-giam">-</button>
                                    <input type="number" class="soluong form-control form-control-sm">
                                    <button class="btn-tang">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-main">
                        <div class="product-main-item">
                            <div class="product-main-item-box">
                                <div class="product-main-item-box-img">
                                    <a href="#"><img src="{{ asset('assets/image/product-cart2.jpeg') }}" alt=""
                                            class="product-main-item-box-img-item"></a>
                                </div>
                                <div class="product-main-item-box-detail">
                                    <div class="product-main-item-box-detail-title">
                                        <a href=""> Combo 2 hộp nước uống Collagen & Hyaluron Fine Japan Plus 5250mg (Hộp 10
                                            chai x 50ml) </a>
                                    </div>
                                    <div class="product-main-item-box-detail-btn-delete"><a href="">Xóa</a> </div>
                                </div>
                                <span class="product-main-item-box-price">3.998.000 đ</span>
                                <div class="product-main-item-box-add-delete">
                                    <button class="btn-giam">-</button>
                                    <input type="number" class="soluong form-control form-control-sm">
                                    <button class="btn-tang">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-12 col-12 ">
                <div class="cart-right">
                    <div class="cart-body">
                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                class="tamtinh-price">3.314.000đ</span> </p>
                        <hr>
                        <p class="total"> <span>Tổng cộng:</span> <span class="total-price">3.314.000đ</span>
                        </p>
                    </div>
                    <button class="btn-dathang">Đặt hàng</button>
                </div>
            </div>

        </div>
    </div>

    <!-- -----------CHƯA CÓ SẢN PHẨM TRONG GIỎ HÀNG--------- -->
    <!-- <div class="no-product">
                <div class="cart-img">
                    <img src="{{ asset('assets/image/cart.png') }}" alt="">
                    <p class="cart-img-text" >Bạn chưa có sản phẩm nào trong giỏ hàng. Vui lòng quay lại chọn thêm sản phẩm.</p>
                </div>
                <div class="btn">
                    <button class="btn-primary btn-a">
                        Xem khuyến mãi
                    </button>
                    <button class="btn-primary btn-b">
                        Tiếp tục mua sắm
                    </button>
                </div>
            </div> -->

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
