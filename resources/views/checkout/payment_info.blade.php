@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/responsive.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xl-8 col-sm-12 col-12">
                <div class="card-left">
                    <div class="list-stores-checkout mt-0">
                        <div class="list-stores-title text-center" id="url-update-type"
                            data-url="{{ route('checkout.updateTypeShip') }}">
                            <h3>DANH SÁCH ĐƠN HÀNG</h3>
                        </div>
                        <hr>
                        <div class="list-stores-body">
                            @foreach ($order->order_stores as $order_store)
                                {{-- @php
                                        $cart = Cart::instance($store_id);
                                        $store = App\Models\Store::whereId($store_id)->first();
                                    @endphp --}}
                                <div class="store-block" id="store{{ $order_store->id_store }}">
                                    <div class="store-title ">
                                        <h4>Cửa hàng {{ $order_store->store->title }}</h4>
                                        <h5> {{ formatMethod($order_store->shipping_method) }} <span
                                                class="pl-1">
                                                {{formatType($order_store->shipping_type)}}

                                            </span>
                                        </h5>

                                        {{-- <label for="receiverstore{{ $store_id }}"><input class="receiverstore"
                                                    type="checkbox" id="receiverstore{{ $store_id }}"
                                                    name="receiverstore{{ $store_id }}" value="{{ $store_id }}"
                                                    data-storeid="{{ $store_id }}" onclick="receiverStore(this)"> Nhận
                                                tại cửa
                                                hàng</label> --}}
                                    </div>
                                    <div class="store-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped w-100">
                                                <thead class="thead-dark">
                                                    <th>Mã SP</th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>C</th>
                                                    <th>M</th>
                                                    <th style="width: 120px">Đơn giá</th>
                                                    <th>Giảm giá</th>
                                                    <th>SL</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order_store->order_products()->get() as $order_product)
                                                        @if ($order_product->sku != null)
                                                            <tr>
                                                                <td>{{ $order_product->sku }}</td>
                                                                <td>{{ $order_product->name }}</td>
                                                                <td>{{ $order_product->c_point }}</td>
                                                                <td>{{ $order_product->m_point }}</td>
                                                                <td>{{ formatPrice($order_product->price) }}</td>
                                                                <td>{{ formatPrice($order_product->discount) }}</td>
                                                                <td>{{ $order_product->quantity }}</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td>{{ $order_product->sku }}</td>
                                                                <td>{{ $order_product->name }}
                                                                    @if (isset($order_vat->vat_company) )
                                                                        <br>
                                                                        {{ $order_vat->vat_email }} <br>
                                                                        {{ $order_vat->vat_company }} <br>
                                                                        {{ $order_vat->vat_mst }}<br>
                                                                        {{ $order_vat->vat_address }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $order_product->c_point }}</td>
                                                                <td>{{ $order_product->m_point }}</td>
                                                                <td>{{ formatPrice($order_product->price) }}</td>
                                                                <td>{{ formatPrice($order_product->discount) }}</td>
                                                                <td>{{ $order_product->quantity }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="store-footer payment-store-footer">
                                        <div class="d-flex  justify-content-md-between justify-content-center flex-md-nowrap flex-wrap">
                                            <div class="text-center mr-4">
                                                <p>Giá trị sản phẩm</p>
                                                <p>{{ formatPrice($order_store->sub_total) }}</p>
                                            </div>
                                            <div class="text-center mr-4">
                                                <p>Giảm giá sản phẩm</p>
                                                <p>{{ formatPrice($order_store->discount_product) }}</p>
                                            </div>
                                            <div class="text-center mx-4">
                                                <p>Thuế GTGT sản phẩm</p>
                                                <p>{{ formatPrice($order_store->vat_products) }}</p>
                                            </div>
                                            <div class="text-center ">
                                                <p>Tích M giảm giá dịch vụ</p>
                                                <p>{{ formatNumber($order_store->m_point) }}</p>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div class="text-center">
                                                <p>Phí Vận chuyển</p>
                                                <p><small>(Chưa bao gồm thuế VAT 8%)</small></p>
                                                <p>{{ formatPrice($order_store->transpot_price) }}</p>
                                            </div>
                                            <div class="text-center">
                                                <p>Phí DV GTGT</p>
                                                <p><small>(Đã bao gồm thuế VAT 8%)</small></p>
                                                <p>{{ formatPrice($order_store->vat_services) }}</p>

                                            </div>
                                            <div class="text-center">
                                                <p>Giá trị thanh toán cho ĐH</p>
                                                <p><small>(Đã bao gồm thuế)</small></p>
                                                <p>{{ formatPrice($order_store->total) }}</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="result-order">
                        <div>
                            <h3>TỔNG KẾT</h3>
                        </div>
                        <div class="d-flex justify-content-md-between justify-content-center flex-md-nowrap flex-wrap">
                            <div class="text-center mr-4">
                                <p>Tổng phí vận chuyển</p>
                                <p><small>(Chưa bao gồm thuế VAT 8%)</small></p>
                                <p>{{ formatPrice($order->transpot_price_total) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Tổng phí DV GTGT</p>
                                <p><small>(Đã bao gồm thuế VAT 8%)</small></p>
                                <p>{{ formatPrice($order->vat_services) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Tổng Giảm giá Dịch vụ</p>
                                <p style="visibility:hidden">s</p>
                                <p>{{ formatPrice($order->m_point) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Giá trị thanh toán Dịch vụ</p>
                                <p><small>(Đã bao gồm thuế VAT 8%)<br><b>= Số M cần tìm thêm để miễn phí dịch vụ</b></small></p>
                                <p>{{ formatPrice($order->total_payment_services) }}
                                </p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="text-center">
                                <p>Tổng Giá trị Sản phẩm</p>
                                <p>{{ formatPrice($order->sub_total) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Tổng Giảm giá Sản phẩm</p>
                                <p>{{ formatPrice($order->discount_products) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Tổng Tiền Tích Lũy</p>
                                <p>{{ formatNumber($order->c_point) }}</p>
                            </div>
                            <div class="text-center">
                                <p><b>Số dư M còn lại</b></p>
                                <p>{{ formatNumber($order->remaining_m_point) }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div class="text-center">
                                <p>Thuế GTGT Sản phẩm</p>
                                <p>{{ formatPrice($order->vat_products) }}</p>

                            </div>
                            <div class="text-center">
                                <p>Thuế GTGT Dịch vụ</p>
                                <p>{{ formatPrice((max((max($order->shipping_total - $order->m_point, 0) * 108) / 100 +($order->vat_services - max($order->m_point - $order->shipping_total, 0)),0)) - (max((max($order->shipping_total - $order->m_point, 0) * 108) / 100 +($order->vat_services - max($order->m_point - $order->shipping_total, 0)),0) /1.08)) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Tổng Thuế GTGT</p>
                                <p>{{ formatPrice($order->vat_products + (max((max($order->shipping_total - $order->m_point, 0) * 108) / 100 +($order->vat_services - max($order->m_point - $order->shipping_total, 0)),0)) - (max((max($order->shipping_total - $order->m_point, 0) * 108) / 100 +($order->vat_services - max($order->m_point - $order->shipping_total, 0)),0) /1.08)) }}</p>
                            </div>
                            <div class="text-center">
                                <p>Giá trị giao dịch</p>
                                <b>{{ formatPrice($order->total) }}</b>
                            </div>

                        </div>
                     
                    </div>
                </div>

            </div>
            <div class="col-xl-4 col-sm-12 col-12 ">
                <div class="card-left">
                    <div class="makhuyenmai">
                        <div class="makhuyenmai-header">
                            <h3>Giảm giá sản phẩm</h3>
                        </div>
                        <div class="makhuyenmai-body">
                            <input type="text" class="makhuyenmai-body-input" placeholder="Nhập mã...">
                            <button class="btn btn-primary" id="btn-apply-coupon" type="button">Áp dụng</button>
                            <p style="display: none" class="text-danger alert-coupon">Hệ thống không xác thực được mã
                                này. Vui lòng liên hệ Hotline 0899.663.883 để được hỗ trợ</p>

                        </div>
                    </div>
                    {{-- <div class="donhang">
                            <div class="donhang-header">
                                <h3>ĐƠN HÀNG</h3> <span> SẢN PHẨM)</span>
                            </div>
                            <div class="donhang-body">

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
                                    </div>
                                    <div class="card-body">
                                        <p class="tamtinh"> <span class="tamtinh-title">Tạm tính:</span> <span
                                                class="tamtinh-price">{{ formatPrice($order->sub_total) }} </span> </p>

                                        <hr>
                                        <p class="tamtinh"> <span class="tamtinh-title">Phí xử lý:</span> <span
                                                class="tamtinh-price">{{ formatPrice($process_fee) }} </span> </p>
                                        <hr>
                                        <p class="tamtinh"> <span class="tamtinh-title">Thuế VAT:</span> <span
                                                class="tamtinh-price">{{ formatPrice($order->tax) }} </span> </p>
                                        <hr>
                                        <p class="tamtinh"><span>Phí vận chuyển:</span> <span id="amount-shipping"
                                                class="tamtinh-price">{{ formatPrice($order->shipping_total) }} đ</span>
                                        </p>

                                        <hr>
                                        <p class="total"> <span>Giá trị giao dịch:</span> <span
                                                class="total-price" id="total-price-checkout"
                                                data-value="{{ $order->total }}">{{ formatPrice($order->total) }}
                                            </span> </p>
                                    </div>
                                </div>

                            </div>

                        </div> --}}
                    <div class="chinhsach">
                        <div class="chinhsach-header">
                            <h3>Điều khoản và chính sách</h3>
                        </div>
                        <div class="chinhsach-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <!-- Default checked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="nhanhang" id="check1"
                                            checked readonly onclick="return false;">
                                        <label class="custom-control-label" for="check1" onclick="showPolicy(this)"
                                            data-slug="chinh-sach-thanh-toan" data-url="{{ route('showPolicy') }}">Tôi
                                            đã đọc và đồng ý với
                                            Chính sách thanh toán
                                        </label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <!-- Default checked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="giaonhan" id="check2"
                                            checked readonly onclick="return false;">
                                        <label class="custom-control-label" for="check2" onclick="showPolicy(this)"
                                            data-slug="chinh-sach-giao-nhan" data-url="{{ route('showPolicy') }}">Tôi đã
                                            đọc và đồng ý với Chính
                                            sách Giao - Nhận</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <!-- Default checked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="doitra" id="check3"
                                            checked readonly onclick="return false;">
                                        <label class="custom-control-label" for="check3" onclick="showPolicy(this)"
                                            data-slug="chinh-sach-doi-tra" data-url="{{ route('showPolicy') }}">Tôi đã
                                            đọc và đồng ý với Chính
                                            sách Đổi - Trả</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <!-- Default checked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="baohanh" id="check4"
                                            checked readonly onclick="return false;">
                                        <label class="custom-control-label" for="check4" onclick="showPolicy(this)"
                                            data-slug="chinh-sach-bao-hanh" data-url="{{ route('showPolicy') }}">Tôi đã
                                            đọc và đồng ý với Chính
                                            sách Bảo hành</label>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <!-- Default checked -->
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="dieukhoan" id="check5"
                                            checked readonly onclick="return false;">
                                        <label class="custom-control-label" for="check5" onclick="showPolicy(this)"
                                            data-slug="quy-dinh-dieu-khoan-dieu-kien-giao-dich"
                                            data-url="{{ route('showPolicy') }}">Tôi đã đọc và đồng ý với Quy
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
                                {{-- <li class="list-group-item">
                                        <!-- Default checked -->
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="checkall" id="check7">
                                            <label class="custom-control-label" for="check7">Chọn tất cả</label>
                                        </div>
                                    </li> --}}
                            </ul>
                            {{-- <p class="text-danger error-chinhsach p-1" style="display: none">Bạn phải đồng ý tất cả
                                    chính sách của Cmart</p>
                                <p class="py-1">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông
                                    tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông
                                    tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng, tạo
                                    sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết</p> --}}

                        </div>
                    </div>
                    <form action="{{ route('checkout.postPayment') }}" class="form-checkout" method="post"
                        enctype="multipart/form">
                        @csrf
                        <input type="hidden" name="order_code" value="{{ $order->order_code }}">
                        <a class="btn-back-cart" href="{{ url()->previous() }}">Quay lại Trang trước</a>
                        <button class="btn-dathang" type="submit">Thanh toán</button>
                    </form>

                    {{-- <div class="phuongthuc-thanhtoan">
                            
                        </div>
                        <div class="phuongthuc-thanhtoan">
                            
                        </div> --}}


                </div>
            </div>
            <div class="modal fade" id="modal-policy" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="policy-title"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body policy-content" style="overflow-y: scroll; height: 70vh">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-12">
                    <div class="result-order">
                        <div>
                            <h3>HÌNH THỨC THANH TOÁN</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="phuongthuc-thanhtoan-card-header">
                                    <h3>THANH TOÁN TRẢ TRƯỚC</h3>
                                </div>
                                <hr>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    <div class="form-group">
                                        <input type="radio" id="pay0" name="payment_method" value="0">
                                        <label for="pay0">Tiền tích lũy</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay1" name="payment_method" value="1" disabled>
                                        <label for="pay1">Nạp tiền</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay2" name="payment_method" value="2" disabled>
                                        <label for="pay2">Chuyển tiền</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay3" name="payment_method" value="3" disabled>
                                        <label for="pay3">Công nợ linh hoạt</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay4" name="payment_method" value="4" disabled>
                                        <label for="pay4">Thanh toán online bằng Thẻ Visa / Mastercard</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay5" name="payment_method" value="5" disabled>
                                        <label for="pay5">Thanh toán online bằng Thẻ JCB / CUP</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay6" name="payment_method" value="6" disabled>
                                        <label for="pay6">Thanh toán online bằng Thẻ Amex / Diners Club</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay7" name="payment_method" value="7" disabled>
                                        <label for="pay7">Thanh toán online bằng Thẻ Ngoài nước / Discover</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay8" name="payment_method" value="8" disabled>
                                        <label for="pay8">Thanh toán online bằng Thẻ Nội địa</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="phuongthuc-thanhtoan-card-header">
                                    <h3>THANH TOÁN TRẢ SAU</h3>
                                </div>
                                <hr>
                                <div class="phuongthuc-thanhtoan-card-body">
                                    <div class="form-group">
                                        <input type="radio" id="pay9" name="payment_method" value="9">
                                        <label for="pay9">Thanh toán khi nhận hàng (Chuyển khoản)</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay10" name="payment_method" value="10" disabled>
                                        <label for="pay10">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay11" name="payment_method" value="11" disabled>
                                        <label for="pay11">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard do SHB phát hành,
                                            qua app QR SHB</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay12" name="payment_method" value="12" disabled>
                                        <label for="pay12">Thanh toán trực tiếp bằng Thẻ Visa / Mastercard / JCB do TPBank
                                            phát hành, qua app QR TPBank</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay13" name="payment_method" value="13" disabled>
                                        <label for="pay13">Thanh toán trực tiếp bằng Thẻ JCB / CUP </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay14" name="payment_method" value="14" disabled>
                                        <label for="pay14">Thanh toán trực tiếp bằng Thẻ JCB / CUP do MBBank phát
                                            hành</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay15" name="payment_method" value="15" disabled>
                                        <label for="pay15">Thanh toán trực tiếp bằng Thẻ Amex / Diners Club</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay16" name="payment_method" value="16" disabled>
                                        <label for="pay16">Thanh toán trực tiếp bằng Thẻ Ngoài nước / Discover</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay17" name="payment_method" value="17" disabled>
                                        <label for="pay17">Thanh toán trực tiếp bằng Thẻ Nội địa</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay18" name="payment_method" value="18" disabled>
                                        <label for="pay18">Thanh toán trực tiếp bằng Thẻ Nội địa do MBBank phát hành</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay19" name="payment_method" value="19" disabled>
                                        <label for="pay19">Thanh toán trực tiếp bằng Thẻ Nội địa do SCB phát hành</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="radio" id="pay20" name="payment_method" value="20" disabled>
                                        <label for="pay20">Thanh toán trực tiếp bằng Thẻ Nội địa do TPBank phát hành, qua
                                            app QR TPBank</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> --}}


        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/shipping.js') }}"></script>
    <script src="{{ asset('public/js/checkout.js') }}"></script>

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
        $('#btn-apply-coupon').click(function() {
            $('.alert-coupon').css('display', 'block');
        });
        $('#pickAdress').on('click', function() {
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
                        $('input[name="fullname"]').val(data[0].hoten);
                        $('input[name="phone"]').val(data[0].phone);
                        // $('input[name="email"]').val(data[0].email);
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
                        getship();

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
