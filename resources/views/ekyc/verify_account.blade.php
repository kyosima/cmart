@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('public/css/ekyc.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container">
        
        <form action="{{ route('ekyc.postVerify') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h4 class="text-center">XÁC THỰC HỒ SƠ KHÁCH HÀNG</h4>
                    @if (Session::has('message'))
                    <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
                @endif
                </div>
                <div class="col-lg-12 col-md-12 col-12">

                    <div class="form-check text-center">
                        <input class="form-check-input" type="checkbox" name="accept_ekyc" id="accept-ekyc" value="1"
                            required oninvalid="this.setCustomValidity('Vui lòng đồng ý trước khi bắt đầu duyệt eKYC')"
                            checked disabled>
                        <label class="form-check-label font-weight-bold text-dark" role="button" for="accept-ekyc"
                            data-toggle="modal" data-target="#policy-md">Tôi đã đọc và đồng ý với Quy định Điều khoản & Điều
                            kiện giao dịch</label>
                    </div>
                </div>
                <div class="modal fade" id="policy-md" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Quy định Điều khoản & Điều kiện giao
                                    dịch</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @include('ekyc.policy')
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row d-flex justify-content-center">
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
                <div class="col-lg-8 col-md-8 col-12">
                    <div class="verify_image_front">
                        <input id="image-front" type="hidden" name="image_front">
                        <input id="status-front" type="hidden" name="status_front" value="0">
                        <canvas id="preview-front" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="verify_image_back">
                        <input id="image-back" type="hidden" name="image_back">
                        <input id="status-back" type="hidden" name="status_back" value="0">
                        <canvas id="preview-back" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="verify_image_portrait">
                        <input id="image-portrait" type="hidden" name="image_portrait">
                        <input id="status-portrait" type="hidden" name="status_portrait" value="0">
                        <canvas id="preview-portrait" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="tool-ekyc">
                        <div class="d-flex justify-content-between">
                            <button id="click-photo" class="btn btn-danger w-100" type="button">Mời chụp mặt trước giấy tờ tùy thân</button>
                            <button id="confirm-image" type="button" class="btn btn-primary w-100"
                                onclick="confirmImage()">Xác nhận hình ảnh mặt trước GTTT</button>
                        </div>
                    </div>
                </div>

                <div class="live_cam">
                    <video id="video" autoplay playsInline></video>
                    <div class="d-md-none d-flex justify-content-between">
                        <button id="btn-front" class="btn btn-secondary" type="button">Camera trước</button>
                        <button id="btn-back" class="btn btn-secondary" type="button">Camera sau</button>
                    </div>
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
