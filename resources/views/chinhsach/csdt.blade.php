@extends('layout.master')

@section('title', 'Chính sách đổi trả')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Chính Sách Đổi Trả Và Hoàn Tiền </a>
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
                        <h3 class="title">Chính sách đổi trả và hoàn tiền</h3>
                        <div class="detail-static">
                            <h3>1. Điều kiện đổi trả hàng:</h3>

                            <p>Hiểu được sự ngần ngại/lo lắng của khách hàng về tính xác thực của hàng hóa khi mua sắm trực
                                tuyến, Siêu thị Nhật Bản Japana.vn hỗ trợ chính sách đồng kiểm, áp dụng với tất cả các sản
                                phẩm được bán tại website Japana <strong>(Không áp dụng với các sản phẩm được niêm phong bởi
                                    nhà sản xuất).</strong></p>

                            <p>Trước khi chấp nhận và thanh toán cho một đơn hàng, khách hàng của Japana có quyền yêu cầu
                                được mở thùng hàng để kiểm tra hàng hóa bên trong có đúng với thông tin đặt hàng hay không.
                                Các thông tin bao gồm: Số lượng, chủng loại (Model), màu sắc, kích thước, hình thức, tính
                                nguyên vẹn của hàng hóa.</p>

                            <p>Các bước kiểm tra sâu hơn như sử dụng thử sản phẩm có thể được tiến hành sau khi Quý khách đã
                                thanh toán cho đơn hàng.</p>

                            <p>Kể từ thời gian nhận hàng, Quý khách có quyền từ chối nhận hàng và thực hiện đổi/trả hàng
                                theo điều kiện đổi/trả hàng được cụ thể bên dưới. Quý khách hãy liên hệ ngay với bộ phận
                                Chăm sóc khách hàng của chúng tôi để được hỗ trợ kịp thời.</p>

                            <p><strong>*** LƯU Ý: </strong>Thông tin trọng lượng của sản phẩm được thể hiện trên website là
                                trọng lượng tương đối, chỉ mang ý nghĩa tham khảo (giúp khách hàng hình dung rõ hơn về sản
                                phẩm), không có ý nghĩa cho việc kiểm tra, đổi trả lại hàng hóa.&nbsp;</p>

                            <ul>
                                <li>Điều kiện đổi hàng:</li>
                            </ul>

                            <p style="text-align: center;"><img class="card-img" style="width:100%"
                                    alt="CHÍNH SÁCH ĐỔI TRẢ VÀ HOÀN TIỀN"
                                    src="https://japana.vn/uploads/detail/2021/05/images/2.png"></p>

                            <p style="text-align: center;"><img class="card-img" style="width:100%"
                                    alt="Chính sách đổi trả và hoàn tiền"
                                    src="https://japana.vn/uploads/detail/2020/05/images/adsadadsa.png"></p>

                            <ul>
                                <li>Điều kiện trả hàng:</li>
                            </ul>

                            <p style="text-align: center;"><img alt="CHÍNH SÁCH ĐỔI TRẢ VÀ HOÀN TIỀN"
                                    src="https://japana.vn/uploads/detail/2021/05/images/1.png"
                                    style="width: 800px; height: 465px;"></p>

                            <h3>2. Phương thức đổi trả hàng:</h3>

                            <p>Trong thời gian còn hiệu lực đổi trả hàng, Quý khách vui lòng thực hiện các bước sau để được
                                đổi trả hàng:</p>

                            <p><strong>- Bước 1: </strong>Liên hệ trực tiếp với nhân viên Tư vấn bán hàng qua Tổng đài:
                                <strong>(028) 7108 8889</strong> để được hỗ trợ kịp thời.
                            </p>

                            <p><strong>- Bước 2: </strong>Chụp và gửi hình ảnh sản phẩm để xác nhận tình trạng hàng hoá.</p>

                            <p><strong>- Bước 3: </strong>Sau khi yêu cầu đổi trả hàng được chấp thuận, quý khách vui lòng
                                đóng gói cẩn thận và gửi qua đường bưu điện hoặc phương tiện vận chuyển khác về cho chúng
                                tôi theo địa chỉ:</p>

                            <p>+ Người nhận: Siêu thị Nhật Bản Japana.vn</p>

                            <p>+ Địa chỉ: Tòa nhà Trường Thịnh Group, Số 76 Nguyễn Háo Vĩnh, P. Tân Quý, Q. Tân Phú, TP.
                                HCM.</p>

                            <p><strong>- Bước 4: </strong>Quý khách vui lòng đóng gói bao bì cẩn thận, tránh trầy xước, hỏng
                                bể, bong tróc hay bám bẩn so với lúc xác nhận chấp thuận đổi trả lại hàng.</p>

                            <p><strong>* LƯU Ý: </strong>Nếu sản phẩm gửi trả về bị hỏng, bể, trầy xước, bong tróc, bám
                                bẩn,... có thay đổi so với thời điểm xác nhận chấp thuận đổi trả lại hàng, chúng tôi có
                                quyền từ chối nhận đổi trả.</p>

                            <h3>3. Chính sách hoàn tiền:</h3>

                            <p>Siêu thị Nhật Bản Japana.vn <strong>cam kết hoàn tiền 200% </strong>nếu sản phẩm kém chất
                                lượng, không chính hãng.</p>

                            <p>Ngay sau khi đơn hàng huỷ trả khách hàng gửi về được chúng tôi xác nhận, <strong>trong vòng
                                    07 ngày làm việc</strong>, Siêu thị Nhật Bản Japana.vn sẽ chuyển trả lại toàn bộ số tiền
                                cho sản phẩm/đơn hàng mà quý khách đã thanh toán.</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
