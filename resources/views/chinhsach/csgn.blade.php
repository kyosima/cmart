@extends('layout.master')

@section('title', 'Chính Sách Giao - Nhận')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/Chính Sách Giao - Nhận</a>
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
          <h3 class="title">Chính sách giao - nhận </h3>
          <div class="detail-static">
                <p style="text-align:justify">Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
                    </p>
                <p style="text-align:justify">	Với các nhóm hàng có sẵn tại C-Store, Quý Khách Hàng có thể tiến hành phương thức Mua nhanh – Bán nhanh (Trải nghiệm tại chỗ – Thanh toán ngay tại C-Store), mà vẫn được đảm bảo đầy đủ các chính sách và quyền lợi. Trong tương lai, C-Store sẽ bổ sung đa dạng các nguồn hàng để Khách cần – Khách đến – Khách có đem về.
                </p>
                <p style="text-align:justify">	C-Mart với 02 đơn vị vận chuyển là C-Ship (nếu địa chỉ nhận hàng tại TP.HCM) và Vietnam Post (nếu địa chỉ nhận hàng khác TP.HCM) sẽ cung cấp đa dạng các phương thức giao nhận, hỗ trợ Quý Khách Hàng lựa chọn phương thức giao nhận phù hợp nguyện vọng, tiện lợi và nhanh chóng:</p>
                <ul>
                    <li>Giao hàng đến địa điểm yêu cầu: Địa điểm nhận hàng là vị trí cụ thể theo nhu cầu của Quý Khách Hàng;</li>
                    <li>Dùng thông tin nhận hàng giống thông tin đặt hàng;</li>
                    <li>Dùng thông tin nhận hàng trước đây;</li>
                    <li>Nhận hàng tại Cửa hàng (C-Store hoặc Cửa hàng phân phối): Quý Khách Hàng sẽ đến trực tiếp C-Store hoặc Cửa hàng phân phối đã lựa chọn để nhận hàng /sử dụng dịch vụ. Quý Khách Hàng vui lòng ghi chú thời gian nhận hàng cụ thể;</li>
                    <li>Giao hàng đến địa điểm bên trung gian khác (chành xe, kho bãi…): Quý Khách Hàng vui lòng ghi chú địa điểm nhận hàng cụ thể, và các thông tin cần thiết khác. </li>
                    <li><strong>Quý Khách Hàng lưu ý C-Mart xin phép miễn trừ hoàn toàn trách nhiệm khi Quý Khách Hàng lựa chọn hình thức nhận hàng này.
                    </strong></li>

                </ul>
                <p style="text-align:justify"><strong>VẤN ĐỀ THƯỜNG GẶP » GIAO NHẬN CÙNG C-MART</strong></p>
                <ul>
                    <li><strong>Phí giao hàng:</strong> Thông tin sẽ được thể hiện cụ thể khi đặt hàng trên website. Hoặc Quý Khách Hàng sẽ được thông báo trong quá trình đặt hàng.
                    </li>
                    <li>
                       <strong>Thời gian giao hàng:</strong> Quý Khách Hàng tra cứu nội dung trong Trang giới thiệu sản phẩm.
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Chủ động tra cứu quá trình xử lý đơn hàng
</strong></p>
                <p style="text-alignt:justify"><strong>* Đối với các đơn hàng qua C-Store, C-Call, C-Zalo: </strong>C-Mart sẽ cung cấp Mã vận chuyển giúp Quý Khách Hàng có thể trực tiếp tra cứu quá trình vận chuyển đơn hàng. Đồng thời, C-Mart cũng sẽ cập nhật liên tục hành trình đơn hàng đến Quý Khách Hàng qua Zalo.
</p>

                <p style="text-alignt:justify"><strong>* Đối với các đơn hàng qua C-Facebook, C-A-Z:</strong> C-Mart sẽ cung cấp Mã vận chuyển giúp Quý Khách Hàng có thể trực tiếp tra cứu quá trình vận chuyển đơn hàng. Đồng thời, C-Mart cũng sẽ cập nhật liên tục hành trình đơn hàng đến Quý Khách Hàng qua chính Số điện thoại đặt hàng..</p>

                <p style="text-alignt:justify"><strong>* Đối với các đơn hàng qua Website cm.com.vn:</strong><br>
- Cách 1: Nhập Mã giao dịch vào công cụ <strong>Kiểm tra Đơn hàng</strong> trong mục Hỗ Trợ C-A-Z.<br>
- Cách 2: Truy cập <strong>Lịch sử Đơn hàng</strong> trong Hồ Sơ Khách Hàng, Quý Khách Hàng nhấn vào cột <strong>Trạng thái</strong> của đơn hàng cần tra cứu.
</p>

                <p style="text-alignt:justify">* Chú giải các trạng thái đơn hàng:<br>
                <strong>+ Đã Đặt Hàng</strong>Đơn hàng đã được đặt thành công<br>
                 <strong> + Đã Xác Nhận Thanh Toán</strong>: Đơn hàng đã hoàn tất trả trước như lựa chọn khi đặt hàng<br>

                    <strong>+ Đang Xử Lý</strong>: Đơn hàng đang được C-Mart xử lý ban đầu.<br>
                    <strong>+ Đang Vận Chuyển</strong>: Đơn hàng đã bàn giao cho Đơn vị vận chuyển<br>
                <strong> + Hoàn Thành</strong>: Đơn hàng đã được giao hàng thành công.<br>
                <strong>+ Đã hủy</strong>: Đơn hàng đã bị hủy.









                </p>
                <p style="text-alignt:justify"><strong>⦁	Chọn thời gian giao hàng, Bổ sung yêu cầu, Thay đổi thông tin giao nhận</strong></p>
                <ul>
                    <li>⦁	Cách 1: Điền vào mục Ghi chú khi đặt hàng.</li>
                    <li>⦁	Cách 2: Liên hệ đến kênh giao dịch chính thức của C-Mart, bằng Số điện thoại đặt hàng hoặc Số điện thoại nhận hàng, gửi yêu cầu kèm Mã giao dịch.</li>
                    <li>⦁	Cách 3: Bổ sung thêm yêu cầu khi Nhân viên Giao nhận liên hệ trước khi giao hàng.</li>
                </ul>
                <p style="text-alignt:justify">

                - Thời gian xét duyệt thao tác diễn ra trong tối đa 02 giờ làm việc (kể từ thời điểm C-Mart xác nhận yêu cầu), C-Mart sẽ phản hồi đến kênh thông tin đặt hàng và/hoặc kênh thông tin nhận hàng, và cập nhật hệ thống (nếu có).
<br>- C-Mart chưa hỗ trợ thay đổi Thông tin Đặt hàng, Thông tin Nhận hàng nằm ngoài tuyến đường. Quý Khách Hàng vui lòng hủy đơn hàng để tạo lại đơn mới.
<br>- Yêu cầu chọn thời gian giao hàng: C-Mart sẽ cố gắng đạt được thỏa thuận với Đơn vị vận chuyển. Do Đơn vị vận chuyển là đối tác độc lập, và luôn trong trạng thái khẩn trương giao hàng đến Quý Khách Hàng, nên sẽ khó tránh khỏi những sơ suất trong một số thời điểm. Xin hãy giữ liên lạc như giữ kết nối yêu thương.

                </p>

                <p style="text-alignt:justify"><strong>Thao tác khi nhận hàng</strong></p>
                <ul>
                    <li>Người Nhận Hàng vui lòng chứng minh nhân thân để nhận hàng, đồng thời kiểm tra danh tính của Nhân viên Giao nhận;</li>

                    <li>Vui lòng kiểm tra cẩn thận hàng hóa khi nhận hàng để đảm bảo quyền lợi:
</li>
                    <li>
                        <ul>
                            <li>⦁	Kiểm tra ngoại quan, niêm phong, đóng gói,... → bảo đảm sản phẩm nguyên bản, không bị tráo đổi hay thất thoát;
</li>
                            <li>⦁	Vui lòng kiểm tra Số lượng và Chất lượng sản phẩm theo Chính sách Đổi - Trả;</li>
                            <li>
⦁	Phối hợp với Nhân viên Giao nhận cùng <strong>đồng kiểm đơn hàng</strong>. Bắt buộc quay video kiện hàng có chữ ký NVGN làm điều kiện bảo đảm quyền lợi Khách Hàng về sau.
</li>




                        </ul>
                    </li>

                    <li>Thực hiện theo Chính sách Đổi - Trả (nếu có);</li>
                    <li>Kiểm tra cẩn thận trước khi tiến hành thanh toán: các thông tin, phương thức thanh toán, công cụ thanh toán;</li>
                    <li>Thực hiện thanh toán theo nhu cầu đã lựa chọn của Quý Khách Hàng, phù hợp Chính sách Thanh toán của C-Mart:</li>
                    <li>
                        <ul>
                            <li>⦁	Cơ chế thanh toán bằng Tiền mặt;</li>
                            <li>⦁	Cơ chế thanh toán bằng Tiền Tích Lũy;</li>
                            <li>⦁	Cơ chế thanh toán bằng Thẻ Thanh Toán C-Card;
</li>
                            <li>⦁	Cơ chế thanh toán bằng Voucher/Coupon;</li>
                            <li>⦁	Cơ chế thanh toán bằng Thẻ ngân hàng, QR Pay;</li>

                        </ul>
                    </li>
                    <li>
Vui lòng lưu giữ hóa đơn chứng từ chứng minh giao dịch nhằm đảm bảo quyền lợi Khách Hàng về sau.</li>


                </ul>



          </div>
        </div>

        </div>
      </div>
    </div>
  </section>












    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
