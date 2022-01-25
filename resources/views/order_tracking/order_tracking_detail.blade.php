@extends('layout.master')

@section('title', 'Tra cứu đơn hàng')

@push('css')
    <link href="{{ asset('public/css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-12 col-lg-9 order-lg-2">
                <div class="checkorder ">
                    <h3 class="title">THÔNG TIN ĐƠN HÀNG</h3>
                    <form action="{{ route('theo-doi-don-hang.index') }}" method="get">
                        @if (isset($error))
                            <div class="alert alert-warning text-center">
                                <b class="text-danger">{{ $error }}</b>
                            </div>
                        @endif
                        <div class="write-order form-group">
                            <input type="text" name="order_code" value="{{ $order->order_code }}"
                                class="form-control ipt-order" placeholder="Nhập mã giao dịch">
                            <button type="submit" class="btn-check">Tra cứu</button>
                        </div>
                    </form>
                    @if (isset($order))
                        <div class="box-order">
                            <div class="top-order">
                                <p><span>Mã giao dịch:</span> {{ $order->order_code }}</p>
                                <p><span>Thời gian đặt hàng:</span> <span class="action-order">
                                        <b
                                            style="color:#15b02a">{{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}</b>
                                    </span></p>
                            </div>

                            {{-- <div class="middle-order">
                                <ol class="progress">
                                    <li class=" ">
                                        <p>
                                            Đã đặt hàng
                                        </p>
                                    </li>
                                    <li
                                        class="pause-complete @if ($order->status >= 1)success @endif
                                    ">
                                        <p>
                                            Đã xác nhận thanh toán
                                        </p>
                                    </li>
                                    <li
                                        class="pause-complete @if ($order->status >= 2)success @endif
                                    ">
                                        <p>
                                            Đang xử lý 
                                        </p>
                                    </li>
                                    <li
                                        class="pause-complete @if ($order->status >= 3)success @endif
                                    ">
                                        <p>
                                            Đang vận chuyển<span></span>
                                        </p>
                                    </li>
                                    <li
                                        class="pause-complete @if ($order->status >= 4)success @endif
                                    ">
                                        <p>
                                            Hoàn thành
                                        </p>
                                    </li>
                                </ol>
                            </div> --}}
                            <div class="progress-order">
                                <div style="overflow-x:auto;">
                                    <table class="table table-striped ">
                                        <thead class="text-center">
                                            <th class="text-uppercase">Đã<br/>đặt hàng</th>
                                            <th class="text-uppercase">Đã xác nhận<br/>thanh toán</th>
                                            <th class="text-uppercase">Đang<br/>xử lý</th>
                                            <th class="text-uppercase">Đang<br/>vận chuyển</th>
                                            <th class="text-uppercase">Hoàn thành</th>
                                            <th class="text-uppercase">Đã hủy</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <li class="check success">

                                                    </li>
                                                </td>
                                                <td>
                                                    @if ($order->status >= 1)
                                                        <li class="check success">

                                                        </li>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status >= 2)
                                                        <li class="check success">

                                                        </li>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status >= 3)
                                                        <li class="check success">

                                                        </li>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->status >= 4)
                                                        <li class="check success">

                                                        </li>
                                                    @endif
                                                </td>
                                                 <td>
                                                    @if ($order->status >= 5)
                                                        <li class="check success">

                                                        </li>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <div class="box-infocart list-order">

                                <h3 class="title">Thông tin khách hàng:</h3>
                                <ul>
                                    <li>Họ và tên: {{ $order_info->fullname }}</li>
                                    <li>Số điện thoại: {{ $order_info->phone }}</li>
                                    {{-- <li>Email: {{ $order_info->email }}</li> --}}
                                    <li>Ghi chú: {{ $order_info->note }}</li>
                                </ul>
                                <hr>
                                <h3 class="title">Thông tin giao hàng:</h3>
                                <ul>
                                    <li>Tỉnh/thành phố: {{ $order_address->province()->value('tentinhthanh') }}</li>
                                    <li>Quận/huyện: {{ $order_address->district()->value('tenquanhuyen') }}</li>
                                    <li>Phường xã: {{ $order_address->ward()->value('tenphuongxa') }}</li>
                                    <li>Ghi chú: {{ $order_address->address }}</li>
                                    {{-- <li>Phương thức vận chuyển: {{ $order->shipping_method }}</li> --}}
                                </ul>
                                {{-- <hr> --}}
                                {{-- <h3 class="title">Thông tin thanh toán:</h3>
                                @if ($order->payment_method == 1)
                                    <p>Thanh toán khi nhận hàng(COD)</p>
                                @endif --}}
                            </div>
                            <div class="box-infocart list-order">
                                <h3 class="title">Thông tin đơn hàng:</h3>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th style="width: 373px; border">Tên sản phẩm</th>
                                            <th style="width: 84px;">Số lượng</th>
                                            <th style="width: 143px;">Thành tiền</th>
                                        </tr>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td><a
                                                        href="{{ route('san-pham.show', $product->product()->value('slug')) }}">{{ $product->product()->value('slug') }}</a>
                                                </td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ formatPrice($product->price * $product->quantity) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="box-allprice box-price-order">
                                    <p>Tạm tính:<span> {{ formatPrice($order->sub_total) }}</span></p>
                                    <p>Thuế VAT:<span> {{ formatPrice($order->tax) }}</span></p>
                                    {{--<p>Phí xử lý:<span> {{ formatPrice($order->process_fee) }}</span></p>
                                    <!--<p>Điểm M quy đổi:<span> {{ formatPrice($order->m_point * 100) }}</span></p>-->
                                    <!--<p>Điểm C tích lũy:<span> {{ $order->c_point }}</span></p>--> --}}
                                    <p>Phí vận chuyển:<span> + {{ formatPrice($order->shipping_total) }}</span></p>
                                    <p class="last-price">Tổng cộng: <span>{{ formatPrice($order->total) }}</span>
                                    </p>
                                </div>
                            </div>


                        </div>
                    @endif
                </div>
            </div>
            <div class="col col-12 col-lg-3 order-lg-1">
                <div class="check-order">
                    @include('policy.sidebar')
                </div>
            </div>

        </div>
        <!-- Detail DVVC -->


    </div>
@endsection
