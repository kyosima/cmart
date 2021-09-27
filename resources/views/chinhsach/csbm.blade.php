@extends('layout.master')

@section('title', 'Chính sách bảo mật')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Chính Sách Bảo Mật</a>
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
                        <button type="button" class="content-hover btn title " data-toggle="modal"
                            data-target="#rightModal">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    </div>
                    <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
                    <div class="static-detail">
                        <h3 class="title">Chính sách bảo mật</h3>
                        <div class="detail-static">
                            <h3 style="text-align:justify"><strong>1. Mục đích và phạm vi thu thập</strong></h3>

                            <p style="text-align:justify">- Việc thu thập dữ liệu chủ yếu trên website&nbsp;<a
                                    href="https://japana.vn">japana.vn</a>&nbsp;bao gồm: Email, điện thoại, tên đăng nhập,
                                mật khẩu đăng nhập, địa chỉ khách hàng (thành viên). Đây là các thông tin mà <strong>Siêu
                                    Thị Nhật Bản Japana&nbsp;</strong>cần thành viên cung cấp bắt buộc khi đăng ký sử dụng
                                dịch vụ và để <strong>Siêu Thị Nhật Bản Japana</strong>&nbsp;liên hệ xác nhận khi khách hàng
                                đăng ký sử dụng dịch vụ trên website nhằm đảm bảo quyền lợi cho cho người tiêu dùng.</p>

                            <p style="text-align:justify">- Trong quá trình giao dịch thanh toán tại website, chúng tôi chỉ
                                lưu giữ thông tin chi tiết về đơn hàng đã thanh toán của thành viên, các thông tin về số tài
                                khoản ngân hàng của thành viên sẽ không được lưu giữ.</p>

                            <p style="text-align:justify">- Các thành viên sẽ tự chịu trách nhiệm về bảo mật và lưu giữ mọi
                                hoạt động sử dụng dịch vụ dưới tên đăng ký, mật khẩu và hộp thư điện tử của mình. Ngoài ra,
                                thành viên có trách nhiệm thông báo kịp thời cho webiste <a href="http://www.japana.vn"
                                    target="_top">www.japana.vn</a> &nbsp;về những hành vi sử dụng trái phép, lạm dụng, vi
                                phạm bảo mật, lưu giữ tên đăng ký và mật khẩu của bên thứ ba để có biện pháp giải quyết phù
                                hợp.</p>

                            <h3 style="text-align:justify"><strong>2. Phạm vi sử dụng thông tin</strong></h3>

                            <p style="text-align:justify">Công ty sử dụng thông tin thành viên cung cấp để:</p>

                            <p style="text-align:justify">- Cung cấp các dịch vụ đến thành viên.</p>

                            <p style="text-align:justify">- Gửi các thông báo về các hoạt động trao đổi thông tin giữa thành
                                viên và website ;</p>

                            <p style="text-align:justify">- Ngăn ngừa các hoạt động phá hủy tài khoản người dùng của thành
                                viên hoặc các hoạt động giả mạo thành viên.</p>

                            <p style="text-align:justify">- Liên lạc và giải quyết với thành viên trong những trường hợp đặc
                                biệt.</p>

                            <p style="text-align:justify">- Không sử dụng thông tin cá nhân của thành viên ngoài mục đích
                                xác nhận và liên hệ có liên quan đến giao dịch tại <strong>Siêu Thị Nhật Bản
                                    Japana.</strong></p>

                            <p style="text-align:justify">- Trong trường hợp có yêu cầu của pháp luật: Công ty có trách
                                nhiệm hợp tác cung cấp thông tin cá nhân thành viên khi có yêu cầu từ cơ quan tư pháp bao
                                gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật
                                nào đó của khách hàng. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của thành
                                viên.</p>

                            <h3 style="text-align:justify"><strong>3. Thời gian lưu trữ thông tin</strong></h3>

                            <p style="text-align:justify">Dữ liệu cá nhân của thành viên sẽ được lưu trữ cho đến khi có yêu
                                cầu hủy bỏ hoặc tự thành viên đăng nhập và thực hiện hủy bỏ. Còn lại trong mọi trường hợp
                                thông tin cá nhân thành viên sẽ được bảo mật trên máy chủ của chúng tôi</p>

                            <h3 style="text-align:justify"><strong>4. Địa chỉ của đơn vị thu thập và quản lý thông tin cá
                                    nhân:</strong></h3>

                            <p style="text-align:justify">- Công ty Cổ Phần Japana Việt Nam</p>

                            <p style="text-align:justify">- Địa chỉ: 76 Nguyễn Háo Vĩnh, P. Tân Quý, Quận Tân Phú, TP.HCM
                            </p>

                            <p style="text-align:justify">- Hotline:&nbsp;<strong>(028)&nbsp;7108 8889</strong>&nbsp;-
                                Email: info@japana.vn</p>

                            <h3 style="text-align:justify"><strong>5. Phương tiện và công cụ để người dùng tiếp cận và chỉnh
                                    sửa dữ liệu cá nhân của mình:</strong></h3>

                            <p style="text-align:justify">- Thành viên có quyền tự kiểm tra, cập nhật, điều chỉnh hoặc hủy
                                bỏ thông tin cá nhân của&nbsp;mình bằng cách đăng nhập vào tài khoản và chỉnh sửa thông tin
                                cá nhân hoặc yêu cầu <strong>Siêu Thị Nhật Bản Japana</strong> thực hiện việc này.</p>

                            <p style="text-align:justify">- Thành viên có quyền gửi khiếu nại về nội dung bảo mật thông tin
                                đề nghị liên hệ Ban quản trị của chúng tôi. Khi tiếp nhận những phản hồi này, <strong
                                    style="text-align: justify;">Siêu Thị Nhật Bản Japana</strong>&nbsp;sẽ xác nhận lại
                                thông tin, trường hợp đúng như phản ánh của thành viên tùy theo mức độ, chúng tôi sẽ có
                                những biện pháp xử lý kịp thời.</p>

                            <h3 style="text-align:justify"><strong>6. Cam kết bảo mật thông tin cá nhân khách hàng:</strong>
                            </h3>

                            <p style="text-align:justify">- Thông tin cá nhân của thành viên trên Siêu Thị Nhật
                                Bản&nbsp;được <strong>Japana</strong>&nbsp;cam kết bảo mật tuyệt đối theo chính sách bảo vệ
                                thông tin cá nhân. Việc thu thập và sử dụng thông tin của mỗi thành viên chỉ được thực hiện
                                khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật có quy định khác.</p>

                            <p style="text-align:justify">- Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên
                                thứ 3 nào về thông tin cá nhân của thành viên khi không có sự cho phép đồng ý từ thành viên.
                            </p>

                            <p style="text-align:justify">- Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công
                                dẫn đến mất mát dữ liệu cá nhân thành viên, <strong>Siêu Thị Nhật Bản
                                    Japana</strong>&nbsp;sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra
                                xử lý kịp thời và thông báo cho thành viên được biết.</p>

                            <p style="text-align:justify">- Bảo mật tuyệt đối mọi thông tin giao dịch trực tuyến của thành
                                viên bao gồm thông tin hóa đơn kế toán chứng từ số hóa</p>

                            <p style="text-align:justify">- Ban quản lý <strong>Công ty Cổ Phần Japana Việt Nam</strong> yêu
                                cầu các cá nhân khi đăng ký/mua hàng là Thành viên, phải cung cấp đầy đủ thông tin cá nhân
                                có liên quan như: Họ và tên, địa chỉ liên lạc, email, điện thoại, số tài khoản, số thẻ thanh
                                toán …., và chịu trách nhiệm về tính pháp lý của những thông tin trên. Ban quản lý Công ty
                                Cổ Phần Japana Việt Nam&nbsp;không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại
                                có liên quan đến quyền lợi của thành viên đó nếu xét thấy tất cả thông tin cá nhân của thành
                                viên đó cung cấp khi đăng ký ban đầu là không chính xác.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
