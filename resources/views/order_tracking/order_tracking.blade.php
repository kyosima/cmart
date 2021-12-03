@extends('layout.master')

@section('title', 'Theo dõi đơn hàng')

@push('css')
    <link href="{{ asset('public/css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-12 col-md-8 order-md-2">
                <div class="checkorder">
                    <h3 class="title">THÔNG TIN ĐƠN HÀNG</h3>
                    @if(isset($error))
                        <div class="alert alert-warning text-center">
                            <b class="text-danger">{{$error}}</b>
                        </div>
                    @endif
                    <form action="" method="get">
                        <div class="write-order form-group">
                            <input value="" type="text" name="order_code" class="form-control ipt-order"
                                placeholder="Nhập mã đơn hàng">
                            <button type="submit" class="btn-check">Tra cứu</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col col-12 col-md-4 order-md-1">
                <div class="check-order">
                    <ul>
                        <li class="active">
                            <a href="#" title="title">
                                <img src="{{ URL::to('public/images/icon1.png') }}" alt="title" class="img-order">
                                <img src="{{ URL::to('public/images/icon1a.png') }}" alt="title" class="hover-order">
                                Theo dõi đơn hàng
                            </a>
                        </li>
                        <li>
                            <a href="#" title="title">
                                <img src="{{ URL::to('public/images/icon1.png') }}" alt="title" class="img-order">
                                <img src="{{ URL::to('public/images/icon1a.png') }}" alt="title" class="hover-order">
                                Chăm sóc khách hàng
                            </a>
                        </li>
                        <li><a href="{{ URL::to('/chinh-sach-van-chuyen') }}" title="Chính sách vận chuyển">Chính sách vận
                                chuyển</a></li>
                        <li><a href="{{ URL::to('/dieu-khoan-giao-dich') }}" title="Điều khoản giao dịch">Điều khoản giao
                                dịch</a></li>
                        <li><a href="{{ URL::to('/phuong-thuc-thanh-toan') }}" title="Phương thức thanh toán">Phương thức
                                thanh toán</a></li>
                        <li><a href="{{ URL::to('/thoi-gian-giao-hang') }}" title="Thời gian giao hàng">Thời gian giao
                                hàng</a></li>
                        <li><a href="{{ URL::to('/chinh-sach-bao-hanh') }}" title="Chính sách bảo hành">Chính sách bảo
                                hành</a></li>
                        <li><a href="{{ URL::to('/chinh-sach-bao-mat') }}" title="Chính sách bảo mật">Chính sách bảo
                                mật</a></li>
                        <li><a href="{{ URL::to('/chinh-sach-doi-tra-va-hoan-tien') }}"
                                title="Chính sách đổi trả và hoàn tiền">Chính sách đổi trả và hoàn tiền</a></li>
                        <li><a href="{{ URL::to('/huong-dan-mua-hang') }}" title="Hướng dẫn mua hàng">Hướng dẫn mua
                                hàng</a></li>
                        <li><a href="{{ URL::to('/quyen-loi-vip') }}" title="Quyền lợi VIP">Quyền lợi VIP</a></li>
                        <li><a href="{{ URL::to('/quy-dinh-ban-hang-tren-website-japana') }}"
                                title="Quy định bán hàng trên Website Japana">Quy định bán hàng trên Website Japana</a></li>
                        <li><a href="{{ URL::to('/cau-hoi-thuong-gap') }}" title="Câu hỏi thường gặp">Câu hỏi thường
                                gặp</a></li>
                    </ul>
                </div>
            </div>

            
        </div>

    </div>
@endsection
