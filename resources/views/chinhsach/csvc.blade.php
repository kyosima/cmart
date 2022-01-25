@extends('layout.master')

@section('title', 'Chính sách vận chuyển')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Chính Sách Vận Chuyển</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container mt-4">
            <div class="row">
                <!--html của chuyện mục thông tin-->
                <div class="col-lg-4 col-md-5 sliderbar  ">
                    <div class="card  w-75  ">
                      @include('layout.sidebarPolicy')

                    </div>

                </div>
                <!--phan ket thuc cua chuyen muc-->
                <div class="col-lg-8  col-md-7 col-12  align-content-center">
                    <div class="btn-content-hidden text-right">
                        <!--nut button chuyen muc an-->
                        <button type="button" class="content-hover btn title " data-toggle="modal"
                            data-target="#rightModal">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    </div>
                    <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
                    <div class="static-detail">
                        <h3 class="title">Chính sách vận chuyển </h3>
                        <div class="detail-static">
                            <h2><strong>CHÍNH SÁCH VẬN CHUYỂN VÀ PHÍ VẬN CHUYỂN TRONG DỊCH COVID-19</strong></h2>
                            <p><em>Trước diễn biến phức tạp của dịch COVID-19 tại TP. Hồ Chí Minh và một số tỉnh thành,
                                    JAPANA cập nhật biểu phí vận chuyển theo khu vực và thời gian giao nhận hàng như
                                    sau:</em></p>
                            <h3><strong>1. Phí vận chuyển và miễn phí vận chuyển</strong></h3>
                            <p><strong>a. Khu vực Thành phố Hồ Chí Minh</strong><br>JAPANA thực hiện hình thức giao nhanh
                                trên các Quận/Huyện&nbsp;Khu vực Thành phố Hồ Chí Minh, <strong>thời gian nhận hàng từ 1-3
                                    ngày</strong> sau khi xác nhận đơn thành công và chỉ áp dụng <strong><a
                                        href="https://japana.vn/phuong-thuc-thanh-toan-static-4.jp" target="_blank">phương
                                        thức thanh toán</a> chuyển khoản</strong>.<br>Biểu phí vận chuyển từng khu vực cụ
                                thể như sau:</p>
                            <p style="text-align: center;" class="card-img ">
                                <img alt="Chính sách vận chuyển"
                                    src="https://japana.vn/uploads/detail/2021/08/images/mien-phi-van-chuyen-cskh-63.jpg"
                                    style="width: 100%; ">
                            </p>
                            <p><strong>b. Khu vực tỉnh/thành khác</strong></p>
                            <ul>
                                <li>Đối với hoá đơn&nbsp;<strong>trên 1.500.000đ&nbsp;</strong>phí vận chuyển sẽ hoàn
                                    toàn&nbsp;<strong>MIỄN PHÍ</strong>.&nbsp;</li>
                                <li>Đối với những hoá đơn&nbsp;<strong>dưới 1.500.000đ: 40.000đ</strong></li>
                            </ul>
                            <p><strong>* Lưu ý:&nbsp;</strong>Trường hợp đối với một số sản phẩm có kích thước và khối lượng
                                nặng, sẽ thu phí vận chuyển cồng kềnh.</p>
                            <h3><strong>2.&nbsp;Thời gian giao nhận hàng</strong></h3>
                            <p>Trước diễn biến phức tạp của dịch COVID-19 tại TP. Hồ Chí Minh và một số tỉnh <strong>thành,
                                    thời gian giao nhận hàng có </strong>thể kéo dài hơn so với thời gian giao hàng dự
                                kiến.&nbsp;<br>Cụ thể như sau:</p>
                            <ul>
                                <li>Áp dụng chính sách giao nhanh khu vực Thành phố Hồ Chí Minh: <strong>1-3 ngày</strong>.
                                </li>
                                <li>Giao hàng khu vực Thành phố Hồ Chí Minh (không áp dụng giao nhanh): <strong>15-30
                                        ngày</strong>.</li>
                                <li>Các tình thành phố khác:&nbsp;<strong>15-30 ngày</strong>.</li>
                            </ul>

                            <p>Chính sách miễn phí vận chuyển được áp dụng cho tất cả các tỉnh thành, huyện xã, trung tâm
                                đến địa phương vùng sâu, trong trường hợp Quý khách hàng khi nhận hàng, hoặc khi thanh toán
                                vẫn còn bị tính phí vận chuyển, vui lòng báo về cho <strong>Siêu Thị Nhật Bản
                                    Japana</strong>&nbsp;theo số Tổng đài : <strong>(028) 7108 8889</strong> để chúng tôi có
                                thể hỗ trợ tối đa cho Quý khách hàng!<br><em><strong>Chúng tôi xin chân thành cảm ơn sự ủng
                                        hộ và đồng hành của Quý khách hàng!</strong></em></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
