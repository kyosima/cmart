@extends('layout.master')

@section('title', 'Quy Định Bán Hàng Trên Website C-mart')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
<section class="navigation shadow-bottom">
    <div class="container" >
      <div class="content-nav">
        <a href="#" class="tchu">Trang Chủ</a>
        <a href="# " class="cs">/Quy Định Bán Hàng Trên Website C-mart</a>
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
          <button type="button" class="content-hover  btn an title m-2" data-toggle="modal" data-target="#rightModal">
            <i class="fas fa-angle-double-left"></i>
          </button>
        </div>
        <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
        <div class="static-detail">
            <h3 class="title">Quy Định Điều Khoản Và Điệu Kiện Giao Dịch Tại C-MART</h3>
            <div class="detail-static">
                <p style="text-alignt:justify"><strong> 1. Quy định chung.</strong>

                    <p>
                <p style="text-alignt:justify;margin-left:5%">

                    Bằng việc kết nối với C-Mart và/hoặc thực hiện các thao tác tại C-Mart trên mọi nền tảng, các chủ thể đã chấp nhận thực hiện các chính sách, quy định, hướng dẫn của C-Mart, đặc biệt là Quy định Điều khoản & Điều kiện giao dịch của C-Mart;
                <br>Trong mọi trường hợp, C-Mart xin phép miễn trừ mọi trách nhiệm (nếu nguyên nhân không phải do lỗi cố ý của C-Mart gây ra), C-Mart có trách nhiệm thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 24 giờ làm việc (kể từ thời điểm xác nhận rủi ro);
                </p>
                <p style="text-alignt:justify">Trong mọi trường hợp, Quý Đối Tác Cung Cấp sẽ chịu hoàn toàn trách nhiệm đối với mọi vấn đề liên quan đến sản phẩm đã cung cấp.</p>
                <p style="text-alignt:justify;margin-left:5%">
                Mọi vấn đề phát sinh trong quan hệ Hợp đồng giữa C-Mart và Quý Khách sẽ được hiểu và điều chỉnh theo quy định của luật pháp Việt Nam. Mọi khiếu nại sẽ được giải quyết thông qua thương lượng trên tinh thần thiện chí trong vòng tối đa 30 ngày làm việc (kể từ thời điểm C-Mart ghi nhận vấn đề). </p>
                <p style="text-alignt:justify">
                    - Trong trường hợp xảy ra tranh chấp, quyết định của C-Mart là quyết định cuối cùng.
                   <br> - Trong giai đoạn này, các bên vẫn thực hiện theo đúng các chính sách, quy định, hướng dẫn của C-Mart, theo đúng Hợp đồng và theo Pháp luật.
                    </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Nếu bất kỳ nội dung nào nằm trong các chính sách, quy định, hướng dẫn của C-Mart bị vô hiệu hóa, thì tính hiệu lực của các nội dung còn lại vẫn không bị ảnh hưởng;
                    <br>	Các chính sách, quy định, hướng dẫn của C-Mart trên mọi nền tảng mặc định có hiệu lực ngay khi đăng tải. Các thông báo có liên quan được công bố trên Cửa hàng trực tuyến cm.com.vn.
                    </p>
                <p style="text-alignt:justify">C-Mart có toàn quyền thay đổi, điều chỉnh, và/hoặc tạm ngừng, và/hoặc hủy bỏ bằng cách đăng tải nội dung cập nhật mà không cần thông báo trước.</p>

                <p style="text-alignt:justify;margin-left:5%">
                    Trong trường hợp xuất hiện nội dung không đồng nhất thì áp dụng theo thứ tự ưu tiên như sau: (i) Hợp đồng ; (ii) Quy định Điều khoản & Điều kiện giao dịch ; (ii) Các chính sách, quy định, hướng dẫn chung có hiệu lực tại thời điểm tra xét.
                    <br>Giải thích các thuật ngữ:
                    </p>
                <ul>
                    <li>⦁	“Đối Tác”: bao gồm các chủ thể hiệp đồng cung ứng hàng hóa, dịch vụ cho C-Mart.</li>

                    <li>⦁	“Kênh giao dịch chính thức của C-Mart”: bao gồm các kênh thông tin liên lạc - đặt hàng chính thức được C-Mart công bố như các kênh C-Store, Điện thoại, mạng xã hội Facebook,  Zalo, kênh Chăm sóc Khách Hàng Trực tuyến C-A-Z.
                    </li>
                    <li>
                        ⦁	“Kênh thông tin xác nhận giao dịch”: các thông tin xác nhận giao dịch được đăng ký với C-Mart, thường là số điện thoại, mạng xã hội.
                        </li>

                    <li>⦁	“Kênh thông tin đặt hàng”: các thông tin liên lạc của người đặt hàng, thường là số điện thoại, mạng xã hội.</li>
                    <li>
                        ⦁	“Kênh thông tin nhận hàng”: các thông tin liên lạc của người nhận hàng, thường là số điện thoại, mạng xã hội.
                        </li>

                    <li>⦁	“Hợp đồng”: bao gồm tất cả mọi giao kết, thỏa thuận bằng văn bản, hành vi, ngôn từ… hợp pháp, hợp lệ.</li>
                    <li>
                        ⦁	“Giao dịch an toàn”: giao dịch diễn ra thuận lợi, không xuất hiện bất kỳ khó khăn nào từ phía Quý Khách Hàng.
                        </li>
                    <li>⦁	“Giao dịch khó khăn”: giao dịch diễn ra không thuận lợi, xuất hiện nhiều khó khăn từ phía Quý Khách Hàng.</li>
                    <li>
                        ⦁	“Giao dịch nguy hiểm”: giao dịch thất bại do nguyên nhân xuất phát từ phía Quý Khách Hàng, gây thiệt hại cho C-Mart.
                        </li>



                </ul>
                <p style="text-alignt:justify"><strong>
                    	Phạm vi áp dụng.
                        </strong></p>
                <p style="text-alignt:justify">
                    	Mọi chủ thể  kết nối với C-Mart và/hoặc thực hiện các thao tác tại C-Mart trên mọi nền tảng;
                    <br>	Mọi chủ thể có liên quan đến quyền lợi, nghĩa vụ của C-Mart.
                    </p>


                <p style="text-alignt:justify" class="text-center">
                <strong>
                    	Quyền và nghĩa vụ của C-Mart.
                    <br>	Quyền của C-Mart.
                    </strong></p>
                <p style="text-alignt:justify;margin-left:2%">Giữ toàn quyền và giữ vai trò quyết định cuối cùng về C-Mart trên mọi nền tảng, bao gồm: phương hướng - chính sách, cách thức - hành động; từ chối, thay đổi, điều chỉnh, tạm ngừng, chấm dứt, vận hành, sử dụng, lưu trữ, bảo vệ, kiểm soát,…</p>

                <p style="text-alignt:justify">C-Mart có toàn quyền cho mọi quyết định, hành động trên các nền tảng của C-Mart mà không cần thông báo đến từng chủ thể, hay chịu bất kỳ trách nhiệm phát sinh nào.</p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Kiểm soát mọi chủ thể có liên quan thực hiện đầy đủ nghĩa vụ theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật;
                    <br>	Kiểm soát mọi chủ thể có liên quan cung cấp, cập nhật chính xác, đầy đủ các thông tin cần thiết, đặc biệt là tiến hành xác thực thông tin;
                    <br>	Giữ bản quyền toàn bộ về C-Mart;
                    </p>
                <p style="text-alignt:justify">Việc sử dụng các nội dung thông tin, hình ảnh, tài nguyên,… từ C-Mart phải được sự đồng ý trước bẳng văn bản của C-Mart.</p>
                <p style="text-alignt:justify;margin-left:5%">
                    Toàn quyền sử dụng các biện pháp cần thiết để đưa ra nhận định, ngăn chặn, xử lý các vi phạm gây ảnh hưởng đến C-Mart và/hoặc các chủ thể liên quan, bao gồm quyền đơn phương ngừng cung cấp các hoạt động, các quyền lợi liên quan, cũng như thực hiện các biện pháp về pháp lý nếu phát hiện vi phạm;</p>

                <p style="text-alignt:justify">Ngoài ra, nếu C-Mart nhận thấy khả năng gây thiệt hại cho C-Mart và/hoặc các chủ thể liên quan, C-Mart có quyền đơn phương từ chối, và/hoặc thay đổi - điều chỉnh, và/hoặc tạm ngừng, và/hoặc chấm dứt ngay tư cách thành viên, cùng các quyền lợi liên quan, và/hoặc quyền truy cập, sử dụng cùng các thao tác hoạt động có liên quan tại C-Mart. Và C-Mart sẽ thông báo đến kênh thông tin có liên quan.</p>
                <p style="text-alignt:justify">Các quyền và lợi ích khác theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.</p>

                <p style="text-alignt:justify" class="text-center"><strong>Nghĩa vụ của C-Mart.</strong></p>
                <p style="text-alignt:justify">
                    Thực hiện tầm nhìn, hoàn thiện sứ mệnh trên tinh thần trung thành với những giá trị cốt lõi của C-Mart;
                    <br>	Phủ sóng đến với mọi đối tượng, tầng lớp trong xã hội một nền văn hóa tiêu dùng: văn minh và tiện lợi;
                    <br>	Cung cấp đa dạng những sản phẩm chất lượng, với mức giá tối ưu, cùng các chương trình, sự kiện ưu đãi - khuyến mãi, tiện ích chăm sóc, hỗ trợ Khách Hàng, mang đến không gian mua sắm thoải mái, hào hứng, tuyệt vời hơn bao giờ hết;
                    <br>	Phát huy vai trò Nhà phân phối trung gian tạo cầu nối giữa Khách Hàng – Đối Tác, vẽ nên bức tranh thương mại chuyên nghiệp tại Việt Nam;
                    <br>	Các trách nhiệm khác theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
                    </p>
                <p style="text-alignt:justify" class="text-center" ><strong>Quyền lợi và nghĩa vụ Khách Hàng</strong></p>

                <p style="text-alignt:justify"><strong>
                    Quyền lợi của Khách Hàng.
                    </strong></p>
                <p style="text-alignt:justify">Tự do tra xét cẩn thận khi giao dịch tại C-Mart;</p>
                <p style="text-alignt:justify;margin-left:5%">Ngành hàng đa dạng, chất lượng, “Tất cả trong một” phục vụ mọi khía cạnh cuộc sống, chinh phục mọi tầng lớp trong xã hội, tạo một không gian mua sắm tiện lợi, nhanh chóng, giúp Khách Hàng tiết kiệm thời gian, năng lượng khi mua sắm, tìm kiếm theo nhu cầu của bản thân: Khách cần – Khách đến – Khách có đem về.
                    <br>Giá cả tiết kiệm tối ưu cho những sản phẩm chất lượng.
                    </p>
                <p style="text-alignt:justify">
                    Trải nghiệm không gian kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết;

                </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Thái độ phục vụ chuyên nghiệp, uy tín, trung thực, an toàn, cẩn thận, nhiệt tình, chu đáo.
                    <br>	Hỗ trợ, tư vấn, cung cấp, phản hồi thông tin.
                    <br>	Hãy để C-Mart “mách” bạn các thông tin mà bạn nên có, và gửi bạn các thông tin mà bạn muốn có.
                    </p>
                <p style="text-alignt:justify">
                    	Hệ thống các chính sách, chuỗi các sự kiện, chương trình ưu đãi - khuyến mãi được tổ chức thường xuyên, rộng rãi;</p>
                <p style="text-alignt:justify;margin-left:5%">
                    	C-Mart luôn tăng cường các chiến lược mở rộng thị trường, kết nối - chinh phục mọi tầng lớp, đối tượng Khách Hàng.
                    <br>	Chính sách Tiền Tích Lũy (C) có giá trị thiết thực dành cho Khách Hàng Thành Viên.
                    </p>
                <p style="text-alignt:justify">
                    Chương trình Hồ Sơ Khách Hàng giúp tăng kết nối giữa C-Mart - Khách Hàng Thành Viên, giúp thao tác quản lý chuyên nghiệp hơn, nhanh chóng hơn, để kết nối cụ thể hơn đến từng Khách Hàng, và hoàn toàn miễn phí;
                    <br>	Phương thức giao dịch đa dạng, tiện lợi, có thể thực hiện mọi lúc – mọi nơi;
                    <br>	Phương thức thanh toán đa dạng, tiện lợi an toàn;
                    <br>	Phương thức giao nhận tiện lợi, tận nơi, nhanh chóng;
                    <br>	Chính sách hậu mãi (chính sách đổi - trả, chính sách bảo hành,…) hợp lý
                    <br>	Các quyền lợi khác theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
                    </p>
                <p style="text-alignt:justify"><strong>Trách nhiệm của Khách Hàng.</strong><br>Cung cấp, cập nhật nhanh chóng, chính xác và đầy đủ các thông tin cần thiết;
                </p>
                <p style="text-alignt:justify;margin-left:5%">

	Quý Khách Hàng cần tạo điều kiện cho C-Mart xác thực thông tin Khách Hàng;
<br>	Bằng cách giao dịch với C-Mart, Quý Khách đã đồng ý điều khoản: Trước khi C-Mart xác nhận yêu cầu hủy thông tin liên lạc được Quý Khách đăng ký với C-Mart, thì <strong>mọi giao dịch, giao kết từ các kênh liên lạc trên đều được xem là giao kết Hợp đồng chính thức giữa C-Mart và Quý Khách</strong>. Trước thời điểm trên, C-Mart xin miễn trừ mọi trách nhiệm từ những vấn đề phát sinh ngoài ý muốn của Quý Khách qua các kênh liên lạc trên.
</p>


                <p style="text-alignt:justify">Phối hợp với C-Mart hoàn thành thành công Hợp đồng qua các chủ thể được chỉ định, qua các kênh giao dịch chính thức của C-Mart;</p>
                <p style="text-alignt:justify">Quý Khách Hàng cần bồi thường thiệt hại cho C-Mart nếu Quý Khách Hàng vi phạm Hợp đồng, các chính sách, quy định, hướng dẫn của C-Mart.</p>

                <p style="text-alignt:justify">
                    	Chịu hoàn toàn mọi trách nhiệm về các Tài khoản HSKH và Tài khoản Tiền Tích Lũy cá nhân tại C-Mart;
                    </p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Ngay khi phát hiện các dấu hiệu bất thường, Quý Khách Hàng cần thông báo ngay và luôn với C-Mart và các chủ thể có liên quan để phối hợp xử lý kịp thời.
                    <br>	Tự bảo mật, chịu hoàn toàn trách nhiệm, thường xuyên theo dõi các thông tin tài khoản, thông tin giao dịch, thông tin thông báo đến kênh thông tin xác nhận giao dịch.
                    <br>	Mách: Cẩn thận khi nhập thông tin tài khoản, bảo mật thông tin tài khoản, không cho bất kỳ ai mượn thông tin hay truy cập vào tài khoản, thậm chí là không đăng nhập vào đường truyền internet công cộng để truy cập tài khoản,...
                    </p>
                <p style="text-alignt:justify">
                    	Phối hợp với C-Mart xử lý những vấn đề phát sinh giữa C-Mart và Quý Khách Hàng (nếu có);
                    <br>	Phối hợp với C-Mart ngăn chặn những hành vi vi phạm các chính sách, quy định, hướng dẫn của C-Mart, gây ảnh hưởng đến C-Mart và/hoặc các chủ thể liên quan;
                    <br>	Các trách nhiệm khác theo các chính sách, quy định, hướng dẫn của C-Mart, theo Hợp đồng, theo Pháp luật.
                    </p>
                <p style="text-alignt:justify;margin-left:25%"><strong>Định danh Khách Hàng và quyền lợi Khách Hàng</strong> được cụ thể hóa trong Chính sách Định danh & Quyền lợi Khách Hàng</p>
                <p style="text-alignt:justify">C-Mart khuyến khích Quý Khách Hàng thực hiện định danh Khách Hàng và được cung cấp Mã Khách Hàng, để trở thành Khách Hàng đồng hành cùng C-Mart để mua sắm tiết kiệm, tiêu dùng thông thái, được định vị cụ thể để tận hưởng thật nhiều quyền lợi từ 4 phương - 8 hướng. </p>

                <p style="text-alignt:justify " class="text-center"><strong>Các quy định về giao dịch của C-Mart.<br>	Mọi quy trình giao dịch của C-Mart tuân thủ theo Hợp đồng với C-Mart, các chính sách, quy định, hướng dẫn của C-Mart, và theo Pháp luật.
                </strong></p>

                <p style="text-alignt:justify">C-Mart có quyền đơn phương từ chối, và/hoặc thay đổi - điều chỉnh, và/hoặc tạm ngừng  và/hoặc hủy các giao dịch trong một số trường hợp theo quyền quyết định cuối cùng của C-Mart. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 24 giờ làm việc (kể từ thời điểm quyết định được đưa ra).</p>
                <p style="text-alignt:justify;margin-left:25%"><strong>	Mọi thông tin trên Cửa hàng trực tuyến cm.com.vn hay qua các kênh giao dịch chính thức của C-Mart vẫn chưa phải là giao kết Hợp đồng chính thức với C-Mart.</strong></p>


                <p style="text-alignt:justify">Quan hệ Hợp đồng với C-Mart chỉ hình thành và có hiệu lực từ thời điểm: giao dịch được C-Mart xác nhận đến các kênh thông tin có liên quan.</p>

                <p style="text-alignt:justify;margin-left:25%"><strong>	Rủi ro giao dịch, Miễn trừ trách nhiệm Hợp đồng.
                </strong></p>
                <p style="text-alignt:justify">
                    C-Mart xin phép miễn trừ mọi trách nhiệm nếu nguyên nhân không phải do lỗi cố ý của C-Mart. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 24 giờ làm việc (kể từ thời điểm xác nhận rủi ro):
                    </p>
                <p  style="text-alignt:justify;margin-left:5%">
                    <br>	Giao dịch không đủ điều kiện thực hiện, sai bản chất, không phù hợp,... ;
                    <br>	Bên thứ ba không thuộc quyền điều hành trực tiếp của C-Mart gây ra;
                    <br>	Các trường hợp bất khả kháng, không lường trước được và không thể khắc phục được mặc dù đã áp dụng mọi biện pháp cần thiết như: thiên tai, thảm họa, dịch bệnh, các sự cố an ninh - chính trị, các chính sách, quy định của cơ quan Nhà nước, đình công, cấm vận, phong tỏa, các sự cố hệ thống vượt ngoài tầm kiểm soát hợp lý của C-Mart,…
                    </p>

                <p style="text-alignt:justify;margin-left:25%"><strong>Giá bán và Chính sách Thanh toán.
                </strong></p>
                <p style="text-alignt:justify;margin-left:35%">

                <strong>Giá bán tham khảo qua các kênh giao dịch chính thức của C-Mart vẫn chưa phải là giao kết Hợp đồng chính thức với C-Mart</strong>. Quan hệ Hợp đồng với C-Mart chỉ hình thành và có hiệu lực từ thời điểm giao dịch được C-Mart xác nhận đến các kênh thông tin có liên quan.
                </p>
                <p style="text-alignt:justif;margin-left:5%">
                    	Trong mọi trường hợp, Giá bán, Phí vận chuyển, Phí DVTT chưa bao gồm thuế giá trị gia tăng VAT (nếu có).
                    <br>	Trong mọi trường hợp, giá bán chưa bao gồm phí vận chuyển (nếu có). Quý Khách Hàng vui lòng tra cứu cụ thể khi đặt hàng trên website. Hoặc Quý Khách Hàng sẽ được thông báo trong quá trình đặt hàng.
                    <br>	Trong mọi trường hợp, giá bán chưa bao gồm phí thanh toán (nếu có). Quý Khách Hàng vui lòng tra cứu cụ thể khi khi chọn phương thức thanh toán đặt hàng trên website. Hoặc Quý Khách Hàng sẽ được thông báo trong quá trình đặt hàng.
                    <br>	Trong mọi trường hợp, giá bán chưa bao gồm phí đổi - trả (nếu có). Quý Khách Hàng vui lòng tham khảo Chính sách Đổi - Trả.
                    <br>	Trong mọi trường hợp, giá bán chưa bao gồm phí bảo hành (nếu có). Quý Khách Hàng vui lòng tham khảo Chính sách Bảo hành.
                    </p>
                <p style="text-alignt:justify;margin-left:35%"><strong>Chính sách thanh toán được thực hiện theo Hợp đồng và/hoặc Chính sách Thanh toán.</strong></p>

                <p style="text-alignt:justify">C-Mart có quyền đơn phương từ chối, và/hoặc thay đổi - điều chỉnh, và/hoặc tạm ngừng, và/hoặc hủy các giao dịch trong một số trường hợp theo quyền quyết định cuối cùng của C-Mart. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 02 giờ làm việc (kể từ thời điểm quyết định được đưa ra). </p>
                <p style="text-alignt:justify;margin-left:35%"><strong>Chính sách giao nhận được thực hiện theo Hợp đồng và/hoặc Chính sách Giao - Nhận.</strong></p>

                <p style="text-alignt:justify">C-Mart có quyền đơn phương từ chối, và/hoặc thay đổi - điều chỉnh, và/hoặc tạm ngừng, và/hoặc hủy giao hàng trong một số trường hợp theo quyền quyết định cuối cùng của C-Mart. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 24 giờ làm việc (kể từ thời điểm quyết định được đưa ra).
                </p>


                <p style="text-alignt:justify;margin-left:35%"><strong>Chính sách đổi - trả được thực hiện theo Hợp đồng và/hoặc Chính sách Đổi - Trả.
                </strong> </p>
                <p style="text-alignt:justify;margin-left:35%"><strong>Chính sách bảo hành được thực hiện theo Hợp đồng và/hoặc Chính sách Bảo hành.
                </strong> </p>
                <p style="text-alignt:justify;margin-left:25%"><strong>	Trong các sự kiện, chương trình ưu đãi - khuyến mãi, để đảm bảo tính công bằng và quyền lợi Khách Hàng, C-Mart có quyền áp dụng một số điều kiện, hoặc tất cả các điều kiện giới hạn sau: </strong></p>

                <p style="text-alignt:justify ;margin-left:5%">
                    	Giao dịch và Phương thức thanh toán có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu của C-Mart;
                    <br>	Giới hạn về giá trị sử dụng;
                    <br>	Giới hạn về thời gian sử dụng;
                    <br>	Giới hạn về đối tượng sử dụng;
                    <br>	Giới hạn về phạm vi sử dụng, hình thức sử dụng, mục đích sử dụng: không được chuyển nhượng hay dùng sai bản chất, không phù hợp, số dư không có giá trị quy đổi trong mọi trường hợp,... ;
                    <br>	Giới hạn về số lượt sử dụng: trong ngày, trong chương trình, trên mỗi hóa đơn, trên mỗi cá nhân,... ;
                    <br>	Nội dung các sự kiện, chương trình ưu đãi - khuyến mãi không có các thông tin định danh nên C-Mart không xác thực chính chủ khi sử dụng, không hỗ trợ cấp lại (trừ trường hợp thực hiện theo Chính sách Đổi - Trả),...
                    <br>	Các sự kiện, chương trình ưu đãi - khuyến mãi có thể không hỗ trợ kèm Chính sách Tiền Tích Lũy (C), Chính sách Đổi - Trả sản phẩm do nguyên nhân chủ quan từ cá nhân,...
                    <br>	Các giới hạn khác, cùng các điều kiện sử dụng được quy định kèm theo.
                    </p>

                <p style="text-alignt:justify">C-Mart sẽ sử dụng các phương tiện của mình để xác minh, và có toàn quyền, cũng như đưa ra quyết định cuối cùng trong triển khai. Theo đó, C-Mart có quyền đơn phương từ chối, và/hoặc thay đổi - điều chỉnh, và/hoặc tạm ngừng, và/hoặc hủy các giao dịch được C-Mart ghi nhận vi phạm. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin có liên quan trong tối đa 24 giờ làm việc (kể từ thời điểm quyết định được đưa ra).</p>

                <p style="text-alignt:justify" class="text-center"><strong>
                    	Quy định về Tiền Tích Lũy (C).
                    </strong></p>
                <p style="text-alignt:justify;margin-left:5%">
                    	Tiền Tích Lũy (1 C = 1 VNĐ) là đơn vị thanh toán do C-Mart phát hành, và Tài khoản Tiền Tích Lũy được quản lý chi tiết trong Hồ Sơ Khách Hàng.
                    <br>	Tiền Tích Lũy (C) có giá trị thanh toán cho các giao dịch cùng C-Mart và các Đối Tác Liên Kết, và thật dễ nhận được theo Cơ chế thanh toán bằng Tiền Tích Lũy.
                    <br>	Tiền Tích Lũy (C) có giá trị thanh toán khi và chỉ khi có giá trị hợp pháp, hợp lệ, thỏa mãn yêu cầu thanh toán, các chính sách, quy định, hướng dẫn của C-Mart và Đối Tác, đủ điều kiện lưu hành và được theo dõi, ghi nhận dữ liệu của C-Mart.
                    <br>	<strong>Xác thực chính chủ khi sử dụng Tiền Tích Lũy (C):</strong>
                    </p>

                <p style="text-alignt:justify;margin-left:15%">
                    Quý Khách Hàng đang giao dịch phải là Chủ nhân Hồ Sơ Khách Hàng chứa Tài khoản Tiền Tích Lũy cần sử dụng;
                    <br>	Mọi giao dịch trích Tài khoản Tiền Tích Lũy đều được xác thực bằng SMS OTP gửi đến chính Số điện thoại xác nhận giao dịch;
                    <br>	Mọi biến động số dư Tài khoản Tiền Tích Lũy đều được thông báo đến chính Số điện thoại xác nhận giao dịch.
                    </p>




                <p style="text-alignt:justify;margin-left:5%">
                    	C-Mart có quyền phong tỏa, và/hoặc tự động trích nợ từ Tài khoản Tiền Tích Lũy sau 02 giờ làm việc (kể từ thời điểm thông báo được gửi đến kênh thông tin xác nhận giao dịch) trong các trường hợp:</p>


                <p style="text-alignt:justify;margin-left:15%">

                    Kết quả giao dịch từ hệ thống quản lý Tiền Tích Lũy bị lỗi;
                    <br>	Các giao dịch không phù hợp, sai quy định, không đúng bản chất,…
                    <br>	Các chi phí phát sinh hợp lệ, theo quy định (nếu có);
                    <br>	Theo quyết định của cơ quan Nhà nước có thẩm quyền;
                    <br>	Các trường hợp khác theo thỏa thuận giữa Quý Khách Hàng và C-Mart.
                </p>
                <p style="text-alignt:justify" class="text-center"><strong>Chăm sóc Khách Hàng, Xử lý khiếu nại.
                </strong></p>
                <p style="text-alignt:justify">
                    - Để yêu cầu hỗ trợ, hay có bất kỳ thắc mắc, khiếu nại nào, Quý Khách vui lòng vui lòng liên hệ đến các kênh giao dịch chính thức của C-Mart đã được công bố, bằng các kênh thông tin xác nhận giao dịch, hoặc kênh thông tin nhận hàng để được hỗ trợ ngay và luôn.
                  <br>  - C-Mart sẽ có thông báo tiếp nhận, và hỗ trợ, phản hồi chính thức đến Quý Khách Hàng trong trạng thái khẩn trương, nhiệt tình nhất.
                    </p>
                <p style="text-alignt:justify" class="text-center"><strong>
                    Chính sách Thông tin.

                </strong></p>
                <p style="text-alignt:justify">
                    Xin Quý Khách tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.
                    </p>
                <p style="text-alignt:justify" class="text-center"><strong>Về việc thu thập thông tin.
                </strong> </p>
                <p style="text-alignt:justify">
                    - Khi Quý Khách thực hiện các giao dịch tại C-Mart, Quý Khách cần cung cấp, cập nhật nhanh chóng, chính xác và đầy đủ các thông tin cần thiết; đồng thời chịu mọi trách nhiệm về các thông tin đã cung cấp.
                <br>    - Xin Quý Khách tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.
                </p>
                <p style="text-alignt:justify" class="text-center"><strong>Về việc lưu giữ và bảo mật thông tin.</strong></p>
                <p style="text-alignt:justify">- Quý Khách Hàng phải chịu hoàn toàn mọi trách nhiệm về Tài khoản HSKH và Tài khoản Tiền Tích Lũy của C-Mart:</p>
                <p style="text-alignt:justify;margin-left:15%">
                    	Ngay khi phát hiện các dấu hiệu bất thường, Quý Khách Hàng cần thông báo ngay và luôn với C-Mart và các chủ thể có liên quan để phối hợp xử lý kịp thời.
                    <br>	Tự bảo mật, chịu hoàn toàn trách nhiệm, thường xuyên theo dõi các thông tin tài khoản, thông tin giao dịch, thông tin thông báo đến kênh thông tin xác nhận giao dịch.
                    <br>	Mách: Cẩn thận khi nhập thông tin tài khoản, bảo mật thông tin tài khoản, không cho bất kỳ ai mượn thông tin hay truy cập vào tài khoản, thậm chí là không đăng nhập vào đường truyền internet công cộng để truy cập tài khoản,...
                </p>
                <p style="text-alignt:justify">
                    - Đối với các Hồ Sơ Khách Hàng đã đóng, C-Mart vẫn tiếp tục lưu trữ các thông tin trong tối đa 12 tháng (kể từ thời điểm thao tác được C-Mart xác nhận) để phục vụ cho các mục đích phòng chống gian lận, hỗ trợ điều tra, hỗ trợ CSKH,… Sau khoảng thời hạn này, C-Mart sẽ tiến hành xóa vĩnh viễn dữ liệu người dùng.
<br>       - Xin Quý Khách tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.
                     </p>
                <p style="text-alignt:justify" class="text-center"><strong>Về việc sử dụng thông tin</strong></p>
                <p style="text-alignt:justify">- C-Mart có toàn quyền sử dụng thông tin của Quý Khách nhằm các mục đích bao gồm nhưng không giới hạn như sau: </p>

                <p style="text-alignt:justify;margin-left:5%">
                    	Cung cấp các dịch vụ, tiện ích đến Quý Khách;
                    <br>	Thông báo, phản hồi, trao đổi thông tin giữa Quý Khách và C-Mart;
                    <br>	Phát hiện, ngăn chặn các hành vi giả mạo, phá hoại, cũng như các hành vi vi phạm chính sách, quy định, hướng dẫn của C-Mart, gây ảnh hưởng đến C-Mart và/hoặc các chủ thể liên quan;
                    <br>	Nâng cao chất lượng hoạt động của C-Mart: chăm sóc Khách Hàng, nghiên cứu thị trường phục vụ nội bộ...


                </p>
                <p style="text-alignt:justify">
                    - Xin Quý Khách tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng.</p>



                <p style="text-alignt:justify" class="text-center"><strong>Về việc chia sẻ thông tin.</strong></p>
                <p style="text-alignt:justify">
                    - C-Mart không chia sẻ thông tin của Quý Khách cho bất kỳ bên thứ ba nào, trừ các trường hợp: cung cấp các dịch vụ, tiện ích đến Quý Khách (các đơn vị giao nhận, đơn vị bảo hành, đơn vị trung gian thanh toán,…), nâng cao chất lượng hoạt động, thực hiện theo quyết định của các cơ quan Nhà nước có thẩm quyền.
                   <br> - Ngoài các trường hợp trên, C-Mart cam kết sẽ chỉ thực hiện chia sẻ thông tin của Quý Khách KHI VÀ CHỈ KHI được sự chấp thuận của Quý Khách. C-Mart sẽ tiến hành thông báo đến Quý Khách qua các kênh thông tin đã đăng ký với C-Mart.
                   <br> - Xin Quý Khách tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng
                    </p>


                <p style="text-alignt:justify;margin-left:5%"><strong>Chính sách Bảo hộ</strong></p>
                <p style="text-alignt:justify;margin-left:15%">	  C-Mart không chịu trách nhiệm về những vấn đề phát sinh do Quý Khách truy cập vào các kênh giao dịch không chính thức của C-Mart, hay kết nối đến các chủ thể không do C-Mart chỉ định.</p>

                <p style="text-alignt:justify;margin-left:15%"><strong>

                    	 Tuyệt đối nếu chưa được sự cho phép trước bằng văn bản của C-Mart, nghiêm cấm mọi hình thức trái phép, sai mục đích như: xâm nhập trái phép, can thiệp trái phép, sử dụng trái phép, đăng tải trái phép, thu thập trái phép, phát tán trái phép, lưu trữ trái phép trên nền tảng của C-Mart, hoặc bất kỳ hành vi trái phép nào trên nền tảng của C-Mart
                    </strong></p>

                <p style="text-alignt:justify">
                    - Nghiêm cấm sử dụng tài nguyên, tiện ích của C-Mart ngoài mục đích giao dịch với C-Mart, hay ngoài các mục đích hướng đến mục đích giao dịch với C-Mart, mà không có sự cho phép trước của C-Mart bằng văn bản.
                   <br> - Nghiêm cấm sử dụng tài nguyên, tiện ích của C-Mart vào những mục đích bất hợp pháp, đầu cơ, phá hoại, tạo các thông tin ảo, thông tin giả, hay bất kỳ hành vi nào gây ảnh hưởng đến xã hội, đến C-Mart và/hoặc các chủ thể có liên quan.
                     </p>
                <p style="text-alignt:justify;margin-left:35%"><strong> Nghiêm cấm các hành vi cung cấp hoặc tác động để được cung cấp những thông tin về C-Mart và/hoặc các chủ thể có liên quan, cung cấp thông tin không đúng sự thật, gây tổn hại đến C-Mart và/hoặc các chủ thể có liên quan, hoặc bất kỳ hành vi nào có cùng tính chất dưới mọi hình thức.</strong></p>

                <p style="text-alignt:justify">
                    - C-Mart có toàn quyền kiểm duyệt, rà soát mọi thông tin, và đưa ra nhận định, ngăn chặn, xử lý các hành vi vi phạm.
                    </p>
                <p style="text-alignt:justify;margin-left:5%"><strong>
                     Trong trường hợp C-Mart phát hiện vi phạm, C-Mart có toàn quyền nhận định, ngăn chặn, xử lý các hành vi vi phạm mà không chịu bất kỳ trách nhiệm nào, và/hoặc bảo lưu quyền khiếu nại, tố cáo đến các cơ quan Nhà nước có thẩm quyền để xử lý theo Pháp luật.
                    </strong></p>
            </div>
        </div>


        </div>
      </div>
    </div>
  </section>


    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
