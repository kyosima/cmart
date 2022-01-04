@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('checkout.post') }}" class="form-checkout" method="post" enctype="multipart/form">
        @csrf
        <div class="container">
         
            <div class="row">
                <div class="col-xl-8 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="card-information">
                            <div class="card-information-header pt-4">
                                <div class="row">
                                    <div class="col-xl-6 col-md-6 col-xs-12 col-sm-12">
                                        <h3>THÔNG TIN GIAO HÀNG</h3>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-xs-12 col-sm-12">
                                        <select id="pickAdress" class="form-control"
                                            data-url="{{ route('checkout.getAddress') }}">
                                            <option value="">Chọn địa chỉ đã lưu</option>
                                            @foreach ($store_address as $adr)
                                                <option value="{{ $adr->id }}">{{ $adr->fullname }}</option>
                                            @endforeach
                                        </select>
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
                            <div class="card-information-body">
                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Họ và tên<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="fullname"
                                            placeholder="Mời nhập họ và tên có dấu" required value="{{ $user->hoten }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tỉnh/ Thành phố<sup class="text-danger">*</sup></label>
                                        <select name="sel_province" class="form-control select2"
                                            data-placeholder="---Chọn tỉnh thành---" required>

                                            <option value="">---Chọn tỉnh thành---</option>
                                            @foreach ($province as $value)
                                                <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phường/ Xã<sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="sel_ward"
                                            data-placeholder="---Chọn phường xã---" required>

                                            <option value="">---Chọn phường xã---</option>
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
                                        <label for="">Quận/ Huyện<sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="sel_district"
                                            data-placeholder="---Chọn quận huyên---" required>

                                            <option value="">---Chọn quận huyện---</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ<sup class="text-danger">*</sup></label>
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
                            <div class="col-xl-12">
                                <div class="form-group">

                                    <label onclick="storeaddress()"><input type="checkbox" id="store-address"
                                            name="store_address" value="1"> Lưu lại thông
                                        tin người nhận</label>


                                </div>

                            </div>
                            <br />
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            <div class="phuongthuc-thanhtoan-card-header">
                                <h3>Xuất hóa đơn GTGT</h3>
                            </div>
                            <hr>
                            <div class="phuongthuc-thanhtoan-card-body">

                                <div class="form-group">
                                    <label onclick="showvat()"><input type="checkbox" id="show-vat" name="show_vat"
                                            value="1"> Xác nhận xuất hóa GTGT</label>
                                </div>
                                <div class="form-vat" style="display:none">
                                    <div class="form-group">
                                        <label for="">Tên công ty<sup class="text-danger">*</sup></label>
                                        <input type="text" name="vat_name" class="form-control" value=""
                                            placeholder="Mời nhập tên công ty">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mã số thuế<sup class="text-danger">*</sup></label>
                                        <input type="number" name="vat_mst" class="form-control" value=""
                                            placeholder="Mời nhập mã số thuế công ty">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ<sup class="text-danger">*</sup></label>
                                        <input type="text" name="vat_address" class="form-control" value=""
                                            placeholder="Mời nhập địa chỉ công ty">
                                    </div>
                                    <div>
                                        <p>Xin Quý Khách Hàng lưu ý: C-Mart xin phép từ chối hỗ trợ xử lý các thao tác về hóa đơn sau khi đặt hàng.</p>
                                    </div>
                                    <br />

                                </div>
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
                    </div>
                </div>
                <div class="col-xl-4 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="makhuyenmai">
                            <div class="makhuyenmai-header">
                                <h3>Mã khuyến mãi</h3>
                            </div>
                            <div class="makhuyenmai-body">
                                <input type="text" class="makhuyenmai-body-input" placeholder="Nhập mã...">
                                <button class="btn btn-primary">Áp dụng</button>
                            </div>
                        </div>
                        <div class="donhang">
                            <div class="donhang-header">
                                <h3>ĐƠN HÀNG</h3> <span>({{ count($carts) }} SẢN PHẨM)</span>
                            </div>
                            <div class="donhang-body">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>SL</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $row)
                                            <tr>
                                                <td class="title">{{ $row->name }}</td>
                                                <td>{{ $row->qty }}</td>
                                                <td>{{ formatPrice($row->qty * $row->price) }}
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
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
                                                class="tamtinh-price">{{ $cart_subtotal }} đ</span> </p>

                                        <hr>
                                        <p><b>Phí vận chuyển:</b></p>
                                        <div class="form-group">
                                            <input type="radio" id="vship" name="shipping_method" value="v_ship" checked
                                                style="display:none">
                                            <label for="vship" id="lbvship" style="display:none">Viettel Shipping
                                                ({{ formatPrice($v_ship) }})</label>
                                            <input type="radio" id="cship" name="shipping_method" value="c_ship"
                                                style="display:none">
                                            <label for="cship" id="lbcship" style="display:none">CMart Shipping
                                                ({{ formatPrice($c_ship) }})</label>
                                        </div>
                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price">{{ formatPrice(str_replace(',', '', $cart_total)) }}
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
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="nhanhang" id="check1">
                                            <label class="custom-control-label" for="check1">Tôi đã đọc và đồng ý với Quy
                                                định Thao tác khi nhận hàng
                                            </label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="giaonhan" id="check2">
                                            <label class="custom-control-label" for="check2">Tôi đã đọc và đồng ý với Chính
                                                sách Giao - Nhận</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="doitra" id="check3">
                                            <label class="custom-control-label" for="check3">Tôi đã đọc và đồng ý với Chính
                                                sách Đổi - Trả</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="baohanh" id="check4">
                                            <label class="custom-control-label" for="check4">Tôi đã đọc và đồng ý với Chính
                                                sách Bảo hành</label>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="dieukhoan"
                                                id="check5">
                                            <label class="custom-control-label" for="check5">Tôi đã đọc và đồng ý với Quy
                                                định Điều khoản & Điều kiện giao dịch</label>
                                        </div>
                                    </li>
                                    {{-- <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                          <input type="checkbox" class="custom-control-input" name="dieukhoan" id="check6">
                                          <label class="custom-control-label" for="check6"></label>
                                        </div>
                                      </li> --}}
                                    <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkall"
                                                id="check7">
                                            <label class="custom-control-label" for="check7">Chọn tất cả</label>
                                        </div>
                                    </li>
                                </ul>
                                <p class="text-danger error-chinhsach p-1" style="display: none">Bạn phải đồng ý tất cả
                                    chính sách của Cmart</p>
                                <p class="py-1">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng, tạo sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết</p>
                            </div>
                        </div>
                        <a class="btn-back-cart" href="{{ route('cart.index') }}">Quay lại giỏ hàng</a>

                        <button class="btn-dathang" type="submit">Tiếp tục thanh toán</button>
                    </div>
                </div>
            </div>  
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/shipping.js') }}"></script>

    <script>
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
        $('.btn-dathang').click(function(e) {
            if ($('.chinhsach-body input:checkbox').is(':checked')) {

            } else {
                e.preventDefault();
                $('.error-chinhsach').css('display', 'block');
            }
        })

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
        $('#pickAdress').on('change', function() {
            id_address = $('#pickAdress').val();
            url = $('#pickAdress').data('url');
            if (id_address != '') {
                $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            id: id_address
                        },
                    })
                    .done(function(data) {
                        console.log(data);
                        $('input[name="fullname"]').val(data[0].fullname);
                        $('input[name="phone"]').val(data[0].phone);
                        $('input[name="email"]').val(data[0].email);
                        $('input[name="address"]').val(data[0].address);

                        var province = '<option value="' + data[1].matinhthanh + '">' + data[1].tentinhthanh +
                            '</option>';
                        $.each(data[4], function(index, value) {
                            province += '<option value="' + value.matinhthanh + '">' + value
                                .tentinhthanh + '</option>';
                        });
                        $('select[name="sel_province"]').empty().html(province);

                        var district = '<option value="' + data[2].maquanhuyen + '">' + data[2].tenquanhuyen +
                            '</option>';
                        $.each(data[5], function(index, value) {
                            district += '<option value="' + value.maquanhuyen + '">' + value
                                .tenquanhuyen + '</option>';
                        });
                        $('select[name="sel_district"]').empty().html(district);

                        var ward = '<option value="' + data[3].maphuongxa + '">' + data[3].tenphuongxa +
                            '</option>';
                        $.each(data[6], function(index, value) {
                            ward += '<option value="' + value.maphuongxa + '">' + value.tenphuongxa +
                                '</option>';
                        });
                        $('select[name="sel_ward"]').empty().html(ward);

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
