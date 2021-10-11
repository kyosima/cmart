@extends('layout.master')

@section('title', '/C-MART & ĐỐI TÁC')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/C-MART & ĐỐI TÁC</a>
      </div>
    </div>
  </section>

  <section>
    <div class="container mt-4">
      <div class="row">
        <!--html của chuyện mục thông tin-->
        <div class="col-lg-4 col-md-5 sliderbar  ">
          <div class=" card the  w-75  ">
            @include('layout.sidebarPolicy')

            </div>
        </div>

        
        <!--phan ket thuc cua chuyen muc-->
        <div class="col-lg-8  col-md-7 col-12  align-content-center">
        <div class="btn-content-hidden text-right">
          <!--nut button chuyen muc an-->
          <button type="button" class="content-hover btn an title " data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>
        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
          <h3 class="title">C-MART & ĐỐI TÁC </h3>
          <div class="detail-static">
            <p style="text-alignt:justify">Giao dịch giữa C-Mart và Quý Đối Tác tuân thủ theo các giao kết chung giữa hai bên (gọi chung là "Hợp đồng") cùng các chính sách, quy định, hướng dẫn của C-Mart:
            </p>
            <ul>
                <li>Bước 1: Quý Đối Tác tiến hành giao kết Hợp đồng với C-Mart;
                </li>
                <li>Bước 2: Quý Đối Tác và C-Mart phối hợp hỗ trợ các phương tiện cần thiết để đối phương thực hiện Hợp đồng: thông tin có bản quyền (hình ảnh, nội dung, giấy tờ có liên quan…) về thương hiệu và sản phẩm,...
                </li>
                <li>Bước 3: C-Mart và Quý Đối Tác phối hợp giao nhận, thanh toán và thực hiện các điều khoản khác theo Hợp đồng;</li>
                <li>Bước 4: C-Mart và Quý Đối Tác phối hợp xử trí những vấn đề phát sinh (nếu có).</li>
            </ul>
            <p style="text-alignt:justify"><strong> Quyền lợi của Quý Đối Tác.
            </strong></p>
            <ul>
                <li>⦁	Được giới thiệu, quảng bá, phân phối thương hiệu và sản phẩm, mở rộng thị trường đến mọi vị trí địa lý, kết nối - chinh phục đến mọi đối tượng, tầng lớp trong xã hội một cách nhiệt tình, rộng rãi;</li>
                <li>⦁	C-Mart sẽ là đại diện làm cầu nối giữa Khách Hàng – Đối Tác trên các phương diện;
                     </li>
                <li> ⦁	Tham gia vào chuỗi thương mại được liên kết chặt chẽ, rộng khắp, chuyên nghiệp, lành mạnh, hiệu quả; góp phần xây dựng môi trường văn hoá tiêu dùng: văn minh - tuyệt vời, phổ thông - tiện lợi, giá trị tối ưu;
                </li>
                <li>⦁	Các quyền lợi khác theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.</li>


            </ul>
            <p style="text-alignt:justify"><strong>Trách nhiệm của Quý Đối Tác.
            </strong></p>
            <p style="  text-alignt:justify">⦁	Chịu mọi trách nhiệm về sản phẩm, về doanh nghiệp, và các thông tin do Quý Đối Tác cung cấp cho C-Mart, cùng các vấn đề liên quan trong mọi trường hợp;</p>
            <p style="text-alignt:justify">
                ⦁	Phối hợp với C-Mart hoàn thành thành công Hợp đồng;
                </p>
            <ul>
                <li>	Cho phép C-Mart quyền giới thiệu, quảng bá doanh nghiệp, sản phẩm của Quý Đối Tác.</li>
                <li>

Quý Đối Tác cần bồi thường thiệt hại cho C-Mart nếu Quý Đối Tác vi phạm giao kết Hợp đồng, các chính sách, quy định, hướng dẫn của C-Mart.

                </li>
            </ul>
            <p style="text-alignt:justify">
                    Cung cấp, cập nhật nhanh chóng, chính xác và đầy đủ các thông tin cần thiết;
            </p>

            <ul>
                    <li>⦁	Tạo điều kiện cho C-Mart xác thực thông tin Đối Tác và các sản phẩm cung cấp.
                    </li>
                    <li>⦁	Cung cấp các thông tin bản quyền và các phương tiện để C- Mart hoàn thành thành công Hợp đồng.</li>
                    <li>⦁	Bằng cách giao dịch với C-Mart, Quý Đối Tác đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy các kênh kết nối được Quý Đối Tác đăng ký với C-Mart, thì mọi giao dịch, giao kết từ các kênh này đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Đối Tác. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Đối Tác qua các kênh kết nối trên.</li>


            </ul>
            <p style="text-alignt:justify">⦁	Phối hợp với C-Mart xử trí những vấn đề phát sinh giữa C-Mart và Quý Đối Tác (nếu có);</p>
            <ul>
                <li>⦁	Tự bảo mật, chịu hoàn toàn trách nhiệm, thường xuyên theo dõi các thông tin tài khoản, thông tin giao dịch, thông tin thông báo đến kênh kết nối được Quý Đối Tác đăng ký với C-Mart.</li>

                <li>⦁	Ngay khi phát hiện các dấu hiệu bất thường, Quý Đối Tác cần thông báo ngay và luôn với C-Mart và các chủ thể có liên quan để phối hợp xử lý kịp thời.
                </li>


            </ul>
            <p style="text-alignt:justify">⦁	Phối hợp với C-Mart ngăn chặn những hành vi vi phạm các chính sách, quy định, hướng dẫn của C-Mart, gây ảnh hưởng đến C-Mart và/hoặc các chủ thể liên quan;
                ⦁	Các trách nhiệm khác theo Trách nhiệm của Khách Hàng, Quy định Điều khoản & Điều kiện giao dịch, các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
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
