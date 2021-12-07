@extends('layout.master')

@section('title', 'Phương thức thanh toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Phương Thức Thanh Toán</a>
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
                        <h3 class="title">Phương thức thanh toán</h3>
                        <div class="detail-static">
                            <p>Nhằm mang đến Quý khách những trải nghiệm mua sắm trực tuyến tuyệt vời nhất&nbsp;tại Siêu thị
                                Nhật Bản&nbsp;Japana.vn, chúng tôi có các&nbsp;phương thức thanh toán để Quý khách dễ dàng
                                lựa chọn:</p>

                            <p>1. Thanh toán bằng tiền mặt khi nhận hàng (COD)</p>

                            <p>2. Thanh toán trực tiếp tại Văn phòng Công ty JAPANA Việt Nam</p>

                            <p>3. Thanh toán qua tài khoản Ngân hàng</p>

                            <p>4. Thanh toán bằng Ví điện tử VNPAY</p>

                            <h3><strong>I. Thanh toán bằng tiền mặt khi nhận hàng (COD)&ZeroWidthSpace;</strong></h3>

                            <p>COD là viết tắt của Cash On Delivery, nghĩa là thanh toán khi nhận hàng. Với phương thức
                                thanh toán này, Quý khách trả tiền mặt cho nhân viên giao hàng ngay khi nhận được đơn hàng
                                của mình. Chúng tôi chấp nhận hình thức thanh toán khi nhận hàng (COD) cho tất cả các đơn
                                hàng trên phạm vi toàn quốc.</p>

                            <p><strong>**Lưu ý:</strong> Chỉ áp dụng cho đơn hàng có tổng giá trị nhỏ hơn 10 triệu đồng. Nếu
                                đơn hàng trên 10 triệu đồng, Quý khách hàng&nbsp;vui lòng chọn hình thức thanh toán khác.
                            </p>

                            <p>Đơn giản. An toàn. Không chút rắc rối mà lại an tâm tuyệt đối khi Quý khách hàng&nbsp;chọn
                                thanh toán COD.</p>

                            <h3><strong>II. Thanh toán trực tiếp tại Văn phòng&nbsp;Công ty Japana Việt Nam</strong></h3>

                            <p>Quý khách hàng&nbsp;có thể đến trực tiếp văn phòng Công Ty Cổ Phần&nbsp;Japana Việt Nam tại
                                địa chỉ: Số 76 đường Nguyễn Háo Vĩnh, Quận Tân Phú, Tp. HCM và gặp trực tiếp nhân viên thu
                                ngân để thanh toán.</p>

                            <h3><strong>III. Thanh toán qua tài khoản Ngân hàng</strong></h3>

                            <p>Hình thức thanh toán qua tài khoản Ngân hàng cho các đơn hàng giá trị lớn và theo yêu cầu quý
                                khách.&nbsp;Đây là hình thức thanh toán bằng việc chuyển tiền từ tài khoản của Quý khách
                                hàng&nbsp;vào tài khoản của Công ty Cổ Phần&nbsp;Japana Việt Nam thông qua Ngân Hàng.</p>

                            <p>Tại trang web của&nbsp;<a href="https://japana.vn">Japana.vn</a>, sau khi Quý khách hàng tiến
                                hành chọn sản phẩm và chọn mua hàng, tại trang cung cấp&nbsp;thông tin giao hàng. Các tư vấn
                                viên hỗ trợ của&nbsp;Japana&nbsp;sẽ cung cấp cho quý khách số tài khoản của
                                Japana.vn&nbsp;tại&nbsp;các Ngân hàng mà&nbsp;<strong>Công Ty Cổ Phẩn Japana Việt
                                    Nam</strong>&nbsp;chấp nhận thanh toán, Quý khách hàng&nbsp;có thể lựa&nbsp;chọn Ngân
                                hàng phù hợp nhất với mình để tiến hành thanh toán cho đơn hàng đã chọn.</p>

                            <p><strong>** Lưu ý: </strong>Khi Quý khách hàng chọn Phương thức thanh toán qua Ngân hàng, Đễ
                                tránh nhầm lẫn do có nhiều đơn hàng,&nbsp;đề nghị Quý khách hàng&nbsp;ghi "Số Đơn Hàng" của
                                đơn hàng&nbsp;đã được chúng tôi cung cấp cho Quý khách hàng&nbsp;qua email xác nhận đơn
                                hàng&nbsp;trong nội dung thanh toán.</p>

                            <p><strong>Thông tin Ngân hàng:</strong></p>

                            <p><img alt="Kết quả hình ảnh cho vcb" class="card-img" style="width: 50%"
                                    src="data:image/jpeg;base64,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">
                            </p>

                            <ul>
                                <li>Tên Ngân Hàng: <strong>Ngân Hàng Vietcombank Chi Nhánh Tân Bình</strong></li>
                                <li>Chủ Tài Khoản: <strong>Công Ty Cổ Phần&nbsp;Japana Việt Nam</strong></li>
                                <li>Số Tài Khoản:<strong>&nbsp;044&nbsp;1000 776 006</strong></li>
                            </ul>

                            <h3><strong>IV.&nbsp;Thanh toán bằng Ví điện tử VNPAY</strong></h3>

                            <p>Quý khách hàng khi mua hàng tại Japana có thể lựa chọn phương thức thanh toán bằng Ví điện tử
                                VNPAY. Bạn chỉ cần quét mã QR và xác nhận số tiền, vậy là bạn đã hoàn thành thanh toán một
                                cách đơn giản, nhanh gọn.</p>

                            <p>Quý khách hàng có bất cứ thắc mắc, vấn đề trong quá trình thanh toán&nbsp;vui lòng liên hệ
                                Japana theo số Tổng đài <strong>(028) 7108 8889,</strong> để chúng tôi có thể hỗ trợ tối đa
                                cho Quý khách hàng!</p>

                            <p><em><strong>Chúc Quý khách có trải nghiệm mua sắm hàng Nhật thật tuyệt vời tại
                                        JAPANA!</strong></em></p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
