@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <style>
        .profile_content .rounded-circle {
            border-radius: 50% !important;
        }

        .profile_content .thongbao_register {
            border: 2px solid #003c7c;
            border-radius: 5px;
            padding: 5px;
            font-size: 14px;
            text-align: left;
            background: #006ee3;
            margin-bottom: 30px
        }

        .profile_content img {
            vertical-align: middle;
            border-radius: 10px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }

        .profile_content .text-muted {
            color: #aeb0b4 !important;
        }

        .profile_content .text-muted {
            font-weight: 300;
        }

        .profile_content .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5;
            color: #4d5154;
            background-color: #ffffff;
            background-clip: padding-box;
            border: 1px solid #eef0f3;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .profile_content .img_avt {
            padding: 5px;
            border: 1px solid #cecece;
            border-radius: 50%;
            object-fit: cover;
        }

        .profile_content button {
            outline: none;
        }

        .profile_content select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }

    </style>

    <div class="container profile_content">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <h2 class="h3 mb-4 page-title"></h2>
                <div class="my-4">

                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="avatar avatar-xl">
                                @if ($profileUser->avatar != null)
                                    <img class="img_avt" for="img_avatar" src="{{ $profileUser->avatar }}"
                                        width="150px" height="150px" />
                                    <input type="file" class="form-control" name="avatar" id="img_avatar"
                                        style="display: none">
                                    {{-- <label for="img_avatar" class="btn btn-primary profile-button mt-2">Ảnh chân dung</label> --}}
                                @else
                                    <img class="img_avt" for="img_avatar" class="rounded-circle mt-3" width="150px"
                                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                    <input type="file" class="form-control" name="avatar" id="img_avatar"
                                        style="display: none">
                                    {{-- <label for="img_avatar" class="btn btn-primary profile-button mt-2">Ảnh chân dung</label> --}}
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col-md-12">
                                    <h4 class="mb-1">Mã Khách Hàng:
                                        <strong>{{ $profileUser->code_customer }}</strong>
                                    </h4>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <p class="text-muted">
                                        Định danh Khách hàng:
                                        @if ($profileUser->level == 1)
                                            Khách hàng VIP
                                        @elseif($profileUser->level == 2)
                                            Cộng tác viên
                                        @elseif($profileUser->level == 3)
                                            Purchasing
                                        @elseif($profileUser->level == 4)
                                            Khách hàng thương mại
                                        @else
                                            Khách hàng thân thiết
                                        @endif
                                    </p>
                                    <!--<div class="">Tích lũy: {{ $profileUser->tichluyC }} point</div>-->
                                    <div class="text-justify ">
                                        <ul class="m-0 pl-0" style="list-style:none;">
                                            <li class="">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc
                                                bảo mật thông tin là điều vô cùng nghiêm túc,
                                                và chúng tôi thực hiện vô cùng nghiêm ngặt.
                                            </li>
                                            <li class="">Các thông tin chỉ dùng để hướng đến sự chuyên
                                                nghiệp, tiện lợi hơn trong phục vụ Khách Hàng,
                                                tạo sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết.
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                            @if ($profileUser->is_company == 1)
                                @if ($profileUser->check_company == 1)
                                    <button class="w-100 btn btn-success">Đã xác minh</button>
                                @else
                                    <button class="w-100 btn btn-warning">Chưa xác minh doanh nghiệp</button>
                                @endif
                            @else
                                @if($profileUser->is_ekyc == 1)
                                    @if ($profileUser->change_ekyc == 1)
                                        <a href="{{ route('vnpt.index') }}" class="w-100 btn btn-success">Thực hiện thay
                                            đổi thông tin bằng EKYC</a>
                                    @else
                                        @if ($check == 0)
                                            <button class="w-100 btn btn-info" data-toggle="modal"
                                                data-target="#modalrequestekyc">Gửi yêu cầu thay đổi thông tin Hồ Sơ Khách Hàng</button>

                                            <div class="modal fade" id="modalrequestekyc" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('vnpt.changeEKYC') }}" method="post">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Gửi yêu cầu thay đổi thông tin Hồ Sơ Khách Hàng</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="reason">Nhập nội dung bạn muốn thay đổi, kèm nguyên nhân thay đổi</label>
                                                                    <textarea class="w-100" name="content" id="reason" cols="30" rows="10"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Hủy</button>
                                                                <button type="submit" class="btn btn-primary">Gửi yêu
                                                                    cầu</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button class="btn btn-warning w-100" type="button">Đã yêu cầu thay đổi thông tin Hồ Sơ Khách Hàng</button>
                                        @endif
                                    @endif
                                    @if($profileUser->is_econtract == 0)
                                            <p>Tài khoản Khách hàng chưa ký hợp đồng giao dịch <a href="{{route('econtract.index')}}" class="text-info">Ký tại đây</a></p>
                                    @else
                                            
                                    @endif
                                @else
                                           <p>Tài khoản Khách hàng chưa được xác minh <a href="{{route('vnpt.index')}}" class="text-info">Xác minh tại đây</a></p>
                                @endif
                            @endif
                        </div>
                    </div>
                    <form action="{{ url('thong-tin-tai-khoan') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <hr class="my-4" />
                        <div class="form-row">
                            @if ($profileUser->is_company == 1)
                                <div class="form-group col-md-12">
                                    <label for="firstname">Tên tổ chức</label>
                                    <input type="text" name="hoten" class="form-control"
                                        value="{{ $profileUser->hoten }}" readonly>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="firstname">Người đại diện</label>
                                    <input type="text" name="hoten" class="form-control"
                                        value="{{ $profileUser->company()->value('company_name') }}" readonly>
                                </div>
                            @else
                                <div class="form-group col-md-12">
                                    <label for="firstname">Họ và tên</label>
                                    <input type="text" name="hoten" class="form-control"
                                        value="{{ $profileUser->hoten }}" readonly>
                                </div>
                            @endif
                            <!--<div class="form-group col-md-6">-->
                            <!--    <label for="lastname">Số điện thoại</label>-->
                            <!-- <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ $profileUser->phone }}" readonly> -->
                            <!--    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ $profileUser->phone }}" readonly>-->
                            <!--</div>-->
                        </div>
                        @if ($profileUser->is_company == 1)
                            <div class="form-group">
                                <label for="">Loại giấy tờ </label>
                                <input type="text" class="form-control" name="" value="Giấy phép kinh doanh" readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Mã số thuế</label>
                                <input type="text" class="form-control" name="cmnd"
                                    value="{{ $profileUser->company()->value('company_licensen_id') }}"
                                    placeholder="Mời nhập số CMND/CCCD/Hộ chiếu" readonly>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="">Loại giấy tờ</label>
                                <input type="text" class="form-control" name="" value="{{ $profileUser->type_cmnd }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="">Mã số giấy tờ</label>
                                <input type="text" class="form-control" name="cmnd" value="{{ $profileUser->cmnd }}"
                                    placeholder="Mời nhập số CMND/CCCD/Hộ chiếu" readonly>
                            </div>
                        @endif

                        @if ($profileUser->is_company == 1)
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh Giấy phép kinh doanh mặt trước</label>
                                {{-- @if ($profileUser->cmnd_image != null) --}}
                                <img id="imgFileUpload"
                                    src="{{ asset('public/company_licensen/' . $profileUser->company()->value('company_licensen_image_front')) }}"
                                    width="100%" style="cursor: pointer" />
                                {{-- <br />
                                <span id="spnFilePath"></span>
                                <input type="file" id="FileUpload1" style="display: none" name="image_cmnd" id="img_cmnd" /> --}}
                                {{-- @else
                                <p>
                                    <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)"
                                        name="image_cmnd">
                                    <img id="output" />
                                </p>
                            @endif --}}
                            </div>
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh Giấy phép kinh doanh mặt sau</label>
                                {{-- @if ($profileUser->cmnd_image2 != null) --}}
                                <img id="imgFileUpload2"
                                    src="{{ asset('public/company_licensen/' . $profileUser->company()->value('company_licensen_image_back')) }}"
                                    width="100%" style="cursor: pointer" />
                                {{-- <br />
                                <span id="spnFilePath2"></span>
                                <input type="file" id="FileUpload2" style="display: none" name="image_cmnd2"
                                    id="img_cmnd2" /> --}}
                                {{-- @else
                                <input class="form-control" type="file" accept="image/*" onchange="loadFile2(event)"
                                    name="image_cmnd2">
                                <img id="output2" />
                            @endif --}}
                            </div>
                        @else
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh giấy tờ mặt trước</label>
                                {{-- @if ($profileUser->cmnd_image != null) --}}
                                <img id="imgFileUpload" src="{{ $profileUser->cmnd_image }}" width="100%"
                                    style="cursor: pointer" />
                                {{-- <br />
                                <span id="spnFilePath"></span>
                                <input type="file" id="FileUpload1" style="display: none" name="image_cmnd" id="img_cmnd" /> --}}
                                {{-- @else
                                <p>
                                    <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)"
                                        name="image_cmnd">
                                    <img id="output" />
                                </p>
                            @endif --}}
                            </div>
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh giấy tờ mặt sau</label>
                                {{-- @if ($profileUser->cmnd_image2 != null) --}}
                                <img id="imgFileUpload2" src="{{ $profileUser->cmnd_image2 }}" width="100%"
                                    style="cursor: pointer" />
                                {{-- <br />
                                <span id="spnFilePath2"></span>
                                <input type="file" id="FileUpload2" style="display: none" name="image_cmnd2"
                                    id="img_cmnd2" /> --}}
                                {{-- @else
                                <input class="form-control" type="file" accept="image/*" onchange="loadFile2(event)"
                                    name="image_cmnd2">
                                <img id="output2" />
                            @endif --}}
                            </div>
                        @endif


                        <div class="form-group row">
                            <label for="lastname" class="col-sm-4 col-form-label">Số điện thoại đăng ký giao dịch</label>
                            <div class=" col-sm-8">
                                <input type="text" name="phone" class="form-control"
                                    placeholder="Mời nhập số điện thoại đăng ký giao dịch"
                                    value="{{ $profileUser->phone }}" readonly>
                            </div>
                            {{-- <div class="form-group col-md-4 pl-0">
                                    <label class="btn btn-primary profile-button"
                                        style="height: 35px;line-height: 22px;">Lấy mã xác thực tối đa 03lần/ngày</label>
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" name="address" class="form-control"
                                        placeholder="Mời nhập mã OTP gửi đến SĐT">
                                </div> --}}
                        </div>

                        <div class="form-group row">
                            <label for="inputAddress5" class="col-sm-2 col-form-label">Địa chỉ chi tiết</label>

                            <div class=" col-sm-10">
                                <input type="text" name="address" class="form-control"
                                    value="{{ $profileUser->address }}" placeholder="Địa chỉ chi tiết" required readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            {{-- <div class="form-group col-md-6">
                                <label for="inputAddress5">Đường<sup class="text-danger">*</sup></label>
                                <input type="text" name="address" class="form-control" value="{{ $profileUser->duong }}"
                        placeholder="Mời nhập tên đường" style="height: 38px;" readonly>
                    </div> --}}
                            <label for="" class="col-sm-2 col-form-label">Cấp Tỉnh</label>

                            <div class="col-sm-10">
                                <select name="sel_province" class="form-control " data-placeholder="---Chọn tỉnh thành---"
                                    required disabled>
                                    <option value="{{ $user_province->PROVINCE_ID }}" selected>
                                        {{ $user_province->PROVINCE_NAME }}
                                    </option>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Cấp Huyện</label>

                            <div class="col-sm-10">
                                <select name="sel_district" class="form-control " data-placeholder="---Chọn quận huyện---"
                                    required disabled>
                                    <option value="{{ $user_district->DISTRICT_ID }}">
                                        {{ $user_district->DISTRICT_NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Cấp Xã</label>

                            <div class=" col-sm-10">
                                <select name="sel_ward" class="form-control " data-placeholder="---Chọn phường xã---"
                                    required disabled>
                                    <option value="{{ $user_ward->WARDS_ID }}">
                                        {{ $user_ward->WARDS_NAME }}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center experience"><span><input
                                            type="checkbox" id="changePassword" name="changePassword"> Đổi mật khẩu</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword5">Nhập mật khẩu mới </label>
                                    <input type="password" class="form-control password" name="password"
                                        placeholder="Mời nhập mật khẩu mới từ 8 kí tự" minlength="8" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword6">Nhập lại mật khẩu mới</label>
                                    <input type="password" class="form-control password" name="passwordAgain"
                                        placeholder="Mời nhập lại mật khẩu mới" minlength="8" disabled>
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                        <p class="mb-2">Hướng dẫn đổi mật khẩu</p>
                        <ul class="small text-muted pl-4 mb-0">
                            <li>Click vào checkbox đổi mật khẩu</li>
                            <li>Điền mật khẩu mới và ô nhập lại mật khẩu</li>
                            <li>Sau đó chọn lưu thông tin</li>
                        </ul>
                    </div> --}}
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')
    <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>
    <script src="{{ asset('public/js/address.js') }}"></script>

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

    <script type='text/javascript'>
        var fileupload = document.getElementById("FileUpload1");
        var filePath = document.getElementById("spnFilePath");
        var image = document.getElementById("imgFileUpload");
        image.onclick = function() {
            fileupload.click();
        };
        fileupload.onchange = function() {
            var fileName = fileupload.value.split('\\')[fileupload.value.split('\\').length - 1];
            filePath.innerHTML = "<b>Selected File: </b>" + fileName;
        };
    </script>

    <script type='text/javascript'>
        var fileupload2 = document.getElementById("FileUpload2");
        var filePath2 = document.getElementById("spnFilePath2");
        var image2 = document.getElementById("imgFileUpload2");
        image2.onclick = function() {
            fileupload2.click();
        };

        fileupload2.onchange = function() {
            var fileName2 = fileupload2.value.split('\\')[fileupload2.value.split('\\').length - 1];
            filePath2.innerHTML = "<b>Selected File: </b>" + fileName2;
        };
    </script>

    <script type='text/javascript'>
        $(document).ready(function() {
            $("#changePassword").change(function() {
                if ($(this).is(":checked")) {
                    $(".password").removeAttr('disabled');
                } else {
                    $(".password").attr('disabled', '');
                }
            });
        });
    </script>

    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        var loadFile2 = function(event) {
            var output2 = document.getElementById('output2');
            output2.src = URL.createObjectURL(event.target.files[0]);
            output2.onload = function() {
                URL.revokeObjectURL(output2.src)
            }
        };
    </script>
@endpush
