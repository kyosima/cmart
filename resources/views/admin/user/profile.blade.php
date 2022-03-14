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

        tbody tr:nth-child(even) td {}

        .styled-table tbody tr {
            border-bottom: 1px solid #11101d;
        }

        .styled-table tbody tr:nth-of-type(even) {}

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #11101d;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #11101d;
        }

        .styled-table td,
        .styled-table th {
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
                        @if ($user->avatar != null)
                            <img src="{{ $user->avatar }}" alt="profile">
                        @else
                            <img src="{{ asset('/public/avatar.png') }}" alt="profile">
                        @endif
                    </div>

                    <div class="profile-card__cnt js-profile-cnt">
                        <div class="profile-card__name pb-3" style="text-transform: uppercase">
                            @if ($user->name != null)
                                - ID: {{ $user->code_customer }} -
                            @else
                                - ID: {{ $user->code_customer }} -
                            @endif
                        </div>
                        <!-- <button class="profile-card__button btn-1 button--orange"><span>Số tiền hiện tại</span></button>
                                                                                        <button class="profile-card__button btn-2 button--blue"><span>Điểm tích lũy</span></button>
                                                                                        <button class="profile-card__button btn-3 button--purple"><span>Điểm thưởng</span></button> -->
                        <div class="row">
                            <div class="col-4">
                                <button class="alert alert-success m-0 text-center"
                                    style="width: 85%;border-radius: 40px; background: orangered; color: white;">Đơn hàng
                                    hoàn thành:
                                    {{ formatNumber($order_done) }}</button>

                            </div>
                            <!-- <div class="col-4">
                                 z                                                           <button class="alert alert-danger m-0" style="width: 85%;border-radius: 40px; background: turquoise; color: white;">Số dư M: 0</button>
                                                                                            </div> -->
                            <div class="col-4">
                                <button class="alert alert-success m-0 text-center"
                                    style="width: 85%;border-radius: 40px; background: rgb(255, 0, 21); color: white;">
                                    Đơn hàng hủy:
                                    {{ formatNumber($order_cancel) }}</button>
                            </div>
                            <div class="col-4">
                                <button class="alert alert-warning m-0"
                                    style="width: 85%;border-radius: 40px; background: darkblue; color: white;">Số dư C:
                                    {{ formatNumber($pointC) }}</button>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-around">
                            <div class="col-md-4 col-12">
                                <button class="alert alert-success m-0 text-center"
                                    style="border-radius: 40px; background: rgb(0, 139, 23); color: white;">
                                    Đơn hàng hoàn thành/tháng:
                                    {{ formatNumber($order_done_month) }}</button>
                            </div>

                            <div class="col-md-4 col-12">
                                <button class="alert alert-success m-0 text-center"
                                    style="border-radius: 40px; background: rgb(0, 26, 5); color: white;">
                                    Đơn hàng hủy/tháng:
                                    {{ formatNumber($order_cancel_month) }}</button>
                            </div>
                        </div>

                        <div class="info pt-5">
                            <form action="{{ $user->id }}" method="POST">
                                @csrf
                                <h3 class="text-uppercase text-center">- Thông tin khách hàng -</h3>
                                <div class="row">
                                    <div class="col-lg-12 text-start">


                                        <div class="form-group">
                                            <span class="text-uppercase">Họ và tên</span>
                                            <input type="name" class="form-control mb-2" name="hoten"
                                                placeholder="Nhập tên người dùng" value="{{ $user->hoten }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 text-start">
                                        <span class="text-uppercase">Số điện thoại</span>
                                        <input type="phone" class="form-control mb-2" name="phone"
                                            placeholder="Nhập số điện thoại" value="{{ $user->phone }}" >
                                        <!-- <span class="text-uppercase">Email</span>
                                                                                                    <input type="email" class="form-control mb-2" name="email" placeholder="Nhập địa chỉ email"
                                                                                                        value="{{ $user->email }}" readonly=""> -->
                                    </div>

                                    <div class="col-lg-4 text-start">
                                        <span class="text-uppercase">Định danh Khách Hàng</span>
                                        <select class="form-select mb-2" name="level" aria-label="Default select example">
                                            <option value="{{ $user->level }}" selected>
                                                @if ($user->level == 0)
                                                    Khách hàng thân thiết
                                                @elseif($user->level == 1)
                                                    Khách hàng VIP
                                                @elseif($user->level == 2)
                                                    Công tác viên
                                                @elseif($user->level == 3)
                                                    Purchasing
                                                @elseif($user->level == 4)
                                                    Khách hàng thương mại
                                                @endif
                                            </option>
                                            @if ($user->level != 0)
                                                <option value="0">Khách hàng thân thiết</option>
                                            @else
                                            @endif

                                            @if ($user->level != 1)
                                                <option value="1">Khách hàng V.I.P</option>
                                            @else
                                            @endif

                                            @if ($user->level != 2)
                                                <option value="2">Cộng tác viên</option>
                                            @else
                                            @endif
                                            @if ($user->level != 3)
                                                <option value="3">Purchasing</option>
                                            @else
                                            @endif
                                            @if ($user->level != 4)
                                                <option value="4">Khách hàng thương mại</option>
                                            @else
                                            @endif

                                        </select>

                                    </div>
                                    {{-- <div class="col-lg-4 text-start">
                                    <span class="text-uppercase">Loại giấy tờ</span>
                                    <select class="form-select" name="type_cmnd" aria-label="Default select example">
                                    
                                    @if ($user->type_cmnd == 0)
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
                                </div> --}}

                                    <div class="col-lg-12 text-start">
                                        <span class="text-uppercase">Địa chỉ</span>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" class="form-control mb-2" name="address"
                                                    placeholder="Nhập địa chỉ" value="{{ $user->address }}" required>
                                            </div>
                                            {{-- <div class="col-lg-3">
                                            <input type="text" class="form-control mb-2" name="duong" placeholder="Nhập tên đường"
                                            value="{{$user->duong}}">
                                        </div> --}}
                                            <div class="col-lg-4">
                                                <select name="sel_province" class="form-control " 
                                                    data-placeholder="---Chọn tỉnh thành---" required>
                                                    <option value="{{$user_province->PROVINCE_ID}}" selected>
                                                        {{$user_province->PROVINCE_NAME}}
                                                    </option>
                                                </select>
                                                {{-- @if ($user->id_tinhthanh == null)
                                                    <select name="sel_province" class="form-control select2" disabled
                                                        data-placeholder="---Chọn tỉnh thành---">
                                                        <option value="">---Chọn tỉnh thành---</option>
                                                        @foreach ($province as $value)
                                                            <option value="{{ $value->matinhthanh }}">
                                                                {{ $value->tentinhthanh }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @else
                                                    <select name="sel_province" class="form-control select2" disabled
                                                        data-placeholder="---Chọn tỉnh thành---">
                                                        <option value="{{ $user->id_tinhthanh }}">
                                                            {{ $tinh }}
                                                        </option>
                                                        @foreach ($province as $value)
                                                            <option value="{{ $value->matinhthanh }}">
                                                                {{ $value->tentinhthanh }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif --}}

                                            </div>
                                            <div class="col-lg-4">
                                                <select name="sel_district" class="form-control " 
                                                    data-placeholder="---Chọn quận huyện---" required>
                                                    <option value="{{ $user_district->DISTRICT_ID }}">
                                                        {{ $user_district->DISTRICT_NAME }}
                                                    </option>
                                                </select>
                                                {{-- @if ($user->id_quanhuyen == null)
                                                    <select class="form-control select2" name="sel_district" disabled
                                                        data-placeholder="---Chọn quận huyên---">
                                                        <option value="">---Chọn quận huyên---</option>
                                                    </select>
                                                @else
                                                    <select class="form-control select2" name="sel_district" disabled
                                                        data-placeholder="---Chọn quận huyên---">
                                                        <option value="{{ $user->id_quanhuyen }}">
                                                            {{ $quan }}

                                                        </option>
                                                    </select>
                                                @endif --}}
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="sel_ward" class="form-control " 
                                                    data-placeholder="---Chọn phường xã---">
                                                    <option value="{{ $user_ward->WARDS_ID }}" required>
                                                        {{ $user_ward->WARDS_NAME }}
                                                    </option>
                                                </select>
                                                {{-- @if ($user->id_phuongxa == null)
                                                        <select class="form-control select2" name="sel_ward" disabled
                                                            data-placeholder="---Chọn phường xã---">
                                                            <option value="">---Chọn phường xã---</option>
                                                        </select>
                                                    @else
                                                        <select class="form-control select2" name="sel_ward" disabled
                                                            data-placeholder="---Chọn phường xã---">
                                                            <option value="{{ $user->id_phuongxa }}">
                                                                {{ $phuongxa }}

                                                            </option>
                                                        </select>
                                                    @endif --}}
                                            </div>
                                        </div>
                                        {{-- <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <span class="text-uppercase">Trạng thái KYC</span>
                                                <select class="form-select" name="check_kyc"
                                                    aria-label="Default select example">
                                                    @if ($user->check_kyc == 0)
                                                        <option value="{{ $user->check_kyc }}" selected>Chọn trạng thái KYC
                                                        </option>
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
                                        </div> --}}
                                        @if ($user->is_ekyc == 1)
                                            <div class="row mb-3">
                                                <div class="col-lg-6">
                                                    <p class="text-uppercase text-center">Mặt trước CMND</p>
                                                    <img src="{{ $user->cmnd_image }}" width="100%" alt="profile"
                                                        height="300px">
                                                </div>
                                                <div class="col-lg-6">
                                                    <p class="text-uppercase text-center">Mặt sau CMND</p>
                                                    <img src="{{ $user->cmnd_image2 }}" alt="profile" width="100%"
                                                        height="300px">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="pt-5">
                                            <div class="row mb-3">
                                                <div class="col-lg-12">
                                                    <h3 class="text-uppercase text-center">- Lịch sử đơn hàng -</h3>
                                                    {{-- <div class="d-flex justify-content-between">
                                                        <div>
                                                            <span>Tổng đơn hàng:
                                                                <b>{{ formatNumber($user->orders()->count()) }}</b></span>
                                                        </div>
                                                        <div>
                                                            <span>Tổng đơn hàng hoàn thành(tháng):
                                                                <b>{{ formatNumber($user->orders()->where('status', 4)->count()) }}</b></span>
                                                        </div>
                                                        <div>
                                                            <span>Tổng đơn hàng hủy(tháng):
                                                                <b>{{ formatNumber($user->orders()->where('status', 5)->count()) }}</b></span>
                                                        </div>
                                                    </div> --}}
                                                    <table class="styled-table table-sortable">
                                                        <thead>
                                                            <tr>
                                                                <th>Mã giao dịch</th>
                                                                <th>Trạng thái</th>
                                                                <th>Chi tiết đơn hàng</th>
                                                                <th></th>

                                                                <!-- <th>Chi tiết đơn hàng</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->orders()->whereIsPayment(1)->latest()->get()
        as $order)
                                                                @foreach ($order->order_stores()->get() as $order_store)
                                                                    <tr style="text-align:center">
                                                                        <td>{{ $order_store->order_store_code }}</td>
                                                                        <td>{!! orderStatus($order_store->status) !!}</td>
                                                                        <td><a target="_blank"
                                                                                href="{{ route('order.viewCbill', ['order_code' => $order->order_code]) }}"
                                                                                class="btn btn-info">Chi tiết</a></td>
                                                                        <td></td>
                                                                    </tr>
                                                                @endforeach
                                                            @endforeach
                                                            <!-- and so on... -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="row mb-3">

                                                <div class="col-lg-12">
                                                    <h3 class="text-uppercase text-center">- Lịch sử chuyển khoản C -
                                                    </h3>
                                                    <table class="styled-table table-sortable">
                                                        <thead>
                                                            <tr>
                                                                <th>Thời gian giao dịch</th>
                                                                <th>Mã giao dịch</th>
                                                                <th>Nội dung</th>
                                                                <th>Số dư ban đầu</th>
                                                                <th>Tăng</th>
                                                                <th>Giảm</th>
                                                                <th>Số dư cuối</th>
                                                                <!-- <th>Chi tiết đơn hàng</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lichsuchuyen as $value)
                                                                <tr style="text-align:center">
                                                                    <td>{{ $value->created_at }}</td>
                                                                    <td>{{ $value->magiaodich }}</td>
                                                                    <td>{{ $value->note }}</td>
                                                                    <td>{{ formatNumber($value->point_past_chuyen) }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($value->point_past_chuyen < $value->point_present_chuyen)
                                                                            {{ formatNumber($value->amount) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($value->point_past_chuyen > $value->point_present_chuyen)
                                                                            {{ formatNumber($value->amount) }}
                                                                        @endif
                                                                    </td>

                                                                    <td>{{ formatNumber($value->point_present_chuyen) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <!-- and so on... -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            {{-- <div class="row mb-3 pt-3">
                                                <div class="col-lg-12">
                                                    <h3 class="text-uppercase text-center">- Lịch sử nhận C -
                                                    </h3>
                                                    <table class="styled-table table-sortable">
                                                        <thead>
                                                            <tr>
                                                                <th>Thời gian</th>
                                                                <th>Mã khách hàng chuyển</th>
                                                                <th>Số dư đầu</th>
                                                                <th>Số dư cuối</th>
                                                                <th>Giá trị chuyển khoản</th>
                                                                <th>Nội dung</th>
                                                                <!-- <th>Chi tiết đơn hàng</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lichsunhan as $value)
                                                                <tr style="text-align:center">
                                                                    <td>{{ $value->created_at }}</td>
                                                                    <td>{{ $value->makhachhang_chuyen }}</td>
                                                                    <td>{{ $value->point_past_chuyen }}</td>
                                                                    <td>{{ $value->point_present_chuyen }}</td>
                                                                    <td>{{ $value->amount }}</td>
                                                                    <td>{{ $value->note }}</td>
                                                                </tr>
                                                            @endforeach
                                                            <!-- and so on... -->
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div> --}}
                                            <div class="row mb-3 pt-3">
                                                <div class="col-lg-12">
                                                    <h3 class="text-uppercase text-center">- Lịch sử nhận C -
                                                    </h3>
                                                    <div class="d-flex justify-content-between">
                                                        <div>
                                                            <span>Tổng C:
                                                                <b>{{ formatNumber($user->point_c()->value('point_c')) }}</b></span>
                                                        </div>
                                                        <div>
                                                            <span>Số C khả dụng:
                                                                <b>{{ formatNumber($user->point_c()->value('point_c')) }}</b></span>
                                                        </div>
                                                    </div>
                                                    <table class="styled-table table-sortable">
                                                        <thead>
                                                            <tr>
                                                                <th>Thời gian giao dịch</th>
                                                                <th>Mã giao dịch</th>
                                                                <th>Nội dung</th>
                                                                <th>Số dư ban đầu</th>
                                                                <th>Tăng</th>
                                                                <th>Giảm</th>
                                                                <th>Số dư cuối</th>
                                                                <!-- <th>Chi tiết đơn hàng</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lichsunhan as $value)
                                                                <tr style="text-align:center">
                                                                    <td>{{ Date('H:i:s d/m/Y', strtotime($value->created_at)) }}
                                                                    </td>
                                                                    <td>{{ $value->magiaodich }}</td>
                                                                    <td>{{ $value->note }}</td>
                                                                    <td>{{ $value->point_past_nhan }}</td>
                                                                    <td>
                                                                        @if ($value->point_past_nhan < $value->point_present_nhan)
                                                                            {{ formatNumber($value->amount) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($value->point_past_nhan > $value->point_present_nhan)
                                                                            {{ formatNumber($value->amount) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ formatNumber($value->point_present_nhan) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            <!-- and so on... -->
                                                        </tbody>
                                                    </table>
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
    <script type="text/JavaScript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
    </script>
<script src="{{ asset('public/js/address.js') }}"></script>
@endpush
