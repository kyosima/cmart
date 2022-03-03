@extends('layout.master')

@section('title', 'Thanh toán đơn hàng bằng tiền tích lũy')

@push('css')
    <link href="{{ asset('public/css/ekyc_payment.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/thanhtoan.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ route('payment.C.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="order_code" value="{{ $order->order_code }}">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h4 class="text-center">XÁC THỰC THANH TOÁN TIỀN TÍCH LŨY CÙNG C-MART mới đúng </h4>
                </div>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="verify_image_portrait">
                        <label for="">Mời bạn chụp ảnh chân dung</label>
                        <input id="image-portrait" type="hidden" name="image_portrait">
                        <input id="status-portrait" type="hidden" name="status_portrait" value="0">
                        <canvas id="preview-portrait" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="row tool-ekyc">
                        <div class="col-lg-6 col-md-6 col-12">
                            <button id="click-photo" class="btn btn-danger w-100" type="button">Chụp ảnh</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <button id="confirm-image" type="button" class="btn btn-primary w-100"
                                onclick="confirmImage()">Chọn
                                ảnh</button>
                        </div>
                    </div>
                    <div class="live_cam">
                        <hr>
                        <label for="">Camera</label>
                        <video id="video" max-width="100%" autoplay></video>
                    </div>
                    <button id="start-camera" class="btn btn-primary w-100" type="button">Bắt đầu EKYC</button>
                </div>
            </div>
            <div class="text-center check-ekyc">
                <button class="btn btn-danger" type="submit">Bắt đầu duyệt EKYC</button>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-6">
                    <a class="btn-back-cart"
                        href="{{ route('checkout.getPaymentMethod', ['order_code' => $order->order_code]) }}">Quay lại trang
                        trước</a>

                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/ekyc_payment.js') }}"></script>
@endpush
