@extends('layout.master')

@section('title', 'Xác minh hồ sơ quên lại mật khẩu')

@push('css')
    <link href="{{ asset('public/css/ekyc_password.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/thanhtoan.css') }}" rel="stylesheet" type="text/css">

@endpush

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <form action="{{route('ekycforgetPassword')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="phone" value="{{$user->phone}}">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h4 class="text-center">XÁC THỰC EKYC ĐỂ TIẾN HÀNH LẤY LẠI MẬT KHẨU</h4>
                </div>
            </div>
            
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="verify_image_front">
                        <label for="">Mời bạn chụp ảnh mặt trước giấy tờ</label>
                        <input id="image-front" type="hidden" name="image_front">
                        <input id="status-front" type="hidden" name="status_front" value="0">
                        <canvas id="preview-front" width="800px" height="600px" max-width="100%"></canvas>
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
                    <a class="btn-back-cart" href="{{ route('account') }}">Quay lai trang đăng nhập/đăng ký</a>

                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/ekyc_password.js') }}"></script>
@endpush
