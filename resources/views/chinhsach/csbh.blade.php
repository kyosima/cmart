@extends('layout.master')

@section('title', 'Chính sách bảo hành')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Chính Sách Bảo Hành</a>
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
                        <h3 class="title">Chính sách bảo hành</h3>
                        <div class="detail-static">
                            <p style="text-align:justify"><strong>I. ĐIỀU KIỆN BẢO HÀNH:</strong></p>

                            <p style="text-align:justify">1. Sản phẩm được bảo hành miễn phí nếu sản phẩm đó hội đủ các điều
                                kiện sau:</p>

                            <p style="text-align:justify">- Sản phẩm bị lỗi kỹ thuật do nhà sản xuất</p>

                            <p style="text-align:justify">- Còn trong thời hạn bảo hành</p>

                            <p style="text-align:justify">- Còn giữ hóa đơn mua hàng Siêu Thị Nhật Bản JAPANA</p>

                            <p style="text-align:justify">- Phiếu bảo hành phải còn nguyên vẹn, không chấp vá, bôi xóa, sửa
                                chữa.</p>

                            <p style="text-align:justify">- Phiếu bảo hành đầy đủ thông tin: kiểu máy, số seri, ngày sản
                                xuất, tên khách hàng sử dụng, địa chỉ, ngày mua (đối với các sản phẩm không áp dụng Bảo hành
                                điện tử)</p>

                            <p style="text-align:justify">- Tem bảo hành (và tem niêm phong) của nhà sản xuất trên sản phẩm
                                còn nguyên vẹn.</p>

                            <p style="text-align:justify">2. Những trường hợp không được bảo hành hoặc phát sinh phí bảo
                                hành:</p>

                            <p style="text-align:justify">- Vi phạm một trong những điều kiện bảo hành miễn phí ở mục 1.<br>
                                - Số series, model sản phẩm không khớp với Phiếu bảo hành.<br>
                                - Khách hàng tự ý can thiệp sửa chữa sản phẩm hoặc sửa chữa tại những trung tâm bảo hành
                                không được sự ủy nhiệm của Hãng.<br>
                                - Sản phẩm bị hư hỏng do lỗi người sử dụng, và lỗi hư không nằm trong phạm vi bảo hành của
                                nhà sản xuất</p>

                            <p style="text-align:justify"><strong>II. THỜI HẠN BẢO HÀNH:</strong></p>

                            <p style="text-align:justify">Thời hạn bảo hành được tính kể từ ngày mua hàng hoặc kể từ ngày
                                sản xuất tùy thuộc từng loại sản phẩm được quy định rõ trên phiếu bảo hành. Đối với sản phẩm
                                bảo hành điện tử, thời hạn bảo hành được tính từ thời điểm kích hoạt bảo hành điện tử.</p>

                            <p style="text-align:justify"><strong>III. TRUNG TÂM BẢO HÀNH:</strong></p>

                            <p style="text-align:justify">Thông tin của trung tâm bảo hành sẽ được ghi trong phiếu bảo hành
                                kèm theo sản phẩm. Quý khách vui lòng liên hệ trực tiếp với trung tâm bảo hành có trên phiếu
                                bảo hành.</p>

                            <p style="text-align:justify">Trong trường hợp sản phẩm được phân phối trực tiếp từ các Đại lý,
                                quý khách vui lòng trực tiếp liên hệ với đại lý đó để được hỗ trợ bảo hành trong thời gian
                                nhanh nhất. Mọi thông tin của đại lý được ghi trên phiếu biên nhận giao hàng được đính kèm
                                trong thùng hàng.</p>

                            <p style="text-align:justify">Nếu quý khách gặp khó khăn trong việc liên hệ trung tâm bảo hành,
                                xin quý khách vui lòng liên hệ bộ phận Chăm sóc khách hàng theo tổng
                                đài&nbsp;<strong>(028)&nbsp;7108 8889</strong></p>

                            <p style="text-align:justify">Trong trường hợp quý khách ở quá xa trung tâm bảo hành hoặc gặp
                                các vấn đề bất tiện không thể đến trung tâm bảo hành trực tiếp, quý khách có thể gửi sản
                                phẩm về Japana.vn, chúng tôi sẽ hỗ trợ gửi sản phẩm đi bảo hành giúp quý khách..</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
