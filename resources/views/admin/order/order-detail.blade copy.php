@extends('admin.layout.master')

@section('title', 'Đơn hàng')
@push('css')
    <link rel="stylesheet" href="{{ asset('css/admin/doitac.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/admin/select2.css') }}" type="text/css">
@endpush
@section('content')
<x-alert />
<div class="team m-3">
    <div class="team_container py-3 px-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card content-checkout content-order">
                    <div class="card-body">	
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="card-title">Đơn hàng #{{$order->order_code}}</h3>
                            </div>
                            
                        </div>
             
                        <div class="collapse show" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                <form id="form-order-detail" class="form" method="post" action="{{route('order.update', ['order' => $order->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="in_id_order" value="{{$order->id}}">
                                    {{-- <p>Thông tin người đặt</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Họ và Tên <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$order->order_info->fullname}}" required readonly>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Số điện thoại <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{$order->order_info->phone}}" required readonly>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{$order->order_info->email}}" readonly>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Trạng thái <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <select class="form-control select2" name="sel_status">
                                                    {!! orderStatusOtion($order->status) !!}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 mb-3 col-xs-12 col-sm-12">
                                            <div class="form-group mb-3 w-100">
                                                <label for="">Tỉnh thành <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                    <select name="sel_province" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required >
                                                        <option value="{{$order_province->PROVINCE_ID}}">{{$order_province->PROVINCE_NAME}}</option>
                                                        {{-- @foreach($provinces as $value)
                                                            <option value="{{$value->matinhthanh}}">{{$value->tentinhthanh}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Quận huyện <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                        <select class="form-control select2" name="sel_district" data-placeholder="---Chọn quận huyên---" required  >
                                                            <option value="{{$order_district->DISTRICT_ID}}">{{$order_district->DISTRICT_NAME}}</option>
                                                            {{-- @foreach($districts as $value)
                                                                <option value="{{$value->maquanhuyen}}">{{$value->tenquanhuyen}}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Phường xã <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                        <select class="form-control select2" name="sel_ward" data-placeholder="---Chọn phường xã---" required >
                                                            <option value="{{$order_ward->WARDS_ID}}">{{$order_ward->WARDS_NAME}}</option>
                                                            {{-- @foreach($wards as $value)
                                                                <option value="{{$value->maphuongxa}}">{{$value->tenphuongxa}}</option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group w-100 mb-3">
                                                    <label for="address">Địa chỉ <abbr class="required"
                                                            title="bắt buộc">*</abbr><small class="text-danger">( Địa chỉ không bao gồm phường xã, quận huyện, tỉnh thành.)</small></label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{$order_address->address}}" required readonly>
                                                    
                                                </div>
                                                <div class="form-group mb-3 w-100">
                                                <label for="fullname">Ngày đặt <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                 
                                                <input type="text" class="form-control" name="in_created_at" id="fdate" value="{{date('Y-m-d H:i:s', strtotime($order->created_at))}}" required readonly>
                                            </div>
                                        </div>
                                    </div>      --}}
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group w-100">
                                                <label for="fullname">Ghi chú <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <textarea name="note" id="note" style="width:100%" rows="5">{{$order->order_info->note}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @if($order->order_vat)
                                    <hr>
                                    <p>Thông tin thuế</p>
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <th class="title">Tên công ty</th>
                                            <th class="title">Email</th>
                                            <th class="title">MST</th>
                                            <th class="title">Địa chỉ</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $order->order_vat->vat_company }}</td>
                                                <td>{{ $order->order_vat->vat_email }}</td>
                                                <td>{{ $order->order_vat->vat_mst }}</td>
                                                <td>{{ $order->order_vat->vat_address }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @endif
                                    <hr>
                                    <p>Đơn hàng con</p>
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr>
                                                <th class="title">Mã giao dịch con</th>
                                                <th class="title">GTTT sản phẩm</th>
                                                <th class="title">ĐVVC</th>
                                                <th class="title">Phí DVVC</th>
                                                <th class="title">Tổng GTGD</th>
                                                <!-- <th class="title" style="width:75px;">Thao tác</th> -->
                                            </tr>
                                        </thead>
                                        <tbody style="color: #748092; font-size: 14px;">
                                            @foreach ( $order->order_stores as $value)
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{number_format($value->sub_total)}} đ</td>
                                                <td>{{ shippingMethodName($value->shipping_method) }}</td>
                                                <td>{{ number_format($value->shipping_total) }} đ</td>
                                                <td>{{number_format($value->total)}} đ</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <hr>
                                    <p>Thông tin sản phẩm</p>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="order-detail-table-product">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="product-name">Sản phẩm</th>
                                                            <th class="product-total">Tổng cộng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ( $order->products as $item)      
                                                            <tr class="cart_item">
                                                                <td class="product-name" data-title="Sản phẩm" style="width:70%">
                                                                    <a href="{{url('san-pham/'.$item->slug)}}">{{$item->name}}</a>
                                                                    <strong class="product-quantity">× {{$item->pivot->quantity}}</strong>
                                                                </td>

                                                                <td class="product-total" data-title="Tổng cộng">
                                                                    <span class="amount">{{number_format($item->pivot->price *$item->pivot->quantity)}} đ</span>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr class="cart-subtotal">
                                                            <th>Tạm tính</th>
                                                            <td><span class="amount">{{number_format($order->sub_total)}} đ</span></td>
                                                        </tr>
                                                        <tr class="cart-subtotal">
                                                            <th>Thuế VAT</th>
                                                            <td><span class="amount">{{number_format($order->tax)}} đ</span></td>
                                                        </tr>
                                                        <tr class="cart-subtotal">
                                                            <th>Phí DVVC</th>
                                                            <td><span class="amount">{{number_format($order->shipping_total)}} đ</span></td>
                                                        </tr>
                                                        <!-- <tr class="checkout-shipping-label-curent">
                                                            <th>Phí ship hiện tại</th>
                                                            <td>Giao hàng miễn phí</td>
                                                        </tr> -->
                                                        <tr class="checkout-shipping-label-curent">
                                                            <th>Phương thức TT</th>
                                                            <td>
                                                                @if($order->payment_method == 1)
                                                                    COD
                                                                @elseif($order->payment_method == 2)
                                                                    TT Online ({!! $order->status == 0 ? '<a href="'.optional($order->order_payme)->link_payment.'" target="_blank">Chưa thanh toán</a>' : 'Đã thanh toán' !!})
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Tổng GTGD</th>
                                                            <td><strong><span class="amount" data-total={{number_format($order->total)}}>{{number_format($order->total + $order->shipping_total)}} ₫</span></strong> </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if(auth()->guard('admin')->user()->can('Cập nhật đơn hàng'))
                                                    <button type="submit" class="btn btn-info btn-submit-unit">Cập nhật</button>
                                                @if($order->payment_method == 2 && $order->status != 6 && $order->status != 0)
                                                    <button type="button" class="btn btn-warning btn-submit-refund">Hoàn tiền</button>
                                                @endif
                                            @endif
                                            {{-- @if(auth()->guard('admin')->user()->can('Xóa đơn hàng'))
                                            <a href="{{route('order.delete', ['order' => $order->id])}}" class="btn btn-danger btn-submit-unit" onclick="return confirm('Are you sure you want to delete this order?')">Xóa</a>
                                            @endif --}}
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form id="formRefund" action="{{ route('admin.order.refund') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{$order->id}}">
</form>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('js/admin/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/order.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/ajax-form.js') }}"></script>
    <script>
        $(document).ready(function(){
            $("#fdate" ).datetimepicker({
                format:'Y-m-d H:i:s',
                formatTime:'H:i:s',
                formatDate:'Y-m-d'
            });
        });
    </script>
@endpush


