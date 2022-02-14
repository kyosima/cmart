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
            <div class="col-3">
                <input type="text" class="form-control" id="search_time" onkeyup="search_time()" placeholder="Nhập thời gian tìm kiếm">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id="search_makhachhang" onkeyup="search_makhachhang()" placeholder="Nhập mã khách hàng tìm kiêm">
            </div>
            <div class="col-3">
                <input type="text" class="form-control" id="search_magiaodich" onkeyup="search_magiaodich()" placeholder="Nhập nội dung tìm kiếm">
            </div>
            <div class="col-3">
                <a href="{{asset('admin/lichsutichluy/download')}}" class="btn btn-primary text-white" style="width: 100%">Xuất File Excel</a>
            </div>
        </div>
    </div>
    <table class="styled-table table-sortable" id="myTable">
        <thead>
            <tr style="text-align:center">
                <th>Thời gian giao dịch</th>
                <th>Mã khách hàng chuyển</th>
                <th>Mã giao dịch</th>
                <th>Số dư ban đầu khách hàng</th>
                <th>Số dư cuối khách hàng</th>
                <th>Giá trị giao dịch</th>
                <th>Nội dung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listHistory as $value)
                <tr style="text-align:center">
                    <td>{{$value->created_at}}</td>
                    <td>{{$value->makhachhang_chuyen}}</td>
                    <td>{{$value->magiaodich}}</td>
                    <td>{{$value->point_past_chuyen}}</td>
                    <td>{{$value->point_present_chuyen}}</td>
                    <td>{{$value->amount}}</td>
                    <td>{{$value->note}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

@endsection


@push('scripts')
<script type="text/javascript" src="{{asset('public/css/table/table.js')}}"></script>
<script>
      function search_magiaodich() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("search_magiaodich");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[6];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }       
    }
  }
</script>
@endpush