@extends('layout.master')

@section('title', 'Điều kiện giao dịch')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Điều Kiện Giao Dịch</a>
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
                        <button type="button" class="content-hover btn title m-2" data-toggle="modal"
                            data-target="#rightModal">
                            <i class="fas fa-angle-double-left"></i>
                        </button>
                    </div>
                    <!--Phan noi dung cua trang Chính Sách Vận Chuyển-->
                    <div class="static-detail">
                        <h3 class="title">Điều khoản giao dịch</h3>
                        <div class="detail-static">
                            <h3><strong>1. Giới thiệu:</strong></h3>

                            <p>Siêu thị Nhật Bản JAPANA ra đời vào năm 2017, được xây dựng nhằm cung cấp cho người tiêu dùng
                                Việt Nam những <strong>sản phẩm Nhật Bản chất lượng, chính hãng</strong>. Bên cạnh đó,
                                Japana mong muốn mang đến trải nghiệm mua sắm dễ dàng, nhanh chóng và an toàn với hệ thống
                                cửa hàng&nbsp;từ Online đến Offline.<br>Bạn có thể mua hàng Nhật chính hãng tại một trong
                                những địa chỉ sau đây:&nbsp;</p>

                            <ul>
                                <li>Mua hàng trực tuyến tại website: <a href="https://japana.vn/"
                                        target="_blank"><strong>https://japana.vn/</strong></a></li>
                                <li>Trụ sở chính tại Việt Nam: Tòa Nhà Trường Thịnh Group, 76 Nguyễn Háo Vĩnh, P. Tân Quý,
                                    Q. Tân Phú, TP. HCM</li>
                                <li>Chi nhánh&nbsp;Hồ Chí Minh: Tầng trệt, Khu 15, Siêu thị Aeon Mall Tân Phú TP.HCM</li>
                                <li>Chi nhánh Hải Phòng: Tầng 1, Khu Cosmetic, Aeon Mall Hải Phòng Lê Chân, TP Hải Phòng
                                </li>
                            </ul>

                            <p>Khi quý khách truy cập vào trang web của chúng tôi có nghĩa là quý khách đồng ý với các điều
                                khoản này. Trang web có quyền thay đổi, chỉnh sửa, thêm hoặc lược bỏ bất kỳ phần nào trong
                                Quy định và Điều kiện sử dụng, vào bất cứ lúc nào. Các thay đổi có hiệu lực ngay khi được
                                đăng trên trang web mà không cần thông báo trước. Và khi quý khách tiếp tục sử dụng trang
                                web, sau khi các thay đổi về Quy định và Điều kiện được đăng tải, có nghĩa là quý khách chấp
                                nhận với những thay đổi đó. Quý khách vui lòng kiểm tra thường xuyên để cập nhật những thay
                                đổi của chúng tôi.<br>Xin vui lòng đọc kỹ trước khi quyết định mua hàng:</p>

                            <h3><strong>2. Hướng dẫn sử dụng website:</strong></h3>

                            <p>- Khi vào web của chúng tôi, người dùng tối thiểu phải 18 tuổi hoặc truy cập dưới sự giám sát
                                của cha mẹ hay người giám hộ hợp pháp.<br>- Chúng tôi cấp giấy phép sử dụng để bạn có thể
                                mua sắm trên web trong khuôn khổ Điều khoản và Điều kiện sử dụng đã đề ra.

                                <br>- Nghiêm cấm sử dụng bất kỳ phần nào của trang web này với mục đích thương mại hoặc nhân
                                danh bất kỳ đối tác thứ ba nào nếu không được chúng tôi cho phép bằng văn bản. Nếu vi phạm
                                bất cứ điều nào trong đây, chúng tôi có quyền và nghĩa vụ thông báo cho cơ quan có thẩm
                                quyền&nbsp;mà không cần báo trước.

                                <br>- Trang web này chỉ dùng để cung cấp thông tin sản phẩm chứ chúng tôi không phải nhà sản
                                xuất nên những nhận xét hiển thị trên web là ý kiến cá nhân của khách hàng, không phải của
                                chúng tôi.

                                <br>- Quý khách phải đăng ký tài khoản với thông tin xác thực về bản thân và phải cập nhật
                                nếu có bất kỳ thay đổi nào. Mỗi người truy cập phải có trách nhiệm với mật khẩu, tài khoản
                                và hoạt động của mình trên web. Hơn nữa, quý khách phải thông báo cho chúng tôi biết khi tài
                                khoản bị truy cập trái phép. Chúng tôi không chịu bất kỳ trách nhiệm nào, dù trực tiếp hay
                                gián tiếp, đối với những thiệt hại hoặc mất mát gây ra do quý khách không tuân thủ quy định.

                                <br>- Trong suốt quá trình đăng ký, quý khách đồng ý nhận email quảng cáo từ website. Sau
                                đó, nếu không muốn tiếp tục nhận mail, quý khách có thể từ chối bằng cách nhấp vào đường
                                link ở dưới cùng trong mọi email quảng cáo.
                            </p>
                            <h3><strong>3. Đặt hàng và xác nhận đơn hàng:</strong></h3>

                            <p>- Khi quý khách đặt hàng tại Japana, chúng tôi sẽ nhận được yêu cầu đặt hàng.&nbsp;Tuy nhiên,
                                yêu cầu đặt hàng cần thông qua một bước xác nhận đơn hàng, Chúng tôi sẽ có nhân viên liên hệ
                                với quý khách&nbsp;để xác nhận thông tin trước khi gửi hàng và&nbsp;nếu yêu cầu đặt hàng của
                                quý khách thỏa mãn các tiêu chí thực hiện đơn hàng.

                                <br>- Để yêu cầu đặt hàng được xác nhận nhanh chóng, quý khách vui lòng cung cấp đúng và đầy
                                đủ các thông tin liên quan đến việc giao nhận, hoặc các điều khoản và điều kiện của chương
                                trình khuyến mãi (nếu có) mà quý khách tham gia.
                            </p>

                            <h3><strong>4. Thông tin sản phẩm:</strong></h3>

                            <p>-&nbsp;Những sản phẩm Siêu Thị Japana&nbsp;cung cấp <strong>cam kết là hàng chính hãng Nhật
                                    Bản</strong>. Chúng tôi cung cấp thông tin chi tiết đối với từng sản phẩm mà chúng tôi
                                đăng tải, tuy nhiên chúng tôi không thể cam kết cung cấp thông tin đầy đủ một cách chính
                                xác, toàn vẹn, cập nhật, và không sai sót đối với từng sản phẩm. Nếu có bất kỳ câu hỏi nào
                                Quý khách hàng vui lòng liên hệ tổng đài <strong>(028)&nbsp;7108 8889</strong> để được giải
                                đáp.

                                <br>- Chúng tôi cam kết tất cả sản phẩm chúng tôi là chính hãng&nbsp;Nhật Bản.&nbsp;Tuy
                                nhiên, hiệu quả sản phẩm mang lại có thể khác nhau <strong>tùy theo cơ địa</strong> của mỗi
                                khách hàng sử dụng. &nbsp;

                                <br>Với đội ngũ tư vấn viên chuyên nghiệp, chúng tôi phục vụ tư vấn cho quý khách hàng 24/7
                                theo số HOTLINE : <strong>(028)&nbsp;7108 8889 - 0935.600.800</strong>
                            </p>

                            <h3><strong>5. &nbsp;Hình thức thanh toán:</strong></h3>

                            <p>Nhằm mang đến Quý khách những trải nghiệm mua sắm trực tuyến tuyệt vời nhất&nbsp;tại
                                <strong>Siêu Thị Nhật Bản Japana</strong> chúng tôi đưa ra các&nbsp;phương thức thanh toán
                                để quý khách dễ dàng lựa chọn:

                                <br>1. Thanh toán khi nhận hàng (COD)<br>2. Thanh toán trực tiếp tại văn phòng&nbsp;Công ty
                                Japana Việt Nam

                                <br>Trừ một số trường hợp có ghi chú riêng, thông thường quý khách có thể lựa chọn một trong
                                3 hình thức thanh toán trên khi tiến hành đặt hàng. Tuy nhiên, để đảm bảo tính an toàn dành
                                cho quý khách trong quá trình thanh toán, đối những đơn hàng có giá trị cao từ 10.000.000
                                vnđ (Mười&nbsp;triệu đồng) trở lên, Japana.vn chỉ chấp nhận hình thức thanh toán qua tài
                                khoản Ngân Hàng hoặc thanh toán trực tiếp tại VP Công ty Japana Việt Nam.
                            </p>

                            <ul>
                                <li>Thanh toán khi nhận hàng - COD là gì?</li>
                            </ul>

                            <p>COD là viết tắt của Cash On Delivery, nghĩa là thanh toán khi nhận hàng. Với phương thức
                                thanh toán này, Quý khách trả tiền mặt cho nhân viên giao hàng ngay khi nhận được đơn hàng
                                của mình. Chúng tôi chấp nhận hình thức thanh toán khi nhận hàng (COD) cho tất cả các đơn
                                hàng trên phạm vi toàn quốc.</p>

                            <p>** Lưu ý: Chỉ áp dụng cho đơn hàng có tổng giá trị nhỏ hơn 10&nbsp;triệu&nbsp;đồng. Nếu đơn
                                hàng trên 10 triệu đồng, Quý khách hàng&nbsp;vui lòng chọn hình thức thanh toán khác.</p>

                            <p>&nbsp;</p>

                            <ul>
                                <li>Thanh toán tại Văn phòng&nbsp;Công ty Japana Việt Nam</li>
                            </ul>

                            <p>Quý khách hàng&nbsp;có thể đến trực tiếp văn phòng Công Ty CP Japana Việt Nam tại số 76 đường
                                Nguyễn Háo Vĩnh, Quận Tân Phú, TP.HCM và gặp trực tiếp nhân viên thu ngân để thanh toán.

                                <br>Ngoài ra, Quý khách hàng còn có thể áp dụng&nbsp;hình thức thanh toán bằng việc chuyển
                                tiền từ tài khoản của Quý khách hàng&nbsp;vào tài khoản của Công ty CP Japana Việt Nam thông
                                qua Ngân hàng.

                                <br>Tại website <strong><a href="https://japana.vn/"
                                        target="_blank">https://japana.vn/</a></strong>, sau khi Quý khách hàng tiến hành
                                chọn sản phẩm và chọn mua hàng, tại trang cung cấp&nbsp;thông tin giao hàng. Chúng
                                tôi&nbsp;sẽ cung cấp cho quý khách số tài khoản của <strong>Công Ty Cổ Phẩn Japana Việt
                                    Nam</strong>&nbsp;tại&nbsp;các Ngân hàng mà Japana chấp nhận thanh toán, Quý khách
                                hàng&nbsp;có thể lựa&nbsp;chọn Ngân hàng phù hợp nhất với mình để tiến hành thanh toán cho
                                đơn hàng đã chọn.

                                <br>** Lưu ý: Khi Quý khách hàng chọn Phương thức thanh toán qua Ngân hàng, Đễ tránh nhầm
                                lẫn do có nhiều đơn hàng,&nbsp;đề nghị Quý khách hàng&nbsp;ghi "Số Đơn Hàng" của đơn
                                hàng&nbsp;đã được chúng tôi cung cấp cho Quý khách hàng&nbsp;qua email "Xác nhận đơn hàng"
                                trong nội dung thanh toán.
                            </p>

                            <p><strong>Thông tin Ngân hàng:</strong></p>

                            <p><img alt="Thông tin Ngân hàng" class="card-img" style="width: 50%;"
                                    src="https://japana.vn/uploads/detail/2019/12/images/Artboard%202.jpg"></p>

                            <p><strong>Tên Ngân Hàng:&nbsp;</strong>Ngân Hàng Vietcombank Chi Nhánh Tân Bình</p>

                            <p><strong>Chủ Tài Khoản:&nbsp;</strong>Công Ty CP Japana Việt Nam</p>

                            <p><strong>Số Tài Khoản:&nbsp;044&nbsp;1000 776 006</strong></p>

                            <h3><strong>6. &nbsp;Cách thức hủy đơn hàng</strong></h3>

                            <p>Trong trường hợp đơn hàng đã được xác nhận, vì bất kỳ lý do gì quý khách cũng có thể hủy đơn
                                hàng.&nbsp;Hãy gọi cho chúng tôi theo số <strong>(028)&nbsp;7108 8889</strong> để được hủy
                                đơn hàng</p>

                            <h3><strong>7. Điều kiện đổi trả hàng:</strong></h3>

                            <p>Hiểu được sự ngần ngại/lo lắng của khách hàng về tính xác thực của hàng hóa khi mua sắm trực
                                tuyến, Siêu thị Nhật Bản Japana.vn hỗ trợ chính sách đồng kiểm, áp dụng với tất cả các sản
                                phẩm được bán tại website Japana (<strong>Không áp dụng với các sản phẩm được niêm phong bởi
                                    nhà sản xuất</strong>).</p>

                            <p>Trước khi chấp nhận và thanh toán cho một đơn hàng, khách hàng của Japana có quyền yêu cầu
                                được mở thùng hàng để kiểm tra hàng hóa bên trong có đúng với thông tin đặt hàng hay không.
                                Các thông tin bao gồm: Số lượng, chủng loại (Model), màu sắc, kích thước, hình thức, tính
                                nguyên vẹn của hàng hóa.</p>

                            <p>Thông tin trọng lượng của sản phẩm được thể hiện trên website là trọng lượng tương đối, chỉ
                                mang ý nghĩa tham khảo (giúp khách hàng hình dung rõ hơn về sản phẩm), không có ý nghĩa cho
                                việc kiểm tra, đổi trả lại hàng hóa. Rất mong Quý khách hàng lưu ý vấn đề này.</p>

                            <p>Các bước kiểm tra sâu hơn như sử dụng thử sản phẩm có thể được tiến hành sau khi Quý khách đã
                                thanh toán cho đơn hàng.</p>

                            <p><strong>*** LƯU Ý: Trong vòng 24 giờ kể từ khi nhận hàng và kiểm tra hàng</strong>, Quý
                                khách&nbsp;có quyền từ chối nhận và thực hiện đổi/ trả hàng. Quý khách hãy liên hệ ngay với
                                bộ phận Chăm sóc khách hàng của chúng tôi để được hỗ trợ kịp thời.</p>

                            <ul>
                                <li>Điều kiện đổi hàng:</li>
                            </ul>

                            <h4><img alt="Điều kiện đổi trả hàng" class="card-img" style="width: 100%;"
                                    src="https://japana.vn/uploads/detail/2021/05/images/2(1).png"></h4>

                            <h4><img alt="Chính sách đổi trả và hoàn tiền" class="card-img" style="width: 100%;"
                                    src="https://japana.vn/uploads/detail/2020/05/images/adsadadsa.png"></h4>

                            <ul>
                                <li>Điều kiện trả hàng:</li>
                            </ul>

                            <h4><img alt="Điều kiện đổi trả hàng" class="card-img" style="width: 100%;"
                                    src="https://japana.vn/uploads/detail/2021/05/images/1(1).png"></h4>

                            <h3>8. Phương thức đổi trả hàng:</h3>

                            <p>Trong thời gian còn hiệu lực đổi trả hàng, Quý khách vui lòng thực hiện các bước sau để được
                                đổi trả hàng:</p>

                            <p><strong>- Bước 1:&nbsp;</strong>Liên hệ trực tiếp với nhân viên Tư vấn bán hàng qua Tổng
                                đài:&nbsp;<strong>(028) 7108 8889</strong>&nbsp;để được hỗ trợ kịp thời.</p>

                            <p><strong>- Bước 2:&nbsp;</strong>Chụp và gửi hình ảnh sản phẩm để xác nhận tình trạng hàng
                                hoá.</p>

                            <p><strong>- Bước 3:&nbsp;</strong>Sau khi yêu cầu đổi trả hàng được chấp thuận, quý khách vui
                                lòng đóng gói cẩn thận và gửi qua đường bưu điện hoặc phương tiện vận chuyển khác về cho
                                chúng tôi theo địa chỉ:</p>

                            <p>+ Người nhận: Siêu thị Nhật Bản Japana.vn</p>

                            <p>+ Địa chỉ: Tòa nhà Trường Thịnh Group, Số 76 Nguyễn Háo Vĩnh, P. Tân Quý, Q. Tân Phú, TP.
                                HCM.</p>

                            <p><strong>- Bước 4:&nbsp;</strong>Quý khách vui lòng đóng gói bao bì cẩn thận, tránh trầy xước,
                                hỏng bể, bong tróc hay bám bẩn so với lúc xác nhận chấp thuận đổi trả lại hàng.</p>

                            <p><strong>* LƯU Ý:&nbsp;</strong>Nếu sản phẩm gửi trả về bị hỏng, bể, trầy xước, bong tróc, bám
                                bẩn,... có thay đổi so với thời điểm xác nhận chấp thuận đổi trả lại hàng, chúng tôi có
                                quyền từ chối nhận đổi trả.</p>

                            <h3><strong>9. Chính sách cam kết "TUYỆT ĐỐI KHÔNG" đối với&nbsp;hàng giả, hàng nhái, hàng không
                                    đúng chất lượng:</strong></h3>

                            <p>- <strong>Siêu Thị Nhật Bản Japana.vn</strong>&nbsp;hướng đến việc cung cấp <strong>hàng Nhật
                                    Bản chính hãng</strong>&nbsp;và chất lượng dịch vụ tốt nhất cho khách hàng qua các sản
                                phẩm được đăng bán trên trang web của chúng và từ chối bán các sản phẩm sản xuất trái phép,
                                sao chép, hàng giả, hàng nhái, không rõ nguồn gốc, xuất xứ...</p>

                            <p>- Các sản phẩm Quý khách mua tại&nbsp;Siêu Thị Japana&nbsp;luôn có tem của công ty. Nếu quý
                                khách đặt hàng tại Japana&nbsp;mà khi nhận hàng trên sản phẩm không có tem của chúng tôi.
                                Vui lòng báo ngay cho chúng tôi theo số Hotline:&nbsp;<strong>0935 600 800.</strong></p>

                            <p>- Trong trường hợp quý khách có nghi ngờ sản phẩm sản xuất trái phép, sao chép, hàng giả,
                                hàng nhái, không rõ nguồn gốc xuất xứ...&nbsp;Vui lòng báo ngay cho chúng tôi theo số
                                Hotline:&nbsp;<strong>0935 600 800</strong>&nbsp;để được xác thực thông tin và hỗ trợ.</p>

                            <p><strong><em>Xin trân trọng cảm ơn!</em></strong></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
