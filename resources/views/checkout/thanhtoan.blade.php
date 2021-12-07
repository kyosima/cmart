@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('checkout.post') }}" method="post" enctype="multipart/form">
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
                                        <select id="pickAdress" class="form-control" data-url="{{route('checkout.getAddress')}}">
                                            <option value="" >Chọn địa chỉ đã lưu</option>
                                            @foreach($store_address as $adr)
                                                <option value="{{$adr->id}}">{{$adr->fullname}}</option>
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
                                        <label for="">Tên đẩy đủ<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="fullname" placeholder="Họ và tên"
                                            required value="{{ $user->hoten }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tỉnh/ Thành phố<sup class="text-danger">*</sup></label>
                                        <select name="sel_province" class="form-control select2"
                                            data-placeholder="---Chọn tỉnh thành---" required>
                                            @if ($user_ward)
                                                <option
                                                    value="{{ $user_ward->getDistrictFromWard()->first()->getProvinceFromDistrict()->value('matinhthanh') }}">
                                                    {{ $user_ward->getDistrictFromWard()->first()->getProvinceFromDistrict()->value('tentinhthanh') }}
                                                    @foreach ($province as $value)
                                                <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="">---Chọn tỉnh thành---</option>
                                            @foreach ($province as $value)
                                                <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                </option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phường/ Xã<sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="sel_ward"
                                            data-placeholder="---Chọn phường xã---" required>
                                            @if ($user_ward)
                                                <option value="{{ $user_ward->maphuongxa }}">
                                                    {{ $user_ward->tenphuongxa }}
                                                @else
                                                <option value="">---Chọn phường xã---</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email<sup class="text-danger">*</sup></label>
                                        <input type="email" class="form-control" name="email" placeholder="Nhập email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Số điện thoại<sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại"
                                            value="{{ $user->phone }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quận/ Huyện<sup class="text-danger">*</sup></label>
                                        <select class="form-control select2" name="sel_district"
                                            data-placeholder="---Chọn quận huyên---" required>
                                            @if ($user_ward)
                                                <option
                                                    value="{{ $user_ward->getDistrictFromWard()->value('maquanhuyen') }}">
                                                    {{ $user_ward->getDistrictFromWard()->value('tenquanhuyen') }}
                                                @else
                                                <option value="">---Chọn quận huyện---</option>
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ<sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $user->address }}" placeholder="Địa chỉ" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ghi chú</label>
                                        <input type="text" name="note" class="form-control"
                                            placeholder="Nhập ghi chú đơn hàng">
                                    </div>

                                </div>

                            </div>
                            <div class="col-xl-12">
                                <div class="form-group">

                                    <label onclick="storeaddress()"><input type="checkbox" id="store-address" name="store_address" value="1"> Lưu lại thông
                                        tin người nhận</label>

                                    <input id="name-address" class="form-control" style="display:none"
                                        placeholder="Nhập tên địa chỉ ghi nhớ" name="name_address">
                                </div>

                            </div>
                            <br/>
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
                                    <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ $cart_subtotal }} đ</span> </p>
                                        <hr>
                                        <p><b>Phí dịch vụ:</b></p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế:</span> <span
                                                class="tamtinh-price">{{ formatPrice($tax) }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Điểm M quy đổi:</span> <span
                                                class="tamtinh-price">{{ formatPrice($m_point * 100) }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Điểm C tích lũy:</span>
                                            <span class="tamtinh-price">{{ $c_point }} </span> </p>
                                        <p class="tamtinh"> <span class="tamtinh-title">Tổng phí dịch vụ:</span>
                                            <span
                                                class="tamtinh-price">{{ formatPrice($tax + $process_fee - $m_point * 100) }}
                                            </span> </p>
                                        <hr>
                                        <p><b>Phí vận chuyển:</b></p>
                                        <div class="form-group">
                                            <input type="radio" id="vship" name="shipping_method" value="v_ship" checked>
                                            <label for="vship">Viettel Shipping ({{ formatPrice($v_ship) }})</label><br>
                                            <input type="radio" id="cship" name="shipping_method" value="c_ship">
                                            <label for="cship">CMart Shipping ({{ formatPrice($c_ship) }})</label><br>
                                        </div>
                                        <hr>
                                        <p class="total"> <span>Tổng cộng:</span> <span
                                                class="total-price">{{ formatPrice(str_replace(',', '', $cart_total) + $tax + $process_fee - $m_point * 100) }}
                                            </span> </p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button class="btn-dathang" type="submit">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/shipping.js') }}"></script>

    <script>
        function storeaddress() {
            if ($('#store-address').is(':checked')) {
                $('#name-address').css("display", "block");
            } else {
                $('#name-address').css("display", "none");
            }
        }
        $('#pickAdress').on('change', function() {
            id_address = $('#pickAdress').val();
            url = $('#pickAdress').data('url');
            if(id_address != ''){
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    data: {id: id_address},
                })
                .done(function(data) {
                    console.log(data);
                    $('input[name="fullname"]').val(data[0].fullname);
                    $('input[name="phone"]').val(data[0].phone);
                    $('input[name="email"]').val(data[0].email);
                    $('input[name="address"]').val(data[0].address);

                    var province = '<option value="'+data[1].matinhthanh+'">'+data[1].tentinhthanh+'</option>';
                    $.each(data[4], function( index, value ) {
                        province += '<option value="'+value.matinhthanh+'">'+value.tentinhthanh+'</option>';
                    });
                    $('select[name="sel_province"]').empty().html(province);

                    var district = '<option value="'+data[2].maquanhuyen+'">'+data[2].tenquanhuyen+'</option>';
                    $.each(data[5], function( index, value ) {
                        district += '<option value="'+value.maquanhuyen+'">'+value.tenquanhuyen+'</option>';
                    });
                    $('select[name="sel_district"]').empty().html(district);

                    var ward = '<option value="'+data[3].maphuongxa+'">'+data[3].tenphuongxa+'</option>';
                    $.each(data[6], function( index, value ) {
                        ward += '<option value="'+value.maphuongxa+'">'+value.tenphuongxa+'</option>';
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
