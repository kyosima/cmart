@extends('layout.master')

@section('title', 'Câu hỏi thường gặp')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Câu Hỏi Thường Gặp</a>
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
                        <h3 class="title">Câu hỏi thường gặp</h3>
                        <div class="detail-static">
                            <h2><strong>I. VỀ SIÊU THỊ NHẬT BẢN JAPANA</strong><strong>:</strong></h2>

                            <h3><strong>1. Siêu Thị Nhật Bản Japana chuyên cung cấp?</strong></h3>

                            <ul>
                                <li>100% sản phẩm xuất xứ và mang thương hiệu Nhật Bản, được sản xuất tại Nhật và/hoặc sản
                                    xuất tại các nước khác.</li>
                            </ul>

                            <h3><strong>2. &ZeroWidthSpace;Japana cung cấp các dòng sản phẩm chính nào?</strong></h3>

                            <ul>
                                <li>Collagen</li>
                                <li>Thực phẩm sức khỏe/Thực phẩm chức năng&nbsp;</li>
                                <li>Hóa mỹ phẩm&nbsp;</li>
                                <li>Sản phẩm dành cho mẹ và bé</li>
                                <li>Đồ dùng gia dụng&nbsp;</li>
                                <li>Thực phẩm Nhật Bản</li>
                                <li>Và nhiều nhóm ngành hàng khác.</li>
                            </ul>

                            <h3><strong>3. Japana có cho thuê gian hàng để các cá nhân bên ngoài (của hàng/shop) bán hàng
                                    trên website </strong><a
                                    href="https://japana.vn/"><strong>https://japana.vn</strong>/</a><strong>
                                    không?</strong></h3>

                            <ul>
                                <li>Không</li>
                            </ul>

                            <h3><strong>4. Sứ mệnh của Siêu Thị Nhật Bản Japana là gì?</strong></h3>

                            <ul>
                                <li>Mang sản phẩm chất lượng Nhật Bản đến với người tiêu dùng Việt Nam.</li>
                            </ul>

                            <h3><strong>5. Địa chỉ công ty ở đâu?</strong></h3>

                            <ul>
                                <li>Văn phòng chính: Tòa nhà Trường Thịnh Group, Số 76 Nguyễn Háo Vĩnh, Quận Tân Phú, TP.
                                    HCM</li>
                                <li>Chi nhánh&nbsp;Hồ Chí Minh: Tầng trệt, Khu 15, Siêu thị Aeon Mall Tân Phú TP.HCM</li>
                                <li>Chi nhánh Hải Phòng: Tầng 1, Khu Cosmetic, Aeon Mall Hải Phòng Lê Chân, TP Hải Phòng
                                </li>
                            </ul>

                            <h3><strong>6. Sản phẩm của Japana có đúng chuẩn hàng Nhật không?</strong></h3>

                            <p><a href="https://g.co/kgs/NvXvE5" target="_blank">Siêu Thị Nhật Bản Japana</a> thấu hiểu nỗi
                                lo của khách hàng về nguồn gốc và chất lượng sản phẩm. Vậy nên:</p>

                            <ul>
                                <li><strong>100% sản phẩm</strong> của Siêu Thị Nhật Bản Japana <strong>xuất xứ từ Nhật
                                        Bản</strong> và sản xuất tại Nhật Bản và/hoặc tại nước khác.</li>
                                <li>Chúng tôi cam kết chất lượng sản phẩm hàng đầu, đạt chuẩn với bộ phận KCS kiểm tra chất
                                    lượng sản phẩm.</li>
                                <li>Japana nói KHÔNG với hàng giả, hàng kém chất lượng, hàng không rõ nguồn gốc.</li>
                            </ul>

                            <h3><strong>7. Sự khác&nbsp;biệt giữa Japana và các trang bán hàng khác như thế nào?</strong>
                            </h3>

                            <p>Đối với Siêu Thị Nhật Bản Japana:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>

                            <ul>
                                <li>100% sản phẩm là thương hiệu Nhật Bản.</li>
                                <li>100% sản phẩm được công ty nhập vào kho, KCS kiểm tra chất lượng, dán tem đạt chuẩn
                                    trước khi giao hàng cho khách.</li>
                                <li>100% sản phẩm được đóng gói bởi Japana, mang thương hiệu japana và theo quy trình chuyên
                                    nghiệp.</li>
                                <li>100% cam kết tuyệt đối KHÔNG bán hàng hóa không rõ nguồn gốc.</li>
                                <li>100% khách hàng của Japana, mỗi khách hàng đều có một nhân viên tư vấn của Japana chăm
                                    sóc.</li>
                            </ul>

                            <h3><strong>8. Tôi đang ở tỉnh muốn mua sản phẩm ở đâu?</strong></h3>

                            <ul>
                                <li>Bạn có thể mua hàng Online tại địa chỉ website&nbsp;<strong><a href="https://japana.vn/"
                                            target="_blank">https://japana.vn/</a>&nbsp;</strong>và được giao hàng ship COD
                                    tận nơi.</li>
                            </ul>

                            <p>Bên cạnh đó, Japana hiện có một văn phòng tại TP. Hồ Chí Minh và các điểm chi nhánh mua hàng
                                tại:</p>

                            <ul>
                                <li>&nbsp;CN Hồ Chí Minh: Tầng trệt, Khu 15, Siêu thị Aeon Mall Tân Phú TP.HCM</li>
                                <li>&nbsp;CN Hải Phòng: Tầng 1, Khu Cosmetic, Aeon Mall Hải Phòng Lê Chân, TP Hải Phòng</li>
                            </ul>

                            <h3><strong>9. Vì sao các sản phẩm của Siêu Thị Nhật Bản Japana đang ở Nhật Bản?</strong></h3>

                            <ul>
                                <li>Siêu Thị Nhật Bản Japana&nbsp;là website bán hàng Nhật Bản, các sản phẩm do văn phòng
                                    đại diện tại Nhật Bản hoặc do các Nhà cung cấp nhập khẩu trực tiếp từ Nhật Bản về Việt
                                    Nam. Theo quy định hiện hành của Siêu Thị Nhật Bản Japana, một số sản phẩm sau khi khách
                                    hàng đặt mua chúng tôi mới nhập về.</li>
                            </ul>

                            <h3><strong>10. Siêu Thị Nhật Bản Japana có bán hàng giả/ hàng nhái/ hàng kém chất lượng
                                    không?</strong></h3>

                            <p>Siêu Thị Nhật Bản Japana thấu hiểu nỗi lo của khách hàng về nguồn gốc và chất lượng sản phẩm.
                                Vì thế:</p>

                            <ul>
                                <li>100% sản phẩm của Siêu Thị Nhật Bản Japana được xuất xứ từ Nhật Bản, sản xuất tại Nhật
                                    Bản, Thái Lan, Mỹ, Trung Quốc,... theo công nghệ và tiêu chuẩn Nhật Bản.</li>
                                <li>Japana nói KHÔNG với hàng giả, hàng kém chất lượng, hàng không rõ nguồn gốc.</li>
                                <li>100% sản phẩm của Japana đều phải thông qua bộ phận kiểm tra chất lượng KCS, chất lượng
                                    sản phẩm đầu vào được kiểm soát và đạt chuẩn mới được thông qua và bán tại
                                    website&nbsp;<strong><a href="https://japana.vn/"
                                            target="_blank">https://japana.vn/</a>.</strong></li>
                            </ul>

                            <h3><strong>11. Tại sao giá bán của sản phẩm cao hơn những nơi khác?</strong></h3>

                            <ul>
                                <li>Cũng có khách hàng ban đầu băn khoăn như anh chị, nhưng sau khi mua hàng bên Japana thì
                                    rất hài lòng vì giá bán phù hợp với chất lượng sản phẩm.</li>
                                <li>Japana là trang thương mại điện tử duy nhất tại Việt Nam 100% sản phẩm phải thông qua bộ
                                    phận KCS kiểm tra chất lượng đầu vào, đạt chuẩn mới được giao cho khách hàng nên giá bán
                                    phù hợp với chất lượng sản phẩm.</li>
                            </ul>

                            <h3><strong>12. Tại sao giá bán tại website Japana lại rẻ hơn khi đi du lịch và mua tại
                                    Nhật?</strong></h3>

                            <ul>
                                <li>Các sản phẩm của Japana được nhập về theo giá sỉ. Bên cạnh đó, Siêu Thị Nhật Bản Japana
                                    luôn có những chương trình khuyến mãi, tri ân khách hàng với mức giá ưu đãi cho khách
                                    hàng.</li>
                            </ul>

                            <h3><strong>13. Thông tin của tôi có được bảo mật không?</strong></h3>

                            <ul>
                                <li>Theo quy định bắt buộc của Japana, tất cả thông tin của khách hàng đều được tôn trọng và
                                    bảo mật.</li>
                            </ul>

                            <h2><strong>II. VỀ CHÍNH SÁCH MUA HÀNG:</strong></h2>

                            <h3><strong>1. Thời gian giao hàng bao lâu?</strong></h3>

                            <p>Thời gian giao hàng được tính từ khi xác nhận đơn hàng thành công, tùy thuộc vào từng sản
                                phẩm quý khách có thể tham khảo tại bảng thời gian giao hàng bên dưới:</p>

                            <ul>
                                <li>Khi các sản phẩm có mặt tại Việt Nam:</li>
                            </ul>

                            <h4><img alt="CÂU HỎI THƯỜNG GẶP VỀ CHÍNH SÁCH MUA HÀNG"
                                    src="https://japana.vn/uploads/detail/2019/06/images/1(1).jpeg" class="card-img"
                                    style="width: 100%"></h4>

                            <ul>
                                <li>Khi các&nbsp;sản phẩm đang ở Nhật Bản:</li>
                            </ul>

                            <h4><img alt="CÂU HỎI THƯỜNG GẶP VỀ CHÍNH SÁCH MUA HÀNG"
                                    src="https://japana.vn/uploads/detail/2019/06/images/2(1).jpeg" class="card-img"
                                    style="width: 100%"></h4>

                            <h3><strong>2. Trường hợp nào được đổi trả hàng?</strong></h3>

                            <ul>
                                <li>Sản phẩm không đúng chủng loại, mẫu mã như khách hàng đã đặt.</li>
                                <li>Sản phẩm không đủ số lượng, khối lượng, phụ kiện như trong đơn hàng đã đặt.</li>
                                <li>Tình trạng bên ngoài của sản phẩm bị bong tróc, bể, vỡ xảy ra do vận chuyển.</li>
                                <li>Sản phẩm cận/hết hạn sử dụng, không vận hành được hay do hỏng hóc.</li>
                                <li>Khách hàng đã nhận và thanh toán tiền nhưng thấy sản phẩm không phù hợp và muốn đổi trả
                                    hàng.</li>
                            </ul>

                            <p>* Xem chi tiết các <a href="https://japana.vn/chinh-sach-doi-tra-static-8.jp"
                                    target="_blank"><strong>trường hợp được hỗ trợ đổi trả hàng</strong></a>.</p>

                            <h3><strong>3. Sau khi nhận sản phẩm bao lâu thì được đổi trả?</strong></h3>

                            <p>Kể từ thời gian nhận hàng, Quý khách có quyền từ chối nhận hàng và thực hiện đổi/trả hàng
                                theo điều kiện đổi/trả hàng được cụ thể bên dưới. Quý khách hãy liên hệ ngay với bộ phận
                                Chăm sóc khách hàng của chúng tôi để được hỗ trợ kịp thời.</p>

                            <ul>
                                <li>
                                    <p>Điều kiện đổi hàng:</p>
                                </li>
                            </ul>

                            <h4><img alt="Điều kiện đổi trả hàng"
                                    src="https://japana.vn/uploads/detail/2021/05/images/2(2).png" class="card-img"
                                    style="width: 100%"></h4>

                            <h4><img alt="Chính sách đổi trả và hoàn tiền"
                                    src="https://japana.vn/uploads/detail/2020/05/images/adsadadsa.png" class="card-img"
                                    style="width: 100%"></h4>

                            <ul>
                                <li>
                                    <p>Điều kiện trả hàng:</p>
                                </li>
                            </ul>

                            <h4><img alt="Điều kiện đổi trả hàng"
                                    src="https://japana.vn/uploads/detail/2021/05/images/1(2).png" class="card-img"
                                    style="width: 100%"></h4>

                            <h3><strong>4. Điều kiện để đổi trả hàng?</strong></h3>

                            <ul>
                                <li>Trong thời gian còn hiệu lực đổi - trả hàng, Quý khách vui lòng liên hệ nhân viên tư vấn
                                    hoặc gọi điện cho chúng tôi qua tổng đài <strong>028.7108.8889</strong>.</li>
                                <li>Chụp và gửi hình ảnh sản phẩm (nếu có) để xác nhận tùy theo từng trường hợp. Lưu ý: Hàng
                                    hóa phải đảm bảo còn nguyên tem niêm phong, seal và chưa qua sử dụng.</li>
                                <li>Sau khi yêu cầu trả hàng được xử lý, quý khách vui lòng đóng gói cẩn thận và gửi qua
                                    đường bưu điện hoặc phương tiện vận chuyển khác về cho chúng tôi theo địa chỉ:
                                    <ul>
                                        <li>Người nhận: Siêu Thị Nhật Bản Japana</li>
                                        <li>Địa chỉ: Tòa nhà Trường Thịnh Group, Số 76 Nguyễn Háo Vĩnh, P. Tân Quý, Q. Tân
                                            Phú, TP. HCM</li>
                                    </ul>
                                </li>
                                <li>Quý khách vui lòng đóng gói bao bì cẩn thận, tránh trầy xướt, hỏng, bể, bong tróc và bám
                                    bẩn so với lúc xác nhận trả lại hàng.</li>
                            </ul>

                            <h3><strong>5. Khi đổi trả hàng chi phí ship ai thanh toán?</strong></h3>

                            <ul>
                                <li>Trong trường hợp sản phẩm bị lỗi, chi phí ship đổi trả hàng sẽ do Siêu Thị Nhật Bản
                                    Japana thanh toán.</li>
                                <li>Trường hợp sản phẩm không bị lỗi, chi phí vận chuyển do quý khách hàng thanh toán.</li>
                            </ul>

                            <h3><strong>6. Khách hàng hủy đơn hàng, bao lâu nhận lại được tiền đã thanh toán?</strong></h3>

                            <ul>
                                <li>Trường hợp đơn hàng hủy, Japana sẽ thanh toán lại tiền đã đặt hàng trong vòng 07 ngày
                                    làm việc.</li>
                            </ul>

                            <h3><strong>7. Tôi có được kiểm tra hàng trước khi thanh toán không?</strong></h3>

                            <ul>
                                <li>Quý khách hàng được quyền kiểm tra hàng hóa trước khi nhận, áp dụng đối với tất cả các
                                    sản phẩm bán tại website của Siêu Thị Nhật Bản Japana.</li>
                                <li>Tuy nhiên, KHÔNG áp dụng đối với các sản phẩm có tem niêm phong của Nhà sản xuất. Các
                                    bước kiểm tra sâu hơn như sử dụng thử có thể được tiến hành sau khi đã thanh toán đơn
                                    hàng.</li>
                            </ul>

                            <h2><strong>III. VỀ SẢN PHẨM:</strong></h2>

                            <h3><strong>1. Phụ nữ có thai và đang cho con bú có sử dụng được không?</strong></h3>

                            <ul>
                                <li>Các dòng thực phẩm là Thực phẩm chức năng không phải là thuốc nên không có chống chỉ
                                    định. Tuy nhiên, tùy thuộc vào từng sản phẩm chúng tôi có những khuyến cáo riêng, vui
                                    lòng đọc kĩ hướng dẫn sử dụng và tham khảo ý kiến bác sĩ trước khi dùng.</li>
                                <li>Japana khuyến cáo phụ nữ có thai chỉ nên sử dụng những sản phẩm bổ sung vitamin, canxi,
                                    sắt, omega 3, DHA và các dòng collagen chiết xuất từ thiên nhiên.</li>
                            </ul>

                            <h3><strong>2. Dùng các sản phẩm bao lâu sẽ có kết quả?</strong></h3>

                            <ul>
                                <li>Hiệu quả của từng sản phẩm còn tùy thuộc vào độ tuổi, thể trạng và cơ địa của từng
                                    người, sẽ có thời gian phát huy hiệu quả khác nhau.</li>
                                <li>Khách hàng tại Siêu Thị Nhật Bản Japana thường phản hồi tích cực sau 1 - 3 tháng sử
                                    dụng.</li>
                            </ul>

                            <h3><strong>3. Thông tin trọng lượng của sản phẩm có ý nghĩa gì?</strong></h3>

                            <ul>
                                <li>Thông tin trọng lượng của sản phẩm trên website là trọng lượng tương đối, chỉ mang tính
                                    chất tham khảo để giúp khách hàng hình dung rõ hơn về sản phẩm. KHÔNG có ý nghĩa cho
                                    việc kiểm tra hay đổi trả lại hàng hóa.</li>
                            </ul>

                            <h3><strong>4. Tôi đang dùng thuốc và điều trị bệnh, vậy có sử dụng thực phẩm chức năng được
                                    không?</strong></h3>

                            <ul>
                                <li>Các dòng Thực phẩm chức năng không phải là thuốc mà là thực phẩm nên không có chống chỉ
                                    định.</li>
                                <li>Tuy nhiên tùy vào từng sản phẩm mà thời gian cách nhau sau khi uống thuốc là từ 1 - 2
                                    giờ.</li>
                                <li>Quý khách hàng vui lòng liên hệ nhân viên tư vấn trực tiếp hoặc hỏi ý kiến bác sĩ để có
                                    thêm thông tin hữu ích.</li>
                            </ul>

                            <h3><strong>5. Tôi đang bị bệnh về tuyến giáp có sử dụng “TẢO BIỂN” được không?</strong></h3>

                            <ul>
                                <li>Các dòng tảo Nhật Bản không có chống chỉ định với người mắc các bệnh tuyến giáp nên quý
                                    khách có thể an tâm sử dụng.</li>
                                <li>Tuy nhiên, hàm lượng iod trong tảo tương đối cao nên với người bị các bệnh liên quan đến
                                    tuyến giáp nên hạn chế sử dụng trong khẩu phần ăn hàng ngày.</li>
                                <li>Quý khách hàng vui lòng liên hệ nhân viên tư vấn trực tiếp hoặc hỏi ý kiến bác sĩ để có
                                    thêm thông tin hữu ích.</li>
                            </ul>

                            <h3><strong>6. Các sản phẩm giảm cân thông thường hay chống chỉ định cho những người bị bệnh
                                    huyết áp, tim mạch, tiểu đường. Tôi bị huyết áp cao, có thể sử dụng sản phẩm giảm cân
                                    của Siêu Thị Nhật Bản Japana được không?</strong></h3>

                            <ul>
                                <li>Đặc điểm chung của các sản phẩm giảm cân Nhật Bản là thành phần an toàn với sức khỏe
                                    cùng cơ chế đốt cháy mỡ thừa, năng lượng, từ đó giảm cân dần và không tăng trở lại.</li>
                                <li>Quý khách hàng vui lòng liên hệ nhân viên hoặc hỏi ý kiến bác sĩ để được tư vấn cụ thể
                                    và tận tình.</li>
                            </ul>

                            <h3><strong>7. Vì sao tôi uống collagen một thời gian và cảm thấy cơ thể mập, tăng cân?</strong>
                            </h3>

                            <ul>
                                <li>Đối với người cơ địa hấp thụ tốt có thể thấy cơ thể mập lên nhưng chỉ là tạm thời. Trong
                                    quá trình sử dụng collagen, khách hàng nên uống nhiều nước để giúp cơ thể thanh lọc cơ
                                    thể và tăng cường hấp thu collagen một cách tốt nhất.</li>
                            </ul>

                            <h3><strong>8. Tôi bị huyết áp cao thì nên sử dụng Đông Trùng Hạ Thảo hay nấm Linh Chi?</strong>
                            </h3>

                            <ul>
                                <li>Đông trùng hạ thảo và nấm Linh chi đều có tác dụng tốt đối với sức khỏe tim mạch và
                                    huyết áp, quý khách hàng có thể kết hợp cả hai sản phẩm để giúp điều hòa huyết áp và
                                    giảm cholesterol một cách nhanh chóng và dứt điểm.</li>
                                <li>Quý khách vui lòng tham khảo ý kiến bác sĩ hoặc liên hệ nhân viên tư vấn để được tư vấn
                                    cụ thể và tận tình.</li>
                            </ul>

                            <h3><strong>9. Tôi dùng mỹ phẩm bị dị ứng thì phải làm sao?</strong></h3>

                            <ul>
                                <li>Khi bị dị ứng mỹ phẩm, quý khách hàng nên ngừng sử dụng sản phẩm và rửa mặt ngày 3 - 4
                                    lần bằng nước muối loãng hay nước ấm.</li>
                                <li>Ngừng sử dụng sản phẩm trong khoảng 3 - 5 ngày, sau đó bôi lại một lớp thật mỏng ở phần
                                    nhỏ của mặt hay mặt trong cánh tay để xem phản ứng của làn da, nếu bình thường có thể
                                    tiếp tục sử dụng.</li>
                                <li>Nếu sử dụng vẫn dị ứng khách hàng nên đổi sang dùng dòng sản phẩm khác.</li>
                            </ul>

                            <h3><strong>10. Tôi dùng Thực phẩm chức năng xong và thấy dị ứng, khó chịu thì phải làm
                                    sao?</strong></h3>

                            <ul>
                                <li>Các dòng Thực phẩm chức năng của Nhật Bản có nguồn gốc từ thiên nhiên nên an toàn và
                                    lành tính với người sử dụng. Một số dòng sản phẩm sẽ có biểu hiện theo lưu ý của Nhà sản
                                    xuất, đó là biểu hiện bình thường do sản phẩm đang có phản ứng tích cực với cơ thể.</li>
                                <li>Tuy nhiên, nếu có những biểu hiện khác thường như dị ứng, chóng mặt, buồn nôn,... không
                                    có trong lưu ý của Nhà sản xuất, khách hàng nên ngừng sử dụng ngay.</li>
                            </ul>

                            <h3><strong>11. Khi dùng sản phẩm và bị dị ứng, chóng mặt, buồn nôn,… có thể đổi trả hàng lại
                                    được không?</strong></h3>

                            <ul>
                                <li>Tác dụng của sản phẩm có thể khác nhau tùy thuộc vào cơ địa người dùng, vì thế nên ngừng
                                    sử dụng và tìm sản phẩm khác phù hợp hơn.</li>
                                <li>Hiện tại Japana KHÔNG áp dụng chính sách đổi trả lại hàng sau khi đã qua sử dụng, mở
                                    nắp, bóc tem, seal.</li>
                                <li>Trường hợp quý khách hàng sau khi sử dụng sản phẩm xuất hiện các biểu hiện khác thường,
                                    nên liên hệ trực tiếp nhân viên chăm sóc khách hàng để được tư vấn và hỗ trợ kịp thời.
                                </li>
                            </ul>

                            <h3><strong>12. Tôi bị u nang (u xơ) buồng trứng (cổ tử cung) có sử dụng collagen được
                                    không?</strong></h3>

                            <ul>
                                <li>Các bác sĩ khuyến cáo người bị u xơ tử cung tránh dùng Estrogen liều cao và kéo dài vì
                                    dễ ảnh hưởng đến sự phát triển của u xơ tử cung. Còn việc sử dụng các sản phẩm collagen
                                    thì không gây ảnh hưởng gì.</li>
                                <li>Quý khách hàng nên tham khảo ý kiến bác sĩ để có thêm thông tin chi tiết và cách sử dụng
                                    hợp lý.</li>
                            </ul>

                            <h3><strong>13. Làm thế nào để biết sản phẩm SK-II là hàng chính hãng?</strong></h3>

                            <ul>
                                <li>Để mua mỹ phẩm SK-II chính hãng nên lựa chọn địa chỉ bán hàng uy tín, chất lượng. Ngoài
                                    ra, bạn có thể truy cập các website uy tín để kiểm tra xuất xứ, hạn sử dụng và thông tin
                                    sản phẩm.</li>
                            </ul>

                            <h3><em><strong>Gửi ngay câu hỏi cho chúng tôi để được giải đáp thắc mắc trong thời gian sớm
                                        nhất!</strong></em></h3>

                            <p>Bản đồ tìm đường đến Japana:</p>

                            <p><iframe class="card-img" style="width: 100%;height:400px"
                                    src="https://www.google.com/maps/d/embed?mid=1rZRxioJd4yWbwdtOMmX2_PsmjqYArtC7">Cửa
                                    h&agrave;ng thực phẩm chức năng Nhật Bản</iframe></p>

                            <p><a href="https://drive.google.com/drive/folders/10xWcWaA0EYy5lu4CNOnv2_zdqCrSGuRa?usp=sharing"
                                    target="_blank">https://drive.google.com/drive/folders/10xWcWaA0EYy5lu4CNOnv2_zdqCrSGuRa?usp=sharing</a><br>
                                <a href="https://niemstyle.blogspot.com/p/japana-social.html" target="_blank">Blog - Social
                                    List</a>
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
