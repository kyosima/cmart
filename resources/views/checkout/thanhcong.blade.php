@extends('layout.master')

@section('title', 'Đặt hàng thành công')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
@endpush

@section('content')
    <div class="container">
        <h3 class="text-center">Đặt hàng thành công</h3>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="alert alert-light order-complete-info  text-dark">
                    <b>Thông tin khách hàng</b>
                    <ul>
                        <li>Họ và tên: {{ $order_info->fullname }}</li>
                        <li>Số điện thoại: {{ $order_info->phone }}</li>
                        <li>Email: {{ $order_info->email }}</li>
                        <li>Ghi chú: {{ $order_info->note }}</li>
                    </ul>
                    <hr>
                    <b>Thông tin giao hàng</b>
                    <ul>
                        <li>Tỉnh/thành phố: {{ $address->province()->value('tentinhthanh') }}</li>
                        <li>Quận/huyện: {{ $address->district()->value('tenquanhuyen') }}</li>
                        <li>Phường xã: {{ $address->ward()->value('tenphuongxa') }}</li>
                        <li>Ghi chú: {{ $address->address }}</li>
                    </ul>
                    <hr>
                    <b>Thông tin thanh toán</b>
                    @if ($order->payment_method == 1)
                        <p>Thanh toán khi nhận hàng(COD)</p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                <div class="alert alert-light order-complete-info  text-dark">
                    <b>Thông tin đơn hàng</b>
                    <table class="table table-bordered">
                        <thead>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tổng phụ</th>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)

                                @php
                                    $item = $product->product()->first();
                                @endphp
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ formatPrice($product->prices) }}</td>
                                    <td>{{ formatPrice($product->price * $product->quantity) }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Tổng:</td>
                                <td> {{ formatPrice($order->total) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
