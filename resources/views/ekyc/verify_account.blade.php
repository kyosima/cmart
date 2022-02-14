@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('public/css/ekyc.css') }}" rel="stylesheet" type="text/css">

@endpush

@section('content')
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ route('ekyc.postVerify') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h4>Cung cấp thông tin tài khoản</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <div class="select-type-profile">
                            <select class="form-control" name="type_cmnd" aria-label="Default select example">
                                <option value="0" selected>Chọn loại giấy tờ tùy thân</option>
                                <option value="1">Chứng minh nhân dân</option>
                                <option value="2">Căn cước công dân</option>
                                <option value="3">Hộ chiếu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="verify_image_front">
                        <label for="">Mời bạn chụp ảnh mặt trước hồ sơ</label>
                        <input id="image-front" type="hidden" name="image_front">
                        <input id="status-front" type="hidden" name="status_front" value="0">
                        <canvas id="preview-front" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="verify_image_back">
                        <label for="">Mời bạn chụp ảnh mặt sau hồ sơ</label>
                        <input id="image-back" type="hidden" name="image_back">
                        <input id="status-back" type="hidden" name="status_back" value="0">
                        <canvas id="preview-back" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
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
                            <button id="confirm-image" type="button" class="btn btn-primary w-100" onclick="confirmImage()">Chọn ảnh</button>
                        </div>
                    </div>
                    <div class="live_cam">
                        <hr>
                        <video id="video" max-width="100%" autoplay></video>
                    </div>
                    <button id="start-camera" class="btn btn-primary w-100" type="button">Bắt đầu EKYC</button>
                </div>
            </div>
            <div class="text-center check-ekyc">
                <button class="btn btn-danger" type="submit">Bắt đầu duyệt EKYC</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/ekyc.js') }}"></script>
@endpush
