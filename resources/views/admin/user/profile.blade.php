@extends('admin.layout.master')

@section('title', 'Thông tin tài khoản')

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

tbody tr:nth-child(even) td {
    color: white;
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
                        @if($user->avatar != null)
                            <img src="{{asset('/public/images/'.$user->avatar)}}" alt="profile">
                        @else
                            <img src="{{asset('/public/avatar.png')}}" alt="profile">
                        @endif
                    </div>

                    <div class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name pb-3" style="text-transform: uppercase">
                            @if($user->name != null)
                                - ID: {{$user->code_customer}} -
                            @else
                                - ID: {{$user->code_customer}} -
                            @endif
                        </div>
                        <!-- <button class="profile-card__button btn-1 button--orange"><span>Số tiền hiện tại</span></button>
                        <button class="profile-card__button btn-2 button--blue"><span>Điểm tích lũy</span></button>
                        <button class="profile-card__button btn-3 button--purple"><span>Điểm thưởng</span></button> -->
                        <div class="row">
                            <div class="col-4">
                                <button class="alert alert-success m-0 text-center" style="width: 85%;border-radius: 40px; background: orangered; color: white;">Số đơn hàng đã hoàn thành: {{$sodonhang}}</button>
                            </div>
                            <div class="col-4">
                                <button class="alert alert-warning m-0" style="width: 85%;border-radius: 40px; background: darkblue; color: white;">Số dư C: {{$user->tichluyC}}</button>
                            </div>
                            <div class="col-4">
                            <button class="alert alert-danger m-0" style="width: 85%;border-radius: 40px; background: turquoise; color: white;">Số dư M: 0</button>
                            </div>
                        </div>
                        
                        
                        
                        <div class="info pt-5">
                            <form action="{{$user->id}}" method="POST">
                            @csrf
                            <h3 class="text-uppercase text-center">- Thông tin khách hàng -</h3>
                            <div class="row">
                                <div class="col-lg-12 text-start">
                                    
                                    
                                    <div class="form-group">
                                        <span class="text-uppercase">Họ và tên</span>
                                        <input type="name" class="form-control mb-2" name="hoten" placeholder="Nhập tên người dùng" value="{{$user->hoten}}">
                                    </div>
                                </div>
                                <div class="col-lg-6 text-start">
                                    <span class="text-uppercase">Số điện thoại</span>
                                    <input type="phone" class="form-control mb-2" name="phone" placeholder="Nhập số điện thoại"
                                        value="{{$user->phone}}">
                                        <!-- <span class="text-uppercase">Email</span>
                                    <input type="email" class="form-control mb-2" name="email" placeholder="Nhập địa chỉ email"
                                        value="{{$user->email}}" readonly=""> -->
                                </div>
                                <div class="col-lg-6 text-start">
                                <span class="text-uppercase">Cấp độ thành viên</span>
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
                                            <span class="text-uppercase">Loại giấy tờ</span>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <select class="form-select" name="type_cmnd" aria-label="Default select example">
                                            
                                            @if($user->type_cmnd == 0)
                                              <option value="0">Chọn loại giấy tờ tùy thân</option>
                                              <option value="1">Chứng minh nhân dân</option>
                                              <option value="2">Căn cước công dân</option>
                                              <option value="3">Hộ chiếu</option>
                                              
                                            @elseif($user->type_cmnd == 1)
                                              <option value="1">Chứng minh nhân dân</option>
                                              <option value="2">Căn cước công dân</option>
                                              <option value="3">Hộ chiếu</option>
                                            
                                            @elseif($user->type_cmnd == 2)
                                              <option value="2">Căn cước công dân</option>
                                              <option value="1">Chứng minh nhân dân</option>
                                              <option value="3">Hộ chiếu</option>

                                            @elseif($user->type_cmnd == 3)  
                                              <option value="3">Hộ chiếu</option>
                                              <option value="1">Chứng minh nhân dân</option>
                                              <option value="2">Căn cước công dân</option>

                                            @else
                                            @endif
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <div class="col-lg-12 text-start">
                                    <span class="text-uppercase">Địa chỉ</span>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <input type="text" class="form-control mb-2" name="address" placeholder="Nhập địa chỉ"
                                            value="{{$user->address}}">
                                        </div>
                                        <div class="col-lg-3">
                                            
                                        @if($user->id_tinhthanh == null)
                                        <select name="sel_province" class="form-control select2"
                                            data-placeholder="---Chọn tỉnh thành---">
                                            <option value="">---Chọn tỉnh thành---</option>
                                                @foreach ($province as $value)
                                                    <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                    </option>
                                                @endforeach
                                        </select>
                                        @else
                                        <select name="sel_province" class="form-control select2"
                                            data-placeholder="---Chọn tỉnh thành---">
                                                <option value="{{ $user->id_tinhthanh }}">
                                                {{$tinh}}
                                                </option>
                                                @foreach ($province as $value)
                                                    <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                    </option>
                                                @endforeach
                                        </select>
                                        @endif

                                        </div>
                                        <div class="col-lg-3">
                                        @if($user->id_quanhuyen == null)
                                        <select class="form-control select2" name="sel_district"
                                            data-placeholder="---Chọn quận huyên---">
                                            <option value="">---Chọn quận huyên---</option>
                                        </select>
                                        @else
                                        <select class="form-control select2" name="sel_district"
                                            data-placeholder="---Chọn quận huyên---">
                                            <option value="{{ $user->id_quanhuyen }}">
                                                {{$quan}}
                                            
                                            </option>
                                        </select>
                                        @endif
                                        </div>
                                        <div class="col-lg-3">
                        @if($user->id_phuongxa == null)
                        <select class="form-control select2" name="sel_ward"
                            data-placeholder="---Chọn phường xã---">
                            <option value="">---Chọn phường xã---</option>
                        </select>
                        @else
                        <select class="form-control select2" name="sel_ward"
                            data-placeholder="---Chọn phường xã---">
                            <option value="{{$user->id_phuongxa}}">
                            {{$phuongxa}}
                                
                            </option>
                        </select>
                        @endif
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6">
                                            <span class="text-uppercase">Trạng thái KYC</span>
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
                                        <div class="col-lg-6">
                                            <p class="text-uppercase text-center">Mặt trước CMND</p>
                                            <img src="{{asset('/public/images/'.$user->cmnd_image)}}" width="100%" alt="profile" height="300px">
                                        </div>
                                        <div class="col-lg-6">
                                            <p class="text-uppercase text-center">Mặt sau CMND</p>
                                            <img src="{{asset('/public/images/'.$user->cmnd_image2)}}" alt="profile" height="300px">
                                        </div>
                                    </div>
                                    
                                    <div class="pt-5">
                                        <div class="col-lg-12">
                                            <h3 class="text-uppercase text-center">- Lịch sử đơn hàng -</h3>
                                            @if ($sodonhang != null)
                                            <table class="styled-table table-sortable">
                                                <thead>
                                                    <tr>
                                                        <th>Mã giao dịch</th>
                                                        <th>Cách thức thanh toán</th>
                                                        <th>Phương thức vận chuyển</th>
                                                        <th>Phí vận chuyển</th>
                                                        <th>Giá trị đơn hàng</th>
                                                        <th>Points</th>
                                                        <th>Trạng thái</th>
                                                        <!-- <th>Chi tiết đơn hàng</th> -->
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
                                                    <!-- <td style="text-align: center"><a href="#">Xem</a></td> -->
                                                </tr>
                                                @endforeach
                                                    <!-- and so on... -->
                                                </tbody>
                                            </table>
                                            @else
                                                <p class="text-center text-danger">Hiện tại khách hàng này chưa thực hiện đơn hàng nào</p>
                                            @endif
                                        </div>
                                    <div class="row mb-3 pt-3">
                                        <div class="col-lg-12">
                                            <h3 class="text-uppercase text-center">- Tài khoản tiền tích lũy C -</h3>
                                            @if($sodonhang != null)
                                                <table class="styled-table table-sortable">
                                                    <thead>
                                                        <tr>
                                                            <th>Mã giao dịch</th>
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
                                            @else
                                                <p class="text-center text-danger">Hiện tại khách hàng này chưa thực hiện đơn hàng nào</p>
                                            @endif   
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="text-center ">
                                <button type="submit" class="btn btn-danger">Lưu thay đổi</button>
                                </div>
                            </div>
                            </form>
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
<script type="text/JavaScript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
</script>
<script src="{{ asset('public/js/shipping.js') }}"></script>
@endpush
