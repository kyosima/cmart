@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('checkout.post') }}" class="form-checkout" method="post" enctype="multipart/form">
        @csrf
        <div class="container">

            <div class="row">
                <div class="col-xl-8 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="list-stores-checkout mt-0">
                            <div class="list-stores-title text-center" id="url-update-type"
                                data-url="{{ route('checkout.updateTypeShip') }}">
                                <h3>Danh sách sản phẩm</h3>
                            </div>
                            <hr>
                            <div class="list-stores-body">
                                @foreach ($order->order_stores()->get() as $order_store)
                                    {{-- @php
                                        $cart = Cart::instance($store_id);
                                        $store = App\Models\Store::whereId($store_id)->first();
                                    @endphp --}}
                                    <div class="store-block" id="store{{ $order_store->id_store }}">
                                        <div class="store-title d-flex justify-content-between">
                                            <h4>Cửa hàng {{ $order_store->store()->value('name') }}</h4>

                                            {{-- <label for="receiverstore{{ $store_id }}"><input class="receiverstore"
                                                    type="checkbox" id="receiverstore{{ $store_id }}"
                                                    name="receiverstore{{ $store_id }}" value="{{ $store_id }}"
                                                    data-storeid="{{ $store_id }}" onclick="receiverStore(this)"> Nhận
                                                tại cửa
                                                hàng</label> --}}
                                        </div>
                                        <div class="store-body">
                                            @foreach ($order_store->order_products()->get() as $row)
                                                <div id="" class="store-product row">
                                                    <div class="product-image col-1 p-2">
                                                        <img src="{{ asset($row->feature_img) }}">
                                                    </div>
                                                    <div class="product-info col-11 pt-2 pb-2">
                                                        <div class="product-name">
                                                            <p>{{ $row->name }}</p>
                                                        </div>
                                                        <div class="product-cart d-flex justify-content-between">
                                                            <div class="quantity">SL: {{ $row->quantity }}</div>
                                                            <div class="price">Tổng tiền:
                                                                {{ formatPrice($row->price * $row->quantity) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="store-footer d-none justify-content-between ">
                                            <div>Phương thức: <span class="name-method"></span></div>
                                            <div><span class="ship-normal"> </span><span class="ship-fast"></span>
                                            </div>
                                            <div>Tổng tiền: <span class="total-cost"></span></div>
                                            <input type="hidden" class="ship-fee">

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="makhuyenmai">
                            <div class="makhuyenmai-header">
                                <h3>Mã khuyến mãi</h3>
                            </div>
                            <div class="makhuyenmai-body">
                                <input type="text" class="makhuyenmai-body-input" placeholder="Nhập mã...">
                                <button class="btn btn-primary" id="btn-apply-coupon" type="button">Áp dụng</button>
                                <p style="display: none" class="text-danger alert-coupon">Hệ thống không xác thực được mã này. Vui lòng liên hệ Hotline 0899.663.883 để được hỗ trợ</p>

                            </div>
                        </div>
                        <div class="donhang">
                            <div class="donhang-header">
                                <h3>ĐƠN HÀNG</h3> <span> SẢN PHẨM)</span>
                            </div>
                            <div class="donhang-body">

                            </div>
                            <div class="donhang-footer">
                                <div class="card-right">
                                    {{-- <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ $cart_subtotal }} đ</span> </p>
                                        <hr>
                                        <p><b>Phí dịch vụ:</b></p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế:</span> <span
                                                class="tamtinh-price">{{ formatPrice($tax) }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Điểm M quy đổi:</span> <span-->
                                        <!--        class="tamtinh-price">{{ formatPrice($m_point * 100) }} </span> </p>-->
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Điểm C tích lũy:</span>-->
                                        <!--    <span class="tamtinh-price">{{ $c_point }} </span> </p>-->
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Tổng phí dịch vụ:</span>-->
                                        <!--    <span-->
                                        <!--        class="tamtinh-price">{{ formatPrice($tax + $process_fee - $m_point * 100) }}-->
                                        <!--    </span> </p>-->
                                        <hr>
                                        <p><b>Phí vận chuyển:</b></p>
                                        <div class="form-group">
                                            <input type="radio" id="vship" name="shipping_method" value="v_ship" checked>
                                            <label for="vship">Viettel Shipping ({{ formatPrice($v_ship) }})</label><br>
                                            <input type="radio" id="cship" name="shipping_method" value="c_ship">
                                            <label for="cship">CMart Shipping ({{ formatPrice($c_ship) }})</label><br>
                                        </div>
                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price">{{ formatPrice(str_replace(',', '', $cart_total) + $tax + $process_fee - $m_point * 100) }}
                                            </span> </p>
                                    </div> --}}
                                    <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ formatPrice($order->sub_total) }} </span> </p>

                                        <hr>
                                        {{-- <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <hr> --}}
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế VAT:</span> <span
                                                class="tamtinh-price">{{ formatPrice($order->tax) }} </span> </p>
                                        <hr>
                                        <p class="tamtinh"><span>Phí vận chuyển:</span> <span id="amount-shipping"
                                                class="tamtinh-price">{{formatPrice($order->shipping_total)}} đ</span></p>
                                      
                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price" id="total-price-checkout"
                                                data-value="{{ $order->total }}">{{ formatPrice($order->total) }}
                                            </span> </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="chinhsach">
                            <div class="chinhsach-header">
                                <h3>Điều khoản và chính sách</h3>
                            </div>
                            <div class="chinhsach-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="nhanhang"
                                                id="check1">
                                            <label class="custom-control-label" for="check1">Tôi đã đọc và đồng ý với Quy
                                                định Thao tác khi nhận hàng
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="giaonhan"
                                                id="check2">
                                            <label class="custom-control-label" for="check2">Tôi đã đọc và đồng ý với Chính
                                                sách Giao - Nhận</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="doitra" id="check3">
                                            <label class="custom-control-label" for="check3">Tôi đã đọc và đồng ý với Chính
                                                sách Đổi - Trả</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="baohanh" id="check4">
                                            <label class="custom-control-label" for="check4">Tôi đã đọc và đồng ý với Chính
                                                sách Bảo hành</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="dieukhoan"
                                                id="check5">
                                            <label class="custom-control-label" for="check5">Tôi đã đọc và đồng ý với Quy
                                                định Điều khoản & Điều kiện giao dịch</label>
                                        </div>
                                    </li>
                                    {{-- <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" name="dieukhoan" id="check6">
                                          <label class="custom-control-label" for="check6"></label>
                                        </div>
                                      </li> --}}
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkall"
                                                id="check7">
                                            <label class="custom-control-label" for="check7">Chọn tất cả</label>
                                        </div>
                                    </li>
                                </ul>
                                <p class="text-danger error-chinhsach p-1" style="display: none">Bạn phải đồng ý tất cả
                                    chính sách của Cmart</p>
                                <p class="py-1">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông
                                    tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông
                                    tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng, tạo
                                    sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết</p>
                            </div>
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            <div class="phuongthuc-thanhtoan-card-header">
                                <h3>THANH TOÁN</h3>
                            </div>
                            <hr>
                            <div class="phuongthuc-thanhtoan-card-body">
                                <div class="thanhtoankhigiaohang">
                                    <input type="radio" name="payment_method" checked="checked" value="1"> <span>COD(Thanh
                                        toán nhận hàng)</span>
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="thanhtoantructuyen">
                                    <input type="radio" name="payment_method" value="2">
                                    <span>Thanh toán online</span>
                                    <img src="{{ asset('assets/image/payme.png') }}">
                                </div>
                                <!-- <div class="thanhtoantructuyen">
                                            <input type="radio" name="payment_method" value="2" readonly="readonly" disabled>
                                            <span>Chuyển khoản qua ngân hàng</span>
                                            <img src="{{ asset('assets/image/vnpay.png') }}">
                                        </div> -->
                                <!-- <div class="chuyenkhoan">
                                            <input type="radio" name="payment_method" value="3" readonly="readonly" disabled>
                                            <span>Chuyển khoản qua ngân hàng</span>
                                            <div class="tk-nganhang">
                                                <p>Doanh nghiệp: Công ty cổ phần</p>
                                                <p>TK ngân hàng: Công ty cổ phần</p>
                                                <p>Chi nhánh: Công ty cổ phần</p>
                                            </div>
                                        </div> -->
                            </div>
                        </div>
                        <a class="btn-back-cart" href="{{ route('cart.index') }}">Quay lại Giỏ hàng</a>

                        <button class="btn-dathang" type="submit">Tiếp tục Thanh toán</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/shipping.js') }}"></script>
    <script src="{{ asset('public/js/checkout.js') }}"></script>

    <script>
        $("select[name='sel_province']").change(function() {
            if ($(this).val() == '70') {
                $('#cship').prop('checked', true);
                $('#vship').prop('checked', false);
                $('#vship').css('display', 'none');
                $('#lbvship').css('display', 'none');
                $('#lbcship').css('display', 'inline-block');
                $('#cship').css('display', 'inline-block');

            } else {
                $('#vship').prop('checked', true);
                $('#cship').prop('checked', false);
                $('#cship').css('display', 'none');
                $('#lbcship').css('display', 'none');
                $('#lbvship').css('display', 'inline-block');
                $('#vship').css('display', 'inline-block');

            }
        });
        $("input[name='checkall']").click(function() {
            $('.chinhsach-body input:checkbox').not(this).prop('checked', this.checked);
        });
        $('.btn-dathang').click(function(e) {
            if ($('.chinhsach-body input:checkbox').is(':checked')) {

            } else {
                e.preventDefault();
                $('.error-chinhsach').css('display', 'block');
            }
        })

        function storeaddress() {
            if ($('#store-address').is(':checked')) {
                $('#name-address').css("display", "block");
            } else {
                $('#name-address').css("display", "none");
            }
        }

        function showvat() {
            if ($('#show-vat').is(':checked')) {
                $('.form-vat').css("display", "block");
            } else {
                $('.form-vat').css("display", "none");
            }
        }
        $('#btn-apply-coupon').click(function(){
            $('.alert-coupon').css('display', 'block');
        });
        $('#pickAdress').on('click', function() {
            id_address = $('#pickAdress').val();
            url = $('#pickAdress').data('url');
            if (id_address != '') {
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id: id_address
                        },
                    })
                    .done(function(data) {
                        console.log(data);
                        $('input[name="fullname"]').val(data[0].hoten);
                        $('input[name="phone"]').val(data[0].phone);
                        // $('input[name="email"]').val(data[0].email);
                        $('input[name="address"]').val(data[0].address);

                        var province = '<option value="' + data[1].matinhthanh + '">' + data[1].tentinhthanh +
                            '</option>';
                        $.each(data[4], function(index, value) {
                            province += '<option value="' + value.matinhthanh + '">' + value
                                .tentinhthanh + '</option>';
                        });
                        $('select[name="sel_province"]').empty().html(province);

                        var district = '<option value="' + data[2].maquanhuyen + '">' + data[2].tenquanhuyen +
                            '</option>';
                        $.each(data[5], function(index, value) {
                            district += '<option value="' + value.maquanhuyen + '">' + value
                                .tenquanhuyen + '</option>';
                        });
                        $('select[name="sel_district"]').empty().html(district);

                        var ward = '<option value="' + data[3].maphuongxa + '">' + data[3].tenphuongxa +
                            '</option>';
                        $.each(data[6], function(index, value) {
                            ward += '<option value="' + value.maphuongxa + '">' + value.tenphuongxa +
                                '</option>';
                        });
                        $('select[name="sel_ward"]').empty().html(ward);
                        getship();

                    });
            }
        });
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
