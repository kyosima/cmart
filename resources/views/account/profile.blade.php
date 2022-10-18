@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('public/css/home.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')

    <div class="container profile_content">

        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 mx-auto">
                <h2 class="h3 mb-4 page-title"></h2>
                <div class="my-4">
                    <div class="row mt-5 align-items-center">
                        <div class="col-md-3 text-center mb-5">
                            <div class="avatar avatar-xl">
                                @if ($user->user_info->indetity_avatar != null)
                                    <img class="img_avt" for="img_avatar" src="{{ $user->user_info->indetity }}"
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
                                        <strong>{{ $user->code_customer }}</strong>
                                    </h4>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <ul class="m-0 pl-0" style="list-style:none;">
                                        <li class="text-muted">
                                            Định danh Khách hàng: <span>{{ $user->level->name }}</span>
                                        </li>
                                        <li class="text-muted">
                                            Loại tài khoản:
                                            <span>{{ $user->is_company == 0 ? 'Tài khoản cá nhân' : 'Tài khoản doanh nghiệp' }}</span>
                                        </li>
                                    </ul>
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
                            <div class="row">
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <p>Trạng thái EKyc: {!! formatStatusEkyc($user->is_ekyc) !!}</p>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                                    <p>Trạng thái ký Econtract: {!! formatStatusEcontract($user->is_econtract) !!}</p>
                                </div>
                            </div>
                            {{-- @if ($user->is_company == 1)
                                <button class="w-100 btn btn-success">Tài khoản doanh nghiệp</button>
                            @else --}}
                            {{-- @if ($profileUser->is_ekyc == 1)
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
                                    @endif --}}
                            {{-- @if ($profileUser->is_econtract == 0)
                                            <p>Tài khoản Khách hàng chưa ký hợp đồng giao dịch <a href="{{route('econtract.index')}}" class="text-info">Ký tại đây</a></p>
                                    @else
                                            
                                    @endif --}}
                            {{-- @else
                                           <p>Tài khoản Khách hàng chưa được xác minh <a href="{{route('vnpt.index')}}" class="text-info">Xác minh tại đây</a></p>
                                @endif --}}
                            {{-- @endif --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <ul class="personal-info">
                                <li>
                                    <span>Họ và tên: <strong>{{ $user->user_info->fullname }}</strong></span>
                                </li>
                                <li>
                                    <span>Loại giấy tờ: <strong>{{ $user->user_info->identity_type }}</strong></span>
                                </li>
                                <li>
                                    <span>Mã số giấy tờ: <strong>{{ $user->user_info->identity_number }}</strong></span>
                                </li>
                                <li>
                                    <span>Số điện thoai đăng ký giao dịch: <strong>{{ $user->phone }}</strong></span>
                                </li>
                                <li>
                                    <span>Cấp tỉnh: <strong>{{ $user->user_info->province->tentinhthanh }}</strong></span>
                                </li>
                                <li>
                                    <span>Cấp huyện: <strong>{{ $user->user_info->district->tenquanhuyen }}</strong></span>
                                </li>
                                <li>
                                    <span>Cấp xã: <strong>{{ $user->user_info->ward->tenphuongxa }}</strong></span>
                                </li>
                                <li>
                                    <span>Địa chỉ chi tiết: <strong>{{ $user->user_info->address }}</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh giấy tờ mặt trước</label>
                                <img id="imgFileUpload" src="{{ $user->user_info->identity_front }}" width="100%"
                                    style="cursor: pointer" />
                            </div>
                            <div class="form-group">
                                <label for="inputAddress5">Ảnh giấy tờ mặt sau</label>
                                <img id="imgFileUpload2" src="{{ $user->user_info->identity_back }}" width="100%"
                                    style="cursor: pointer" />
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('account.postProfile') }}" method="POST" role="form"
                        enctype="multipart/form-data">
                        @csrf
                       
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-between align-items-center experience"><span><input
                                            type="checkbox" id="changePassword" name="changePassword"> Đổi mật
                                        khẩu</span>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword5">Nhập mật khẩu mới </label>
                                    <input type="password" class="form-control password" name="password"
                                        placeholder="Mời nhập mật khẩu mới từ 8 kí tự" minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword6">Nhập lại mật khẩu mới</label>
                                    <input type="password" class="form-control password" name="passwordAgain"
                                        placeholder="Mời nhập lại mật khẩu mới" minlength="8">
                                </div>
                            </div>

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
@endpush
