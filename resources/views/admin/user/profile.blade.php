@extends('admin.layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/profile.css') }}" type="text/css">
    <style>
        .dtsb-searchBuilder {
            display: none;
        }

    </style>
@endpush

@section('content')

    <div class="m-3">
        <div class="wrapper-top bg-white p-4">
            <div class="wrapper-top">
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
                                            placeholder="Nhập số điện thoại" value="{{ $user->phone }}">
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
                                                    <option value="{{ $user_province->PROVINCE_ID }}" selected>
                                                        {{ $user_province->PROVINCE_NAME }}
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
                                                    <table id="order" class="table table-striped table-bordered">
                                                        <thead class="bg-dark text-light">
                                                            <tr>
                                                                <th>Mã giao dịch</th>
                                                                <th>Trạng thái</th>
                                                                <th>Chi tiết đơn hàng</th>

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
                                                    <h3 class="text-uppercase text-center">- Lịch sử sử dụng C -
                                                    </h3>
                                                    <div class="row pb-1">
                                                        <div class="col-6">
                                                            <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                                                                Tổng C: {{ formatNumber($user->point_c()->value('point_c') + $user->getHistory()->whereStatus(0)->sum('amount')) }}
                                                            </a>
                                                        </div>
                                    
                                                        <div class="col-6">
                                                            <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                                                                Số C khả dụng: {{ $user->point_c()->value('point_c') }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <table id="history-c" class="table table-striped table-bordered">
                                                        <thead class="bg-dark text-light text-center">
                                                            <tr>
                                                                <th>Thời gian giao dịch</th>
                                                                <th>Mã giao dịch</th>
                                                                <th>Nội dung</th>
                                                                <th>Số dư ban đầu</th>
                                                                <th>Tăng</th>
                                                                <th>Giảm</th>
                                                                <th>Số dư cuối</th>
                                                                <th>Trạng thái</th>
                                                                <!-- <th>Chi tiết đơn hàng</th> -->
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($user->getHistory()->latest()->get()
        as $history)
                                                                <tr style="text-align:center">
                                                                    <td>{{ date('d-m-Y H:i:s', strtotime($history->created_at)) }}
                                                                    </td>
                                                                    <td>{{ $history->code }}</td>
                                                                    <td>{{ $history->content }}</td>
                                                                    <td>{{ formatNumber($history->user_old_balance) }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($history->type == 1)
                                                                            0
                                                                        @else
                                                                            {{ formatNumber($history->amount) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($history->type == 1)
                                                                            {{ formatNumber($history->amount) }}
                                                                        @else
                                                                            0
                                                                        @endif
                                                                    </td>

                                                                    <td>
                                                                        @if ($history->type == 1)
                                                                            {{ formatNumber($history->user_old_balance - $history->amount) }}
                                                                        @else
                                                                            {{ formatNumber($history->user_old_balance + $history->amount) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($history->status == 1)
                                                                            Khả dụng
                                                                        @else
                                                                            Phỏng tỏa đến {{date('d/m/Y H:i:s', strtotime($history->time))}}
                                                                        @endif
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
                                            </div> --}}

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
    <script src="{{ asset('public/js/address.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/sorting/datetime-moment.js"></script>
    {{-- <script type="text/javascript" src="{{ asset('public/css/table/table.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $.fn.dataTable.moment('HH:mm MMM D, YY');
            $.fn.dataTable.moment('dddd, MMMM Do, YYYY');

            // $('#history-c').on('error.dt', function(e, settings, techNote, message) {
            //     console.log('An error has been reported by DataTables: ', message);
            // }).DataTable();
            $('#history-c').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [5, 25, 50, -1],
                    [5, 25, 50, "All"]
                ],


                "language": {
                    "emptyTable": "Không có dữ liệu nào !",
                    "info": "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
                    "infoEmpty": "Hiển thị 0 đến 0 trong số 0 mục nhập",
                    "infoFiltered": "(Có _TOTAL_ kết quả được tìm thấy)",
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "search": "Tìm kiếm",
                    "zeroRecords": "Không có bản ghi nào tìm thấy !",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    },
                    "decimal": ",",
                    "thousands": ".",
                },
                dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    data = $('<td>' + data + '</td>').text();
                                    console.log();

                                    return data.replace(/\./g, '');

                                }
                            }
                        }

                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }
                ],
            });
        });
        $(document).ready(function() {

            $('#order').DataTable({
                responsive: true,
                "order": [],
                lengthMenu: [
                    [5, 25, 50, -1],
                    [5, 25, 50, "All"]
                ],

                columnDefs: [{
                    targets: [2],
                    orderable: false,
                }, ],
                "language": {
                    "emptyTable": "Không có dữ liệu nào !",
                    "info": "Hiển thị _START_ đến _END_ trong số _TOTAL_ mục nhập",
                    "infoEmpty": "Hiển thị 0 đến 0 trong số 0 mục nhập",
                    "infoFiltered": "(Có _TOTAL_ kết quả được tìm thấy)",
                    "lengthMenu": "Hiển thị _MENU_ bản ghi",
                    "search": "Tìm kiếm",
                    "zeroRecords": "Không có bản ghi nào tìm thấy !",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                        "previous": '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                    },
                    "decimal": ",",
                    "thousands": ".",
                },
                dom: '<Q><"wrapper d-flex justify-content-between mb-3"lf><"custom-export-button"B>tip',
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            format: {
                                body: function(data, row, column, node) {
                                    data = $('<td>' + data + '</td>').text();
                                    console.log();

                                    return data.replace(/\./g, '');

                                }
                            }
                        }

                    },
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',

                    }
                ],
            });
        });
    </script>
@endpush
