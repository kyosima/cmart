@extends('layout.master')

@section('title', 'Chính Sách Định Dang Khách Hàng & Quyền Lợi Khách Hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/Chính Sách Định Dang Khách Hàng & Quyền Lợi Khách Hàng</a>
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
          <button type="button" class="content-hover btn an title m-2" data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>
        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
            <h3 class="title">Chính Sách Định Dang Khách Hàng & Quyền Lợi Khách Hàng</h3>
            <div class="detail-static">

                <p style="text-alignt:justify">

                Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì <strong>mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách</strong>. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
                </p>
                <p style="text-alignt:justify" class="text-center"><strong>QUYỀN LỢI CƠ BẢN CỦA KHÁCH HÀNG</strong></p>
                <p style="text-alignt:justify">- Khi giao dịch cùng C-Mart, bất kỳ Khách Hàng nào cũng được khuyến khích trở thành Khách Hàng đồng hành cùng C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, được định vị cụ thể để tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng, như:</p>
                <p style="text-alignt:justify;margin-left:5%">
                    Tự do tra xét cẩn thận khi giao dịch cùng C-Mart;

                </p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Ngành hàng đa dạng, chất lượng, “Tất cả trong một” phục vụ mọi khía cạnh cuộc sống, chinh phục mọi tầng lớp trong xã hội, tạo không gian mua sắm tiện lợi, nhanh chóng, giúp Khách Hàng tiết kiệm thời gian, năng lượng khi mua sắm, tìm kiếm theo nhu cầu của bản thân: Khách cần – Khách đến – Khách có đem về.
                    <br>	Giá cả tiết kiệm tối ưu cho những sản phẩm chất lượng.
                </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Trải nghiệm không gian kết nối thoải mái, hào hứng, và tuyệt vời hơn bao giờ hết;

                </p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Thái độ phục vụ chuyên nghiệp, uy tín, trung thực, an toàn, cẩn thận, nhiệt tình, chu đáo.
<br>	Hỗ trợ, tư vấn, cung cấp, phản hồi thông tin.
<br>	Hãy để C-Mart “mách” bạn các thông tin mà bạn nên có, và gửi bạn các thông tin mà bạn muốn có.

                </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Hệ thống các chính sách, chuỗi các sự kiện, chương trình ưu đãi - khuyến mãi được tổ chức thường xuyên, rộng rãi;

            </p>
            <p style="text-alignt:justify;margin-left:15%">
                	C-Mart luôn tăng cường các chiến lược mở rộng thị trường, kết nối - chinh phục mọi tầng lớp, đối tượng Khách Hàng.
<br>	Chính sách Tiền Tích Lũy (C) có giá trị thiết thực dành cho Quý Khách Hàng Thành Viên.


            </p>
            <p style="text-alignt:justify;margin-left:5%">
                	Chương trình Hồ Sơ Khách Hàng giúp tăng kết nối giữa C-Mart - Quý Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Quý Khách Hàng, và hoàn toàn miễn phí;
<br>	Phương thức giao dịch đa dạng, tiện lợi, có thể thực hiện mọi lúc – mọi nơi;
<br>	Phương thức thanh toán đa dạng, tiện lợi an toàn;
<br>	Phương thức giao nhận tiện lợi, tận nơi, nhanh chóng;
<br>	Chính sách hậu mãi (chính sách đổi - trả, chính sách bảo hành…) hợp lý;

            </p>
            <p style="text-alignt:justify">	Các quyền lợi khác được thực hiện theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
            </p>
            <p style="text-alignt:justify"><strong> Khách Hàng Định Danh Thân Thiết: </strong></p>
            <p style="text-alignt:justify;margin-left:5%">
                	Nhận diện Khách Hàng thỏa 03 điều kiện:
            </p>
            <p style="text-alignt:justify;margin-left:15%">
                	Khách Hàng đã xác thực Hồ Sơ Khách Hàng tại C-Mart.
                    <br>	Trong 01 tháng:

            </p>
            <p style="text-alignt:justify;margin-left:20%">
                	Giao Dịch Nguy Hiểm (là giao dịch thất bại do nguyên nhân xuất phát từ phía Quý Khách Hàng, gây thiệt hại cho C-Mart) ≤ 1 lần.

            </p>
            <p style="text-alignt:justify;margin-left:15%">
                	Thỏa mãn điều kiện thẩm định, tái thẩm định của C-Mart.

            </p>
            <p style="text-alignt:justify;margin-left:5%">
                	Kết quả thẩm định được cập nhật vào <strong>ngày cuối cùng của tháng</strong>, hoặc trong vòng tối đa 24 giờ làm việc sau khi C-Mart tiếp nhận yêu cầu của Quý Khách Hàng.
<br>	<strong>Hướng dẫn Định danh Thân Thiết</strong>: Quý Khách Hàng thực hiện theo Hướng dẫn tạo mới Hồ Sơ Khách Hàng.
<br>	Quyền lợi:

            </p>
            <p style="text-alignt:justify;margin-left:15%">
                	Gồm các đặc quyền được quy định trong Quyền lợi cơ bản của Khách Hàng;
                <br>	Giá tốt: Được mua sắm đa dạng những sản phẩm chất lượng với khung Giá Bán Lẻ tiết kiệm tối ưu;
                <br>	Tích Lũy: Chính sách Tiền Tích Lũy (C) là đặc quyền nhận được từ những giao dịch cùng C-Mart, được quy định tại Cơ chế thanh toán bằng Tiền Tích Lũy (C) và Quy định về Tiền Tích Lũy (C);
                <br>	Tiêu dùng thông thái:
                </p>
            <p style="text-alignt:justify;margin-left:20%">
                	Được cung cấp Mã Khách Hàng để tăng kết nối giữa C-Mart - Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Khách Hàng, giúp Quý Khách Hàng chủ động quản lý tài khoản Tiền Tích Lũy, lịch sử giao dịch,... cập nhật đầy đủ và cụ thể các đặc quyền, cập nhật nhanh chóng thông tin các chính sách, chương trình - sự kiện, bão ưu đãi - khuyến mãi từ 4 phương - 8 hướng,...
                <br>	Giao dịch của Quý Khách Hàng đã định danh có độ xác thực cao nên sẽ được xử lý nhanh chóng hơn.
                </p>
            <p style="text-alignt:justify;margin-left:15%">⦁	Các đặc quyền khác được thực hiện theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.</p>


            <p style="text-alignt:justify"><strong>
                 Khách Hàng Định Danh V.I.P:
                </strong></p>
            <p style="text-alignt:justify;margin-left:5%">
                <strong>Nhận diện Khách Hàng thỏa 05 điều kiện: </strong>
            </p>
            <p style="text-alignt:justify;margin-left:15%">
                	Khách Hàng đã xác thực Hồ Sơ Khách Hàng tại C-Mart.
                <br>	Trong 01 tháng:
                </p>
            <p style="text-alignt:justify;margin-left:20%">
                	Tổng Giá Trị Giao Dịch Có Tích Lũy C ≥ 50.000.000 VNĐ;
                <br>	Giao Dịch An Toàn (là giao dịch diễn ra thuận lợi, không xuất hiện bất kỳ khó khăn nào từ phía Quý Khách Hàng) ≥ 4 lần;
                <br>	Giao Dịch Nguy Hiểm (là giao dịch thất bại do nguyên nhân xuất phát từ phía Quý Khách Hàng, gây thiệt hại cho C-Mart) ≤ 1 lần.
                </p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Khách Hàng cần hỗ trợ Công nợ linh hoạt: Trả góp, Gối đầu, Hẹn thời gian thanh toán.
                    <br>	Thỏa mãn điều kiện thẩm định, tái thẩm định của C-Mart.

                </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Kết quả thẩm định được cập nhật vào <strong>ngày cuối cùng của tháng</strong>, hoặc trong vòng tối đa 24 giờ làm việc <strong>sau khi C-Mart tiếp nhận yêu cầu của Quý Khách Hàng</strong>.
                    <br>	<strong>Hướng dẫn Định danh V.I.P</strong>: Quý Khách Hàng thỏa điều kiện nhận diện trên, hãy liên hệ với C-Mart để yêu cầu xác thực và định danh Khách Hàng VI.P.
                    <br>	Quyền lợi:
                    </p>

                <p style="text-alignt:justify;margin-left:15%">
                    	Gồm các đặc quyền được quy định trong <strong>Quyền lợi cơ bản của Khách Hàng</strong>;
                    <br>	Giá tốt: Được mua sắm đa dạng những sản phẩm chất lượng với khung<strong> Giá Shock</strong> tiết kiệm tối ưu;
                    </p>
                <p style="text-alignt:justify;margin-left:20%">	<strong>Chính sách Công nợ linh hoạt</strong> với các phương thức: Trả góp, Gối đầu, Hẹn thời gian thanh toán. Được quy định tại Cơ chế Công nợ linh hoạt</p>
                <p style="text-alignt:justify;margin-left:15%">

	<strong>Tích Lũy</strong>: Chính sách Tiền Tích Lũy (C) là đặc quyền nhận được từ những giao dịch cùng C-Mart, được quy định tại Cơ chế thanh toán bằng Tiền Tích Lũy (C) và Quy định về Tiền Tích Lũy (C);
<br>	Tiêu dùng thông thái:
</p>
                <p style="text-alignt:justify;margin-left:20%">
                    	Được cung cấp Mã Khách Hàng để tăng kết nối giữa C-Mart - Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Khách Hàng, giúp Quý Khách Hàng chủ động quản lý tài khoản Tiền Tích Lũy, lịch sử giao dịch,... cập nhật đầy đủ và cụ thể các đặc quyền, cập nhật nhanh chóng thông tin các chính sách, chương trình - sự kiện, bão ưu đãi - khuyến mãi từ 4 phương - 8 hướng,...
                    <br>	Giao dịch của Quý Khách Hàng đã định danh có độ xác thực cao nên sẽ được xử lý nhanh chóng hơn.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">	Các đặc quyền khác được thực hiện theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
                </p>
                <p style="text-alignt:justify"><strong>Khách Hàng Định Danh Thương Mại:
                </strong></p>
                <p style="text-alignt:justify;margin-left:5%"><strong>Nhận diện Khách Hàng thỏa 05 điều kiện: </strong></p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Khách Hàng đã xác thực Hồ Sơ Khách Hàng tại C-Mart, và giao kết Hợp đồng Phân phối cùng C-Mart.
                    <br>	Khách Hàng thường xuyên giao dịch thành công cho mục đích thương mại. Trong 01 tháng:
                    </p>
                <p style="text-alignt:justify;margin-left:20%">
                    	Tổng Giá Trị Giao Dịch Có Tích Lũy C ≥ 300.000.000 VNĐ;
                    <br>	Giao Dịch Nguy Hiểm (là giao dịch thất bại do nguyên nhân xuất phát từ phía Quý Khách Hàng, gây thiệt hại cho C-Mart) = 0 lần.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">
                    		Khách Hàng cần hỗ trợ Công nợ linh hoạt: Trả góp, Gối đầu, Hẹn thời gian thanh toán.
<br>	Thỏa mãn điều kiện thẩm định, tái thẩm định của C-Mart.
                </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Kết quả thẩm định được cập nhật vào<strong> ngày cuối cùng của tháng</strong>, hoặc trong vòng tối đa 24 giờ làm việc <strong>sau khi C-Mart tiếp nhận yêu cầu của Quý Khách Hàng.</strong>
                    <br>	<strong>Hướng dẫn Định danh Thương Mại</strong>: Quý Khách Hàng thỏa điều kiện nhận diện trên, hãy liên hệ với C-Mart để yêu cầu xác thực và định danh Khách Hàng Thương Mại.
                    <br>	Quyền lợi:
                    </p>
                <p style="text-alignt:justify;margin-left:15%">	Gồm các đặc quyền được quy định trong <strong>Quyền lợi cơ bản của Khách Hàng</strong></p>
                <p style="text-alignt:justify;margin-left:20%">	Chính sách Giá buôn có thể không hỗ trợ kèm Chính sách Tiền Tích Lũy (C), Chính sách Đổi - Trả sản phẩm do nguyên nhân chủ quan từ cá nhân,...</p>

                <p style="text-alignt:justify;margin-left:15%">	Giá tốt: Được phân phối đa dạng những sản phẩm chất lượng với khung Giá Buôn tốt nhất.
                </p>
                <p style="text-alignt:justify;margin-left:20%">	Chính sách Công nợ linh hoạt với các phương thức: Trả góp, Gối đầu, Hẹn thời gian thanh toán. Được quy định tại Cơ chế Công nợ linh hoạt.</p>
                <p style="text-alignt:justify;margin-left:15%">	C-Mart là cầu nối hỗ trợ Quý Khách Hàng kinh doanh thông thái:</p>
                <p style="text-alignt:justify;margin-left:20%">
                    	Được cung cấp Mã Khách Hàng để tăng kết nối giữa C-Mart - Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Khách Hàng, giúp Quý Khách Hàng chủ động quản lý tài khoản Tiền Tích Lũy, lịch sử giao dịch,... cập nhật đầy đủ và cụ thể các đặc quyền, cập nhật nhanh chóng thông tin các chính sách, chương trình - sự kiện, bão ưu đãi - khuyến mãi từ C-Mart, từ Nhà cung cấp, từ Nhà sản xuất,...
                    <br>	Giao dịch của Quý Khách Hàng đã định danh có độ xác thực cao nên sẽ được xử lý nhanh chóng hơn.
                    <br>	Hỗ trợ đa dạng các phương thức giao dịch: C-Store, C-Call, C-Zalo.
                    <br>	Được cung cấp các thông tin bản quyền và các phương tiện cần thiết khác hỗ trợ Quý Khách Hàng kinh doanh.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">	Các đặc quyền khác được thực hiện theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.</p>
                <p style="text-alignt:justify">Khách Hàng Định Danh Cộng Tác Viên:</p>
                <p style="text-alignt:justify;margin-left:5%"><strong>	Nhận diện Khách Hàng thỏa 04 điều kiện:</strong></p>
                <p style="text-alignt:justify;margin-left:15%">	Khách Hàng đã xác thực Hồ Sơ Khách Hàng tại C-Mart, và giao kết Hợp đồng Cộng tác viên cùng C-Mart.
                    <br>	Trong 01 tháng:
                    </p>
                <p style="text-alignt:justify;margin-left:20%">
                    	Tổng Giá Trị Giao Dịch Có Tích Lũy C đảm bảo theo Hợp đồng;
                	<br>Giao Dịch An Toàn (là giao dịch diễn ra thuận lợi, không xuất hiện bất kỳ khó khăn nào từ phía Quý Khách Hàng) đảm bảo theo Hợp đồng;
                    <br>	Giao Dịch Nguy Hiểm (là giao dịch thất bại do nguyên nhân xuất phát từ phía Quý Khách Hàng, gây thiệt hại cho C-Mart) ≤ 4 lần.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">	Thỏa mãn điều kiện thẩm định, tái thẩm định của C-Mart  </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Kết quả thẩm định được cập nhật vào <strong>ngày cuối cùng của tháng</strong>, hoặc trong vòng tối đa 24 giờ làm việc sau khi C-Mart tiếp nhận yêu cầu của Quý Khách Hàng.
                    <br>	Hướng dẫn Định danh Cộng Tác Viên: Quý Khách Hàng thỏa điều kiện nhận diện trên, hãy liên hệ với C-Mart để yêu cầu xác thực và định danh Cộng Tác Viên.
                    <br>	Quyền lợi:
                    </p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Gồm các đặc quyền được quy định trong Quyền lợi cơ bản của Khách Hàng;
                    <br>	Giá tốt: Được phân phối đa dạng những sản phẩm chất lượng với khung Giá Shock tốt nhất.
                    <br>	Tích Lũy: Chính sách Tiền Tích Lũy (C) là đặc quyền nhận được từ những giao dịch cùng C-Mart, được quy định tại Cơ chế thanh toán bằng Tiền Tích Lũy (C) và Quy định về Tiền Tích Lũy (C);
                    <br>	C-Mart là cầu nối hỗ trợ Quý Khách Hàng kinh doanh thông thái:
                    </p>
                <p style="text-alignt:justify;margin-left:20%">
                    	Được cung cấp Mã Khách Hàng để tăng kết nối giữa C-Mart - Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Khách Hàng, giúp Quý Khách Hàng chủ động quản lý tài khoản Tiền Tích Lũy, lịch sử giao dịch,... cập nhật đầy đủ và cụ thể các đặc quyền, cập nhật nhanh chóng thông tin các chính sách, chương trình - sự kiện, bão ưu đãi - khuyến mãi từ C-Mart, từ Nhà cung cấp, từ Nhà sản xuất,...
                    <br>	Giao dịch của Quý Khách Hàng đã định danh có độ xác thực cao nên sẽ được xử lý nhanh chóng hơn.
                    <br>	Được cung cấp các thông tin bản quyền và các phương tiện cần thiết khác hỗ trợ Quý Khách Hàng kinh doanh.
                    </p>
                <p style="text-alignt:justify;margin-left:15%">
                	Các đặc quyền khác được thực hiện theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.</p>

                <p style="text-alignt:justify"><strong>VẤN ĐỀ THƯỜNG GẶP » HỒ SƠ KHÁCH HÀNG, ĐỊNH DANH KHÁCH HÀNG TẠI C-MART</strong></p>


                <p style="text-alignt:justify">
                    Tạo Hồ Sơ Khách Hàng tại C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, được định vị cụ thể để tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng.
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
