@extends('admin.layout.master')

@section('title', 'Lịch sử chuyển khoản')

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
            <div class="col-12">
                <div class="row">
                    <div class="col-6"><a href="{{asset('admin/lichsuchuyenkhoan/download/pdf')}}" class="btn btn-primary text-white" style="width: 100%">Xuất PDF</a></div>
                    <div class="col-6"><a href="{{asset('admin/lichsuchuyenkhoan/download/xlsx')}}" class="btn btn-primary text-white" style="width: 100%">Xuất Excel</a></div>
                </div>
            </div>
        </div>
     
    </div>
    <table class="styled-table table-sortable" id="myTable">
        <thead>
            <tr style="text-align:center">
                <th>Thời gian giao dịch</th>
                <th>Mã khách hàng</th>
                <th>Nội dung</th>
                <th>Số dư ban đầu</th>
                <th>Giá trị giao dịch</th>
                <th>Số dư cuối</th>
                <!-- <th>Mã khách hàng chuyển</th>
                <th>Số dư ban đầu KH chuyển</th>
                <th>Số dư cuối KH chuyển</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($listHistory as $value)
                <tr style="text-align:center">
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->makhachhang}}</td>
                    <td>{{$value->note}}</td>
                    <td>{{$value->point_past_chuyen}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->point_present_chuyen}}</td>
                    <!-- <td>{{$value->makhachhang}}</td>
                    <td>{{$value->point_past_nhan}}</td>
                    <td>{{$value->point_present_nhan}}</td> -->
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

@endsection


@push('scripts')
<script type="text/javascript" src="{{asset('public/css/table/table.js')}}"></script>
@endpush