<link rel="stylesheet" href="{{ asset('css/c_bill.css') }}">
<link rel="stylesheet" href="{{ asset('css/header.css') }}">

{{-- <link href="{{ asset('public/css/boostrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css"> --}}
<div class="container">
    <div class="c-bill">
        <div class="d-flex justify-content-center">
            <div class="col-md-10 col-12">

                <div class="row">
                    <div class="col-md-12 col-12">
                        <h4 class="text-center text-uppercase">
                            C-MART
                        </h4>
                        @php
                            $user = $order->user()->first();
                            $order_address = $order->order_address()->first();
                            $order_info = $order->order_info()->first();
                            $order_products = $order->order_products()->get();
                            $addressController = new App\Http\Controllers\AddressController();
                            $order_province = $addressController->getProvinceDetail($order_address->id_province);
                            $order_district = $addressController->getDistrictDetail($order_address->id_province, $order_address->id_district);
                            $order_ward = $addressController->getWardDetail($order_address->id_district, $order_address->id_ward);
                            $order_vat = $order->order_vat()->first();
                        @endphp
                        <p class="text-center font-italic">“Tất cả trong Một”</p>
                        <p class="text-center">
                            ○○○○○○○○○○○○○○○○○○○○○○○
                        </p>
                        <h4 class="text-center text-uppercase">
                            Hóa đơn
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <ul class="info-order">
                            <li>Thời gian đặt hàng: {{ date('H:i:s d/m/Y', strtotime($order->created_at)) }}</li>
                            <li>Người đặt: {{ $user->hoten }} - {{ $user->phone }} -
                                {{ formatLevel($user->level) }}
                            </li>
                            <li>Người nhận:
                                <div>
                                    <table class="table table-bordered text-center">
                                        <tr>
                                            <td>Họ và tên: {{ $order_info->fullname }}</td>
                                        </tr>
                                        <tr>
                                            <td>Số điện thoại: {{ $order_info->phone }}</td>
                                        </tr>
                                        <tr>
                                            <td>Địa chỉ chi tiết: {{ $order_address->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cấp tỉnh: {{ $order_province->PROVINCE_NAME }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cấp huyện: {{ $order_district->DISTRICT_NAME }}</td>
                                        </tr>
                                        <tr>
                                            <td>Cấp xã: {{ $order_ward->WARDS_NAME }}</td>
                                        </tr>
                                    </table>
                            </li>
                            <li style=" word-wrap: break-word;">Ghi chú: <span>{{ $order_info->note }}</span></li>
                        </ul>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="c-bill-orders mt-0">
                            <div class="c-bill-orders-body">
                                @foreach ($order->order_stores()->get() as $order_store)
                                    <hr>
                                    <div class="c-bill-order" id="store{{ $order_store->id_store }}">
                                        <div class="order-title ">
                                            <h4>Cửa hàng {{ $order_store->store()->value('name') }}</h4>
                                            <h5> {{ formatMethod($order_store->shipping_method) }}
                                                {{ formatType($order_store->shipping_type) }}

                                            </h5>
                                        </div>
                                        <div class="order-head">
                                            <ul>
                                                <li>Mã giao dịch: {{ $order_store->order_store_code }}</li>
                                                <li>Mã vận chuyển: {{ $order_store->shipping_code }}</li>
                                            </ul>
                                        </div>
                                        <div class="order-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped w-100">
                                                    <thead class="thead-dark">
                                                        <th>Mã SP</th>
                                                        <th>Tên sản phẩm</th>
                                                        <th>Chiết khấu C</th>
                                                        <th>Chiết khấu M</th>
                                                        <th style="width: 120px">Đơn giá</th>
                                                        <th>Giảm giá</th>
                                                        <th>Thuế suất</th>
                                                        <th>PXL</th>
                                                        <th>TLVC</th>
                                                        <th>SL</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($order_store->order_products()->get() as $order_product)
                                                            @if ($order_product->sku != null)
                                                                <tr>
                                                                    <td>{{ $order_product->sku }}</td>
                                                                    <td>{{ $order_product->name }}</td>
                                                                    <td>{{ formatNumber($order_product->c_point) }}
                                                                    </td>
                                                                    <td>{{ formatNumber($order_product->m_point) }}
                                                                    </td>
                                                                    <td>{{ formatPrice($order_product->price) }}</td>
                                                                    <td>{{ formatPrice($order_product->discount) }}
                                                                    </td>
                                                                    <td>
                                                                        @if ($order_product->product()->first() != null)
                                                                            {{ formatTax($order_product->product()->first()->productPrice()->value('tax')) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($order_product->product()->first() != null)
                                                                            {{ formatPrice($order_product->product()->first()->productPrice()->value('phi_xuly') ) }}
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $order_product->weight }}g</td>
                                                                    <td>{{ $order_product->quantity }}</td>

                                                                </tr>
                                                            @else
                                                                <tr>
                                                                    <td>{{ $order_product->sku }}</td>
                                                                    <td>{{ $order_product->name }}@if ($order_vat->vat_company != null)
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
                                                                    <td>{{ formatPrice($order_product->discount) }}
                                                                    </td>
                                                                    <td>
                                                                        KKK
                                                                    </td>
                                                                    <td>
                                                                        0đ
                                                                    </td>
                                                                    <td>{{ $order_product->weight }}g</td>

                                                                    <td>{{ $order_product->quantity }}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="order-footer payment-store-footer">

                                            <span class="text-danger"></span>
                                            <div class="d-md-flex justify-content-between">
                                                <div class="text-center">
                                                    <p><b>Giá trị sản phẩm</b></p>
                                                    <p>{{ formatPrice($order_store->sub_total) }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <p><b>Giảm giá sản phẩm</b></p>
                                                    <p>{{ formatPrice($order_store->discount_product) }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <p><b>Thuế GTGT sản phẩm</b></p>
                                                    <p>{{ formatPrice($order_store->vat_products) }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <p><b>Tích M giảm giá dịch vụ</b></p>
                                                    <p>{{ formatNumber($order_store->m_point) }}</p>
                                                </div>
                                            </div>
                                            <div class="d-md-flex justify-content-between">
                                                <div class="text-center">
                                                    <p><b>Số Km</b></p>
                                                    <p><small style="visibility:hidden">(Chưa bao gồm thuế VAT
                                                            8%)</small></p>
                                                    <p>{{ $order_store->shipping_distance }} km</p>
                                                </div>
                                                <div class="text-center">
                                                    <p><b>Phí Vận chuyển</b></p>
                                                    <p><small class="font-italic">(Chưa bao gồm thuế VAT 8%)</small>
                                                    </p>
                                                    <p>{{ formatPrice($order_store->shipping_total) }}</p>
                                                </div>
                                                <div class="text-center">
                                                    <p><b>Phí DV GTGT</b></p>
                                                    <p><small class="font-italic">(Đã bao gồm thuế VAT 8%)</small>
                                                    </p>
                                                    <p>{{ formatPrice($order_store->vat_services) }}</p>

                                                </div>
                                                <div class="text-center">
                                                    <p><b>Giá trị thanh toán cho ĐH</b></p>
                                                    <p><small class="font-italic">(Đã bao gồm thuế)</small></p>
                                                    <p>{{ formatPrice($order_store->total) }}</p>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="order-sign">
                                            <div class="order-sign-body d-md-flex justify-content-around">
                                                <div class="order-sign text-center">
                                                    <p><b>Bộ phận Tài vụ</b></p>
                                                    <p><small><b class="font-italic">Đã thu hoàn tất Giá trị giao
                                                                dịch
                                                            </b></small></p>
                                                </div>
                                                <div class="order-sign text-center">
                                                    <p><b>Bộ phận Kho vận</b></p>
                                                    <p><small><b class="font-italic">Đã hoàn tất nhiệm vụ xuất kho
                                                            </b></small></p>
                                                </div>
                                            </div>
                                            <div class="order-sign-body d-md-flex justify-content-around">
                                                <div class="order-sign text-center">
                                                    <p><b>Bộ phận Thu mua</b></p>
                                                    <p><small><b class="font-italic">Đã hoàn tất nhiệm vụ tồn kho
                                                            </b></small></p>
                                                </div>
                                                <div class="order-sign text-center">
                                                    <p><b>Bộ phận Vận chuyển</b></p>
                                                    <p><small><b class="font-italic">Đã hoàn tất nhiệm vụ nhận hàng
                                                            </b></small></p>
                                                </div>
                                                <div class="order-sign text-center">
                                                    <p><b>Bộ phận Kế toán</b></p>
                                                    <p><small><b class="font-italic">Đã hoàn tất nhiệm vụ chứng từ
                                                            </b></small></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 col-12">
                        <div>
                            <h4 class="text-center">TỔNG KẾT</h4>
                        </div>
                        <div class="">
                            <ul>
                                <li>Tổng chiết khấu C: <b>{{ formatPrice($order->c_point) }}</b></li>
                                <li>Tổng Giá trị Sản phẩm: <b>{{ formatPrice($order->sub_total) }}</b></li>
                                <li>Tổng Giảm giá Sản phẩm: <b>{{ formatPrice($order->discount_products) }}</b></li>
                                <li>Tổng Phí DV Vận chuyển: <b>{{ formatPrice($order->shipping_total) }}</b></li>
                                <li>Tổng Phí DV GTGT: <b>{{ formatPrice($order->vat_services) }}</b></li>
                                <li>Tổng chiết khấu M: <b>{{ formatPrice($order->m_point) }}</b></li>
                                <li>Giá trị thanh toán Dịch vụ <b>= Số M cần tìm thêm để miễn phí dịch vụ</b>:
                                    <b>{{ formatPrice($order->total_payment_services) }}</b>
                                </li>
                                <li>Số dư M còn lại: <b>{{ formatNumber($order->remaining_m_point) }}</b></li>
                                <li>Thuế GTGT Sản phẩm: <b>{{ formatPrice($order->vat_products) }}</b></li>
                                <li>Thuế GTGT Dịch vụ:
                                    <b>{{ formatPrice($order->tax_services) }}</b>
                                </li>
                                <li>Tổng Thuế GTGT:
                                    <b>{{ formatPrice($order->total_tax_services) }}</b>
                                </li>
                                <li>Hình thức thanh toán:
                                    <b>{{ App\Models\PaymentMethod::whereId($order->payment_method)->value('name') }}</b>
                                </li>
                                <li>Tổng giá trị Giao dịch: <b>{{ formatPrice($order->total) }}</b></li>

                            </ul>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-12 text-center">
                            <p> --------------------------------------------------------------------------------------------------------------------------
                            </p>
                            <p class="text-justify"> Bằng cách giao dịch với C-Mart, Quý Khách đồng ý ghi nợ khoản giá
                                trị đặt cọc cho
                                C-Mart. Giá
                                trị
                                Đặt cọc sẽ trở thành Giá trị Trả trước (trong giao dịch thành công); hoặc Giá trị Bồi
                                thường
                                theo
                                Hướng dẫn Đặt hàng trước khi hoàn trả (trong trường hợp nguyên nhân từ phía Quý Khách
                                Hàng đơn
                                phương hủy giao dịch, và C-Mart đã tiến hành nhập hàng).
                            </p>
                            <p> --------------------------------------------------------------------------------------------------------------------------
                            </p>
                            <p class="text-center">
                                Quý Khách Hàng vui lòng tham khảo cẩn thận<br>
                                Thao tác khi nhận hàng, Chính sách Đổi - Trả và Chính sách Bảo hành của C-Mart
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
