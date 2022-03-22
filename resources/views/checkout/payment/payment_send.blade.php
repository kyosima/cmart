@extends('layout.master')

@section('title', 'Thanh toán đơn hàng bằng hình thức chuyển tiền')

@push('css')
    <link href="{{ asset('public/css/ekyc_payment.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/thanhtoan.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ route('payment.postSend') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h3>THANH TOÁN CHUYỂN TIỀN</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul style="list-style: none">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="result-order">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div>
                                    <h3>ĐƠN VỊ THANH TOÁN</h3>
                                </div>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    <input type="hidden" name="order_code" value="{{ $order->order_code }}">

                                    <input type="hidden" name="payment_method" value="{{ $payment_method->id }}"
                                        data-url="{{ route('payment.getInfo') }}">
                                    <div class="row" id="list-payment-method-options">
                                        @foreach ($payment_method->options()->whereStatus(1)->orderBy('id', 'asc')->get()
        as $payment_method_option)
                                            <div class="col-md-3 col-6">
                                                <div class="form-group text-center">
                                                    <input type="radio" class="form-control"
                                                        id="pay{{ $payment_method_option->id }}" name="payment_option"
                                                        value="{{ $payment_method_option->id }}">
                                                    <label
                                                        for="pay{{ $payment_method_option->id }}">{{ $payment_method_option->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12" style="border-left: 1px solid #ddd">
                                <div>
                                    <h3>THÔNG TIN THANH TOÁN</h3>
                                </div>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    <ul>
                                        <li>Tên đơn vị: <b id="name-option"></b></li>
                                        <li>Chủ tài khoản: <b id="account-option"></b></li>
                                        <li>Số tài khoản: <b id="value-option"></b></li>
                                        <li>Giá trị thanh toán: <b id="order_value">{{ formatPrice($order->total) }}</b>
                                        </li>
                                    </ul>
                                    <div class="qr-code text-center">
                                        <img src="" alt="" width="150px" height="150px">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-6 col-12">
                            {{-- <a class="btn-back-cart"
                                href="{{ route('checkout.getPaymentMethod', ['order_code' => $order->order_code]) }}">Quay
                                lại trang trước</a>

                        </div>
                        <div class="col-md-6 col-12"> --}}
                            <button class="btn-dathang" type="submit">Thanh toán</button>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/ekyc_payment.js') }}"></script>
    <script src="{{ asset('public/js/payment.js') }}"></script>
@endpush
