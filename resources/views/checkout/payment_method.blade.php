@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('checkout.getPayment') }}" class="form-checkout" method="get">
        <div class="container">
            @if (Session::has('message'))
                <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
            @endif
            <input type="hidden" name="order_code" value="{{ $order->order_code }}">
            <div class="row">
                <div class="col-12">
                    <div class="result-order">
                        <div>
                            <h3>HÌNH THỨC THANH TOÁN</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="phuongthuc-thanhtoan-card-header">
                                    <h3>THANH TOÁN TRẢ TRƯỚC</h3>
                                </div>
                                <hr>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    @foreach ($payment_methods as $payment_method)
                                        @if ($payment_method->type == 1)
                                            <div class="form-group d-flex justify-content-start align-items-center ">
                                                <input type="radio" id="pay{{ $payment_method->id }}"
                                                    name="payment_method" value="{{ $payment_method->id }}"
                                                    @if ($payment_method->id == 1 && $point_c->point_c < $order->total) disabled @endif
                                                    @if ($payment_method->id == 3) checked @endif>
                                                <label
                                                    for="pay{{ $payment_method->id }}">{{ $payment_method->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach

                                    {{-- <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay1" name="payment_method" value="1">
                                        <label for="pay1">Nạp tiền</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay2" name="payment_method" value="2" checked>
                                        <label for="pay2">Chuyển tiền</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay3" name="payment_method" value="3">
                                        <label for="pay3">Công nợ linh hoạt</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay4" name="payment_method" value="4">
                                        <label for="pay4">Thanh toán online bằng Thẻ Visa / Mastercard</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay5" name="payment_method" value="5">
                                        <label for="pay5">Thanh toán online bằng Thẻ JCB / CUP</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay6" name="payment_method" value="6">
                                        <label for="pay6">Thanh toán online bằng Thẻ Amex / Diners Club</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay7" name="payment_method" value="7">
                                        <label for="pay7">Thanh toán online bằng Thẻ Ngoài nước / Discover</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay8" name="payment_method" value="8">
                                        <label for="pay8">Thanh toán online bằng Thẻ Nội địa</label>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="phuongthuc-thanhtoan-card-header">
                                    <h3>THANH TOÁN TRẢ SAU</h3>
                                </div>
                                <hr>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    @foreach ($payment_methods as $payment_method)
                                        @if ($payment_method->type == 2)
                                            <div class="form-group d-flex justify-content-start align-items-center ">
                                                <input type="radio" id="pay{{ $payment_method->id }}"
                                                    name="payment_method" value="{{ $payment_method->id }}"
                                                    @if (!$check_shipping_method) disabled @endif>
                                                <label
                                                    for="pay{{ $payment_method->id }}">{{ $payment_method->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                    {{-- <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay9" name="payment_method" value="9"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay9">Thanh toán khi nhận hàng (Chuyển khoản)</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay10" name="payment_method" value="10"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay10">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard </label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay11" name="payment_method" value="11"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay11">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard do SHB phát hành,
                                            qua app QR SHB</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay12" name="payment_method" value="12"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay12">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard / JCB do TPBank
                                            phát hành, qua app QR TPBank</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay13" name="payment_method" value="13"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay13">Thanh toán trực tiếp bằng Thẻ JCB / CUP </label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay14" name="payment_method" value="14"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay14">Thanh toán trực tiếp bằng Thẻ JCB / CUP do MBBank phát
                                            hành</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay15" name="payment_method" value="15"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay15">Thanh toán trực tiếp bằng Thẻ Amex / Diners Club</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay16" name="payment_method" value="16"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay16">Thanh toán trực tiếp bằng Thẻ Ngoài nước / Discover</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay17" name="payment_method" value="17"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay17">Thanh toán trực tiếp bằng Thẻ Nội địa</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay18" name="payment_method" value="18"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay18">Thanh toán trực tiếp bằng Thẻ Nội địa do MBBank phát hành</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay19" name="payment_method" value="19"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay19">Thanh toán trực tiếp bằng Thẻ Nội địa do SCB phát hành</label>
                                    </div>
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="pay20" name="payment_method" value="20"
                                            @if (!$check_shipping_method) disabled @endif>
                                        <label for="pay20">Thanh toán trực tiếp bằng Thẻ Nội địa do TPBank phát hành, qua
                                            app QR TPBank</label>
                                    </div> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a class="btn-back-cart" href="{{route('checkout.edit', ['order_code'=>$order->order_code])}}">Quay lại trang trước</a>
                        <button class="btn-dathang" type="submit">Tổng kết đơn hàng</button>
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
        // $('.btn-dathang').click(function(e) {
        //     if ($('.chinhsach-body input:checkbox').is(':checked')) {

        //     } else {
        //         e.preventDefault();
        //         $('.error-chinhsach').css('display', 'block');
        //     }
        // })

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
        $('#btn-apply-coupon').click(function() {
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
