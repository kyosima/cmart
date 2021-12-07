@extends('admin.layout.master')

@section('title', 'Quản lý tài khoản')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}" type="text/css">
@endpush

@section('content')
<style type="text/css">
.styled-table {
    border-collapse: collapse;
    font-size: 0.9em;
    font-family: sans-serif;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    width: 100%;
}

.styled-table thead tr {
    background-color: #11101d;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #11101d;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #11101d;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #11101d;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #11101d;
}    

.styled-table td, .styled-table th {
    text-align: center;
}

        .table-sortable th {
        cursor: pointer;
        }

        .table-sortable .th-sort-asc::after {
        content: "\25b4";
        }

        .table-sortable .th-sort-desc::after {
        content: "\25be";
        }

        .table-sortable .th-sort-asc::after,
        .table-sortable .th-sort-desc::after {
        margin-left: 5px;
        }

        .table-sortable .th-sort-asc,
        .table-sortable .th-sort-desc {
        background: rgba(0, 0, 0, 0.1);
        }
</style>
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="wrapper">
                <div class="profile-card js-profile-card">
                    <div class="profile-card__img">
                        <img src="{{asset('/public/storage/upload/'.$user->avatar)}}" alt="profile">
                    </div>

                    <div class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name" style="text-transform: uppercase">{{$user->name}}</div>
                        <!-- <button class="profile-card__button btn-1 button--orange"><span>Số tiền hiện tại</span></button>
                        <button class="profile-card__button btn-2 button--blue"><span>Điểm tích lũy</span></button>
                        <button class="profile-card__button btn-3 button--purple"><span>Điểm thưởng</span></button> -->
                        <div class="info">
                            <form action="{{$user->id}}" method="POST">
@csrf
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
                                    <label for="exampleFormControlInput1" class="form-label">Cấp độ thành viên</label>
                                            <select class="form-select mb-2" name="level" aria-label="Default select example">
                                              <option value="{{$user->level}}" selected>
                                                    @if($user->level == 0)
                                                        Khách hàng bình thường
                                                    @elseif($user->level == 1)
                                                        Khách hàng thân thiết
                                                    @elseif($user->level == 2)
                                                        Khách hàng VIP
                                                    @else
                                                    @endif  
                                              </option>
                                              @if($user->level != 0)
                                              <option value="0">Khách hàng bình thường</option>
                                              @else
                                              @endif

                                              @if($user->level != 1)
                                              <option value="1">Khách hàng thân thiết</option>
                                              @else
                                              @endif

                                              @if($user->level != 2)
                                              <option value="2">Khách hàng VIP</option>
                                              @else
                                              @endif

                                            </select>
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
                                              
                                              @if($user->level != 1)
                                              <option value="1">Chứng minh nhân dân</option>
                                              @else
                                              @endif

                                              @if($user->level != 2)
                                              <option value="2">Căn cước công dân</option>
                                              @else
                                              @endif

                                              @if($user->level != 3)
                                              <option value="3">Hộ chiếu</option>
                                              @else
                                              @endif
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
                                                    <option value="{{$user->check_kyc}}" selected>Chọn trạng thái KYC</option>
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
                                    <div class="row mb-3">
                                        <div class="col-lg-4">
                                            <label for="exampleFormControlInput1" class="form-label">Mặt trước CMND</label><br>
                                            <img src="{{asset('/public/storage/upload/'.$user->cmnd_image)}}" alt="profile" height="200px">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="exampleFormControlInput1" class="form-label">Mặt sau CMND</label><br>
                                            <img src="{{asset('/public/storage/upload/'.$user->cmnd_image2)}}" alt="profile" height="200px">
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="exampleFormControlInput1" class="form-label">Lịch sử đơn hàng</label><br>
                                            <table class="styled-table table-sortable">
                                                <thead>
                                                    <tr>
                                                        <th>Mã đơn hàng</th>
                                                        <th>Cách thức thanh toán</th>
                                                        <th>Phương thức vận chuyển</th>
                                                        <th>Phí vận chuyển</th>
                                                        <th>Giá trị đơn hàng</th>
                                                        <th>Points</th>
                                                        <th>Trạng thái</th>
                                                        <th>Chi tiết đơn hàng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($orders as $k)
                                                <tr>
                                                    <td>{{$k->order_code}}</td>
                                                    <td>
                                                        @if($k->payment_method == 1)
                                                            Thanh toán khi nhận hàng
                                                        @else
                                                            Thanh toán bằng chuyển khoản
                                                        @endif
                                                    </td>
                                                    <td>{{$k->shipping_method}}</td>
                                                    <td>{{$k->shipping_total}}</td>
                                                    <td>{{$k->sub_total}}</td>
                                                    <td>0</td>
                                                    <td>
                                                        @if($k->payment_method == 1)
                                                            Đang vận chuyển
                                                        @elseif($k->payment_method != 1)
                                                            Đang chờ thanh toán
                                                        @else
                                                            Đang vận chuyển
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center"><a href="#">Xem</a></td>
                                                </tr>
                                                @endforeach
                                                    <!-- and so on... -->
                                                </tbody>
                                            </table>
                                        </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="exampleFormControlInput1" class="form-label">Lịch sử nhận point</label><br>
                                            <div style="text-align: -webkit-center;">
    <form data-action="cpoint" method="POST">
    @csrf 
    <table class="styled-table table-sortable">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Số điểm nhận đc</th>
                <th>Ngày nhận</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $k)
            <tr>
                <td>{{$k->order_code}}</td>
                <td>{{$k->c_point}}</td>
                <td>{{$k->created_at}}</td>
            </tr>
            @endforeach
            <!-- and so on... -->
        </tbody>
    </table>
    </div>
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
