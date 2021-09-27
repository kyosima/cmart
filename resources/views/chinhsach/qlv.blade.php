@extends('layout.master')

@section('title', 'Quyền lợi VIP')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush


@section('content')

    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Quyền Lợi Vip</a>
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
                        <button type="button" class="content-hover btn title m-2" data-toggle="modal"
                            data-target="#rightModal">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    </div>
                    <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
                    <div class="static-detail">
                        <h3 class="title">Quyền lợi VIP</h3>
                        <div class="detail-static">
                            <p>Nhằm mang đến cho&nbsp;khách hàng thân thiết của Japana được mua hàng với&nbsp;những dịch vụ
                                tốt nhất, chúng tôi đưa ra các Ưu Đãi&nbsp;tương ứng với cấp độ VIP&nbsp;như sau:</p>

                            <ul>
                                <li><strong>VIP&nbsp;Gold:</strong> Giảm 3% trên tất cả đơn hàng&nbsp;(điều kiện tổng số
                                    tiền đã mua là 10.000.000đ)</li>
                                <li><strong>VIP&nbsp;Platinum: </strong>Giảm 4%&nbsp; trên tất cả đơn hàng&nbsp;(điều kiện
                                    tổng số tiền đã mua là 30.000.000đ)</li>
                                <li><strong>VIP&nbsp;Diamond:</strong> Giảm 5% trên tất cả đơn hàng&nbsp;(điều kiện tổng số
                                    tiền đã mua là 50.000.000đ)</li>
                            </ul>

                            <p><em><strong>Chúng tôi xin chân thành cảm ơn sự ủng hộ và đồng hành của Quý khách
                                        hàng!</strong></em></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
