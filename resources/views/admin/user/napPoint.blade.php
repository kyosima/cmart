@extends('admin.layout.master')

@section('title', 'Nạp C')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
@endpush

@section('content')
<div class="container pt-4 pb-4">
    <div class="row pb-3">
        <div class="col-12">
            <a class="btn btn-primary text-white" style="width: 100%">
                Tài khoản C của C-mart: {{$pointC->point_c}}
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
        <form action="{{route('postNapC')}}" method="POST">
                <!-- <div class="pt-1">Mã giao dịch:</div> -->
                <!-- <input class="form-control" name="code_chuyenkhoan" value="{{$magiaodich}}" readonly> -->
                <input name="id_user_nhan" id="id_user_nhan"  type="text" class="form-control mt-2" placeholder="Mã HSKH nhận C" value="202201170001" readonly>
                <!-- <textarea name="note" class="form-control mt-2" placeholder="Nội dung chuyển khoản"></textarea> -->
                <div class="pt-1">Số dư hiện tại:</div>
                <input class="form-control" id="point_present" name="point_present" value="{{$pointC->point_c}}" readonly>
                <div class="pt-1">Số C nạp:</div>
                <input class="form-control" id="sodiemchuyen" name="sodiemchuyen" placeholder="Nhập số C muốn nạp">
                <div class="pt-1">Số dư cuối:</div>
                <input class="form-control" id="point_past" name="point_past" value="{{$pointC->value('point_c')}}" readonly>
                <button type="submit" class="btn btn-primary mt-2 text-uppercase" style="width: 100%">Nạp </button>
        @csrf
        </form>
        </div>
    </div>


</div>
<script>


$("#sodiemchuyen").change(function(e) {
    console.log($(this).val());
    e.preventDefault();
    var html = '100';
    /* Act on the event */
    var id_user_nhan = $("#id_user_nhan").val();
    var point = $("#sodiemchuyen").val();
    $.ajax({
        url: "{{route('tinhDiemNap')}}",
        type: 'GET',
        dataType: 'json',
        data: {id: id_user_nhan,point: point},
        success: function (response) {
            console.log(response)
            $('#point_past').val(response.pointC)
        }
    })
});

</script>
@endsection