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
        <a href="# " class="cs">/Hưỡng Dẫn Đặt Hàng </a>
      </div>
    </div>
  </section>

  <section>
    <div class="container mt-4">
      <div class="row">
        <!--html của chuyện mục thông tin-->
        <div class="col-lg-4 col-md-5 sliderbar  ">
          <div class="card the w-75  ">
            @include('layout.sidebarPolicy')

          </div>

        </div>
        <!--phan ket thuc cua chuyen muc-->
        <div class="col-lg-8  col-md-7 col-12  align-content-center">
        <div class="btn-content-hidden text-right">
          <!--nut button chuyen muc an-->
          <button type="button" class="content-hover btn an  title m-2" data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>
        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
            <h3 class="title">Hướng dẫn đặt hàng </h3>
            <div class="detail-static">
                <p style="text-alignt:justify">Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.</p>

                <p style="text-alignt:justify">❖	Quý Khách Hàng có thể lựa chọn đặt hàng tại C-Mart theo các hình thức:</p>
                <ul>
                  <li>1)	Đặt hàng trực tuyến qua Cửa hàng trực tuyến cm.com.vn (Link đến liên kết): dành cho Khách Hàng Thân Thiết, Khách Hàng V.I.P, Cộng Tác Viên;</li>
                  <li>2)	Đặt hàng trực tuyến qua Kênh Chăm sóc Khách Hàng Trực tuyến C-A-Z dành cho Khách Hàng Chưa Định Danh;</li>
                  <li>3)	Đặt hàng trực tiếp tại C-Store: dành cho Khách Hàng Thương Mại;</li>
                  <li>4)	Đặt hàng qua C-Call 0899302323 (Link đến ứng dụng ĐT): dành cho Khách Hàng Thương Mại;</li>
                  <li>5)	Đặt hàng trực tuyến qua Mạng xã hội C-Facebook (Box chứa liên kết): dành cho Khách Hàng Chưa Định Danh;</li>
                  <li>6)	Đặt hàng trực tuyến qua Mạng xã hội C-Zalo (Box chứa liên kết): dành cho Khách Hàng  Thương Mại, Khách Hàng C-Ship</li>

                </ul>
                <p><strong>I. HƯỚNG DẪN ĐẶT HÀNG TRỰC TUYẾN QUA CỬA HÀNG TRỰC TUYẾN CM.COM.VN (Link đến liên kết)</strong></p>
                <div class="text-center">
                  <p>😀 Người Đặt Hàng bắt buộc phải là chủ nhân Hồ Sơ Khách Hàng đang giao dịch 😀 <br>
                  😀 Dành cho Khách Hàng Thân Thiết, Khách Hàng V.I.P, Cộng Tác Viên 😀</p>
                </div>
                <p style="text-alignt:justify"><strong>1. Tìm Kiếm Sản Phẩm.</strong></p>
                <p style="text-alignt:justify">Cách 1: Tham quan, mua sắm theo ý thích trong Danh mục sản phẩm;</p>
                <p style="text-alignt:justify">Cách 2: Nhập Tên sản phẩm hoặc Mã sản phẩm cần tìm vào thanh công cụ Tìm kiếm ở trên cùng màn hình;</p>
                <p style="text-alignt:justify">Cách 3: Liên hệ các kênh giao dịch chính thức của C-Mart để yêu cầu hỗ trợ.</p>

                <p style="text-alignt:justify"><strong>2. Tìm Hiểu Sản Phẩm:</strong> Nhấn vào Hình ảnh hoặc Tên sản phẩm cần tìm hiểu. </p>

                <p style="text-alignt:justify"><strong>3. Đặt Mua Sản Phẩm.</strong></p>

                <p style="text-alignt:justify">Bước 1: <strong>Chọn đặc điểm, chủng loại sản phẩm</strong> như kích thước, màu sắc, mẫu mã… (nếu có) ;</p>

                <p style="text-alignt:justify">Bước 2: <strong>Chọn số lượng</strong> sản phẩm;</p>

                <p style="text-alignt:justify">Bước 3: <strong>Nhấn Thêm vào giỏ hàng</strong> để chọn sản phẩm.</p>


                <p style="text-alignt:justify"><strong>4. Kiểm Tra Giỏ Hàng:</strong> Trong Giỏ hàng vừa hiện ra trên cửa sổ màn hình mới:</p>

                <ul>
                  <li>●	Thay đổi số lượng	: Nhập điều chỉnh ở mục Số lượng, rồi nhấn <strong>Cập nhật .</strong></li>
                  <li>●	Trả lại sản phẩm về gian hàng	: <strong>Ấn Trả .</strong></li>
                  <li>●	Quay lại tiếp tục mua sắm siêu tiết kiệm	: <strong>Ấn Tiếp tục chọn hàng .</strong></li>
                  <li>●	Hoàn tất mua sắm và thực hiện thanh toán	: <strong>Ấn Đặt hàng .</strong></li>
                </ul>

                <p style="text-alignt:justify"><strong>5. Định danh Khách Hàng - Đặt hàng:</strong> Trong trang Định danh Khách Hàng vừa hiện ra trên cửa sổ màn hình mới:</p>
                <p style="text-alignt:justify"><strong>Trường Hợp 1: Quý Khách Hàng đã có Hồ Sơ Khách Hàng tại C-Mart.</strong></p>
                <ul>
                  <li>Bước 1: Nhấn <strong>Tôi đã có Hồ Sơ Khách Hàng. Thật nhiều quyền lợi !! Hãy như tôi !! </strong>để truy cập Hồ Sơ Khách Hàng;</li>
                  <li>Bước 2: Sau khi truy cập HSKH, tại cửa sổ màn hình mới hiện ra, cung cấp thông tin nhận hàng theo 01 trong 04 cách:</li>
                  <li>
                    <ul>
                      <li>Đánh dấu vào ô <strong>Thông tin nhận hàng giống thông tin đặt hàng</strong> để chọn thông tin nhận hàng là thông tin đặt hàng;</li>
                      <li>Đánh dấu vào ô <strong>Dùng thông tin nhận hàng trước đây</strong> để chọn các thông tin nhận hàng đã lưu trong HSKH;</li>
                      <li>Đánh dấu vào ô Nhận hàng tại Cửa hàng để chọn <strong>nhận hàng tại C-Store</strong> hoặc Cửa hàng phân phối,  và nhập Tên + Địa chỉ Cửa hàng;</li>
                      <li>Hoặc <strong>nhập các thông tin nhận hàng mới</strong> theo trình tự.</li>


                    </ul>
                  </li>
                  <li>Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.</li>
                  <li>Bước 3: Chọn Đơn vị vận chuyển (C-Ship nếu địa chỉ nhận hàng tại TP.HCM, hoặc Vietnam Post nếu địa chỉ nhận hàng khác TP.HCM), Ghi chú cho đơn hàng (nếu có), Thông tin xuất hóa đơn GTGT (nếu có);</li>
                  <li>Bước 4: Nếu cần chỉnh sửa giỏ hàng, nhấn <strong>Quay lại Giỏ hàng.</strong> Nếu không cần thay đổi, nhấn<strong>Tiếp tục Thanh toán;</strong></li>
                  <li>Bước 5: Chọn Phương thức thanh toán, Xem lại đơn hàng và xác nhận đồng ý với 04 chính sách, quy định giao dịch:</li>
                  <li>
                    <ul>
                      <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Giao - Nhận;</strong></li>
                      <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Đổi - Trả;</strong></li>
                      <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Bảo hành;</strong></li>
                      <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Quy định Điều khoản & Điều kiện giao dịch.</strong></li>
                    </ul>
                  </li>
                  <li>Bước 6: Nếu cần chỉnh sửa thông tin, nhấn <strong>Quay lại Trang trước</strong>. Nếu không cần thay đổi, nhấn <strong>Thanh toán</strong> và thực hiện theo trình tự.</li>
                  <li>Bước 7: Hoàn tất đặt hàng sẽ xuất hiện <strong>Thông báo Xác nhận đặt hàng thành công.</strong></li>

                </ul>
                <p style="text-alignt:justify"><strong>Trường Hợp 2: Quý Khách Hàng muốn tạo Hồ Sơ Khách Hàng tại C-Mart để tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                </strong></p>
                <ul>
                    <li>Bước 1: Nhấn <strong>Tôi muốn tạo Hồ Sơ Khách Hàng để xác định quyền lợi !!</strong> ;
                    </li>
                    <li>Bước 2: Tại cửa sổ màn hình mới hiện ra, <strong>nhập các thông tin theo trình tự</strong>;</li>
                    <li>
                        <ul>
                            <li><p style="text-alignt:justify">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.</p>
                            </li>
                        </ul>
                    </li>
                    <li>Bước 3: Tiến hành đăng ký và xác thực Hồ Sơ Khách Hàng theo trình tự như hướng dẫn tại <strong>Hướng dẫn tạo mới Hồ Sơ Khách Hàng</strong>.</li>
                    <li>Bước 4: Sau khi tạo HSKH, tại cửa sổ màn hình mới hiện ra, cung cấp thông tin nhận hàng theo 01 trong 04 cách:</li>
                    <ul>
                        <li>Đánh dấu vào ô <strong>Thông tin nhận hàng giống thông tin đặt hàng</strong> để chọn thông tin nhận hàng là thông tin đặt hàng;</li>
                        <li>Đánh dấu vào ô <strong>Dùng thông tin nhận hàng trước đây</strong> để chọn các thông tin nhận hàng đã lưu trong HSKH;</li>
                        <li>Đánh dấu vào ô <strong>Nhận hàng tại Cửa hàng</strong> để chọn nhận hàng tại C-Store hoặc Cửa hàng phân phối,  và nhập Tên + Địa chỉ Cửa hàng;</li>
                        <li>Hoặc <strong>nhập các thông tin nhận hàng mới</strong> theo trình tự.</li>
                        <ul>
                            <li>Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.</li>
                        </ul>

                    </ul>
                    <li>Bước 6: Chọn Đơn vị vận chuyển (C-Ship nếu địa chỉ nhận hàng tại TP.HCM, hoặc Vietnam Post nếu địa chỉ nhận hàng khác TP.HCM), Ghi chú cho đơn hàng (nếu có), Thông tin xuất hóa đơn GTGT (nếu có);</li>
                    <li>Bước 7: Nếu cần chỉnh sửa giỏ hàng, nhấn <strong>Quay lại Giỏ hàng</strong>. Nếu không cần thay đổi, nhấn <strong>Tiếp tục Thanh toán</strong>;</li>
                    <li>Bước 8: Chọn Phương thức thanh toán, Xem lại đơn hàng và xác nhận đồng ý với 04 chính sách, quy định giao dịch:
                    </li>
                    <ul>
                        <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Giao - Nhận;</strong></li>
                        <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Đổi - Trả;</strong></li>
                        <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Chính sách Bảo hành;</strong></li>
                        <li>Đánh dấu vào ô <strong>Tôi đã đọc và đồng ý với Quy định Điều khoản & Điều kiện giao dịch.</strong></li>

                    </ul>
                    <li>Bước 9: Nếu cần chỉnh sửa thông tin, nhấn <strong>Quay lại Trang trước</strong>. Nếu không cần thay đổi, nhấn <strong>Thanh toán</strong> và thực hiện theo trình tự.</li>
                    <li>Bước 10: Hoàn tất đặt hàng sẽ xuất hiện <strong>Thông báo Xác nhận đặt hàng thành công.</strong></li>

                </ul>




                <p style="text-alignt:justify"><strong>II. HƯỚNG DẪN ĐẶT HÀNG TRỰC TIẾP TẠI C-STORE</strong></p>
                <p style="text-alignt:justify" class="text-center"> 😀 Người Đặt Hàng bắt buộc phải là chủ nhân Hồ Sơ Khách Hàng đang giao dịch 😀<br>
                    😀 Dành cho Khách Hàng Thương Mại 😀
                    </p>
                <p style="text-alignt:justify">Với các nhóm hàng có sẵn tại C-Store, Quý Khách Hàng có thể tiến hành phương thức Mua nhanh – Bán nhanh (Trải nghiệm tại chỗ – Thanh toán ngay tại C-Store), mà vẫn được đảm bảo đầy đủ các chính sách và quyền lợi. Trong tương lai, C-Store sẽ bổ sung đa dạng các nguồn hàng để Khách cần – Khách đến – Khách có đem về.</p>
                <p style="text-alignt:justify">Quý Khách Hàng có thể đến trực tiếp C-Store để đặt hàng, cung cấp phương thức thanh toán, phương thức giao nhận, cũng như các thông tin cần thiết khác.</p>
                <p style="text-alignt:justify"><strong>Trường Hợp 1: Quý Khách Hàng đã có Hồ Sơ Khách Hàng tại C-Mart.</strong></p>
                <ul>
                    <li>⦁  Quý Khách Hàng vui lòng cung cấp Mã Khách Hàng và Giấy tờ tùy thân đã được đăng ký với C-Mart để xác thực giao dịch nhanh chóng và xác định quyền lợi Khách Hàng</li>
                </ul>
                <p style="text-alignt:justify"><strong>Trường Hợp 2: Quý Khách Hàng muốn tạo Hồ Sơ Khách Hàng tại C-Mart để tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.</strong></p>
                <ul>
                    <li>⦁	Quý Khách Hàng vui lòng cung cấp Giấy tờ tùy thân, cũng như các thông tin cần thiết khác để tạo HSKH.
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>
                    III. HƯỚNG DẪN ĐẶT HÀNG QUA KÊNH ĐIỆN THOẠI CHÍNH THỨC CỦA C-MART: C-CALL  0899.30.2323. (Link đến ứng dụng điện thoại)
                    </strong></p>
                <p style="text-alignt:justify" class="text-center"> 😀 Người Đặt Hàng bắt buộc phải là chủ nhân Hồ Sơ Khách Hàng đang giao dịch 😀<br>
                        😀 Dành cho Khách Hàng Thương Mại 😀
                        </p>
                <p style="text-alignt:justify">- Nếu Quý Khách Hàng đã có Hồ Sơ Khách Hàng, Quý Khách Hàng có thể tiến hành đặt hàng ngay và luôn qua Kênh Điện thoại chính thức của C-Mart, mà vẫn được đảm bảo đầy đủ các chính sách và quyền lợi.</p>
                <p style="text-alignt:justify">- Đặt hàng bằng chính Số điện thoại xác nhận giao dịch đã được đăng ký với C-Mart, Quý Khách Hàng chỉ cần đọc Mã Khách Hàng và Mã Giấy tờ tùy thân đã được đăng ký với C-Mart; sau đó cung cấp phương thức thanh toán, phương thức giao nhận, cũng như các các thông tin cần thiết khác.</p>
                <p style="text-alignt:justify"><strong>IV. HƯỚNG DẪN ĐẶT HÀNG QUA MẠNG XÃ HỘI C-ZALO CHÍNH THỨC CỦA C-MART. (Box chứa liên kết Zalo)
                </strong></p>
                <p style="text-alignt:justify" class="text-center"> 😀 Người Đặt Hàng bắt buộc phải là chủ nhân Hồ Sơ Khách Hàng đang giao dịch 😀<br>
                    😀 Dành cho Khách Hàng Thương Mại 😀
                    </p>
                <p style="text-alignt:justify">- Nếu Quý Khách Hàng đã có Hồ Sơ Khách Hàng, Quý Khách Hàng có thể tiến hành đặt hàng ngay và luôn qua Mạng xã hội Zalo chính thức của C-Mart, mà vẫn được đảm bảo đầy đủ các chính sách và quyền lợi.</p>
                <p style="text-alignt:justify">- Đặt hàng bằng chính Tài khoản xác nhận giao dịch đã được đăng ký với C-Mart, Quý Khách Hàng chỉ cần Call chân dung, cung cấp Mã Khách Hàng + Ảnh giấy tờ tùy thân đã được đăng ký với C-Mart; sau đó cung cấp phương thức thanh toán, phương thức giao nhận, cũng như các các thông tin cần thiết khác</p>
                <p style="text-alignt:justify"><strong>
                    V. HƯỚNG DẪN ĐẶT HÀNG QUA KÊNH CHĂM SÓC KHÁCH HÀNG TRỰC TUYẾN C-A-Z, HOẶC MẠNG XÃ HỘI C-FACEBOOK CHÍNH THỨC CỦA C-MART. (Box chứa liên kết Facebook)
                    </strong></p>
                <p style="text-alignt:justify" class="text-center"> 😀 Người Đặt Hàng bắt buộc phải là chủ nhân Hồ Sơ Khách Hàng đang giao dịch 😀<br>
                        😀 Dành cho Khách Hàng Thương Mại 😀
                        </p>
                <p style="text-alignt:justify">- Quý Khách Hàng chưa có Hồ Sơ Khách Hàng có thể đặt hàng qua Kênh Chăm sóc Khách Hàng Trực tuyến C-A-Z hoặc Mạng xã hội Facebook chính thức của C-Mart. Nhân viên của C-Mart sẽ hỗ trợ Quý Khách Hàng ngay và luôn</p>
                <p style="text-alignt:justify"><strong>VẤN ĐỀ THƯỜNG GẶP » ĐẶT HÀNG CÙNG C-MART</strong></p>
                <p style="text-alignt:justify"><strong>Phí đặt hàng tại C-Mart = MIỄN PHÍ ?
                </strong></p>
                <p style="text-alignt:justify">- HOÀN TOÀN MIỄN PHÍ. C-Mart cung cấp MIỄN PHÍ hoàn toàn các thao tác đặt hàng, từ hỗ trợ, tư vấn, cung cấp, phản hồi thông tin, tìm hàng hóa theo yêu cầu, cho đến xử lý đơn hàng, thậm chí kéo dài đến quá trình hậu mãi,... nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ 3, chi phí theo thỏa thuận (nếu có).</p>
                <p style="text-alignt:justify"><strong>Làm sao đây để biết bản thân đã đặt hàng thành công hay chưa ?
                </strong></p>
                <p style="text-alignt:justify">- <strong>Cách 1</strong>: Khi đặt hàng thành công trên website, Quý Khách Hàng sẽ nhận được <strong>Thông Báo Xác Nhận Đặt Hàng Thành Công</strong>. Hoặc khi đặt hàng qua các kênh giao dịch chính thức khác, C-Mart sẽ trực tiếp thông báo đến Quý Khách Hàng</p>
                <p style="text-alignt:justify">- <strong>Cách 2</strong>: Nhập Mã giao dịch vào công cụ Kiểm tra Đơn hàng trong mục Hỗ Trợ C-A-Z. Nếu đơn hàng trong trạng thái <strong>Đã Đặt Hàng</strong>, thì đơn hàng đã được đặt thành công;
                </p>
                <p style="text-alignt:justify">- <strong>Cách 3</strong>: Truy cập Lịch sử Đơn hàng trong Hồ Sơ Khách Hàng, Quý Khách Hàng nhấn vào cột Trạng thái của đơn hàng cần tra cứu. Nếu đơn hàng trong trạng thái <strong>Đã Đặt Hàng</strong>, thì đơn hàng đã được đặt thành công.</p>

                <p style="text-align:justify" class="text-center"><strong>Quản lý Lịch sử đơn hàng, Chủ động tra cứu quá trình xử lý đơn hàng
                </strong></p>
                <p style="text-alignt:justify"><strong>* Đối với các đơn hàng qua C-Facebook, C-A-Z</strong>: C-Mart sẽ cung cấp Mã vận chuyển giúp Quý Khách Hàng có thể trực tiếp tra cứu quá trình vận chuyển đơn hàng. Đồng thời, C-Mart cũng sẽ cập nhật liên tục hành trình đơn hàng đến Quý Khách Hàng qua Zalo.

                </p>
                <p style="text-alignt:justify"><strong>* Đối với các đơn hàng qua C-Facebook, C-A-Z</strong>: C-Mart sẽ cung cấp Mã vận chuyển giúp Quý Khách Hàng có thể trực tiếp tra cứu quá trình vận chuyển đơn hàng. Đồng thời, C-Mart cũng sẽ cập nhật liên tục hành trình đơn hàng đến Quý Khách Hàng qua chính Số điện thoại đặt hàng.
                </p>
                <p style="text-alignt:justify" ><strong>* Đối với các đơn hàng qua Website cm.com.vn:
                </strong></p>
                <p style="text-alignt:justify">- Cách 1: Nhập Mã giao dịch vào công cụ <strong>Kiểm tra Đơn hàng</strong> trong mục Hỗ Trợ C-A-Z.
                </p>
                <p style="text-alignt:justify">- Cách 2: Truy cập <strong>Lịch sử Đơn hàng</strong> trong Hồ Sơ Khách Hàng, Quý Khách Hàng nhấn vào cột Trạng thái của đơn hàng cần tra cứu.
                </p>
                <p style="text-alignt:justify"><strong>* Chú giải các trạng thái đơn hàng:</strong></p>
                <p style="text-alignt:justify"><strong>+ Đã Đặt Hàng</strong>: Đơn hàng đã được đặt thành công
                </p>
                <p style="text-alignt:justify"><strong>+ Đã Xác Nhận Thanh Toán</strong>: Đơn hàng đã hoàn tất trả trước như lựa chọn khi đặt hàng.

                </p>
                <p style="text-alignt:justify"><strong>+ Đang Xử Lý</strong>:  Đơn hàng đang được C-Mart xử lý ban đầu.</p>
                <p style="text-alignt:justify"><strong>+ Đang Vận Chuyển</strong>: Đơn hàng đã bàn giao cho Đơn vị vận chuyển</p>
                <p style="text-alignt:justify"><strong>+ Hoàn Thành</strong>: Đơn hàng đã được giao hàng thành công.</p>
                <p style="text-alignt:justify"><strong>+ Đã hủy</strong>: Đơn hàng đã bị hủy.</p>
                <p style="text-alignt:justify"><strong>Bổ sung yêu cầu, Thay đổi thông tin về đơn hàng
                </strong></p>
                <ul>
                    <li>Cách 1: Điền vào mục Ghi chú khi đặt hàng.
                    </li>
                    <li>Cách 2: Liên hệ đến kênh giao dịch chính thức của C-Mart, bằng Số điện thoại đặt hàng hoặc Số điện thoại nhận hàng, gửi yêu cầu kèm Mã giao dịch.</li>
                </ul>
                <p style="text-alignt:justify">- Thời gian xét duyệt thao tác diễn ra trong tối đa 02 giờ làm việc (kể từ thời điểm C-Mart xác nhận yêu cầu), C-Mart sẽ phản hồi đến kênh thông tin đặt hàng và/hoặc kênh thông tin nhận hàng, và cập nhật hệ thống (nếu có).</p>
                <p style="text-alignt:justify">- C-Mart chưa hỗ trợ thay đổi Thông tin Đặt hàng, Thông tin Nhận hàng nằm ngoài tuyến đường, Thông tin Sản phẩm, Hóa đơn GTGT, Phương thức Thanh toán. Quý Khách Hàng vui lòng hủy đơn hàng để tạo lại đơn mới.</p>
                <p style="text-alignt:justify"><strong>Hủy đặt hàng</strong></p>
                <p style="text-alignt:justify">- Quý Khách Hàng không nên đơn phương hủy giao dịch, do Quý Khách Hàng phải chịu trách nhiệm do đơn phương hủy Hợp đồng đã giao kết.</p>
                <p style="text-alignt:justify">- Đồng thời, về phía C-Mart buộc phải đưa ra các chính sách hạn chế đối với Quý Khách Hàng theo một hoặc không giới hạn các điều khoản sau:
                </p>
                <ul>
                    <li>⦁	Bồi thường thiệt hại phát sinh: từ 100% giá trị đặt cọc, giá trị Tài khoản Tiền Tích Lũy, công nợ, hay các biện pháp truy thu vi phạm Hợp đồng khác ;
                    </li>
                    <li>⦁	Tiến trình xác nhận giao dịch cẩn thận, chi tiết hơn trong tương lai;
                    </li>
                    <li>⦁	Từ chối thanh toán Trả sau, thanh toán bằng Voucher/Coupon;</li>
                    <li>
                        ⦁	Ngưng hỗ trợ các chính sách Giá shock, Giá buôn, Công nợ linh hoạt;
                        </li>

                    <li>⦁	Từ chối sự tham gia của Quý Khách Hàng trong các sự kiện, chương trình ưu đãi - khuyến mãi của C-Mart;
                    </li>
                    <li>
                        ⦁	Từ chối đặt hàng theo nhu cầu (order);
                        </li>
                    <li>⦁	Hạ bậc hoặc hủy Định danh Khách Hàng.
                    </li>
                    <li>
                        ⦁	Đưa thông tin Khách Hàng, thông tin thiết bị… vào “Danh sách giao dịch xấu” cùng các chính sách hạn chế khác.
                        </li>
                    <li>
                        ⦁	Xử lý theo quy trình về Pháp luật có liên quan.
                        </li>




                </ul>
                <p style="text-alignt:justify">
                    - Thay vào đó, C-Mart có thể thỏa thuận hỗ trợ theo nhu cầu của Quý Khách Hàng.
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
