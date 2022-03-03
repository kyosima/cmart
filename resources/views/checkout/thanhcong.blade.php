@extends('layout.master')

@section('title', 'Đặt hàng thành công')

@push('css')
@endpush

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 col-12">
                <h3 class="text-center">THÔNG BÁO XÁC NHẬN ĐẶT HÀNG THÀNH CÔNG</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12">
                @include('order_tracking.c_bill', ['order'=>$order])
            </div>
        </div>
        {{-- <div class="row">
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                <div class="alert alert-light order-complete-info  text-dark">
                    <h5>Mã giao dịch: <span class="text-danger">{{ $order->order_code }}</span></h5>
                    <b>Thông tin khách hàng</b>
                    <ul>
                        <li>Họ và tên: {{ $order_info->fullname }}</li>
                        <li>Số điện thoại: {{ $order_info->phone }}</li>
                        <li>Ghi chú: {{ $order_info->note }}</li>
                    </ul>
                    <hr>
                    <b>Thông tin giao hàng</b>
                    <ul>
                        <li>Tỉnh/thành phố: {{ $address->province()->value('tentinhthanh') }}</li>
                        <li>Quận/huyện: {{ $address->district()->value('tenquanhuyen') }}</li>
                        <li>Phường xã: {{ $address->ward()->value('tenphuongxa') }}</li>
                        <li>Địa chỉ: {{ $address->address }}</li>
                    </ul>
                    <hr>
                    <p><b>Thông tin thanh toán</b></p>
                    @if ($order->payment_method == 1)
                        <p>Phương thức TT: Thanh toán khi nhận hàng(COD)</p>
                    @elseif ($order->payment_method == 2)
                        <p>Phương thức TT: Thanh toán online</p>
                        @if($order->status == 0)
                            <p>Trạng thái thanh toán: Chưa thanh toán</p>
                            <a href="{{URL::to(optional($order->order_payme)->link_payment)}}" class="btn btn-primary">Thanh toán ngay</a>
                        @else
                            <p>Trạng thái thanh toán: Đã thanh thoán</p>
                        @endif
                    @endif
                    <hr>
                    <b>Thông tin đơn hàng tổng</b>
                    <ul>
                        <li>Thuế GTGT: {{ formatPrice($order->tax) }}</li>
                        <li>Phí vận chuyển: {{ formatPrice($order->shipping_total) }}</li>
                        <li>Giá trị giao dịch: {{ $order->total }}</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12">
                @foreach ($order_stores as $order_store)
                    <div class="alert alert-light order-complete-info  text-dark">
                        <b>Thông tin đơn hàng - {{ $order_store->store()->value('name') }}</b>
                        <table class="table table-bordered">
                            <thead>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Tổng phụ</th>
                            </thead>
                            <tbody>
                                @foreach ($order_store->order_products()->get() as $product)
                                    @php
                                        $item = $product->product()->first();
                                    @endphp
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ formatPrice($product->price) }}</td>
                                        <td>{{ formatPrice($product->price * $product->quantity) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="info_order_success">
                            <div class="row text-center">
                                <div class="col-4">
                                    <p>Hình thức vận chuyển</p>
                                    <span class="text-danger">{{ formatMethod($order_store->shipping_method) }}</span>
                                </div>
                                <div class="col-4">
                                    <p>Phương thức vận chuyển</p>
                                    <span class="text-danger">{{ formatType($order_store->shipping_type) }}</span>
                                </div>
                                <div class="col-4">
                                    <p>Phí vận chuyển</p>
                                    <span class="text-danger">{{ formatPrice($order_store->shipping_total) }}</span>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-3">
                                    <p>Điểm dịch vụ (M)</p>
                                    <span class="text-danger">{{ number_format($order_store->m_point, 0, '.', ',') }} điểm</span>
                                </div>
                                <div class="col-3">
                                    <p>Tiền tích lũy (C)</p>
                                    <span class="text-danger">{{ number_format($order_store->c_point, 0, '.', ',') }} điểm</span>
                                </div>
                                <div class="col-3">
                                    <p>Thuế GTGT</p>
                                    <span class="text-danger">{{ formatPrice($order_store->tax) }}</span>
                                </div>
                                <div class="col-3">
                                    <p>Giá trị giao dịch</p>
                                    <span class="text-danger">{{ formatPrice($order_store->total) }}</span></li></span>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
    </div>
@endsection

@push('scripts')
@endpush
