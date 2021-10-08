@extends('layout.master')

@section('title', 'Thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/thanhtoan.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
@endpush

@section('content')
    <form action="{{ route('checkout.post') }}" method="post" enctype="multipart/form">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-sm-12 col-12">
                    <div class="card-left">
                        <div class="card-information">
                            <div class="card-information-header">
                                <h3>THÔNG TIN GIAO HÀNG</h3>
                            </div>
                            <hr>
                            <div class="card-information-body">
                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Tên:</label>
                                        <input type="text" class="form-control " placeholder="Bạn chưa nhập họ tên">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tỉnh/ Thành phố:</label>
                                        <input type="text" class="form-control" placeholder="Chọn tỉnh, thành phố">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Phường/ Xã:</label>
                                        <input type="text" class="form-control" placeholder="Chọn phường, xã">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" placeholder="Nhập email">
                                    </div>
                                </div>
                                <div class="col-xl-6 ">
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control" placeholder="Bạn chưa nhập số điện thoại">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quận/ Huyện</label>
                                        <input type="text" class="form-control" placeholder="Chọn quận, huyện">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ</label>
                                        <input type="text" class="form-control" placeholder="Ban chưa nhập địa chỉ">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Ghi chú</label>
                                        <input type="text" class="form-control" placeholder="Nhập ghi chú đơn hàng">
                                    </div>
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
                                    <input type="radio" name="optradio"> <span>COD</span>
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="thanhtoantructuyen">
                                    <input type="radio" name="optradio"> <span>Chuyển khoản qua ngân hàng</span>
                                    <img src="{{ asset('assets/image/vnpay.png') }}">
                                </div>
                                <div class="chuyenkhoan">
                                    <input type="radio" name="optradio"> <span>Chuyển khoản qua ngân hàng</span>
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
                                                <td>1</td>
                                                <td>{{ $row->qty * $row->price }} đ
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
                                        <p class="total"> <span>Tổng cộng:</span> <span
                                                class="total-price">{{ $cart_total }} đ</span> </p>
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
    <script>
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
