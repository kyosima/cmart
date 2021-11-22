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
                                <h3 class="card-title">Đơn hàng #{{$order->id}}</h3>
                            </div>
                            
                        </div>
                        <div class="collapse show" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                <form id="form-order-detail" class="form" method="post" action="{{route('order.update', ['order' => $order->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="in_id_order" value="{{$order->id}}">
                                    <p>Thông tin người đặt</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Họ và Tên <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="{{$order->order_info->fullname}}" required>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Số điện thoại <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{$order->order_info->phone}}" required>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Email <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{$order->order_info->email}}" required>
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
                                                    <select name="sel_province" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                                                        <option value="{{$order->order_address->province->matinhthanh}}">{{$order->order_address->province->tentinhthanh}}</option>
                                                        @foreach($provinces as $value)
                                                            <option value="{{$value->matinhthanh}}">{{$value->tentinhthanh}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Quận huyện <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                        <select class="form-control select2" name="sel_district" data-placeholder="---Chọn quận huyên---" required>
                                                            <option value="{{$order->order_address->district->maquanhuyen}}">{{$order->order_address->district->tenquanhuyen}}</option>
                                                            @foreach($districts as $value)
                                                                <option value="{{$value->maquanhuyen}}">{{$value->tenquanhuyen}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Phường xã <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                        <select class="form-control select2" name="sel_ward" data-placeholder="---Chọn phường xã---" required>
                                                            <option value="{{$order->order_address->ward->maphuongxa}}">{{$order->order_address->ward->tenphuongxa}}</option>
                                                            @foreach($wards as $value)
                                                                <option value="{{$value->maphuongxa}}">{{$value->tenphuongxa}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group w-100 mb-3">
                                                    <label for="address">Địa chỉ <abbr class="required"
                                                            title="bắt buộc">*</abbr><small class="text-danger">( Địa chỉ không bao gồm phường xã, quận huyện, tỉnh thành.)</small></label>
                                                    <input type="text" class="form-control" id="address" name="address" value="{{$order->order_address->address}}" required>
                                                    
                                                </div>
                                                <div class="form-group mb-3 w-100">
                                                <label for="fullname">Ngày đặt <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                 
                                                <input type="text" class="form-control" name="in_created_at" id="fdate" value="{{date('Y-m-d H:i:s', strtotime($order->created_at))}}" required>
                                            </div>
                                        </div>
                                    </div>     
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group w-100">
                                                <label for="fullname">Ghi chú <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <textarea name="note" id="note" style="width:100%" rows="5">{{$order->order_info->note}}</textarea>
                                            </div>
                                        </div>
                                    </div>
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
                                                                <td class="product-name" data-title="Sản phẩm">
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
                                                        <tr class="checkout-shipping-label-curent">
                                                            <th>Phí ship hiện tại</th>
                                                            <td>Giao hàng miễn phí</td>
                                                        </tr>
                                                        <tr class="checkout-shipping-label-curent">
                                                            <th>Phương thức hiện tại</th>
                                                            <td>COD</td>
                                                        </tr>
                                                        <tr class="order-total">
                                                            <th>Tổng cộng</th>
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
                                            @endif
                                            @if(auth()->guard('admin')->user()->can('Xóa đơn hàng'))
                                            <a href="{{route('order.delete', ['order' => $order->id])}}" class="btn btn-danger btn-submit-unit" onclick="return confirm('Are you sure you want to delete this order?')">Xóa</a>
                                            @endif
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


