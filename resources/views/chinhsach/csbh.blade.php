@extends('layout.master')

@section('title', 'CHÍNH SÁCH BẢO HÀNH CỦA C-MART')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/CHÍNH SÁCH BẢO HÀNH CỦA C-MART</a>
      </div>
    </div>
  </section>

  <section>
    <div class="container mt-4">
      <div class="row">
        <!--html của chuyện mục thông tin-->
        <div class="col-lg-4 col-md-5 sliderbar  ">
          <div class="card the  w-75  ">
            @include('layout.sidebarPolicy')

          </div>

        </div>
        <!--phan ket thuc cua chuyen muc-->
        <div class="col-lg-8  col-md-7 col-12  align-content-center">
        <div class="btn-content-hidden text-right">
          <!--nut button chuyen muc an-->
          <button type="button" class="content-hover btn an title m-2" data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>
        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
            <h3 class="title">Chính sách bảo hành</h3>
            <div class="detail-static">
                <p style="text-align:justify">Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
                </p>
                <p style="text-align:justify">C-Mart sẽ phát huy vai trò nhà phân phối trung gian bảo vệ quyền lợi Khách Hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                </p>
                <p style="text-align:justify"><strong>1. ĐIỀU KIỆN BẢO HÀNH:</strong></p>

                <p style="text-align:justify"><strong>1.1 Sản phẩm được bảo hành MIỄN PHÍ nếu thỏa mãn TẤT CẢ các điều kiện sau:</strong></p>

                <p style="text-align:justify">⦁	Chính sách bảo hành sản phẩm vẫn còn hiệu lực</p>

                <p style="text-align:justify">⦁	Thông tin sản phẩm trùng khớp với thông tin bảo hành</p>

                <p style="text-align:justify">⦁	Phiếu bảo hành (nếu có) còn nguyên vẹn, rõ ràng và đầy đủ thông tin, không có bất kỳ dấu hiệu khác biệt nào so với bản gốc, mà không phải do chủ thể chịu trách nhiệm theo quy định (như gạch xóa, sửa chữa...)</p>

                <p style="text-align:justify">⦁	Tem bảo hành và Tem niêm phong (nếu có) trên sản phẩm còn nguyên vẹn, rõ ràng và đầy đủ thông tin, không có bất kỳ dấu hiệu khác biệt nào so với bản gốc, mà không phải do chủ thể chịu trách nhiệm theo quy định (như gạch xóa, sửa chữa...)</p>

                <p style="text-align:justify">⦁ Bảo hành do lỗi Nhà sản xuất</p>

                <p style="text-align:justify">⦁	Sản phẩm còn nguyên vẹn, không có dấu hiệu bị sửa chữa, hoặc các hành vi có cùng tính chất, do cá nhân/tổ chức không có chức năng bảo hành theo quy định</p>

                <p style="text-align:justify">⦁	Sản phẩm thỏa mãn các chính sách, quy định, hướng dẫn của Nhà sản xuất, Nhà cung cấp, C-Mart</p>

                <p style="text-align:justify">⦁	Sản phẩm không được bảo hành hoặc sẽ phát sinh phí bảo hành nếu Không Thỏa Mãn Một Trong Các Điều Kiện Bảo Hành ở Mục 1.1.</p>

                <p style="text-align:justify">→ C-Mart sẽ cung cấp các thông tin hướng dẫn đến Quý Khách Hàng, hỗ trợ Quý Khách Hàng tiến hành bảo hành sản phẩm một cách nhanh chóng, tiện lợi.
                </p>

                <p style="text-align:justify"><strong>2. PHƯƠNG THỨC BẢO HÀNH: </strong></p>

                <p style="text-align:justify"><strong>2.1 Đối với những sản phẩm được quy định cụ thể chủ thể chịu trách nhiệm bảo hành.</strong></p>

                <p style="text-align:center"><strong>Địa Điểm Bảo Hành</strong></p>

                <p style="text-align:justify">– Quý Khách Hàng vui lòng liên hệ trực tiếp đến Kênh Bảo hành của sản phẩm.
                </p>
                <p style="text-align:justify">– C-Mart sẽ cung cấp các thông tin hướng dẫn đến Quý Khách Hàng, hỗ trợ Quý Khách Hàng tiến hành bảo hành sản phẩm một cách nhanh chóng, tiện lợi.
                </p>
                <p style="text-align:center"><strong>Thời Gian Và Chi Phí Bảo Hành</strong></p>

                <p style="text-align:justify">Trong mọi trường hợp, thời gian bảo hành sản phẩm phụ thuộc vào chính sách và/hoặc mức độ sẵn có của thiết bị và/hoặc sản phẩm thay thế tại Kênh Bảo hành.
                </p>
                <p style="text-align:justify">→ Kênh Bảo hành sẽ chịu trách nhiệm thông báo cụ thể mọi thông tin bảo hành đến Quý Khách Hàng. </p>

                <p style="text-align:justify"><strong>2.2. Đối với những sản phẩm còn lại.</strong></p>
                <p style="text-align:justify">– Quý Khách Hàng vui lòng liên hệ đến các kênh giao dịch chính thức của C-Mart, bằng kênh thông tin nhận hàng để được hỗ trợ ngay và luôn.                </p>



            </div>
        </div>


        </div>
      </div>
    </div>
  </section>












  <!--Phần Slider Của Chuyên Mục THông Tin -->





    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
