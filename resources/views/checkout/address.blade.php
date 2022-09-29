@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')

    <form action="{{ route('checkout.postOrder') }}" class="form-checkout" method="post" enctype="multipart/form">
        @csrf
        <div class="container">

            <div class="row">   
                <div class="col-xl-12 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="card-information">
                            <div class="card-information-header pt-4">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-xs-12 col-sm-12">   
                                        <h3 class="text-center">THÔNG TIN NHẬN HÀNG</h3>
                                    </div>
                                
                                </div>

                            </div>
                            <hr>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="col-md-12 col-12">
                                <label for="pickAdress1"><input type="radio" id="pickAdress1" name="pick_address"
                                        value="1" data-url="{{ route('checkout.getAddress') }}"> Thông tin nhận hàng
                                    giống
                                    thông tin đặt hàng</label>
                                <br>
                                <label for="pickAdress2"><input type="radio" id="pickAdress2" value="2"
                                        name="pick_address" data-url="{{ route('checkout.getAddress') }}" checked> Thông tin
                                    nhận hàng mới</label>

                            </div>
                            <div class="card-information-body">

                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Họ và tên<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="fullname"
                                            placeholder="Mời nhập họ và tên có dấu" required value="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cấp tỉnh<sup class="text-danger">*</sup></label>
                                        <select id="selectProvince" name="province_id" class="form-control" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cấp xã<sup class="text-danger">*</sup></label>
                                        <select id="selectWard" class="form-control " name="ward_id" required>
                                        </select>
                                    </div>
            
                                </div>
                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Số điện thoại<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="phone"
                                            placeholder="Mời nhập số điện thoại nhận hàng" value="{{ $user->phone }}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cấp huyện<sup class="text-danger">*</sup></label>
                                        <select id="selectDistrict" class="form-control" name="district_id" required>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ chi tiết<sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" class="form-control" value=""
                                            placeholder="Mời nhập địa chỉ" required>
                                    </div>


                                </div>

                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">
                                    <label for="">Ghi chú</label>
                                    <input type="text" name="note" class="form-control"
                                        placeholder="Mời nhập ghi chú đơn hàng">
                                </div>
                            </div>
                            <br />
                        </div>
                        <input type="hidden" name="in_store" id="in_store" value="0">
                        <div class="list-stores-checkout " id="method-ship" data-url="{{ route('checkout.calship') }}"
                            data-urlcmartship="{{ route('checkout.calCmartShip') }}">
                            <div class="list-stores-title text-center card-information-header pt-4" id="url-update-type"
                                data-url="{{ route('checkout.updateTypeShip') }}">
                                <h3>Danh sách cửa hàng</h3>
                            </div>
                            <hr>
                            <div class="list-stores-body" id="eUrl"
                                data-url_change_type_ship="{{ route('checkout.changeTypeTranspotStore') }}"
                                data-url_get_transpot="{{ route('checkout.getTranspot') }}">

                                @include('checkout.include.list_store_none_transpot', ['carts' => $carts])
                            </div>
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            <div class="phuongthuc-thanhtoan-card-header">
                                <h3 class="text-center">THÔNG TIN HÓA ĐƠN GTGT</h3>
                            </div>
                            <hr>
                            <div class="phuongthuc-thanhtoan-card-body">
                                <input type="hidden" id="show-vat" name="show_vat" value="1">
                                <div class="form-vat">
                                    <div class="form-group">
                                        <input type="email" name="vat_email" class="form-control" value=""
                                            placeholder="Mời nhập email nhận hóa đơn">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="vat_company" class="form-control" value=""
                                            placeholder="Mời nhập tên công ty">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" name="vat_mst" class="form-control" value=""
                                            placeholder="Mời nhập mã số thuế công ty">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="vat_address" class="form-control" value=""
                                            placeholder="Mời nhập địa chỉ công ty">
                                    </div>
                                    <div>
                                        <p class="mb-0">- Nếu Quý Khách Hàng không nhập thông tin thì C-Mart sẽ
                                            ghi nhận <b>“Người mua không
                                                lấy hóa đơn”</b>, và không gửi hóa đơn GTGT đến Quý Khách Hàng.</p>
                                        <p class="mb-0">- C-Mart xin phép từ chối hỗ trợ xử lý các thao tác về hóa
                                            đơn sau khi đặt hàng.
                                        </p>
                                    </div>
                                    <br />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex justify-between-center">
                <a class="btn-back-cart" href="{{ route('cart.index') }}">Quay lại Giỏ hàng</a>
                <button id="btn-to-payment" class="btn-dathang" type="submit">Tiếp tục Thanh toán</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/admin/address.js') }}"></script>
    <script src="{{ asset('public/js/checkout.js') }}"></script>

    <script>

    </script>
@endpush
