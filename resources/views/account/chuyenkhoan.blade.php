@extends('layout.master')

@section('title', 'Tài khoản')

@push('css')
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
<div class="container pt-2">
    <div class="row  d-flex justify-content-center">
        <div class="col-12 text-center">
            <h3 class="text-uppercase m-0">Chuyển khoản C</h3>
        </div>
      
        <div class="col-lg-6 col-md-8 col-12">
        @if(session('thongbao'))
        <div class="alert alert-success">
            {{session('thongbao')}} 
        </div>
        @endif

        @if(session('thatbai'))
        <div class="alert alert-danger">
            {{session('thatbai')}} 
        </div>
        @endif
            <form action="{{route('chuyenkhoanC')}}" method="POST">
                <div class="pt-1">Mã giao dịch:</div>
                <input class="form-control" name="code_chuyenkhoan" value="{{$number}}" readonly>
                <input name="id_user_nhan" type="text" class="form-control mt-2" placeholder="Mã HSKH nhận C">
                <textarea name="note" class="form-control mt-2" placeholder="Nội dung chuyển khoản"></textarea>
                <div class="pt-1">Số dư hiện tại:</div>
                <input class="form-control" value="{{$pointC->value('point_c')}}" readonly>
                <div class="pt-1">Số điểm chuyển:</div>
                <input class="form-control" name="sodiemchuyen" placeholder="Nhập số điểm muốn chuyển">
                <button type="submit" class="btn btn-primary mt-2 text-uppercase" style="width: 100%">Chuyển khoản ngay</button>
            @csrf
            </form>
        </div>
    </div>
</div>


@endsection

@push('scripts')
<script src="{{ asset('public/js/account.js') }}"></script>
@endpush