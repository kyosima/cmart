@extends('layout.master')

@section('title', 'Tra cứu đơn hàng')

@push('css')
    <link href="{{ asset('css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="container">
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
                    <ul>
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
                </li>
            </ul>
        </div>
        <main class="checkorder content">
            <h3 class="title">THÔNG TIN ĐƠN HÀNG</h3>
            <form action="" method="get">
                <div class="write-order form-group">
                    <input value="chEMwk" type="text" name="code" class="form-control ipt-order"
                        placeholder="Nhập mã đơn hàng">
                    <button type="submit" class="btn-check">Tra cứu</button>
                </div>
            </form>
            <div class="box-order">
                <div class="top-order">
                    <p><span>Mã đơn hàng:</span> chEMwk</p>
                    <p><span>Tình trạng đơn hàng:</span> <span class="action-order">
                            <b style="color:#15b02a">Mới đặt</b> </span></p>
                </div>

                <div class="middle-order">
                    <ol class="progress">
                        <li class=" 
                            ">
                            <p>
                                Mới đặt <span>2021-09-22 09:53:58</span>
                            </p>
                        </li>
                        <li class="pause-complete 
                            ">
                            <p>
                                Đã xác nhận <span></span>
                            </p>
                        </li>
                        <li class="pause-complete 
                            ">
                            <p>
                                Đang xử lý <span></span>
                            </p>
                        </li>
                        <li class="pause-complete 
                            ">
                            <p>
                                Đang giao hàng <span></span>
                            </p>
                        </li>
                        <li class="pause-complete 
                            ">
                            <p>
                                Giao hàng thành công <span></span>
                            </p>
                        </li>
                    </ol>
                </div>

                <div class="box-infocart list-order">
                    <h3 class="title">Thông tin đơn hàng:</h3>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th style="width: 373px; border">Tên sản phẩm</th>
                                <th style="width: 84px;">Số lượng</th>
                                <th style="width: 143px;">Thành tiền</th>
                            </tr>


                        </tbody>
                    </table>
                    <div class="box-allprice box-price-order">
                        <p>Tạm tính:<span> 0 đ</span></p>
                        <p>Phí vận chuyển:<span> + 20.000 đ</span></p>
                        <p class="last-price">Tổng cộng: <span>175.000 đ</span></p>
                    </div>
                </div>


            </div>
        </main>
        <!-- Detail DVVC -->
        <div class="custom_modal modal fade" id="DVVC" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="box-modal">
                            <p class="title-log">Thông tin giao hàng</p>
                            <p class="intro-log" style="color:#000;"><b>Đơn vị giao:</b> </p>
                            <p class="intro-log" style="color:#000;"><b>Mã vận đơn:</b> </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
