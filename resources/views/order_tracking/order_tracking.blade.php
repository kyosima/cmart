@extends('layout.master')

@section('title', 'Theo dõi đơn hàng')

@push('css')
    <link href="{{ asset('public/css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-8 order-md-2">
                <div class="checkorder">
                    <h3 class="title">THÔNG TIN ĐƠN HÀNG</h3>
                    @if(isset($error))
                        <div class="alert alert-warning text-center">
                            <b class="text-danger">{{$error}}</b>
                        </div>
                    @endif
                    <form action="" method="get">
                        <div class="write-order form-group">
                            <input value="" type="text" name="order_code" class="form-control ipt-order"
                                placeholder="Nhập mã giao dịch">
                            <button type="submit" class="btn-check">Tra cứu</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col col-12 col-md-4 order-md-1">
                <div class="check-order">
                    @include('policy.sidebar')

                </div>
            </div>

            
        </div>

    </div>
@endsection
