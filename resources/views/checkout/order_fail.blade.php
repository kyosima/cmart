@extends('layout.master')

@section('title', 'Đặt hàng không thành công')

@push('css')
@endpush

@section('content')
    <div class="loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h3 class="text-center">THÔNG BÁO XÁC ĐẶT HÀNH KHÔNG THÀNH CÔNG</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                <div class="text-center">
                    <a href="{{ route('home') }}" class="btn btn-primary">Trở về trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/share_cbill.js') }}"></script>
@endpush
