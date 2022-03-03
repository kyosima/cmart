@extends('layout.master')

@section('title', 'Xác minh hồ sơ quên lại mật khẩu')

@push('css')
    <link href="{{ asset('public/css/ekyc_password.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/css/thanhtoan.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <h4 class="text-center">NHẬP MẬT KHẨU MỚI</h4>
            </div>
        </div>
        <form action="{{route('postResetPassword')}}" method="post">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-12 text-center">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Mời nhập mật khẩu mới ít nhất 8 ký tự" name="password" value="" minlength="8">
        
                    </div>
                    <input type="submit" name="" id="" class="btn btn-primary" value="Xác nhận mật khẩu mới">
                </div>

            </div>
            
        </form>
    </div>
@endsection
@push('js')
@endpush
