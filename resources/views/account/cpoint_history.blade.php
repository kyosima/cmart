@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')

<style type="text/css">
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #00e6f8;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #00e6f8;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #00e6f8;
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
<body>
    <div style="text-align: -webkit-center;">
    <div class="container pt-2">
        <div class="row pb-4">
            <div class="col-6">
                <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                    Tổng C: {{$pointC->point_c}}
                </a>
            </div>

            <div class="col-6">
                <a class="btn text-white" style="width: 100%;background-color: #00e6f8;">
                    Số C khả dụng: {{$pointC->point_c}}
                </a>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-4">
                <input type="text" class="form-control" id="search_time" onkeyup="search_time()" placeholder="Nhập thời gian tìm kiếm">
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="search_makhachhang" onkeyup="search_makhachhang()" placeholder="Nhập giao dịch tìm kiêm">
            </div>
            <div class="col-4">
                <input type="text" class="form-control" id="search_magiaodich" onkeyup="search_magiaodich()" placeholder="Nhập nội dung tìm kiếm">
            </div>
        </div> -->
    </div>
    
    <div class="container">
        <table class="styled-table table-sortable" id="myTable" style="width: 100%;">
            <thead>
                <tr>
                    <th>Thời gian giao dịch</th>
                    <th>Mã giao dịch</th>
                    <th>Nội dung</th>
                    <th>Số dư ban đầu</th>
                    <th>Tăng</th>
                    <th>Giảm</th>
                    <th>Số dư cuối</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $k)
                <tr>
                <td>{{$k->created_at}}</td>
                    <td>{{$k->magiaodich}}
                    <td>{{$k->note}}</td>
                    @if ($user->code_customer == $k->makhachhang && $user->code_customer != $k->makhachhang_chuyen)
                    <td>{{$k->point_past_nhan}}</td>
                    <td>{{$k->amount}}</td>
                    <td> </td>
                    <td>{{$k->point_present_nhan}}</td>
                    @else
                    <td>{{$k->point_past_chuyen}}</td>
                    <td> </td>
                    <td>{{$k->amount}}</td>
                    <td>{{$k->point_present_chuyen}}</td>
                    @endif
                    <td>Khả dụng</td>
                </tr>
                @endforeach


                <!-- and so on... -->
            </tbody>
        </table>
    </div>
    </div>
</body> 
</html>

@endsection
    
@push('scripts')
<script type="text/javascript" src="{{asset('public/css/table/table.js')}}"></script>
@endpush

