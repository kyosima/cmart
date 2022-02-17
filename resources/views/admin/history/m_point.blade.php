@extends('admin.layout.master')

@section('title', 'Lịch sử điểm tích luỹ M')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/css/table/table.css') }}" type="text/css">
@endpush

@section('content') 
<body>
    <div class="container pt-4 pb-4">
    <!-- @include('admin.history.cmart_point') -->
        <div class="row">
            <div class="col-4">
                <input type="text" class="form-control" id="search_time" onkeyup="search_time()" placeholder="Nhập thời gian tìm kiếm">
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="search_makhachhang" onkeyup="search_makhachhang()" placeholder="Nhập mã khách hàng tìm kiêm">
            </div>
        </div>
    </div>
    
    <table class="styled-table table-sortable" id="myTable">
        <thead>
            <tr style="text-align:center">
                <th>Thời gian giao dịch</th>
                <th>Mã khách hàng</th>
                <th>Nội dung</th>
                <th>Số dư ban đầu khách hàng</th>
                <th>Giá trị giao dịch</th>
                <th>Số dư cuối khách hàng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listHistory as $value)
                <tr style="text-align:center">
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->makhachhang}}</td>
                    <td>{{$value->note}}</td>
                    <td>{{$value->point_past}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->point_present}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

@endsection


@push('scripts')
<script type="text/javascript" src="{{asset('public/css/table/table.js')}}"></script>
@endpush