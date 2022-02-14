@extends('admin.layout.master')

@section('title', 'Chuyển điểm')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
<div class="container pt-4 pb-4">
    <div class="row">
        <div class="col-12">
        <form action="{{route('chuyendiem')}}" method="POST">
                <!-- <div class="pt-1">Mã giao dịch:</div> -->
                <!-- <input class="form-control" name="code_chuyenkhoan" value="{{$magiaodich}}" readonly> -->
                <input name="id_user_nhan" id="id_user_nhan"  type="text" class="form-control mt-2" placeholder="Mã HSKH nhận C">
                <textarea name="note" class="form-control mt-2" placeholder="Nội dung chuyển khoản"></textarea>
                <div class="pt-1">Số dư hiện tại:</div>
                <input class="form-control" id="point_present" name="point_present" value="{{$pointC->value('point_c')}}" readonly>
                <div class="pt-1">Số điểm chuyển:</div>
                <input class="form-control" name="sodiemchuyen" id="sodiemchuyen" placeholder="Nhập số điểm muốn chuyển">
                <div class="pt-1">Số dư cuối:</div>
                <input class="form-control" name="point_past" id="point_past" placeholder="Nhập số điểm muốn chuyển" value="" readonly>
                <button type="submit" class="btn btn-primary mt-2 text-uppercase" style="width: 100%">Chuyển khoản ngay</button>
        @csrf
        </form>
        </div>
    </div>


</div>
<script>


$("#id_user_nhan").change(function(e) {
    console.log($(this).val());
    e.preventDefault();
    var html = '100';
    /* Act on the event */
    var id_user_nhan = $("#id_user_nhan").val();
    var point_past = $("#sodiemchuyen").val();
    $.ajax({
        url: "{{route('test')}}",
        type: 'GET',
        dataType: 'json',
        data: {id: id_user_nhan},
        success: function (response) {
            console.log(response)
            $('#point_present').val(response.pointC)
            $('#point_past').val(response.point_past)
        }
    })
});
$("#sodiemchuyen").change(function(e) {
    console.log($(this).val());
    e.preventDefault();
    var html = '100';
    /* Act on the event */
    var id_user_nhan = $("#id_user_nhan").val();
    var point_past = $("#sodiemchuyen").val();
    $.ajax({
        url: "{{route('test')}}",
        type: 'GET',
        dataType: 'json',
        data: {id: id_user_nhan, point_past: point_past},
        success: function (response) {
            console.log(response)
            $('#point_present').val(response.pointC)
            $('#point_past').val(response.point_past)
        }
    })
});
</script>
@endsection