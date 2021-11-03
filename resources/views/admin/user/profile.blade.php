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
                        <img src="{{asset('/public/storage/upload/'.$user->avatar)}}" alt="profile">
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
                                    <label for="exampleFormControlInput1" class="form-label">Loại giấy tờ</label>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <select class="form-select" name="type_cmnd" aria-label="Default select example">
                                              <option selected>
                                                    @if($user->type_cmnd == 0)
                                                        Chọn loại giấy tờ tùy thân
                                                    @elseif($user->type_cmnd == 1)
                                                        Chứng minh nhân dân
                                                    @elseif($user->type_cmnd == 2)
                                                        Căn cước công dân
                                                    @elseif($user->type_cmnd == 3)
                                                        Hộ chiếu
                                                    @else
                                                    @endif  
                                              </option>
                                              <option value="1">Chứng minh nhân dân</option>
                                              <option value="2">Căn cước công dân</option>
                                              <option value="3">Hộ chiếu</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="cmnd" class="form-control mb-2" name="Số CMND" placeholder="Level" value="{{$user->cmnd}}">
                                        </div>
                                    </div>


                                </div>

                                <div class="col-lg-12 text-start">
                                    <label for="exampleFormControlInput1" class="form-label">Địa chỉ</label>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control mb-2" name="address" placeholder="Nhập địa chỉ"
                                            value="{{$user->address}}">
                                        </div>
                                        <div class="col-lg-3">
                                            <select name="tinhthanh" class="form-control select2" data-placeholder="---Chọn tỉnh thành---">
                                                @if($user->id_tinhthanh != null)
                                                    @foreach ($province as $value)
                                                    <option value="{{$value->matinhthanh}}">{{ $value->tentinhthanh }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">---Chọn tỉnh thành---</option>
                                                    @foreach ($province as $value)
                                                    <option value="{{$value->matinhthanh}}">{{ $value->tentinhthanh }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select name="phuongxa" class="form-control select2" data-placeholder="---Chọn tỉnh thành---">
                                                @if($user->id_phuongxa != null)
                                                    @foreach ($ward as $value)
                                                    <option value="{{$value->maphuongxa}}">{{ $value->tenphuongxa }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">---Chọn phường xã---</option>
                                                    @foreach ($ward as $value)
                                                    <option value="{{$value->maphuongxa}}">{{ $value->tenphuongxa }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-lg-3">
                                            <select name="quanhuyen" class="form-control select2" data-placeholder="---Chọn tỉnh thành---">
                                                @if($user->id_quanhuyen != null)
                                                    @foreach ($district as $value)
                                                    <option value="{{$value->maquanhuyen}}">{{ $value->tenquanhuyen }}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">---Chọn quận huyện---</option>
                                                    @foreach ($district as $value)
                                                    <option value="{{$value->maquanhuyen}}">{{ $value->tenquanhuyen }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-3">
                                            <label for="exampleFormControlInput1" class="form-label">Trạng thái KYC</label>
                                            <select class="form-select" name="check_kyc" aria-label="Default select example">
                                                @if($user->check_kyc == 0)
                                                    <option selected>Chọn trạng thái KYC</option>
                                                    <option value="1">Đồng ý</option>
                                                    <option value="2">Từ chối</option>
                                                @elseif($user->check_kyc == 1)
                                                    <option selected value="1">Đồng ý</option>
                                                    <option value="2">Từ chối</option>
                                                @elseif($user->check_kyc == 2)
                                                    <option selected value="2">Từ chối</option>
                                                    <option value="1">Đồng ý</option>
                                                @else
                                                @endif  
                                              
                                            </select>
                                        </div>
                                    </div>
                                    
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
