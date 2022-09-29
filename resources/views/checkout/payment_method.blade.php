@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('payment.getPaymentDetail') }}" class="form-checkout" method="get">
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
                                                    @if (($payment_method->id == 1 && $wallet->cpoint < $order->total) ||($payment_method->status == 0) || (!in_array($payment_method->id, $payment_method_avai))) disabled @endif
                                                  >
                                                <label for="pay{{ $payment_method->id }}">{{ $payment_method->name }}
                                                   
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach

                                 
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
                                                    @if ((!$check_shipping_method)||($payment_method->status == 0) || (!in_array($payment_method->id, $payment_method_avai))) disabled @endif>
                                                <label
                                                    for="pay{{ $payment_method->id }}">{{ $payment_method->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                  
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <a class="btn-back-cart"
                            href="{{ route('checkout.index') }}">Quay lại trang
                            trước</a>
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
