@extends('layout.master')

@section('title', 'Câu hỏi thường gặp')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/C-Mart Và Khách Hàng Đặt Biệt</a>
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
            <h3 class="title">C-Mart và khách hàng đặt biệt</h3>
            <div class="detail-static">
                <p style="text-alignt:justify">
                     Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
                </p>
                <p style="text-alignt:justify"> Giao dịch giữa C-Mart và Quý Khách Hàng Đặc Biệt tuân thủ theo các giao kết chung giữa hai bên (gọi chung là "Hợp đồng") cùng các chính sách, quy định, hướng dẫn của C-Mart:

                </p>
                <ul>
                    <li>
                        Bước 1: Quý Khách Hàng được nhận diện theo Chính sách Định danh Khách Hàng, tiến hành đăng ký Hồ Sơ Khách Hàng Đặc Biệt như hướng dẫn tại Hướng dẫn tạo mới HSKH Đặc biệt;
                    </li>
                    <li>Bước 2: Quý Khách Hàng tiến hành giao kết Hợp đồng với C-Mart;</li>
                    <li>Bước 3: C-Mart và Quý Khách Hàng phối hợp hỗ trợ các phương tiện cần thiết để đối phương thực hiện Hợp đồng: thông tin có bản quyền (hình ảnh, nội dung, giấy tờ có liên quan…) về thương hiệu và sản phẩm,...</li>
                    <li>Bước 4: C-Mart và Quý Khách Hàng phối hợp giao nhận, thanh toán, và thực hiện các điều khoản khác theo Hợp đồng;</li>
                    <li>Bước 5: C-Mart và Quý Khách Hàng phối hợp xử trí những vấn đề phát sinh (nếu có).</li>

                </ul>
                <p style="text-alignt:justify"> Quyền lợi của Quý Khách Hàng Đặc Biệt được quy định thỏa 02 mục:</p>
                <ul>
                    <li>⦁	Quyền lợi cơ bản của Khách Hàng;
                    </li>
                    <li>⦁	Khách Hàng Định Danh Thương Mại hoặc Khách Hàng Định Danh Cộng Tác Viên.</li>
                </ul>
                <p style="text-alignt:justify"> Trách nhiệm của Quý Khách Hàng Đặc Biệt được quy định thỏa 03 mục</p>
                <ul>
                    <li>⦁	Trách nhiệm của Khách Hàng ;
                    </li>
                    <li>⦁   Quy định Điều khoản & Điều kiện giao dịch;
                        </li>
                    <li>⦁	Các điều khoản khác theo Hợp đồng.</li>
                </ul>
                <p style="text-alignt:justify"> <strong>VẤN ĐỀ THƯỜNG GẶP » HỒ SƠ KHÁCH HÀNG ĐẶC BIỆT TẠI C-MART</strong></p>
                <p style="text-alignt:justify"><strong>Phí HSKH Đặc Biệt tại C-Mart = MIỄN PHÍ ? Thời gian ?   </strong>	          </p>
                <p style="text-alignt:justify">- HOÀN TOÀN MIỄN PHÍ. C-Mart hỗ trợ MIỄN PHÍ hoàn toàn các thao tác về Hồ Sơ Khách Hàng tại C-Mart, như tạo mới, chỉnh sửa, duy trì,…
                    <br>- Thời gian xét duyệt thao tác diễn ra trong tối đa 24 giờ làm việc (kể từ thời điểm C-Mart xác nhận yêu cầu).
                    </p>
                <p style="text-alignt:justify">
                <strong>Làm sao đây để biết bản thân đã có HSKH Đặc Biệt tại C-Mart hay chưa ?

                    </strong></p>
                <p style="text-alignt:justify">- Quý Khách Hàng truy cập vào Trang cá nhân, và kiểm tra mức Định danh Khách Hàng là: Khách Hàng Thương Mại hoặc Cộng Tác Viên.</p>
                <p style="text-alignt:justify"> Hướng dẫn tạo mới HSKH Đặc Biệt.<strong></strong></p>
                <ul>
                    <li>Bước 1: Quý Khách Hàng thực hiện theo hướng dẫn tại Hướng dẫn tạo mới Hồ Sơ Khách Hàng ;</li>
                    <li>
                        Bước 2: Sau khi đã đăng ký thành công Hồ Sơ Khách Hàng, Quý Khách Hàng vui lòng liên hệ đến kênh giao dịch chính thức của C-Mart, bằng kênh thông tin xác nhận giao dịch với C-Mart để được hỗ trợ ngay và luôn.
                        </li>
                </ul>
                <p style="text-alignt:justify"><strong>Hướng dẫn truy cập HSKH Đặc Biệt.</strong> </p>
                <p style="text-alignt:justify">
                    Quý Khách Hàng thực hiện tương tự theo hướng dẫn tại Hướng dẫn truy cập Hồ Sơ Khách Hàng.
                    </p>
                <p style="text-alignt:justify"><strong>
                    Hướng dẫn quản lý thông tin HSKH Đặc Biệt.
                    </strong></p>
                <p style="text-alignt:justify">Quý Khách Hàng thực hiện tương tự theo hướng dẫn tại Hướng dẫn quản lý Hồ Sơ Khách Hàng.</p>




            </div>
        </div>

        </div>
      </div>
    </div>
  </section>


    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
