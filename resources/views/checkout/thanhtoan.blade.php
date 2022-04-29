@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <div class="loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <form action="{{ route('checkout.post') }}" class="form-checkout" method="post" enctype="multipart/form">
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
                                    {{-- <div class="col-xl-6 col-md-6 col-xs-12 col-sm-12">
                                        <select id="pickAdress" class="form-control"
                                            data-url="{{ route('checkout.getAddress') }}">
                                            <option value="">Chọn địa chỉ đã lưu</option>
                                            @foreach ($store_address as $adr)
                                                <option value="{{ $adr->id }}">{{ $adr->fullname }}</option>
                                            @endforeach
                                        </select> 
                                        
                                    </div> --}}
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
                                <label for="pickAdress1"><input type="radio" id="pickAdress1" name="pick_address" value="1"
                                        data-url="{{ route('checkout.getAddress') }}"> Thông tin nhận hàng giống
                                    thông tin đặt hàng</label>
                                    <br>
                                <label for="pickAdress2"><input type="radio" id="pickAdress2" value="2" name="pick_address"
                                        data-url="{{ route('checkout.getAddress') }}" checked> Thông tin nhận hàng mới</label>

                            </div>
                            <div class="card-information-body">

                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Họ và tên<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="fullname"
                                            placeholder="Mời nhập họ và tên có dấu" required value="{{ $user->hoten }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cấp tỉnh<sup class="text-danger">*</sup></label>
                                        <select name="sel_province" class="form-control select2"
                                            data-placeholder="---Chọn tỉnh thành---" required>
                                            {{-- <option value="">---Chọn tỉnh thành---</option>
                                            @foreach ($province as $value)
                                                <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cấp xã<sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="sel_ward"
                                            data-placeholder="---Chọn phường xã---" required>

                                            <option value="">Cấp xã</option>
                                        </select>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="">Email<sup class="text-danger">*</sup></label>
                                        <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                            value="{{ $user->email }}">
                                    </div> --}}
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
                                        <select class="form-control select2" name="sel_district"
                                            data-placeholder="---Chọn quận huyên---" required>

                                            <option value="">Cấp huyện</option>
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
                            {{-- <div class="col-xl-12">
                                <div class="form-group">

                                    <label onclick="storeaddress()"><input type="checkbox" id="store-address"
                                            name="store_address" value="1"> Lưu lại thông
                                        tin người nhận</label>


                                </div>

                            </div> --}}
                            <br />
                        </div>
                        <input type="hidden" name="in_store" id="in_store" value="0">
                        <div class="list-stores-checkout" id="method-ship"
                        data-url="{{ route('checkout.calship') }}"
                        data-urlcmartship="{{ route('checkout.calCmartShip') }}">
                            <div class="list-stores-title text-center" id="url-update-type"
                                data-url="{{ route('checkout.updateTypeShip') }}">
                                <h3>Danh sách cửa hàng</h3>
                            </div>
                            <hr>
                            <div class="list-stores-body">
                                @foreach (explode(',', $store_ids) as $store_id)
                                    @php
                                        $cart = Cart::instance($store_id);
                                        $store = App\Models\Store::whereId($store_id)->first();
                                    @endphp
                                    <div class="store-block" id="store{{ $store_id }}">
                                        <div class="store-title d-flex justify-content-between">
                                            <h4>{{ $store->name }}</h4>

                                            <label for="receiverstore{{ $store_id }}"><input class="receiverstore"
                                                    type="checkbox" id="receiverstore{{ $store_id }}"
                                                    name="receiverstore{{ $store_id }}" value="{{ $store_id }}"
                                                    data-storeid="{{ $store_id }}" onclick="receiverStore(this)"> Nhận
                                                tại cửa
                                                hàng</label>
                                        </div>
                                        {{-- <div class="store-body">
                                            @foreach ($cart->content() as $row)
                                                <div id="{{ $row->rowId }}" class="store-product row">
                                                    <div class="product-image col-1 p-2">
                                                        <img src="{{ asset($row->model->feature_img) }}">
                                                    </div>
                                                    <div class="product-info col-11 pt-2 pb-2">
                                                        <div class="product-name">
                                                            <p>{{ $row->name }}</p>
                                                        </div>
                                                        <div class="product-cart d-flex justify-content-between">
                                                            <div class="quantity">SL: {{ $row->qty }}</div>
                                                            <div class="price">Tổng tiền:
                                                                {{ formatPrice($row->price * $row->qty) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div> --}}
                                        <div class="store-footer d-none justify-content-between ">
                                            <div>Đơn vị vận chuyển: <span class="name-method"></span></div>
                                            <div><span class="ship-normal"> </span><span class="ship-fast "></span>
                                            </div>
                                            <div class="d-none">Tổng tiền: <span class="total-cost"></span>
                                            </div>
                                            <input type="hidden" class="ship-fee">

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            <div class="phuongthuc-thanhtoan-card-header">
                                <h3 class="text-center">THÔNG TIN HÓA ĐƠN GTGT</h3>
                            </div>
                            <hr>
                            <div class="phuongthuc-thanhtoan-card-body">

                                <!--<div class="form-group">-->
                                <!--    <label onclick="showvat()"><input type="checkbox" id="show-vat" name="show_vat"-->
                                <!--            value="1"> Xác nhận xuất hóa GTGT</label>-->
                                <!--</div>-->
                                <input type="hidden" id="show-vat" name="show_vat" value="1">
                                <div class="form-vat">
                                    <div class="form-group">
                                        <!--<label for="">Tên người mua<sup class="text-danger">*</sup></label>-->
                                        <input type="email" name="vat_email" class="form-control" value=""
                                            placeholder="Mời nhập email nhận hóa đơn">
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="">Tên công ty<sup class="text-danger">*</sup></label>-->
                                        <input type="text" name="vat_company" class="form-control" value=""
                                            placeholder="Mời nhập tên công ty">
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="">Mã số thuế<sup class="text-danger">*</sup></label>-->
                                        <input type="number" name="vat_mst" class="form-control" value=""
                                            placeholder="Mời nhập mã số thuế công ty">
                                    </div>
                                    <div class="form-group">
                                        <!--<label for="">Địa chỉ chi tiết<sup class="text-danger">*</sup></label>-->
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
                <div class="col-xl-4 col-sm-12 col-12 d-none">
                    <div class="card-left">
                        <div class="makhuyenmai">
                            <div class="makhuyenmai-header">
                                <h3>Mã khuyến mãi</h3>
                            </div>
                            <div class="makhuyenmai-body">
                                <input type="text" class="makhuyenmai-body-input" placeholder="Nhập mã...">
                                <button class="btn btn-primary" type="button">Áp dụng</button>
                            </div>
                        </div>
                        <div class="donhang">
                            <div class="donhang-header">
                                <h3>ĐƠN HÀNG</h3> <span>({{ $count_cart }} SẢN PHẨM)</span>
                            </div>
                            <div class="donhang-body">

                            </div>
                            <div class="donhang-footer">
                                <div class="card-right">
                                    {{-- <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ $cart_subtotal }} đ</span> </p>
                                        <hr>
                                        <p><b>Phí dịch vụ:</b></p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế:</span> <span
                                                class="tamtinh-price">{{ formatPrice($tax) }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Điểm M quy đổi:</span> <span-->
                                        <!--        class="tamtinh-price">{{ formatPrice($m_point * 100) }} </span> </p>-->
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Điểm C tích lũy:</span>-->
                                        <!--    <span class="tamtinh-price">{{ $c_point }} </span> </p>-->
                                        <!--<p class="tamtinh"> <span class="tamtinh-title">Tổng phí dịch vụ:</span>-->
                                        <!--    <span-->
                                        <!--        class="tamtinh-price">{{ formatPrice($tax + $process_fee - $m_point * 100) }}-->
                                        <!--    </span> </p>-->
                                        <hr>
                                        <p><b>Phí vận chuyển:</b></p>
                                        <div class="form-group">
                                            <input type="radio" id="vship" name="shipping_method" value="v_ship" checked>
                                            <label for="vship">Viettel Shipping ({{ formatPrice($v_ship) }})</label><br>
                                            <input type="radio" id="cship" name="shipping_method" value="c_ship">
                                            <label for="cship">CMart Shipping ({{ formatPrice($c_ship) }})</label><br>
                                        </div>
                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price">{{ formatPrice(str_replace(',', '', $cart_total) + $tax + $process_fee - $m_point * 100) }}
                                            </span> </p>
                                    </div> --}}
                                    <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ formatPrice($cart_subtotal) }} </span> </p>

                                        <hr>
                                        {{-- <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <hr> --}}
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế VAT:</span> <span
                                                class="tamtinh-price">{{ formatPrice($tax) }} </span> </p>
                                        <hr>
                                        <p class="tamtinh"><span>Phí vận chuyển:</span> <span id="amount-shipping"
                                                class="tamtinh-price">0 đ</span></p>
                                        <div class="form-group" id="method-ship"
                                            data-url="{{ route('checkout.calship') }}"
                                            data-urlcmartship="{{ route('checkout.calCmartShip') }}">
                                            {{-- <input type="radio" id="vship" name="shipping_method" value="v_ship" checked
                                                style="display:none">
                                            <label for="vship" id="lbvship" style="display:none">Viettel Shipping
                                                ({{ formatPrice($v_ship) }})</label>
                                            <input type="radio" id="cship" name="shipping_method" value="c_ship"
                                                style="display:none">
                                            <label for="cship" id="lbcship" style="display:none">CMart Shipping
                                                ({{ formatPrice($c_ship) }})</label> --}}
                                        </div>
                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price" id="total-price-checkout"
                                                data-value="{{ $cart_total }}">{{ formatPrice($cart_total) }}
                                            </span> </p>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="chinhsach">
                            <div class="chinhsach-header">
                                <h3>Điều khoản và chính sách</h3>
                            </div>
                            <div class="chinhsach-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="nhanhang"
                                                id="check1">
                                            <label class="custom-control-label" for="check1">Tôi đã đọc và đồng ý với Quy
                                                định Thao tác khi nhận hàng
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="giaonhan"
                                                id="check2">
                                            <label class="custom-control-label" for="check2">Tôi đã đọc và đồng ý với Chính
                                                sách Giao - Nhận</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="doitra" id="check3">
                                            <label class="custom-control-label" for="check3">Tôi đã đọc và đồng ý với Chính
                                                sách Đổi - Trả</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="baohanh" id="check4">
                                            <label class="custom-control-label" for="check4">Tôi đã đọc và đồng ý với Chính
                                                sách Bảo hành</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="dieukhoan"
                                                id="check5">
                                            <label class="custom-control-label" for="check5">Tôi đã đọc và đồng ý với Quy
                                                định Điều khoản & Điều kiện giao dịch</label>
                                        </div>
                                    </li>
                                    {{-- <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" name="dieukhoan" id="check6">
                                          <label class="custom-control-label" for="check6"></label>
                                        </div>
                                      </li> --}}
                                    <li class="list-group-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkall"
                                                id="check7">
                                            <label class="custom-control-label" for="check7">Chọn tất cả</label>
                                        </div>
                                    </li>
                                </ul>
                                <p class="text-danger error-chinhsach p-1" style="display: none">Bạn phải đồng ý tất cả
                                    chính sách của Cmart</p>
                                <p class="py-1">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông
                                    tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông
                                    tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng, tạo
                                    sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết</p>
                            </div>
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            <div class="phuongthuc-thanhtoan-card-header">
                                <h3>THANH TOÁN</h3>
                            </div>
                            <hr>
                            <div class="phuongthuc-thanhtoan-card-body">
                                <div class="thanhtoankhigiaohang">
                                    <input type="radio" name="payment_method" checked="checked" value="1"> <span>COD(Thanh
                                        toán nhận hàng)</span>
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="thanhtoantructuyen">
                                    <input type="radio" name="payment_method" value="2">
                                    <span>Thanh toán online</span>
                                    <img src="{{ asset('assets/image/payme.png') }}">
                                </div>
                                <div class="thanhtoantructuyen">
                                    <input type="radio" name="payment_method" value="2" readonly="readonly" disabled>
                                    <span>Chuyển khoản qua ngân hàng</span>
                                    <img src="{{ asset('assets/image/vnpay.png') }}">
                                </div>
                                <div class="chuyenkhoan">
                                    <input type="radio" name="payment_method" value="3" readonly="readonly" disabled>
                                    <span>Chuyển khoản qua ngân hàng</span>
                                    <div class="tk-nganhang">
                                        <p>Doanh nghiệp: Công ty cổ phần</p>
                                        <p>TK ngân hàng: Công ty cổ phần</p>
                                        <p>Chi nhánh: Công ty cổ phần</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a class="btn-back-cart" href="{{ route('cart.index') }}">Quay lại Giỏ hàng</a>

                        <button class="btn-dathang" type="submit">Tiếp tục Thanh toán</button> --}}
                    </div>
                </div>
            </div>
            <div class="d-flex justify-between-center">
                <a class="btn-back-cart" href="{{ route('cart.index') }}">Quay lại Giỏ hàng</a>
                <button id="btn-to-payment" class="btn-dathang" type="submit" disabled>Tiếp tục Thanh toán</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/address.js') }}"></script>
    <script src="{{ asset('public/js/checkout.js') }}"></script>

    <script>
        $(".receiverstore").change(function() {
            if ($('.receiverstore:checked').length == $('.receiverstore').length) {
                $('select[name="sel_province"]').prop('required', false);
                $('select[name="sel_district"]').prop('required', false);
                $('select[name="sel_ward"]').prop('required', false);
                $('input[name="address"]').prop('required', false);


            }
        });
        $("select[name='sel_province']").change(function() {
            if ($(this).val() == '70') {
                $('#cship').prop('checked', true);
                $('#vship').prop('checked', false);
                $('#vship').css('display', 'none');
                $('#lbvship').css('display', 'none');
                $('#lbcship').css('display', 'inline-block');
                $('#cship').css('display', 'inline-block');

            } else {
                $('#vship').prop('checked', true);
                $('#cship').prop('checked', false);
                $('#cship').css('display', 'none');
                $('#lbcship').css('display', 'none');
                $('#lbvship').css('display', 'inline-block');
                $('#vship').css('display', 'inline-block');

            }
        });
        $("input[name='checkall']").click(function() {
            $('.chinhsach-body input:checkbox').not(this).prop('checked', this.checked);
        });
        $('input.receiverstore').change(function() {
            if ($('input.receiverstore').not(':checked').length == 0) {
                $('select[name="sel_province"]').removeAttr('required');
                $('select[name="sel_district"]').removeAttr('required');
                $('select[name="sel_ward"]').removeAttr('required');
                $('input[name="address"]').removeAttr('required');
                $('input[name="fullname"]').removeAttr('required');
                $('input[name="phone"]').removeAttr('required');

                $('#btn-to-payment').removeAttr('disabled');
                $('#in_store').val(1);
            }else{
                $('select[name="sel_province"]').attr('required','true');
                $('select[name="sel_district"]').attr('required','true');
                $('select[name="sel_ward"]').attr('required','true');
                $('input[name="address"]').attr('required','true');
                $('input[name="fullname"]').attr('required','true');
                $('input[name="phone"]').attr('required','true');

                $('#in_store').val(0);

            }
        });

        // $('.btn-dathang').click(function(e) {
        //     if ($('.chinhsach-body input:checkbox').is(':checked')) {

        //     } else {
        //         e.preventDefault();
        //         $('.error-chinhsach').css('display', 'block');
        //     }
        // })

        function storeaddress() {
            if ($('#store-address').is(':checked')) {
                $('#name-address').css("display", "block");
            } else {
                $('#name-address').css("display", "none");
            }
        }

        function showvat() {
            if ($('#show-vat').is(':checked')) {
                $('.form-vat').css("display", "block");
            } else {
                $('.form-vat').css("display", "none");
            }
        }
        $('input[name="pick_address"]').on('click', function() {
            id = $(this).val();
            url = $(this).data('url');
            if (id == 1) {
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',

                    })
                    .done(function(data) {
                        console.log(data);
                        $('input[name="fullname"]').val(data[0].hoten);
                        $('input[name="phone"]').val(data[0].phone);
                        // $('input[name="email"]').val(data[0].email);
                        $('input[name="address"]').val(data[0].address);

                        var province = '<option value="' + data[1].PROVINCE_ID + '">' + data[1].PROVINCE_NAME +
                            '</option>';
                        // $.each(data[4], function(index, value) {
                        //     province += '<option value="' + value.matinhthanh + '">' + value
                        //         .tentinhthanh + '</option>';
                        // });
                        $('select[name="sel_province"]').empty().html(province);

                        var district = '<option value="' + data[2].DISTRICT_ID + '">' + data[2].DISTRICT_NAME +
                            '</option>';
                        // $.each(data[5], function(index, value) {
                        //     district += '<option value="' + value.maquanhuyen + '">' + value
                        //         .tenquanhuyen + '</option>';
                        // });
                        $('select[name="sel_district"]').empty().html(district);

                        var ward = '<option value="' + data[3].WARDS_ID + '">' + data[3].WARDS_NAME +
                            '</option>';
                        // $.each(data[6], function(index, value) {
                        //     ward += '<option value="' + value.maphuongxa + '">' + value.tenphuongxa +
                        //         '</option>';
                        // });
                        $('select[name="sel_ward"]').empty().html(ward);
                        getship();

                    });
            } else {
                $.ajax({
                        url: urlHome + '/lay-dia-chi/cap-tinh',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id: $(this).val()
                        },
                    })
                    .fail(function(data) {
                        console.log(data);

                    })
                    .done(function(data) {
                        console.log(data);
                        var html = '<option value="">Cấp tỉnh</option>';
                        $.each(data, function(index, value) {
                            html += '<option value="' + value.PROVINCE_ID + '">' + value.PROVINCE_NAME +
                                '</option>';
                        });

                        $('select[name="sel_province"]').empty(html);

                        $('select[name="sel_province"]').append(html);
                        $('select[name="sel_district"]').empty().append('<option value="">Cấp huyện</option>');
                        $('select[name="sel_ward"]').empty().append('<option value="">Cấp xã</option>');

                    });
            }
        });
        window.addEventListener("load", function() {
            const slider = document.querySelector(".slider");
            const sliderMain = document.querySelector(".slider-product");
            const sliderItems = document.querySelectorAll(".slider-product-item");
            const nextBtn = document.querySelector(".slide-btn-next");
            const prevBtn = document.querySelector(".slide-btn-prev");
            const slideritemWidth = sliderItems[0].offsetWidth;
            console.log("slideritemWidth", slideritemWidth);
        });
    </script>
@endpush
