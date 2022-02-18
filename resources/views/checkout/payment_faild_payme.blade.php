@extends('layout.master')

@section('title', 'Thanh toán thất bại')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Thanh toán thất bại</h3>
                </div>
                <div class="card-body text-center">
                    <p class="text-danger">Có lỗi xảy ra trong quá trình thanh toán. 
                        @if(session()->has('order_code'))
                        Vui lòng <a href="{{ route('checkout.orderSuccess', session()->get('order_code')) }}" class="text-primary">kiểm tra đơn hàng</a> để lấy lại đường dẫn thanh toán.
                        @endif
                    </p>
                    <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection