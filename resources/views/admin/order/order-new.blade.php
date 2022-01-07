@extends('admin.layout.master')

@section('title', 'Tạo đơn hàng')
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
                                <h3 class="card-title">Đơn hàng mới</h3>
                            </div>
                            
                        </div>
                        <div class="collapse show" id="collapseExample">
                            <div class="row">
                                <div class="col-sm-12" style="overflow-x: auto;">
                                <form id="createNewOrder" class="needs-validation" method="post" action="{{ route('order.store') }}" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                                        <div class="form-group mb-3 w-100">
                                                <label for="fullname">Chọn khách hàng <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                    <select name="sel_user" class="form-control select2" data-placeholder="---Chọn Khách Hàng---" required>
                                                        <option value="">---Chọn Khách Hàng---</option>
                                                        @foreach($user as $value)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Họ và Tên <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="fullname" name="fullname" value="" required placeholder="Họ và tên">
                                                <div class="invalid-feedback">
                                                    Vui lòng nhập họ và tên.
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Số điện thoại <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="" required placeholder="Số điện thoại">
                                                <div class="invalid-feedback">
                                                    Vui lòng nhập số điện thoại.
                                                </div>
                                            </div>
                                            <div class="form-group mb-3 w-100">
                                                <label for="fullname">Email <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <input type="text" class="form-control" id="email" name="email" value="" required placeholder="Email">
                                                <div class="invalid-feedback">
                                                    Vui lòng nhập email.
                                                </div>
                                            </div>
                                            <!-- <div class="form-group mb-3 w-100">
                                                <label for="fullname">Ngày đặt <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                
                                                <input type="text" class="form-control" name="in_created_at" id="fdate" autocomplete="off" required>
                                                <div class="invalid-feedback">
                                                    Vui lòng chọn ngày đặt
                                                </div>
                                            </div> -->
                                            <div class="form-group w-100">
                                                <label for="fullname">Ghi chú <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <textarea name="note" id="note" style="width:100%" rows="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-8 col-md-8 mb-3 col-xs-12 col-sm-12">
                                            <div class="row">
                                                <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Tỉnh thành <abbr class="required"
                                                                title="bắt buộc">*</abbr></label>
                                                    <select name="sel_province" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                                                    <option value="">---Chọn Tỉnh Thành---</option>
                                                        @foreach($provinces as $key => $value)
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Quận huyện <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                    <select class="form-control select2" name="sel_district" data-placeholder="---Chọn quận huyên---" required>
                                                        <option value="">---Chọn Quận Huyện---</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="">Phường xã <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                    <select class="form-control select2" name="sel_ward" data-placeholder="---Chọn phường xã---" required>
                                                        <option value="">---Chọn Phường Xã---</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 col-sm-12 col-lg-6">
                                                    <label for="address">Địa chỉ <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                    <input type="text" class="form-control" id="address" name="address" value="" required placeholder="998/42/15 Quang Trung">
                                                    <small class="text-danger">( Địa chỉ không bao gồm phường xã, quận huyện, tỉnh thành.)</small>
                                                </div>
                                                <div class="form-group mb-3 col-sm-10 col-lg-10">
                                                    <label for="address">Chọn sản phẩm <abbr class="required"
                                                            title="bắt buộc">*</abbr></label>
                                                    <select name="sel_product[]" class="form-control select2" data-placeholder="---Chọn sản phẩm---" multiple required>
                                                        <option value="">---Chọn sản phẩm---</option>
                                                        @foreach($product as $value)
                                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3 col-sm-2 col-lg-2" style="align-items: flex-end;display: flex;">
                                                    <button class="btn btn-primary" type="button" id="choosProduct">Chọn</button>
                                                </div>
                                            </div>
                                            <table id="tableProduct" class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="product-name">Sản phẩm</th>
                                                        <th class="product-total">Tổng cộng</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                </tbody>
                                                <tfoot>
                                                    <tr class="cart-subtotal">
                                                        <th>Tạm tính</th>
                                                        <td>
                                                            <input type="hidden" name="in_subtotal" value="">
                                                            <span class="amount amount_tt">0 đ</span>
                                                        </td>
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
                                                        <td><strong><span class="amount amount_tc" data-total=0>0 ₫</span></strong> </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>   
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if(auth()->guard('admin')->user()->can('Cập nhật đơn hàng'))
                                            <button type="submit" class="btn btn-info btn-submit-unit">Tạo đơn hàng</button>
                                            @endif
                                            @if(auth()->guard('admin')->user()->can('Xóa đơn hàng'))
                                            <a href="#" class="btn btn-danger btn-submit-unit" onclick="javascript:history.back();">Quay lại</a>
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


