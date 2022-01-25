@extends('layout.master')

@section('title', 'Chính Sách Thanh Toán')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/Chính Sách Thanh Toán</a>
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
          <button type="button" class="content-hover an title m-2" data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>

        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
            <h3 class="title">Chính Sách Thanh Toán</h3>
            <div class="detail-static">
                <p style="text-align:justify">Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì<strong> mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách</strong>. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
                </p>
                <p style="text-align: justify">⦁ C-Mart cung cấp các đa dạng các phương thức thanh toán, hỗ trợ Quý Khách Hàng thanh toán tiện lợi, nhanh chóng và an toàn:</p>
                <div>
                    <table class="table table-bordered ">
                        <thead>
                          <tr>
                            <th scope="col">Hình thức</th>
                            <th scope="col">Phương thức Thanh toán trả trước</th>
                            <th scope="col">Phương thức Thanh toán trả sau</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>

                            <td>
                                <p>Tiền mặt</p>
                            </td>
                            <td>
                                <p>- Gửi tiền tại các Điểm Nạp Tiền trên toàn quốc <br>- Chuyển tiền thông qua các Dịch vụ Chuyển tiền.</p>
                            </td>
                            <td>
                                <p>- Giao dịch COD (Cash On Delivery: nhận hàng - trả tiền mặt);<br>- Chính sách Công nợ linh hoạt: Trả góp, Gối đầu, Hẹn thời gian thanh toán.</p>
                            </td>
                          </tr>
                          <tr>
                              <td><p>Tiền Tích Lũy (C)</p></td>
                              <td><p>- Thanh toán trực tuyến;<br>
                                - Trích nợ từ Tài khoản Tiền Tích Lũy.</p></td>
                              <td><p>- Thanh toán chuyển khoản với C-Ship;<br>
                                - Trích nợ từ Tài khoản Tiền Tích Lũy với C-Ship.</p></td>
                          </tr>
                          <tr>
                              <td><p>Voucher/Coupon</p></td>
                              <td><p>Thanh toán trực tuyến</p></td>
                              <td><p>Chưa hỗ trợ</p></td>
                          </tr>
                          <tr>
                              <td><p>Thẻ Thanh Toán C-Card</p></td>
                              <td><p>Liên hệ đến<br>
                                các kênh giao dịch chính thức của C-Mart</p></td>
                              <td><p>Chưa hỗ trợ</p></td>
                          </tr>
                          <tr>
                              <td><p>Thẻ Napas/ Visa / Mastercard / JCB / Union Pay / Amex / CUP /
                                QR Pay</p></td>
                              <td><p>- Thanh toán trực tuyến</p></td>
                              <td><p>Thanh toán trực tiếp với C-Ship</p></td>
                          </tr>



                        </tbody>
                      </table>

                </div>
                <p style="text-align:justify"><strong>I. CHÍNH SÁCH THANH TOÁN TRẢ SAU.</strong></p>
                <p style="text-align:justify">Trong một số trường hợp có sử dụng phương thức thanh toán trả sau, C-Mart xin phép yêu cầu bổ sung để giảm độ rủi ro cho giao dịch:</p>
                <p style="text-align:justify"><strong>⦁	Quý Khách Hàng Chưa Định Danh có Giá trị thanh toán trả sau ≥ 5.000.000 VNĐ</strong> hoặc <strong>Tổng đơn hàng chưa hoàn thành ≥ 3;</strong></p>
                <p style="text-alignt:justify">→ Quý Khách Hàng vui lòng thực hiện <strong>thanh toán trả trước tối thiểu (chưa bao gồm VAT) = 10% Giá trị sản phẩm + 2 x Phí vận chuyển + Phí DVTT.</strong></p>
                <p style="text-align:justify">⦁	Quý Khách Hàng Thân Thiết có Tổng thanh toán trả sau ≥ 10.000.000 VNĐ hoặc Tổng đơn hàng chưa hoàn thành ≥ 3;
                </p>
                <p style="text-align:justify">→ Quý Khách Hàng vui lòng thực hiện <strong>thanh toán trả trước tối thiểu (chưa bao gồm VAT) = 10% Giá trị sản phẩm + 2 x Phí vận chuyển + Phí DVTT.
                </strong></p>
                <p style="text-alignt:justify">⦁	Quý Khách Hàng V.I.P có Tổng thanh toán trả sau ≥ 30.000.000 VNĐ hoặc Tổng đơn hàng chưa hoàn thành ≥ 5;</p>

                <p style="text-align:justify">→ Quý Khách Hàng vui lòng thực hiện <strong>thanh toán trả trước tối thiểu (chưa bao gồm VAT) = 10% Giá trị sản phẩm + 2 x Phí vận chuyển + Phí DVTT.</strong></p>
                <p style="text-alignt:justify"><strong>
                    ⦁	Quý Khách Hàng Thương Mại có Tổng thanh toán trả sau ≥ 30.000.000 VNĐ hoặc Tổng đơn hàng chưa hoàn thành ≥ 3;
                    </strong></p>
                <p style="text-alignt:justify">
                    → Quý Khách Hàng vui lòng thực hiện <strong>thanh toán trả trước tối thiểu (chưa bao gồm VAT) = 30% giá trị sản phẩm + 2 x Phí vận chuyển + Phí DVTT.
                    </strong></p>

                <p style="text-align:justify"><strong>
                    ⦁	Quý Cộng Tác Viên có Tổng thanh toán trả sau ≥ 30.000.000 VNĐ hoặc Tổng đơn hàng chưa hoàn thành ≥ 10;
                    </strong></p>
                <p style="text-alignt:justify">
                    → Quý Khách Hàng vui lòng thực hiện <strong>thanh toán trả trước tối thiểu (chưa bao gồm VAT) = 10% Giá trị sản phẩm + 2 x Phí vận chuyển + Phí DVTT.
                    </strong></p>
                <p style="text-alignt:justify">Quý Khách Hàng giao dịch trong các trường hợp:</p>
                <ul>
                    <li style="text-alignt:justify"><strong>Chưa đủ điều kiện bảo đảm về nghĩa vụ Khách Hàng;
                    </strong></li>
                    <li style="text-alignt:justify">Có <strong>nhiều giao dịch khó khăn, giao dịch nguy hiểm</strong> trong 03 tháng gần nhất;
                    </li>
                    <li style="text-align: justify"><strong>Giao dịch tiềm ẩn rủi ro cao</strong> (ngành hàng thực phẩm, sản phẩm đặt trước, sản phẩm đặt số lượng lớn…);
                    </li>
                </ul>
                <p style="text-alignt:justify">→ Quý Khách Hàng vui lòng <strong>hỗ trợ phương thức thanh toán</strong> an toàn cho C-Mart (thanh toán trả trước, chứng minh sở hữu Voucher/Coupon/C-Card/Tiền Tích Lũy có giá trị thanh toán phù hợp; hoặc được đảm bảo thanh toán bởi đơn vị trung gian...).</p>

                <p style="text-align:justify"> <strong>II. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC VÀ/HOẶC TRẢ SAU BẰNG TIỀN MẶT.</strong></p>
                <p style="text-alignt:justify">Quý Khách Hàng có thể thanh toán bằng tiền mặt cùng C-Mart theo các hình thức sau:
                </p>
                <ul>
                    <li>⦁	<strong>Gửi tiền tại các Điểm Nạp Tiền trên toàn quốc</strong> (Thanh toán trả trước): Miễn phí dịch vụ (nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ ba,...)
                    </li>
                </ul>
                <p style="text-alignt:justify">- <strong>Nội dung thanh toán</strong> theo mẫu sau:</p>
                <ul>
                    <li>⦁	<strong>Thanh toán đơn hàng 21021710000 của Nguyễn Văn A</strong> (với 21021710000 là mã giao dịch, Nguyễn Văn A là tên Người Đặt Hàng).</li>

                    <li>⦁	<strong>Nạp Tài khoản 202102171000 của Nguyễn Văn A </strong>(với 202102171000 là mã Khách Hàng, Nguyễn Văn A là tên Chủ nhân Hồ Sơ Khách Hàng).

                    </li>
                </ul>
                <p style="text-alignt:justify">- <strong>Các Điểm Nạp Tiền trên toàn quốc</strong> được hỗ trợ: </p>
                <ul>
                    <li>⦁	<strong>Mạng lưới Điểm Nạp/Rút của Ví điện tử MoMo</strong> tại hệ thống FPT Shop, Thế Giới Di Động, Điện Máy Xanh, Bách Hóa Xanh, Circle K, Ministop, F88,... trên toàn quốc.
                    </li>
                    <li>
                        <ul>
                            <li>⦁	Số ví: <strong>08888.26027</strong>.</li>
                            <li>⦁	Chủ tài khoản: <strong>Lê Đại Cường</strong></li>
                        </ul>
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TMCP Việt Nam Thịnh Vượng (VPBank)</strong>: Phạm vi TP.HCM
                </p>
                <ul>
                    <li>⦁	Số tài khoản: <strong>21.581.99 99.99.99.99.</strong>
                    </li>
                    <li>⦁	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                    </li>
                    <li>⦁	Chi nhánh Chợ Lớn - TP.HCM.
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TMCP An Bình (ABBank)</strong>: Phạm vi TP.HCM (Không giới hạn) và Toàn quốc (< 50 triệu VNĐ)
                </p>
                <ul>
                    <li>⦁	Số tài khoản: ………………………….
                        </li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁	Chi nhánh: ………………………….
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TMCP Hàng Hải Việt Nam (MSB)</strong> Phạm vi TP.HCM (Không giới hạn) và Toàn quốc (< 20 triệu VNĐ)
                </p>
                <ul>
                    <li>⦁	Số tài khoản: ………………………….
                    </li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁	Chi nhánh: ………………………….
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>⦁	Mạng lưới Ngân hàng TMCP Sài Gòn Thương Tín (Sacombank)</strong>  Phạm vi TP.HCM
                </p>
                <ul>
                    <li>⦁	Số tài khoản: ………………………….
                    </li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁	Chi nhánh: ………………………….
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TMCP Sài Gòn (SCB)</strong>: Phạm vi Toàn quốc và Giá trị < 300 triệu VNĐ cho tài khoản tại:
                </p>
                <ul>
                    <li>⦁	Số tài khoản: <strong>0212.4179.501.</strong></li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁	Chi nhánh Tây Sài Gòn - TP.HCM.
                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TNHH MTV Shinhan Việt Nam</strong>: Phạm vi Toàn quốc :
                </p>
                <ul>
                    <li>⦁	Số tài khoản: <strong>7000.1031.3611.</strong></li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁   Chi nhánh An Đông - TP.HCM.

                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>Mạng lưới Ngân hàng TMCP Tiên Phong (TPBank)</strong>: Phạm vi TP.HCM (Không giới hạn) và Toàn quốc (< 100 triệu VNĐ) :
                </p>
                <ul>
                    <li>⦁	Số tài khoản: <strong>0212.4179.501.
                    </strong></li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁  Chi nhánh Tây Sài Gòn - TP.HCM.


                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>⦁	Mạng lưới Ngân hàng TMCP Công thương Việt Nam (Vietinbank)</strong>: Phạm vi TP.HCM :
                </p>
                <ul>
                    <li>⦁	Số tài khoản: ………………………….
                    </li>
                    <li>⦁	Chủ tài khoản:<strong> Lê Đại Cường</strong>.
                    </li>
                    <li>⦁   Chi nhánh: ………………………….


                    </li>
                </ul>
                <p style="text-alignt:justify"><strong>⦁	Gửi tiền thông qua các Dịch vụ chuyển tiền </strong>(Thanh toán trả trước): Phí do đơn vị cung cấp dịch vụ thu trực tiếp (nếu có).
                </p>
                <p style="text-alignt:justify">- <strong>Nội dung thanh toán</strong> theo mẫu sau:
                </p>
                <ul>
                    <li>⦁	<strong>Thanh toán đơn hàng 21021710000 của Khách Hàng Nguyễn Văn A </strong>(với 21021710000 là mã giao dịch, Nguyễn Văn A là tên Người Đặt Hàng).</li>
                    <li>⦁	<strong>Nạp tiền Tài khoản 202102171000 của Khách Hàng Nguyễn Văn A</strong> (với 202102171000 là mã Khách Hàng, Nguyễn Văn A là tên Chủ nhân Hồ Sơ Khách Hàng).
                    </li>

                </ul>
                <p style="text-alignt:justify">- <strong>Các Dịch vụ chuyển tiền</strong> được hỗ trợ: </p>
                <ul>
                    <li><strong>⦁	Ví điện tử MoMo:
                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số ví:<strong> 08888.26027.</strong>
                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ví điện tử ZaloPay:

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số ví:<strong> 08888.26027.</strong>
                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ví điện tử ViettelPay:

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số ví:<strong> 08888.26027.</strong>
                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ngân hàng TMCP Việt Nam Thịnh Vượng (VPBank):

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:<strong> 21.581.99 99.99.99.99.
                            </strong>
                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                            <li>-	Chi nhánh Chợ Lớn - TP.HCM.
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁  Ngân hàng TMCP An Bình (ABBank):


                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:………………………….

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                            <li>-	Chi nhánh : ………………………….
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁  Ngân hàng TMCP An Bình (ABBank):


                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:………………………….

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.</strong>
                            </li>
                            <li>-	Chi nhánh : ………………………….
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁  Ngân hàng TMCP Á Châu (ACB):


                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:<strong>212.1996.68
                            </strong>
                            </li>
                            <li>-	Chủ tài khoản: <strong>CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ C-MART.
                            </strong>
                            </li>
                            <li>-	Chi nhánh Phú Lâm - Quận 6 (TP.HCM).
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ngân hàng TMCP Quân Đội (MB):


                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:
                            </li>
                            <li>-	Chủ tài khoản: <strong>CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ C-MART.
                            </strong>
                            </li>
                            <li>-	Chi nhánh - TP.HCM.
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ngân hàng TMCP Hàng Hải Việt Nam (MSB):

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:: ………………………….

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.
                            </strong>
                            </li>
                            <li>-	Chi nhánh : ………………………….
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ngân hàng TMCP Sài Gòn Thương Tín (Sacombank):

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:: ………………………….

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.
                            </strong>
                            </li>
                            <li>-	Chi nhánh : ………………………….
                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁   Ngân hàng TNHH MTV Shinhan Việt Nam:
                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản:: <strong>: 7000.1031.3611.</strong>

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.
                            </strong>
                            </li>
                            <li>-   Chi nhánh An Đông - TP.HCM.

                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁  Ngân hàng TMCP Tiên Phong (TPBank):

                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản: <strong>:0212.4179.501.</strong>

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.
                            </strong>
                            </li>
                            <li>-   Chi nhánh Tây Sài Gòn - TP.HCM.

                            </li>
                        </ul>
                    </li>
                    <li><strong>⦁  Ngân hàng TMCP Công thương Việt Nam (Vietinbank):


                    </strong></li>
                    <li>
                        <ul>
                            <li>-	Số Tài Khoản: ………………………….

                            </li>
                            <li>-	Chủ tài khoản: <strong>Lê Đại Cường.
                            </strong>
                            </li>
                            <li>-   Chi nhánh : ………………………….

                            </li>
                        </ul>
                    </li>



                </ul>
                <p style="text-alignt:justify"><strong>Giao dịch COD - Cash On Delivery</strong> (Thanh toán trả sau): Miễn phí thu hộ.<br>
                    Khách Hàng nhận hàng và thanh toán cho Nhân viên Giao nhận theo Chính sách Giao - Nhận.
                </p>
                <p style="text-alignt:justify"><strong>⦁	Công nợ linh hoạt </strong> (Thanh toán trả sau): Phí dịch vụ căn cứ theo quy định Hợp đồng.<br>

                    - Chính sách Công nợ linh hoạt dành riêng cho nhóm Khách Hàng V.I.P, Khách Hàng Thương Mại có ký kết Hợp đồng Công nợ<br>
                    - Các hình thức công nợ linh hoạt:
                </p>
                <ul>
                    <li>⦁	Trả góp: thanh toán từng khoản công nợ theo chu kỳ.</li>
                    <li>⦁	Gối đầu: thanh toán toàn bộ công nợ theo chu kỳ.</li>
                    <li>⦁	Hẹn thời gian thanh toán toàn bộ công nợ.</li>
                </ul>
                <p style="text-alignt:justify">- Kết quả thẩm định được cập nhật vào ngày 01 hàng tháng, thỏa 02 điều kiện:
                </p>
                <ul>
                    <li>⦁	<strong>Giá trị công nợ</strong> tính đến thời điểm thẩm định: Căn cứ theo quy định Hợp đồng Thỏa mãn điều kiện thẩm định, tái thẩm định của C-Mart.
                        </li>
                </ul>
                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN
                </strong></p>
                <p style="text-alignt:justify">Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.<br>
                    Tiền dạng vật chất có giá trị thanh toán khi và chỉ khi là tiền Việt Nam Đồng có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành theo quy định của Ngân hàng Nhà nước Việt Nam.
                    </p>
                <p style="text-alignt:justify" class="text-center"><strong>QUYỀN LỢI<br>
                        Vô cùng tiện lợi - "Tất cả trong Một"

                    </strong></p>
                <p style="text-alignt:justify">C-Mart hỗ trợ đa dạng và phong phú những trải nghiệm, đặc biệt cung cấp đa dạng các phương thức thanh toán tiền mặt tiện lợi, nhanh chóng, an toàn. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một” - cho phép thanh toán ở nhiều nơi, tại nhiều thời điểm, trong cả Thanh toán trả trước, Thanh toán trả sau và Thanh toán kết hợp, cả Giao dịch trực tiếp và Giao dịch trực tuyến.<br>Chính sách Công nợ linh hoạt cho phép thanh toán công nợ theo chu kỳ mong muốn.
                        Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).
                    </p>
                <p style="text-alignt:justify"><strong>III. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC VÀ/HOẶC TRẢ SAU BẰNG TIỀN TÍCH LŨY (C).</strong></p>
                <p style="text-alignt:justify">
                    - Tiền Tích Lũy (1 C = 1 VNĐ) là đơn vị thanh toán do C-Mart phát hành theo Quy định về Tiền Tích Lũy. Tiền Tích Lũy (C) có giá trị thanh toán cho các giao dịch cùng C-Mart và các Đối Tác Liên Kết, và thật dễ nhận được từ:
                </p>
                <ul>
                    <li>⦁	<strong>Mua thành công sản phẩm của C-Mart</strong>: Tiền Tích Lũy (C) được thể hiện cụ thể tại trang giới thiệu sản phẩm. Khi ĐH Hoàn thành, Tài khoản Tiền Tích Luỹ sẽ tự động cập nhật theo hóa đơn C-Bill;</li>
                    <li>⦁	<strong>Chính sách Tiết Kiệm Tích Tài C-Saving</strong>: Gia tăng Tiền Tích Lũy (C) theo tỉ lệ được công bố, căn cứ trên số dư bình quân của Số C khả dụng;</li>
                    <li>⦁	Các thao tác khác: nạp Tài khoản Tiền Tích Lũy (tỉ lệ 1:1), quy đổi Thẻ Thanh Toán C-Card, hoàn tiền đơn hàng,...</li>
                    <li>
                </ul>
                <p style="text-alignt:justify">- Quý Khách Hàng có thể thanh toán bằng Tiền Tích Lũy (C) tại C-Mart theo các hình thức:
                </p>
                <ul>
                    <li>⦁	<strong>Thanh toán Trực tuyến </strong>(Thanh toán trả trước): Nhập số (C) muốn sử dụng để thanh toán khi đặt hàng tại website;</li>
                    <li>⦁	<strong>Thanh toán Chuyển khoản</strong> (Thanh toán trả sau): Nhập số (C) muốn chuyển để thanh toán, bằng công cụ Thanh toán cho C-Mart tại trang Hồ Sơ Khách Hàng;
                    </li>
                    <li>⦁	<strong>Trích nợ từ Tài khoản Tiền Tích Lũy</strong> (Thanh toán trả trước với mọi đơn vị vận chuyển và Thanh toán trả sau với C-Ship): Quý Khách Hàng liên hệ đến các kênh giao dịch chính thức của C-Mart, bằng kênh thông tin xác nhận giao dịch với C-Mart, và cung cấp mã giao dịch + mã Khách Hàng + xác thực chính chủ, để yêu cầu trích nợ thanh toán Tài khoản Tiền Tích Lũy chính chủ.</li>




                </ul>
                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN</strong></p>
                <p style="text-alignt:justify">
                    Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.<br>
                    Tiền Tích Lũy (C) có giá trị thanh toán khi và chỉ khi là Tiền Tích Lũy có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại C-Mart.
                </p>
                <p style="text-alignt:justify"><strong>Xác thực chính chủ khi sử dụng Tiền Tích Lũy (C):
                </strong></p>
                <ul>
                    <li>⦁	Quý Khách Hàng đang giao dịch phải là Chủ nhân Hồ Sơ Khách Hàng chứa Tài khoản Tiền Tích Lũy cần sử dụng.</li>
                    <li>⦁	Mọi giao dịch trích Tài khoản Tiền Tích Lũy đều được xác thực bằng SMS OTP gửi đến chính Số điện thoại xác nhận giao dịch;</li>
                    <li>⦁	Mọi biến động số dư Tài khoản Tiền Tích Lũy đều được thông báo đến chính Số điện thoại xác nhận giao dịch.</li>

                </ul>
                <p style="text-alignt:justify"><strong>Phí xử lý thanh toán: Miễn phí dịch vụ</strong> (nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ ba,...).</p>

                <p style="text-alignt:justify" class="text-center"><strong>QUYỀN LỢI <br>Mua Hàng Đa Dạng - Tích Lũy Tiền Ngay - Thanh Toán Như Ý”</strong></p>
                <p style="text-alignt:justify">
                    	Tiền Tích Lũy (C) có giá trị thanh toán như tiền mặt tại C-Mart và các Đối Tác Liên Liên Kết. Với giá trị sử dụng cao, đa dạng, nên chẳng những vô cùng tiện lợi, nhanh chóng, mà còn rất an toàn khi không cần kè kè tiền mặt mọi lúc - mọi nơi. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một” - cho phép sử dụng Tiền Tích Lũy ở nhiều nơi, tại nhiều thời điểm, trong cả Thanh toán trả trước, Thanh toán trả sau và Thanh toán kết hợp, cả Giao dịch trực tiếp và Giao dịch trực tuyến.
                </p>
                <p style="text-alignt:justify">Chính sách Tiết Kiệm Tích Tài C-Saving: Gia tăng Tiền Tích Lũy (C) theo tỉ lệ được công bố, căn cứ trên số dư bình quân của Số C khả dụng.</p>
                <p style="text-alignt:justify">Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).</p>
                <p style="text-alignt:justify"><strong>
                    IV. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC BẰNG VOUCHER/COUPON.
                    </strong></p>
                <p style="text-alignt:justify">- Voucher/Coupon từ C-Mart hoạt động như thẻ thanh toán tại C-Mart và các Đối Tác Liên Kết. Voucher/Coupon do C-Mart phát hành dùng để biếu tặng Quý Khách Hàng, hay phân bổ qua các sự kiện, chương trình ưu đãi - khuyến mãi thường xuyên của C-Mart để khởi tạo những niềm vui rực rỡ cho Quý Khách Hàng.
                </p>
                <p style="text-alignt:justify">- Quý Khách Hàng có thể thanh toán bằng Voucher/Coupon tại C-Mart dưới hình thức Thanh toán trực tuyến (Thanh toán trả trước): Nhập mã code của Voucher/Coupon để thanh toán khi đặt hàng tại website.</p>

                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN</strong></p>
                <p style="text-alignt:justify">Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.
                    <br>Voucher/Coupon từ C-Mart có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại C-Mart: về giá trị sử dụng, thời gian sử dụng, đối tượng sử dụng, phạm vi sử dụng, hình thức sử dụng, số lượt sử dụng, chính sách đổi - trả, cùng các điều kiện sử dụng khác theo quy định kèm theo.
                    </p>
                <ul>
                    <li>
                        ⦁	Voucher/Coupon không có các thông tin định danh nên C-Mart không xác thực chính chủ khi sử dụng, không hỗ trợ cấp lại (trừ trường hợp thực hiện theo Chính sách Đổi - Trả),...
                        </li>
                </ul>
                <p style="text-alignt:justify">⦁	Phương thức thanh toán bằng Voucher/Coupon có thể không hỗ trợ kèm Chính sách Tiền Tích Lũy (C), Chính sách Đổi - Trả sản phẩm do nguyên nhân chủ quan từ cá nhân,...</p>
                <p style="text-alignt:justify">
                    ⦁	Voucher/Coupon được C-Mart phát hành dùng để biếu tặng Quý Khách Hàng nhằm tăng kích cầu mua sắm, ích nước lợi nhà.
                    </p>
                <p style="text-alignt:justify">
                    Vì thế số <strong>dư từ Voucher/Coupon không có giá trị quy đổi trong mọi trường hợp.
                        Phí xử lý thanh toán: Miễn phí dịch vụ</strong> (nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ ba,...).
                    </p>
                <p style="text-alignt:justify" class="text-center"><strong>QUYỀN LỢI<br>Tặng Miễn Phí – Trao Thường Xuyên - Thanh Toán Như Ý</strong>
                </p>
                <p style="text-alignt:justify">
                    Voucher/Coupon từ C-Mart có giá trị thanh toán như tiền mặt tại C-Mart và các Đối Tác Liên Liên Kết. Với giá trị sử dụng cao, đa dạng, nên chẳng những vô cùng tiện lợi, nhanh chóng, mà còn rất an toàn khi không cần kè kè tiền mặt mọi lúc - mọi nơi. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một”.
                    <br>Voucher/Coupon do C-Mart phát hành dùng để biếu tặng Quý Khách Hàng, hay phân bổ qua các sự kiện, chương trình ưu đãi - khuyến mãi thường xuyên của C-Mart để khởi tạo những niềm vui rực rỡ cho Quý Khách Hàng, tăng kích cầu mua sắm, ích nước lợi nhà.
                    <br>Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).
                    </p>
                <p style="text-alignt:justify"><strong>V. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC BẰNG THẺ THANH TOÁN C-CARD.
                    </strong></p>
                <p style="text-alignt:justify">
                    - Thẻ Thanh Toán C-Card (1 C = 1 VNĐ) do C-Mart phát hành có đơn vị thanh toán là Tiền Tích Lũy (C). Thẻ Thanh Toán C-Card có giá trị thanh toán cho các giao dịch cùng C-Mart và các Đối Tác Liên Kết.
<br>- Quý Khách Hàng có thể sử dụng Thẻ Thanh Toán C-Card của C-Mart bằng cách liên hệ đến các kênh giao dịch chính thức của C-Mart để yêu cầu quy đổi mã thẻ thành Tiền Tích Lũy (C) có giá trị thanh toán tại C-Mart và các Đối Tác Liên Kết. Quý Khách Hàng vui lòng liên hệ từ Số điện thoại nhận hàng trong đơn hàng chứa C-Card cần dùng, và cung cấp mã giao dịch + mã Khách Hàng + xác thực chính chủ.

                </p>
                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN
                </strong></p>
                <p style="text-alignt:justify" >Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.
                    <br>Thẻ Thanh Toán C-Card từ C-Mart có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại C-Mart.
                     </p>
                <p style="text-alignt:justify"><strong>
                Xác thực chính chủ khi sử dụng Thẻ Thanh Toán C-Card:
                    </strong></p>
                <ul>
                    <li>⦁	Quý Khách Hàng đang giao dịch phải là Người Nhận Hàng theo thông tin đơn hàng chứa C-Card cần sử dụng;

                    </li>
                    <li>⦁	Trường hợp Quý Cộng Tác Viên là Người Đặt Hàng: Quý Khách Hàng đang giao dịch phải là Người Đặt Hàng theo thông tin đơn hàng chứa C-Card cần sử dụng;</li>
                </ul>
                <p style="text-alignt:justify">
                    C-Mart không hỗ trợ cấp lại / điều chỉnh sau khi đã tiến hành quy đổi (trừ trường hợp thực hiện theo Chính sách Đổi - Trả),...
                    <br>	Số dư từ C-Card chỉ có giá trị quy đổi thành Tiền Tích Lũy (C).
                    <br>Phí xử lý thanh toán: Miễn phí dịch vụ (nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ ba,...).
                    </p>

                <p style="text-alignt:justify" class="text-center"> <strong>QUYỀN LỢI<br>
                    Quà Tặng Thiết Thực Cho Đời Sống - "Tất cả trong Một</strong></p>
                <p style="text-alignt:justify">
                    Thẻ Thanh Toán C-Card có giá trị thanh toán như tiền mặt tại C-Mart và các Đối Tác Liên Liên Kết. Với giá trị sử dụng cao, đa dạng, nên chẳng những vô cùng tiện lợi, nhanh chóng, mà còn rất an toàn khi không cần kè kè tiền mặt mọi lúc - mọi nơi. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một”.
                    <br>Chính sách Tiết Kiệm Tích Tài C-Saving: Gia tăng Tiền Tích Lũy (C) theo tỉ lệ được công bố, căn cứ trên số dư bình quân của Số C khả dụng.
                    <br>Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).

                </p>
                <p style="text-alignt:justify"> <strong>VI. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC VÀ/HOẶC TRẢ SAU BẰNG THẺ NGÂN HÀNG, QR PAY</strong> </p>

                <p style="text-alignt:justify">
                    - Các phương thức thanh toán qua Thẻ ngân hàng, QR Pay tại C-Mart được thực hiện hoàn toàn thông qua các đơn vị cung ứng dịch vụ thanh toán đã được Ngân hàng Nhà nước Việt Nam thẩm định cấp phép.

                    <br>Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. C-Mart cam kết hoàn toàn không lưu giữ lại các thông tin thanh toán của Quý Khách Hàng, mà toàn bộ đều được chuyển trực tiếp đến hệ thống xử lý thanh toán.

                    <br>- Quý Khách Hàng có thể thanh toán bằng Thẻ ngân hàng, QR Pay tại C-Mart theo các hình thức:
                    </p>
                <ul>
                    <li>⦁	Thanh toán trực tuyến (Thanh toán trả trước): Sau khi hoàn tất thông tin đặt hàng, Quý Khách Hàng sẽ thực hiện thanh toán tại duy nhất cửa sổ thanh toán do C-Mart chuyển đến sau đó. Quý Khách Hàng thực hiện nhập thông tin thanh toán, Cổng thanh toán trực tuyến sẽ gửi xác thực đến kênh liên lạc đã đăng ký với Tổ chức tín dụng, Quý Khách Hàng vui lòng hoàn tất theo hướng dẫn.
                    </li>
                    <li>⦁	Thanh toán trực tiếp qua Máy quẹt thẻ, NFC, QR Pay (Thanh toán trả sau với đơn vị vận chuyển C-Ship): Khi thanh toán, Quý Khách Hàng chỉ thực hiện thanh toán qua phương tiện thanh toán được C-Mart cung cấp, và thực hiện đúng - đủ quy trình theo Thao tác khi thanh toán.</li>

                </ul>
                <p style="text-alignt:justify">Quý Khách Hàng vui lòng kiểm tra cẩn thận các thông tin trước khi thực hiện thanh toán, trước khi ký tên; kiểm tra phương thức thanh toán được trả lại là hàng thật không tỳ vết; và nhận lại các hóa đơn để lưu trữ.</p>
                <p style="text-alignt:justify " class="text-center"><strong>CHÍNH SÁCH THANH TOÁN
                </strong>    </p>
                <p style="text-alignt:justify">⦁	Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.</p>
                <ul>
                    <li>⦁	Tài khoản và/hoặc thẻ, phương thức thanh toán cần được đăng ký hình thức thanh toán phù hợp (thanh toán online, thanh toán QR, NFC…), và thỏa mãn các điều kiện thanh toán;</li>
                    <li>⦁	Giao dịch phải được ghi nhận thành công do hệ thống thanh toán trả về (đảm bảo số dư/hạn mức, xác thực theo quy định…), và C-Mart đã nhận được khoản thanh toán.</li>

                </ul>
                <p style="text-alignt:justify">Phương thức thanh toán có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại đơn vị phát hành phương thức thanh toán được cấp phép.
                    <br>Xác thực chính chủ khi thanh toán bằng Thẻ ngân hàng, QR Pay: Quý Khách Hàng đang giao dịch phải là Chủ nhân phương thức thanh toán đang sử dụng.
                </p>
                <ul>
                    <li>⦁	Khi thanh toán trực tuyến: Quý Khách Hàng có thể được yêu cầu xác minh ảnh Giấy tờ tùy thân chụp cạnh ảnh Mặt trước thẻ đã che 6 số ở giữa.
                    </li>
                    <li>⦁	Khi thanh toán trực tiếp: C-Mart xin phép đối chiếu Giấy tờ tùy thân - Thông tin chủ thẻ hiển thị</li>
                    <li>
                        ⦁	Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin này CHỈ DÙNG ĐỂ XÁC MINH NHÂN THÂN nhằm đảm bảo an toàn giao dịch theo quy định.
                        </li>

                </ul>
                <p style="text-alignt:justify">Phí xử lý thanh toán: Miễn phí dịch vụ. Các chi phí vật tư tiêu hao, chi phí của bên thứ ba,... sẽ được thể hiện cụ thể khi chọn phương thức thanh toán đặt hàng trên website. Hoặc Quý Khách Hàng sẽ được thông báo trong quá trình đặt hàng.</p>
                <p style="text-alignt:justify" class="text-center"><strong> QUYỀN LỢI </strong></p>
                <p style="text-alignt:justify">
                    C-Mart hỗ trợ đa dạng và phong phú những trải nghiệm, đặc biệt cung cấp đa dạng các phương thức thanh toán tiện lợi, nhanh chóng, an toàn. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một” - cho phép thanh toán ở nhiều nơi, tại nhiều thời điểm, trong cả Thanh toán trả trước, Thanh toán trả sau và Thanh toán kết hợp, cả Giao dịch trực tiếp và Giao dịch trực tuyến.
                    <br>Các sự kiện, chương trình ưu đãi - khuyến mãi khi thanh toán bằng Thẻ, NFC, QR Pay thường xuyên được C-Mart phối hợp cùng các Đối Tác thực hiện.
                    <br>Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).
                    </p>
                <p style="text-alignt:justify"><strong>V. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC BẰNG THẺ THANH TOÁN C-CARD.</strong></p>
                <p style="text-alignt:justify">
                - Thẻ Thanh Toán C-Card (1 C = 1 VNĐ) do C-Mart phát hành có đơn vị thanh toán là Tiền Tích Lũy (C). Thẻ Thanh Toán C-Card có giá trị thanh toán cho các giao dịch cùng C-Mart và các Đối Tác Liên Kết.
                <br>- Quý Khách Hàng có thể sử dụng Thẻ Thanh Toán C-Card của C-Mart bằng cách <strong>liên hệ đến các kênh giao dịch chính thức của C-Mart để yêu cầu quy đổi mã thẻ</strong> thành Tiền Tích Lũy (C) có giá trị thanh toán tại C-Mart và các Đối Tác Liên Kết. Quý Khách Hàng vui lòng liên hệ từ Số điện thoại nhận hàng trong đơn hàng chứa C-Card cần dùng, và cung cấp mã giao dịch + mã Khách Hàng + xác thực chính chủ.
                </p>
                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN
                    </strong></p>
                <p style="text-alignt:justify">
                    Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.
               <br> Thẻ Thanh Toán C-Card từ C-Mart có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại C-Mart.
              <br>     <strong> Xác thực chính chủ khi sử dụng Thẻ Thanh Toán C-Card:</strong>
                </p>
                <p style="text-alignt:justify;margin-left:5%">
                                    Quý Khách Hàng đang giao dịch phải là Người Nhận Hàng theo thông tin đơn hàng chứa C-Card cần sử dụng;
                <br>	Trường hợp Quý Cộng Tác Viên là Người Đặt Hàng: Quý Khách Hàng đang giao dịch phải là Người Đặt Hàng theo thông tin đơn hàng chứa C-Card cần sử dụng;
                </p>
                <p style="text-alignt:justify">
                	C-Mart không hỗ trợ cấp lại / điều chỉnh sau khi đã tiến hành quy đổi (trừ trường hợp thực hiện theo Chính sách Đổi - Trả),...
                <br>	Số dư từ C-Card chỉ có giá trị quy đổi thành Tiền Tích Lũy (C).
                <br>	<strong>Phí xử lý thanh toán: Miễn phí dịch vụ</strong> (nhưng không bao gồm các chi phí vật tư tiêu hao, chi phí của bên thứ ba,...).


                                </p>
                <p style="text-alignt:justify" class="text-center">QUYỀN LỢI
                <br>Quà Tặng Thiết Thực Cho Đời Sống - "Tất cả trong Một"
                </p>

                <p style="text-alignt:justify;margin-left:5%">	Thẻ Thanh Toán C-Card có giá trị thanh toán như tiền mặt tại C-Mart và các Đối Tác Liên Liên Kết. Với giá trị sử dụng cao, đa dạng, nên chẳng những vô cùng tiện lợi, nhanh chóng, mà còn rất an toàn khi không cần kè kè tiền mặt mọi lúc - mọi nơi. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một”.
                <br><strong>	Chính sách Tiết Kiệm Tích Tài C-Saving</strong>: Gia tăng Tiền Tích Lũy (C) theo tỉ lệ được công bố, căn cứ trên số dư bình quân của Số C khả dụng.
                <br>	Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).
                </p>
                <p style="text-alignt:justify"><strong>VI. CƠ CHẾ THANH TOÁN TRẢ TRƯỚC VÀ/HOẶC TRẢ SAU BẰNG THẺ NGÂN HÀNG, QR PAY</strong></p>


                <p style="text-alignt:justify">
                - Các phương thức thanh toán qua Thẻ ngân hàng, QR Pay tại C-Mart được thực hiện hoàn toàn thông qua các đơn vị cung ứng dịch vụ thanh toán đã được Ngân hàng Nhà nước Việt Nam thẩm định cấp phép.</p>

                <p style="text-alignt:justify">Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. C-Mart cam kết hoàn toàn không lưu giữ lại các thông tin thanh toán của Quý Khách Hàng, mà toàn bộ đều được chuyển trực tiếp đến hệ thống xử lý thanh toán.
</p>
                <p style="text-alignt:justify">- Quý Khách Hàng có thể thanh toán bằng Thẻ ngân hàng, QR Pay tại C-Mart theo các hình thức</p>



                <p style="text-alignt:justify;margin-left:5%">
                	Thanh toán trực tuyến (Thanh toán trả trước): Sau khi hoàn tất thông tin đặt hàng, Quý Khách Hàng sẽ thực hiện thanh toán tại duy nhất cửa sổ thanh toán do C-Mart chuyển đến sau đó. Quý Khách Hàng thực hiện nhập thông tin thanh toán, Cổng thanh toán trực tuyến sẽ gửi xác thực đến kênh liên lạc đã đăng ký với Tổ chức tín dụng, Quý Khách Hàng vui lòng hoàn tất theo hướng dẫn.
                <br>	Thanh toán trực tiếp qua Máy quẹt thẻ, NFC, QR Pay (Thanh toán trả sau với đơn vị vận chuyển C-Ship): Khi thanh toán, Quý Khách Hàng chỉ thực hiện thanh toán qua phương tiện thanh toán được C-Mart cung cấp, và thực hiện đúng - đủ quy trình theo Thao tác khi thanh toán.



                </p>

                <p style="text-alignt:justify">Quý Khách Hàng vui lòng kiểm tra cẩn thận các thông tin trước khi thực hiện thanh toán, trước khi ký tên; kiểm tra phương thức thanh toán được trả lại là hàng thật không tỳ vết; và nhận lại các hóa đơn để lưu trữ.</p>



                <p style="text-alignt:justify" class="text-center"><strong>CHÍNH SÁCH THANH TOÁN</strong></p>

                <p style="text-alignt:justify;margin-left:5%">
                	Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác.</p>

                <p style="text-alignt:justify;margin-left:15%">
                	Tài khoản và/hoặc thẻ, phương thức thanh toán cần được đăng ký hình thức thanh toán phù hợp (thanh toán online, thanh toán QR, NFC…), và thỏa mãn các điều kiện thanh toán;
<br>	Giao dịch phải được ghi nhận thành công do hệ thống thanh toán trả về (đảm bảo số dư/hạn mức, xác thực theo quy định…), và C-Mart đã nhận được khoản thanh toán.
</p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Phương thức thanh toán có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu tại đơn vị phát hành phương thức thanh toán được cấp phép.
                    <br><strong>	Xác thực chính chủ khi thanh toán bằng Thẻ ngân hàng, QR Pay</strong>: Quý Khách Hàng đang giao dịch phải là Chủ nhân phương thức thanh toán đang sử dụng.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Khi thanh toán trực tuyến: Quý Khách Hàng có thể được yêu cầu xác minh ảnh Giấy tờ tùy thân chụp cạnh ảnh Mặt trước thẻ đã che 6 số ở giữa.
                    <br>	Khi thanh toán trực tiếp: C-Mart xin phép đối chiếu Giấy tờ tùy thân - Thông tin chủ thẻ hiển thị.
                    <br>	Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin này CHỈ DÙNG ĐỂ XÁC MINH NHÂN THÂN nhằm đảm bảo an toàn giao dịch theo quy định.
                    </p>
                <p style="text-alignt:justify;margin-left:5%">
                    <strong>Phí xử lý thanh toán</strong>: Miễn phí dịch vụ. Các chi phí vật tư tiêu hao, chi phí của bên thứ ba,... sẽ được thể hiện cụ thể khi chọn phương thức thanh toán đặt hàng trên website. Hoặc Quý Khách Hàng sẽ được thông báo trong quá trình đặt hàng.</p>


                <p style="text-alignt:justify" class="text-center">
                    <strong>PHỤ LỤC. DANH SÁCH<br>
                        CÁC CỔNG THANH TOÁN TRỰC TUYẾN TẠI C-MART

                       <br> PHỤ LỤC. QUY ĐỊNH THANH TOÁN QUA CỔNG THANH TOÁN TRỰC TUYẾN
                       <br> PHỤ LỤC. DANH SÁCH
                        <br>CÁC PHƯƠNG THỨC THANH TOÁN THẺ, NFC, QR PAY TẠI C-MART

                        <br>PHỤ LỤC. QUY ĐỊNH KHI THANH TOÁN BẰNG THẺ, NFC, QR PAY
                       <br> QUYỀN LỢI

                    </strong>
                    </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	C-Mart hỗ trợ đa dạng và phong phú những trải nghiệm, đặc biệt cung cấp đa dạng các phương thức thanh toán tiện lợi, nhanh chóng, an toàn. Tất cả chỉ cần thực hiện cùng C-Mart – Nhà phân phối “Tất cả trong Một” - cho phép thanh toán ở nhiều nơi, tại nhiều thời điểm, trong cả Thanh toán trả trước, Thanh toán trả sau và Thanh toán kết hợp, cả Giao dịch trực tiếp và Giao dịch trực tuyến.
                        <br>	Các sự kiện, chương trình ưu đãi - khuyến mãi khi thanh toán bằng Thẻ, NFC, QR Pay thường xuyên được C-Mart phối hợp cùng các Đối Tác thực hiện.
                        <br>	Phương thức thanh toán trả trước giúp Quý Khách Hàng nhanh chóng nắm bắt và tối ưu hóa quyền lợi cùng C-Mart (các chương trình - sự kiện, bão ưu đãi - khuyến mãi, Chính sách Tiền Tích Lũy, Chính sách Tiết Kiệm Tích Tài C-Saving, các chính sách ưu tiên,…).

                </p>
                <p style="text-alignt:justify"><strong>VẤN ĐỀ THƯỜNG GẶP » THANH TOÁN CÙNG C-MART</strong></p>
                <p style="text-alignt:justify;margin-left:5%"><strong>	Thanh toán 1 đơn hàng bằng nhiều phương thức ?
                </strong></p>
                <p style="text-alignt:justify">Dĩ nhiên là được. Chỉ cần các phương thức thanh toán hợp pháp, hợp lệ, thỏa mãn các chính sách, quy định, hướng dẫn của C-Mart.
                </p>

                <p style="text-alignt:justify;margin-left:5%"><strong>		Làm sao đây để quản lý Tài khoản Tiền Tích Lũy của bản thân tại C-Mart ?

                </strong></p>
                <p style="text-alignt:justify">- Quý Khách Hàng có thể trực tiếp quản lý, theo dõi Tài khoản Tiền Tích Lũy của bản thân tại Hồ Sơ Khách Hàng.
                    <br>- Mọi giao dịch trích Tài khoản Tiền Tích Lũy do chính Quý Khách Hàng thực hiện hay ủy quyền cho C-Mart thực hiện đều được xác thực bằng SMS OTP gửi đến chính Số điện thoại xác nhận giao dịch.
                   <br> - Mọi biến động về giá trị Tài khoản Tiền Tích Lũy đều được thông báo đến chính Số điện thoại xác nhận giao dịch.
                </p>


                <p style="text-alignt:justify;margin-left:5%"><strong>
                    	Làm sao đây để biết bản thân đã thanh toán thành công hay chưa ?

                </strong></p>
                <p style="text-alignt:justify">* Đối với các đơn hàng qua C-Store, C-Call, C-Zalo: C-Mart sẽ cập nhật trực tiếp đến Quý Khách Hàng qua Zalo.
                </p>
                <p style="text-alignt:justify">* Đối với các đơn hàng qua C-Facebook, C-A-Z: C-Mart sẽ cập nhật liên tục các khoản thanh toán đơn hàng đến Quý Khách Hàng qua chính Số điện thoại đặt hàng.
                </p>
                <p style="text-alignt:justify">* Đối với các đơn hàng qua Website cm.com.vn:
                   <br> - Cách 1: Nhập Mã giao dịch vào công cụ Kiểm tra Đơn hàng trong mục Hỗ Trợ C-A-Z. Nếu đơn hàng trong trạng thái Đã Xác Nhận Thanh Toán, thì đơn hàng đã hoàn tất trả trước như lựa chọn khi đặt hàng;
                    <br>- Cách 2: Truy cập Lịch sử Đơn hàng trong Hồ Sơ Khách Hàng, Quý Khách Hàng nhấn vào cột Trạng thái của đơn hàng cần tra cứu. Nếu đơn hàng trong trạng thái Đã Xác Nhận Thanh Toán, thì đơn hàng đã hoàn tất trả trước như lựa chọn khi đặt hàng.

                </p>
                <ul>
                    <li><strong>
                        	Bổ sung yêu cầu, Thay đổi thông tin thanh toán
                        </strong></li>
                    <li>
                        <ul>
                            <li><p>	Cách 1: Điền vào mục Ghi chú khi đặt hàng.
                                <br>	Cách 2: Liên hệ đến kênh giao dịch chính thức của C-Mart, bằng Số điện thoại đặt hàng hoặc Số điện thoại nhận hàng, gửi yêu cầu kèm Mã giao dịch.
                                <br>	Cách 3: Bổ sung thêm yêu cầu khi Nhân viên Giao nhận liên hệ trước khi giao hàng.
                                </p></li>
                        </ul>
                    </li>
                </ul>
                <p style="text-alignt:justify">
                    - Thời gian xét duyệt thao tác diễn ra trong tối đa 02 giờ làm việc (kể từ thời điểm C-Mart xác nhận yêu cầu), C-Mart sẽ phản hồi đến kênh thông tin đặt hàng và/hoặc kênh thông tin nhận hàng, và cập nhật hệ thống (nếu có).
                  <br>  - C-Mart chưa hỗ trợ thay đổi Phương thức thanh toán. Quý Khách Hàng vui lòng hủy đơn hàng để tạo lại đơn mới.
                    </p>
                <p style="text-alignt:justify;margin-left:5%"><strong>	Thao tác khi thanh toán</strong></p>
                <ul style="margin-left:5%">
                    <li>
                        	Vui lòng chứng minh nhân thân và kiểm tra cẩn thận trước khi tiến hành thanh toán: các thông tin, phương thức thanh toán, công cụ thanh toán;
                        <br>	Thực hiện thanh toán theo nhu cầu đã lựa chọn của Quý Khách Hàng, phù hợp Chính sách Thanh toán của C-Mart:
                        </li>
                        <ul>
                            <li>	Cơ chế thanh toán bằng Tiền mặt;
                                <br>	Cơ chế thanh toán bằng Tiền Tích Lũy;
                                <br>Cơ chế thanh toán bằng Thẻ Thanh Toán C-Card;
                                <br>	Cơ chế thanh toán bằng Voucher/Coupon;
                                <br>	Cơ chế thanh toán bằng Thẻ ngân hàng, QR Pay;
                                </li>
                        </ul>
                        <li>	Vui lòng lưu giữ hóa đơn chứng từ chứng minh giao dịch nhằm đảm bảo quyền lợi Khách Hàng.</li>
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
