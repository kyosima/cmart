@extends('layout.master')

@section('title', 'Hướng dẫn mua hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Hướng Dẫn Mua Hàng </a>
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
                        <h3 class="title">Hướng dẫn mua hàng</h3>
                        <div class="detail-static">
                            <p>Quý khách có thể đặt mua hàng trực tuyến tại&nbsp;website <a
                                    href="https://japana.vn">Japana.vn</a> thông qua các bước đơn giản sau</p>

                            <h3><strong>1. Tìm kiếm sản phẩm:</strong></h3>

                            <p>Qúy khách có thể tìm sản phẩm theo&nbsp;3 cách:&nbsp;</p>

                            <p>a. Gõ tên sản phẩm vào thanh tìm kiếm</p>

                            <p>b. Tìm theo danh mục</p>

                            <p>c. Tìm theo các sản phẩm mới nhất, bán chạy hoặc danh mục phổ biến trên từng ngành hàng</p>

                            <h3><strong>2. Thêm sản phẩm vào giỏ hàng:</strong></h3>

                            <p>Khi đã tìm được sản phẩm mong muốn, quý khách vui lòng bấm vào hình hoặc tên sản phẩm để vào
                                được trang thông tin chi tiết của sản phẩm, sau đó:</p>

                            <p>a. Kiểm tra thông tin sản phẩm: giá, thông tin khuyến mãi.&nbsp;</p>

                            <p>b. Chọn số lượng mong muốn.&nbsp;</p>

                            <p>c. Thêm sản phẩm vào giỏ hàng.</p>

                            <h3><strong>3. Kiểm tra giỏ hàng:</strong></h3>

                            <p>Trong giỏ hàng thể hiện đầy đủ thông tin số lượng sản phẩm và tổng giá trị tiền hàng. Quý
                                khách vui lòng kiểm tra đúng sản phẩm, số lượng và giá trị tiền hàng.&nbsp;</p>

                            <p>Tại giỏ hàng, Quý khách có thể chọn mua thêm sản phẩm khác hoặc chọn huỷ một sản phẩm bất kỳ.
                            </p>

                            <h3><strong>4. Điền thông tin địa chỉ giao nhận hàng:</strong></h3>

                            <p>Quý khách phải điền đầy đủ thông tin của người mua và nhận hàng, Chúng tôi&nbsp;cam kết sẽ
                                giữ bí mật thông tin cá nhân của quý khách.</p>

                            <p>Trên cơ sở thông tin quý khách cung cấp, <strong>Siêu Thị Nhật Bản Japana.vn</strong> sẽ tiến
                                hành các thủ tục còn lại để giao hàng</p>

                            <h3><strong>5. Phương thức thanh toán:</strong></h3>

                            <p>Hiện tại&nbsp;<strong>Siêu Thị Nhật Bản Japana.vn</strong> có các&nbsp;hình thức thanh toán
                                cho khách hàng lực chọn:</p>

                            <p>- Thanh toán khi nhận hàng (COD) - Áp dụng toàn quốc.</p>

                            <p>- Thanh toán trực tiếp tại Văn phòng đại diện Công ty CP Japana Việt Nam</p>

                            <p>Nếu các thông tin trên đã chính xác, quý khách&nbsp;vui lòng&nbsp;bấm "Đặt&nbsp;Mua", hệ
                                thống sẽ bắt đầu tiến hành tạo đơn hàng dựa trên các thông tin quý khách đã đăng ký.</p>

                            <h3><strong>6. Kiểm tra và xác nhận đơn hàng:</strong></h3>

                            <p>Quý khách có thể vào email của mình&nbsp;để nhận thư xác nhận đặt hàng</p>

                            <h3><strong>7. Hoàn tất đơn hàng:</strong></h3>

                            <p>Sau khi đơn hàng đã được xác nhận bằng email, bộ phận chăm sóc khách hàng của <strong>Siêu
                                    Thị Nhật Bản Japana.vn&nbsp;</strong>sẽ gọi điện trực tiếp cho quý khách hàng thông qua
                                số điện thoại mà quý khách hàng đã cung cấp để xác nhận lại&nbsp;một lần nữa về đơn hàng.
                            </p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
