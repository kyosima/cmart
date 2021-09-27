@extends('admin.layout.master')

@section('title', 'Quản lý tài khoản')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}" type="text/css">
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="wrapper">
                <div class="profile-card js-profile-card">
                    <div class="profile-card__img">
                        <img src="./image/header/68885333_131036021490989_8108439814333792256_n.jpg" alt="profile">
                    </div>

                    <div class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name">Riddler</div>
                        <button class="profile-card__button btn-1 button--orange"><span>Mã giới thiệu</span></button>
                        <button class="profile-card__button btn-2 button--blue"><span>Điểm tích lũy</span></button>
                        <button class="profile-card__button btn-3 button--purple"><span>Điểm thưởng</span></button>
                        <div class="info">
                            <div class="row m-5">
                                <div class="col-lg-12 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Họ và tên *</label>
                                    <input type="text" class="form-control mb-2" placeholder="Nhập đầy đủ họ và tên"
                                        value="Nguyễn Mai Chí Trung">
                                </div>
                                <div class="col-lg-6 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">CMND *</label>
                                    <input type="text" class="form-control mb-2" placeholder="Nhập chứng minh nhân dân"
                                        value="0000 0000 1111">
                                    <label for="exampleFormControlInput1" class="form-label">Số điện thoại *</label>
                                    <input type="text" class="form-control mb-2" placeholder="Nhập số điện thoại"
                                        value="000 123 1111">
                                    <label for="exampleFormControlInput1" class="form-label">Email *</label>
                                    <input type="email" class="form-control mb-2" placeholder="name@example.com"
                                        value="riddler">
                                </div>
                                <div class="col-lg-6 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Tỉnh/Thành phố *</label>
                                    <select class="form-select w-100 mb-2" aria-label="Default select example">
                                        <option selected>Chọn Tỉnh/Thành phố</option>
                                        <option value="1">Hồ Chí Minh</option>
                                        <option value="2">Hà Nội</option>
                                        <option value="3">Đà Nẵng</option>
                                    </select>
                                    <label for="exampleFormControlInput1" class="form-label">Xã/Phường thị trấn</label>
                                    <select class="form-select w-100 mb-2" aria-label="Default select example">
                                        <option selected>Chọn Xã/Phường thị trấn</option>
                                        <option value="1">Long Trường</option>
                                        <option value="2">Hiệp Phú</option>
                                    </select>
                                    <label for="exampleFormControlInput1" class="form-label">Quận/Huyện *</label>
                                    <select class="form-select w-100 mb-2" aria-label="Default select example">
                                        <option selected>Chọn Quận/Huyện</option>
                                        <option value="1">Quận 1</option>
                                        <option value="2">Quận 10</option>
                                        <option value="3">Quận 9</option>
                                    </select>
                                </div>
                                <div class="col-lg-12 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Địa chỉ *</label>
                                    <input type="text" class="form-control mb-2" placeholder="Nhập địa chỉ"
                                        value="998 Quang Trung, Thành phố Hồ Chí Minh, Việt Nam">
                                </div>
                            </div>
                        </div>


                        <div class="profile-card-social">
                            <a href="#" class="profile-card-social__item facebook">
                                <span class="icon-font">
                                    <i class="fa fa-facebook icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item twitter">
                                <span class="icon-font">
                                    <i class="fa fa-twitter icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item instagram">
                                <span class="icon-font">
                                    <i class="fa fa-instagram icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item behance">
                                <span class="icon-font">
                                    <i class="fa fa-google icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item github">
                                <span class="icon-font">
                                    <i class="fa fa-youtube icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item codepen">
                                <span class="icon-font">
                                    <i class="fa fa-pinterest icon "></i>
                                </span>
                            </a>

                            <a href="#" class="profile-card-social__item link">
                                <span class="icon-font">
                                    <i class="fa fa-behance icon "></i>
                                </span>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer text-center">
        <spans style="font-size: 12px; color: #333;">Copyright©2005-2021 . All rights reserved</spans>
    </div>
@endsection

@push('scripts')
    
@endpush
