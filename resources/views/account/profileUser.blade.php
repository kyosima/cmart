@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">

@endpush

@section('content')
    <style>
        .rounded-circle {
            border-radius: 50% !important;
        }

        .thongbao_register {
            border: 2px solid #003c7c;
            border-radius: 5px;
            padding: 5px;
            font-size: 14px;
            text-align: left;
            background: #006ee3;
            margin-bottom: 30px
        }

        img {
            vertical-align: middle;
            border-style: none;
        }

        .text-muted {
            color: #aeb0b4 !important;
        }

        .text-muted {
            font-weight: 300;
        }

        .form-control {
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

    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <h2 class="h3 mb-4 page-title"></h2>
                <div class="my-4">
                    <form action="{{ url('thong-tin-tai-khoan') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-5 align-items-center">
                            <div class="col-md-3 text-center mb-5">
                                <div class="avatar avatar-xl">
                                    @if ($profileUser->avatar != null)
                                        <img for="img_avatar" src="{{ asset('/public/images/' . $profileUser->avatar) }}"
                                            width="150px" height="150px" />
                                        <input type="file" class="form-control" name="avatar" id="img_avatar"
                                            style="display: none">
                                        {{-- <label for="img_avatar" class="btn btn-primary profile-button mt-2">Ảnh chân dung</label> --}}
                                    @else
                                        <img for="img_avatar" class="rounded-circle mt-3" width="150px"
                                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                        <input type="file" class="form-control" name="avatar" id="img_avatar"
                                            style="display: none">
                                        {{-- <label for="img_avatar" class="btn btn-primary profile-button mt-2">Ảnh chân dung</label> --}}
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="row align-items-center">
                                    <div class="col-md-7">
                                        <h4 class="mb-1">Mã Khách Hàng:
                                            <strong>{{ $profileUser->code_customer }}</strong>
                                        </h4>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                   
                                        {{ $profileUser->name }}
                                        <p class="text-muted">
                                            Định danh Khách hàng:
                                            @if ($profileUser->level == 1)
                                                Member Vip
                                            @elseif($profileUser->level == 2)
                                                Cộng tác viên
                                            @else
                                                Member bình thường
                                            @endif
                                        </p>
                                        <!--<div class="">Tích lũy: {{ $profileUser->tichluyC }} point</div>-->
                                        <div class="text-justify ">
                                            <ul class="m-0 pl-0">
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
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="firstname">Họ và tên</label>
                                <input type="text" name="hoten" class="form-control" value="{{ $profileUser->hoten }}"
                                    readonly>
                            </div>
                            <!--<div class="form-group col-md-6">-->
                            <!--    <label for="lastname">Số điện thoại</label>-->
                            <!-- <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ $profileUser->phone }}" readonly> -->
                            <!--    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" value="{{ $profileUser->phone }}" readonly>-->
                            <!--</div>-->
                        </div>
                        <div class="form-group">
                            <select class="form-select mb-1" name="type_cmnd" aria-label="Default select example" readonly>
                                @if ($profileUser->type_cmnd == 0)
                                    <option value="0" selected>Chọn loại giấy tờ tùy thân</option>
                                @elseif($profileUser->type_cmnd == 1)
                                    <option value="1" selected>Chứng minh nhân dân</option>
                                @elseif($profileUser->type_cmnd == 2)
                                    <option value="2" selected>Căn cước công dân</option>
                                @elseif($profileUser->type_cmnd == 3)
                                    <option value="3" selected>Hộ chiếu</option>
                                @else
                                @endif

                                @if ($profileUser->type_cmnd != 1)
                                    <option value="1">Chứng minh nhân dân</option>
                                @else
                                @endif

                                @if ($profileUser->type_cmnd != 2)
                                    <option value="2">Căn cước công dân</option>
                                @else
                                @endif

                                @if ($profileUser->type_cmnd != 3)
                                    <option value="3">Hộ chiếu</option>
                                @else
                                @endif
                            </select>
                            <input type="text" class="form-control" name="cmnd" value="{{ $profileUser->cmnd }}"
                                placeholder="Mời nhập số CMND/CCCD/Hộ chiếu" readonly>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress5">Ảnh CMND</label>
                            @if ($profileUser->cmnd_image != null)
                                <img id="imgFileUpload" src="{{ asset('/public/images/' . $profileUser->cmnd_image) }}"
                                    width="100%" height="250px" style="cursor: pointer" />
                                <br />
                                <span id="spnFilePath"></span>
                                <input type="file" id="FileUpload1" style="display: none" name="image_cmnd" id="img_cmnd" />
                            @else
                                <p>
                                    <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)"
                                        name="image_cmnd">
                                    <img id="output" />
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="inputAddress5">Ảnh CMND mặt sau</label>
                            @if ($profileUser->cmnd_image2 != null)
                                <img id="imgFileUpload2"
                                    src="{{ asset('/public/images2/' . $profileUser->cmnd_image2) }}" width="100%"
                                    height="250px" style="cursor: pointer" />
                                <br />
                                <span id="spnFilePath2"></span>
                                <input type="file" id="FileUpload2" style="display: none" name="image_cmnd2"
                                    id="img_cmnd2" />
                            @else
                                <input class="form-control" type="file" accept="image/*" onchange="loadFile2(event)"
                                    name="image_cmnd2">
                                <img id="output2" />
                            @endif
                        </div>

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
                                    value="{{ $profileUser->address }}" placeholder="Địa chỉ chi tiết" readonly>
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
                                <input type="text" name="address" class="form-control" value="{{ DB::table('province')->join('users', 'users.id_tinhthanh', '=', 'province.matinhthanh')->where('province.matinhthanh', '=', auth()->user()->id_tinhthanh)->select('province.tentinhthanh')->first()->tentinhthanh }}
        " placeholder="Địa chỉ chi tiết" readonly>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Cấp Huyện</label>

                            <div class="col-sm-10">
                                <input type="text" name="address" class="form-control" value="{{ DB::table('district')->join('users', 'users.id_quanhuyen', '=', 'district.maquanhuyen')->where('district.maquanhuyen', '=', auth()->user()->id_quanhuyen)->select('district.tenquanhuyen')->first()->tenquanhuyen }}
                                    " placeholder="Địa chỉ chi tiết" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Cấp Xã</label>

                            <div class=" col-sm-10">
                                <input type="text" name="address" class="form-control" value="{{ DB::table('ward')->join('users', 'users.id_phuongxa', '=', 'ward.maphuongxa')->where('ward.maphuongxa', '=', auth()->user()->id_phuongxa)->select('ward.tenphuongxa')->first()->tenphuongxa }}
                                    " placeholder="Địa chỉ chi tiết" readonly>

                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center experience"><span><input
                                            type="checkbox" id="changePassword" name="changePassword"> Đổi mật khẩu</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword5">Mật khẩu mới</label>
                                    <input type="password" class="form-control password" name="password"
                                        placeholder="Mời nhập mật khẩu" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword6">Nhập lại mật khẩu</label>
                                    <input type="password" class="form-control password" name="passwordAgain"
                                        placeholder="Mời nhập lại mật khẩu" disabled>
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
                        {{-- <div class="text-center">
                            <button type="submit" class="btn btn-primary">Lưu Thông Tin</button>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>

    </div>


@endsection

@push('scripts')
    <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>
    <script src="{{ asset('public/js/shipping.js') }}"></script>

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
