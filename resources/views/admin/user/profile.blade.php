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
                        <div class="profile-card__name" style="text-transform: uppercase">{{$user->name}}</div>
                        <button class="profile-card__button btn-1 button--orange"><span>Số tiền hiện tại</span></button>
                        <button class="profile-card__button btn-2 button--blue"><span>Điểm tích lũy</span></button>
                        <button class="profile-card__button btn-3 button--purple"><span>Điểm thưởng</span></button>
                        <div class="info">
                            <form action="{{$user->id}}" method="POST">
                            <input type="hidden" class="form-control mb-2" name="_token" value="{{csrf_token()}}" />
                            <div class="row m-5">
                                <div class="col-lg-12 text-start">
                                    
                                    
                                    <div class="form-group">
                                        <label>Họ và tên</label>
                                        <input type="name" class="form-control mb-2" name="name" placeholder="Nhập tên người dùng" value="{{$user->name}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Số điện thoại</label>
                                    <input type="phone" class="form-control mb-2" name="phone" placeholder="Nhập số điện thoại"
                                        value="{{$user->phone}}">
                                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                                    <input type="email" class="form-control mb-2" name="email" placeholder="Nhập địa chỉ email"
                                        value="{{$user->email}}" readonly="">
                                </div>
                                <div class="col-lg-6 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Level</label>
                                    <input type="level" class="form-control mb-2" name="level" placeholder="Level"
                                        value="{{$user->level}}">
                                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                                    <input type="password" class="form-control mb-2" name="password" placeholder="Password"
                                        value="{{$user->password}}">
                                </div>

                                <div class="col-lg-12 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control mb-2" name="address" placeholder="Nhập địa chỉ"
                                        value="{{$user->address}}">
                                </div>
                                <button type="submit" class="btn btn-danger">Save Changes</button>
                            </div>
                            </form>
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
