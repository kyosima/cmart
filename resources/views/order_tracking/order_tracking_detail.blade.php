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
                                            <th class="text-uppercase">Đã<br />đặt hàng</th>
                                            <th class="text-uppercase">Đã xác nhận<br />thanh toán</th>
                                            <th class="text-uppercase">Đang<br />xử lý</th>
                                            <th class="text-uppercase">Đang<br />vận chuyển</th>
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
                            <div class="box-infocart list-order list-store">
                                @foreach ($order_stores as $order_store)
                                    <h3 class="title">Thông tin đơn hàng -
                                        {{ $order_store->store()->value('name') }}:
                                    </h3>
                                    <table class="table table-bordered table-striped">
                                        <tbody>
                                            <tr>
                                                <th style=" border">Tên sản phẩm</th>
                                                <th style="">Số lượng</th>
                                                <th style="">Trọng lượng</th>
                                                <th style="">Thành tiền</th>
                                            </tr>
                                            @foreach ($order_store->order_products()->get() as $row)
                                                <tr>
                                                    <td><a
                                                            href="{{ route('san-pham.show', $row->slug) }}">{{ $row->name }}</a>
                                                    </td>
                                                    <td>{{ $row->quantity }}</td>
                                                    <td>{{ App\Http\Controllers\CheckoutController::getWeight($row->product()->first(), $row->qty) }}
                                                        g</td>
                                                    <td>{{ formatPrice($row->price * $row->quantity) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="row text-center">
                                        <div class="col-3">
                                            @php
                                                $store = $order_store->store()->first();
                                                $address1 = $store->address . ' ' . $store->ward()->value('tenphuongxa') . ' ' . $store->district()->value('tenquanhuyen') . ' ' . $store->province()->value('tentinhthanh');
                                                $address2 = $order_address->address . ' ' . $order_address->ward()->value('tenphuongxa') . ' ' . $order_address->district()->value('tenquanhuyen') . ' ' . $order_address->province()->value('tentinhthanh');
                                            @endphp
                                            <p>Khoảng cách</p>
                                            <span class="text-danger">{{ App\Http\Controllers\CheckoutController::getDistance($address1, $address2) }} km</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Hình thức vận chuyển</p>
                                            <span
                                                class="text-danger">{{ formatMethod($order_store->shipping_method) }}</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Phương thức vận chuyển</p>
                                            <span
                                                class="text-danger">{{ formatType($order_store->shipping_type) }}</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Phí vận chuyển</p>
                                            <span
                                                class="text-danger">{{ formatPrice($order_store->shipping_total) }}</span>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col-3">
                                            <p>Điểm dịch vụ (M)</p>
                                            <span
                                                class="text-danger">{{ number_format($order_store->m_point, 0, '.', ',') }}
                                                điểm</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Tiền tích lũy (C)</p>
                                            <span
                                                class="text-danger">{{ number_format($order_store->c_point, 0, '.', ',') }}
                                                điểm</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Thuế GTGT</p>
                                            <span class="text-danger">{{ formatPrice($order_store->tax) }}</span>
                                        </div>
                                        <div class="col-3">
                                            <p>Giá trị giao dịch</p>
                                            <span class="text-danger">{{ formatPrice($order_store->total) }}</span>
                                            </li></span>
                                        </div>
                                    </div>

                                @endforeach
                                <hr>
                                <div class="box-allprice box-price-order">
                                    <p>Tạm tính:<span> {{ formatPrice($order->sub_total) }}</span></p>
                                    <p>Thuế GTGT:<span> {{ formatPrice($order->tax) }}</span></p>
                                    <p>Điểm dịch vụ (M):<span> {{ number_format($order->m_point, 0, '.', ',') }}
                                            điểm</span></p>
                                    <p>Tiền tích lũy (C):<span> {{ number_format($order->c_point, 0, '.', ',') }}
                                            điểm</span></p>
                                    <p>Phí vận chuyển:<span> {{ formatPrice($order->shipping_total) }}</span></p>
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
