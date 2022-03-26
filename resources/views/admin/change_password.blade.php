@extends('admin.layout.master')

@section('title', 'Đổi mật khẩu')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/amcharts.css') }}" type="text/css">
    <style>
        .form-group {
            padding: 10px 0px;
        }

    </style>
@endpush

@section('content')
    <div class="m-3">
        <div class="wrapper bg-white p-4">
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-12">
                    @if (session('message'))
                        <div class="portlet-status mb-2">
                            <div class="caption bg-success p-3">
                                <span class="caption-subject bold uppercase text-light">{{ session('message') }}</span>
                            </div>
                        </div>
                    @endif
                    <form action="" method="post"
                        oninput='re_password.setCustomValidity(new_password.value != re_password.value ? "Mật khẩu không khớp!" : "")'>
                        @csrf
                        <div class="form-group">
                            <input type="password" class="form-control" name="old_password" id=""
                                placeholder="Mời nhập mật khẩu hiện tại" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="new_password"
                                placeholder="Mời nhập mật khẩu mới trên 8 ký tự" minlength="8" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="re_password" id=""
                                placeholder="Mời nhập lại mật khẩu mới" required>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary w-100" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

@endsection


@push('scripts')
@endpush
