@extends('layout.master')

@section('title', 'Chính Sách Đổi Trả')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/Chính Sách Đổi Trả </a>
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
            <h3 class="title">Chính Sách Đổi Trả </h3>
            <div class="detail-static">
                <p style="text-alignt:justify">

 Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì <strong>mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách</strong>. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.



                </p>
                <p style="text-alignt:justify">
                    C-Mart sẽ phát huy vai trò nhà phân phối trung gian bảo vệ quyền lợi Khách Hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                    </p>
                <p style="text-alignt:justify" class="text-center" ><strong>CHÍNH SÁCH ĐỔI SẢN PHẨM <br>
                    Nguyên nhân do C-Mart, do Nhà cung cấp, do Nhà sản xuất.
                    </strong> </p>
                <p style="text-alignt:justify"><strong>
                    Trường hợp 1a: Người Nhận Hàng ĐANG thực hiện thủ tục nhận hàng:
                    </strong></p>
                <p style="text-alignt:justify">Đơn hàng <strong>sai sót có thể phát hiện ngay vào thời điểm nhận hàng</strong>, như mất niêm phong, đóng gói, sai chủng loại sản phẩm, sai đặc điểm sản phẩm, hư hỏng ngoại quan, hết giá trị sử dụng,...</p>
                <p style="text-alignt:justify"><strong>* Điều kiện:</strong> </p>
                <p style="text-alignt:justify">
                    Các lỗi sản phẩm chưa được C-Mart công bố đến Quý Khách Hàng dưới mọi hình thức;
                    <br>	Sản phẩm thỏa mãn các quy định kèm theo;
                    <br>	Hoàn sản phẩm, các loại phụ kiện, giấy tờ kèm theo, tặng phẩm,... Nguyên Vẹn Như Khi Được Giao Tới (không kể đến đai kiện đóng gói).
                    </p>
                <p style="text-alignt:justify"><strong>→ Người Nhận Hàng: </strong></p>
                <ul>
                    <li>⦁	Vui lòng <strong>phối hợp</strong> với <strong>Nhân viên Giao nhận cùng xác thực</strong>; đồng thời <strong>ghi rõ tình trạng, chữ ký NVGN</strong> lên trên kiện hàng và/hoặc hóa đơn C-Bill;</li>
                    <li>
                        ⦁	Vui lòng <strong>quay video </strong>kiện hàng có nội dung trên,<strong> liên hệ</strong> kèm mã giao dịch đến kênh điện thoại chính thức của C-Mart để được hỗ trợ ngay và luôn;
                        </li>
                    <li>⦁	Vui lòng tiến hành <strong>hoàn trả kiện hàng</strong> ngay cho Nhân viên Giao nhận.
                    </li>



                </ul>
                <p style="text-alignt:justify"><strong>→ C-Mart sẽ khẩn trương xác minh, phản hồi với Người Nhận Hàng</strong> để xử lý đơn hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.</p>


                <p style="text-alignt:justify">
                    	Đơn hàng sai sót <strong>về số lượng.</strong>
                     </p>
                <p style="text-alignt:justify"><strong>
                    → Người Nhận Hàng:
                    </strong></p>

                <ul>
                    <li>⦁	Vui lòng<strong> phối hợp</strong> với <strong>Nhân viên Giao nhận cùng xác thực</strong>; đồng thời <strong>ghi rõ tình trạng, có chữ ký NVGN</strong> lên trên kiện hàng và/hoặc hóa đơn C-Bill;</li>
                    <li>
                        ⦁	Vui lòng <strong>quay video</strong> kiện hàng có nội dung trên, </strong>liên hệ kèm mã giao dịch đến kênh điện thoại chính thức của C-Mart để được hỗ trợ ngay và luôn;
                        </li>
                    <li>⦁	Vui lòng tiếp nhận phần còn lại của đơn hàng, hoặc hoàn trả kiện hàng ngay cho Nhân viên Giao nhận như được<strong> hướng dẫn tại thời điểm.</strong>
                    </li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <p style="text-alignt:justify"><strong> → C-Mart sẽ khẩn trương liên hệ với Người Nhận Hàng</strong> để giao bổ sung sản phẩm, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.</p>
                <p style="text-alignt:justify"><strong>Trường hợp 2a: Người Nhận Hàng ĐÃ thực hiện thủ tục nhận hàng:
                </strong></p>
                <p style="text-alignt:justify;margin-left:2%" >	Sản phẩm bị Lỗi Sản Xuất không thể phát hiện ngay vào thời điểm nhận hàng (lỗi cấu tạo, lỗi nội dung, lỗi phần mềm kỹ thuật,...).
                    <br>	Sản phẩm Không Thể Sử Dụng Được (kèm bằng chứng cụ thể).
                    </p>
                <p style="text-alignt:justify"><strong>* Điều kiện:</strong></p>
                <p style="text-alignt:justify;margin-left:2%">⦁	Các lỗi sản phẩm chưa được C-Mart công bố đến Quý Khách Hàng dưới mọi hình thức;
                    	Sản phẩm thỏa mãn các quy định kèm theo;
                    <br>	Thời gian từ Thời điểm giao hàng thành công (dựa theo dữ liệu vận chuyển) đến Thời điểm gửi đổi sản phẩm (dựa theo xác nhận của đơn vị giao nhận hoặc thời điểm C-Mart trực tiếp nhận sản phẩm) là 72 Giờ;
                    <br>	Hoàn sản phẩm, các loại phụ kiện, giấy tờ kèm theo, tặng phẩm,...
                     </p>
                <ul>
                    <li>⦁	Tất cả còn đầy đủ, rõ ràng, nguyên vẹn, <strong>không bị ảnh hưởng đến việc “tái xuất”;</strong></li>
                    <li>⦁	Sản phẩm chưa có dấu hiệu sử dụng nhiều lần hay hư hại do Quý Khách Hàng, không lưu lại các dấu vết hay mùi vị lạ, chưa qua vệ sinh, <strong>không bị ảnh hưởng đến việc “tái xuất”.</strong></li>





                </ul>
                <p style="text-alignt:justify">
                    →<strong> Người Nhận Hàng </strong>vui lòng cung cấp<strong> dữ liệu quay video</strong> kiện hàng có chữ ký NVGN, <strong>liên hệ</strong> kèm mã giao dịch đến các kênh giao dịch chính thức của C-Mart, bằng kênh thông tin nhận hàng để được hỗ trợ ngay và luôn.
                    <br>→ <strong>C-Mart sẽ khẩn trương xác minh, phản hồi với Người Nhận Hàng</strong> để xử lý đơn hàng, phát huy vai trò nhà phân phối trung gian bảo vệ quyền lợi Khách Hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                    </p>
                <p style="text-alignt:justify;margin-left:2%"><strong>⦁	Nguyên nhân do Người Đặt Hàng.
                </strong></p>
                <p style="text-alignt:justify"><strong>Trường hợp 1b: Giai đoạn từ khi Đơn hàng được đặt thành công, chưa vận chuyển:
                    <br>* Điều kiện:
                    </strong></p>
                <p style="text-alignt:justify;margin-left:2%">Trang giới thiệu sản phẩm thể hiện thông tin cho phép đổi - trả;
                    <br>	Sản phẩm thỏa mãn các quy định kèm theo.
                    </p>
                <p style="text-alignt:justify"><strong>→ Người Đặt Hàng: </strong></p>
                <ul>
                    <li>
                        ⦁	Vui lòng<strong> kèm mã giao dịch đến kênh điện thoại chính thức của C-Mart, bằng kênh thông tin đặt hàng để được hỗ trợ ngay và luôn;
                    </li>
                    <li>
                        ⦁	Vui lòng <strong>thanh toán phụ phí</strong> đã được thỏa thuận khi C-Mart liên hệ để hỗ trợ Quý Khách Hàng = 10% Giá trị sản phẩm + Phí nhập kho + Phí DVTT (nếu có) (chưa bao gồm VAT).
                    </li>
                </ul>
                <p style="text-alignt:justify">→<strong> C-Mart sẽ khẩn trương liên hệ với Người Đặt Hàng</strong> để xử lý đơn hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                </p>
                <p style="text-alignt:justify"><strong>Trường hợp 2b: Giai đoạn từ khi Đơn hàng được vận chuyển → Người Nhận Hàng ĐANG thực hiện thủ tục nhận hàng:
                    <br>* Điều kiện:
                    </strong></p>
                <p style="text-alignt:justify;margin-left:2%">
                    	Trang giới thiệu sản phẩm thể hiện thông tin cho phép đổi - trả;
                    <br>	Sản phẩm thỏa mãn các quy định kèm theo;
                    <br>	Hoàn sản phẩm, các loại phụ kiện, giấy tờ kèm theo, tặng phẩm,... <strong>Nguyên Vẹn Như Khi Được Giao Tới (nguyên vẹn cả đai kiện đóng gói).
                    </strong>   </p>

                <p style="text-alignt:justify"><strong>
                    → Người Đặt Hàng:
                    </strong></p>
                <ul>
                    <li>⦁	Vui lòng<strong> liên hệ</strong> kèm mã giao dịch đến kênh điện thoại chính thức của C-Mart, bằng kênh thông tin đặt hàng để được hỗ trợ ngay và luôn;</li>
                    <li>⦁	Vui lòng<strong> thanh toán phụ phí </strong>đã được thỏa thuận khi C-Mart liên hệ để hỗ trợ Quý Khách Hàng = 10% Giá trị sản phẩm + Phí vận chuyển + Phí DVTT (nếu có) (chưa bao gồm VAT).</li>




                </ul>
                <p style="text-alignt:justify"><strong>
                    → Người Nhận Hàng:
                    </strong></p>
                <ul>
                    <li>⦁		Vui lòng <strong>không ký nhận</strong> đơn hàng;</li>
                    <li>⦁
                        	Vui lòng<strong> hoàn trả kiện hàng</strong> ngay cho Nhân viên Giao nhận.
                        </li>




                </ul>


                <p style="text-alignt:justify">
                    →<strong> C-Mart sẽ khẩn trương phản hồi với Người Đặt Hàng</strong> để xử lý đơn hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
                    </p>
                <p style="text-alignt:justify"><strong>
                    Trường hợp 3b: Người Nhận Hàng ĐÃ thực hiện thủ tục nhận hàng:
                    <br>* Điều kiện:
                    </strong></p>
                <p style="text-alignt:justify;margin-left:2%">

	Trang giới thiệu sản phẩm thể hiện thông tin cho phép đổi - trả;
<br>Sản phẩm thỏa mãn các quy định kèm theo;
<br>	Thời gian từ Thời điểm giao hàng thành công (dựa theo dữ liệu vận chuyển) đến Thời điểm gửi đổi sản phẩm (dựa theo xác nhận của đơn vị giao nhận hoặc thời điểm C-Mart trực tiếp nhận sản phẩm) là 24 Giờ;
<br>	Hoàn sản phẩm, các loại phụ kiện, giấy tờ kèm theo, tặng phẩm,...
</p>
                <ul>
                    <li>⦁	Tất cả còn đầy đủ, rõ ràng, nguyên vẹn, <strong>không bị ảnh hưởng đến việc “tái xuất”;</strong></li>
                    <li>⦁	Sản phẩm chưa có dấu hiệu sử dụng nhiều lần hay hư hại do Quý Khách Hàng, không lưu lại các dấu vết hay mùi vị lạ, chưa qua vệ sinh, <strong>không bị ảnh hưởng đến việc “tái xuất”.</strong></li>
                </ul>

                <p style="text-alignt:justify"><strong>→ Người Đặt Hàng: </strong></p>
                <p style="text-alignt:justify;margin-left:2%">
                    	Vui lòng liên hệ kèm mã giao dịch đến kênh điện thoại chính thức của C-Mart, bằng kênh thông tin đặt hàng để được hỗ trợ ngay và luôn;
                    <br>	Vui lòng thanh toán phụ phí đã được thỏa thuận khi C-Mart liên hệ để hỗ trợ Quý Khách Hàng = 10% Giá trị sản phẩm + Phí vận chuyển + Phí DVTT (nếu có) (chưa bao gồm VAT).
                    </p>

                <p style="text-alignt:justify">
                    →<strong> C-Mart sẽ khẩn trương phản hồi với Người Đặt Hàng để xử lý đơn hàng</strong>, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.                    </p>
                <p style="text-alignt:justify" class="text-center"><strong>QUY TRÌNH ĐỔI SẢN PHẨM</strong></p>
                <p style="text-alignt:justify"><strong>Trường hợp Đơn hàng chưa được vận chuyển:
                </strong></p>
                <ul>
                  <li>⦁	<strong>Bước 1</strong>: Quý Khách Hàng vui lòng thực hiện theo Trường hợp 1b;
                  </li>
                  <li>⦁	<strong>Bước 2</strong>: Sau khi xử lý yêu cầu, C-Mart sẽ phản hồi và gửi Biên bản xác nhận đến kênh thông tin đặt hàng;
                  </li>
                  <li>⦁	<strong>Bước 3</strong>: Quý Khách Hàng vui lòng thanh toán phụ phí (nếu có), và lưu giữ chứng từ thanh toán;

                  </li>
                  <li>⦁	<strong>Bước 4</strong>: Kể từ thời điểm C-Mart tiếp nhận khoản thanh toán (nếu có), trong khoảng thời gian thỏa thuận, C-Mart sẽ tiến hành đổi hàng đến Quý Khách Hàng.

                  </li>

                </ul>
                <p style="text-alignt:justify"><strong>Trường hợp Đơn hàng đang được vận chuyển → Người Nhận Hàng đang thực hiện thủ tục nhận hàng:</strong></p>

                <ul>
                      <li>
                      ⦁ <strong>Bước 1</strong>: Quý Khách Hàng vui lòng thực hiện theo Trường hợp 1a hoặc Trường hợp 2b;
                      </li>
                      <li>
                        ⦁	<strong>Bước 2</strong>: Sau khi xử lý yêu cầu, C-Mart sẽ phản hồi và gửi Biên bản đến kênh thông tin đặt hàng, cùng kênh thông tin nhận hàng;
                      </li>
                      <li>
                        ⦁	<strong>Bước 3</strong>: Quý Khách Hàng vui lòng thanh toán phụ phí (nếu có). Nếu có hướng dẫn hoàn hàng tại thời điểm, Quý Khách Hàng vui lòng tiến hành hoàn hàng, cung cấp thông tin hoàn, và lưu giữ chứng từ thanh toán + hoàn hàng;

                      </li>
                      <li>
                        ⦁	<strong>Bước 4</strong>: Kể từ thời điểm C-Mart tiếp nhận khoản thanh toán (nếu có) và hàng hoàn (nếu có), trong khoảng thời gian thỏa thuận, C-Mart sẽ tiến hành đổi hàng đến Quý Khách Hàng.

                      </li>



                </ul>
                <p style="text-alignt:justify"><strong>Trường hợp Người Nhận Hàng đã thực hiện thủ tục nhận hàng:</strong></p>
                <ul>
                  <li>⦁	<strong>Bước 1</strong>: Quý Khách Hàng vui lòng thực hiện theo Trường hợp 2a hoặc Trường hợp 3b;</li>
                  <li>⦁	<strong>Bước 2</strong>: Sau khi xử lý yêu cầu, C-Mart sẽ phản hồi và gửi Biên bản đến kênh thông tin đặt hàng, cùng kênh thông tin nhận hàng;</li>
                  <li>⦁	<strong>Bước 3</strong>: Quý Khách Hàng vui lòng thanh toán phụ phí (nếu có). Nếu có hướng dẫn hoàn hàng tại thời điểm, Quý Khách Hàng vui lòng tiến hành hoàn hàng, cung cấp thông tin hoàn, và lưu giữ chứng từ thanh toán + hoàn hàng;</li>
                  <li>⦁	<strong>Bước 4</strong>: Kể từ thời điểm C-Mart tiếp nhận khoản thanh toán (nếu có) và hàng hoàn (nếu có), trong khoảng thời gian thỏa thuận, C-Mart sẽ tiến hành đổi hàng đến Quý Khách Hàng.</li>

                </ul>
                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH TRẢ SẢN PHẨM</strong><br>khi và chỉ khi:
                </p>
                <p style="text-alignt:justify">Sản phẩm là <strong>kết quả xử lý sau 03 lần liên tục đổi sản phẩm</strong> do Lỗi Sản Xuất khiến Quý Khách Hàng không thể sử dụng được sản phẩm, tức là <strong>Hơn 3 Lần Liên Tục Đổi Sản Phẩm</strong> Đều Do Lỗi Sản Xuất. Tại thời điểm này, C-Mart chân thành xin lỗi Quý Khách Hàng vì những trải nghiệm không tốt này, nếu Người Nhận Hàng có nhu cầu, thì C-Mart sẽ hỗ trợ trả sản phẩm - hoàn tiền đến Quý Khách Hàng.
                </p>

                <p style="text-alignt:justify"><strong>* Điều kiện:
                </strong></p>
                <p style="text-alignt:justify;margin-left:2%">
                  Trang giới thiệu sản phẩm thể hiện thông tin cho phép đổi - trả;
                  <br>Sản phẩm thỏa mãn các quy định kèm theo;
                  <br>Thời gian từ Thời điểm giao hàng thành công (dựa theo dữ liệu vận chuyển) đến Thời điểm gửi đổi sản phẩm (dựa theo xác nhận của đơn vị giao nhận hoặc thời điểm C-Mart trực tiếp nhận sản phẩm) là 72 Giờ;
                  <br>Hoàn sản phẩm, các loại phụ kiện, giấy tờ kèm theo, tặng phẩm,...
                </p>
                <ul>
                  <li>⦁	Tất cả còn đầy đủ, rõ ràng, nguyên vẹn, <strong>không bị ảnh hưởng đến việc “tái xuất”;</strong></li>

                  <li>⦁	Sản phẩm chưa có dấu hiệu sử dụng nhiều lần hay hư hại do Quý Khách Hàng, không lưu lại các dấu vết hay mùi vị lạ, chưa qua vệ sinh, <strong>không bị ảnh hưởng đến việc “tái xuất”.</strong></li>




                </ul>
                <p style="text-alignt:justify">→<strong> Người Nhận Hàng</strong> vui lòng cung cấp <strong>dữ liệu quay video</strong> kiện hàng có chữ ký NVGN, <strong>liên hệ</strong> kèm mã giao dịch đến các kênh giao dịch chính thức của C-Mart, bằng kênh thông tin nhận hàng để được hỗ trợ ngay và luôn.</p>

                <p style="text-alignt:justify">→<strong> C-Mart sẽ khẩn trương xác minh, phản hồi với Người Nhận Hàng</strong> để xử lý đơn hàng, phát huy vai trò nhà phân phối trung gian bảo vệ quyền lợi Khách Hàng, khuyến khích Quý Khách Hàng đồng hành với C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, và tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.</p>

                <p style="text-alignt:justify" class="text-center"><strong>QUY TRÌNH TRẢ SẢN PHẨM - HOÀN TIỀN</strong></p>
                <p style="text-alignt:justify"> ⦁	<strong>Bước 1</strong>: Quý Khách Hàng vui lòng thực hiện theo Trường hợp 2a;
                </p>
                <p style="text-alignt:justify"> ⦁	<strong>Bước 2</strong>: Sau khi xử lý yêu cầu, C-Mart sẽ phản hồi và gửi Biên bản đến kênh thông tin đặt hàng, cùng kênh thông tin nhận hàng;
                </p>
                <p style="text-alignt:justify"> ⦁	<strong>Bước 3</strong>: Quý Khách Hàng vui lòng tiến hành hoàn hàng, cung cấp thông tin hoàn, và lưu giữ chứng từ hoàn hàng.

                </p>
                <p style="text-alignt:justify"> ⦁	<strong>Bước 4</strong>: Kể từ thời điểm C-Mart tiếp nhận khoản thanh toán (nếu có) và hàng hoàn, trong tối đa 24 giờ làm việc, C-Mart sẽ tiến hành <strong>hoàn tiền đến Người Đặt Hàng.
                </strong>


                </p>
                <p style="text-alignt:justify" class="text-center"><strong>PHƯƠNG THỨC HOÀN TIỀN MẶC ĐỊNH
                </strong></p>
                <p style="text-alignt:justify">
                  Thanh toán bằng Tiền mặt→ Số dư Ngân hàng.
                  <br>	Thanh toán bằng Tiền Tích Lũy / Thẻ Thanh Toán C-Card → Tiền Tích Lũy / C-Card.
                  <br>	Thanh toán bằng Thẻ, QR Pay → Thẻ, QR Pay.
                  <br>	Thanh toán bằng Voucher/Coupon →Voucher/Coupon
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
