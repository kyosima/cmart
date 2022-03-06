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
                                      
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group w-100">
                                                <label for="fullname">Ghi chú <abbr class="required"
                                                        title="bắt buộc">*</abbr></label>
                                                <textarea name="note" id="note" style="width:100%" rows="5">{{$order->order_info->note}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if(auth()->guard('admin')->user()->can('Cập nhật đơn hàng'))
                                                    <button type="submit" class="btn btn-info btn-submit-unit">Cập nhật</button>
                                             
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


