@extends('admin.layout.master')

@section('title', 'Lịch sử tích luỹ')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/css/table/table.css') }}" type="text/css">
@endpush

@section('content') 
<body>
    <div class="container pt-4 pb-4">
        <div class="row">
            <!-- <div class="col-3">
                <input type="text" class="form-control" id="search_time" onkeyup="search_time()" placeholder="Nhập thời gian tìm kiếm">
            </div> -->
            <div class="col-3">
                <input type="text" class="form-control" id="search_makhachhang" onkeyup="search_makhachhang()" placeholder="Nhập mã khách hàng tìm kiêm">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id="search_magiaodich" onkeyup="search_noidung()" placeholder="Nhập tên khách hàng tìm kiếm">
            </div> 

            <div class="col-6">
                <div class="row">
                    <div class="col-6">
                        <a href="{{asset('admin/lichsutichluy/download/pdf')}}" class="btn btn-primary text-white" style="width: 100%">
                        Xuất PDF</a></div>
                    <div class="col-6">
                        <a href="{{asset('admin/lichsutichluy/download/xlsx')}}" class="btn btn-primary text-white" style="width: 100%">
                        Xuất Excel</a></div>
                </div>
            </div>
        </div>
        <div class="row pt-3">
            <div class="col-3"></div>
            <div class="col-6">
                <a class="btn btn-tongC" href="{{asset('admin/danh-sach-user/1')}}">
                    Tổng C hiện tại TK C-MART: {{$user->point_c->point_c}}</a>
            </div>
        </div>
    </div>
    <table class="styled-table table-sortable" id="myTable">
        <thead>
            <tr style="text-align:center">
                <th>Thời gian giao dịch</th>
                <th>Mã khách hàng</th>
                <th>Tên khách hàng</th>
                <th>Nội dung</th>
                <th>Số dư ban đầu</th>
                <th>Giá trị giao dịch</th>
                <th>Số dư cuối</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listHistory as $value)
                <tr style="text-align:center">
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->makhachhang_chuyen}}</td>
                    <td>{{DB::table('users')->where('id',$value->point_c_idchuyen)->first()->hoten}}</td>
                    <td>{{$value->note}}</td>
                    <td>{{$value->point_past_chuyen}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->point_present_chuyen}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

@endsection


@push('scripts')
<script type="text/javascript" src="{{asset('public/css/table/table.js')}}"></script>
@endpush