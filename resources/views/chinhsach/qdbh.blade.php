@extends('layout.master')

@section('title', 'Quy định bán hàng')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/japana.css') }}">
@endpush

@section('content')
    <section class="navigation shadow-bottom">
        <div class="container">
            <div class="content-nav">
                <a href="#" class="tchu">Trang Chủ</a>
                <a href="# " class="cs">/Quy Định Bán Hàng Trên Website japana.vn</a>
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
                        <h3 class="title">Quy định bán hàng trên Website Japana</h3>
                        <div class="detail-static">
                            <p><strong>KÍNH GỬI: CÁC NHÀ CUNG CẤP</strong></p>

                            <p><strong>Giới thiệu &amp; Sứ mệnh</strong></p>

                            <p>Chúng tôi là Công ty Cổ phần&nbsp;JAPANA Việt Nam, địa chỉ trụ sở chính tại Số 76&nbsp;Nguyễn
                                Háo Vĩnh, Quận Tân Phú, TP.HCM và văn phòng&nbsp;Nhật Bản tại địa chỉ :&nbsp;Kangawa Ken
                                Ebina - Sbi Nakana, Japan,&nbsp;hoạt động kinh doanh thương mại điện tử qua trang web của
                                Siêu Thị Nhật Bản JAPANA&nbsp;(sau đây được gọi là "Japana" hoặc "Japana.vn"&nbsp;hoặc
                                "chúng tôi").</p>

                            <p><strong>Siêu thị Nhật Bản&nbsp;Japana</strong>&nbsp;ra đời mang một hoài bão khát khao tạo
                                nên bước đột phá lớn trong lĩnh vực thương mại điện tử có kiểm soát chất lượng sản phẩm ở
                                Việt Nam, hướng đến sứ mệnh cung cấp các sản phẩm chất lượng, an toàn vì sức khỏe người
                                Việt.</p>

                            <p>Với ý nghĩa trên, chúng tôi rất mong muốn hợp tác và chỉ hợp tác với các đối tác là các Công
                                ty, Cá nhân, Nhà nhập khẩu, … muốn phân phối các sản phẩm uy tín, chất lượng đến với người
                                tiêu dùng Việt Nam. Trong trường hợp Nhà cung cấp nào cung cấp cho chúng tôi các sản phẩm
                                không rõ&nbsp;nguồn gốc, không đúng cam kết, không đảm bảo chất lượng, hàng giả, hàng nhái…
                                gây thiệt hại cho quyền lợi người tiêu dùng, làm ảnh hưởng uy tín của chúng tôi đối với
                                khách hàng thì Quý nhà cung cấp đó hoàn toàn chịu trách nhiệm theo pháp luật.</p>

                            <p><strong>Khi Quý nhà cung cấp và/hoặc cho phép chúng tôi đưa hình ảnh sản phẩm của mình lên
                                    website japana.vn của chúng tôi có nghĩa là quý khách đồng ý với các điều khoản
                                    này.</strong></p>

                            <p><strong>Xin vui lòng đọc kỹ trước khi quyết định bán hàng trên website chúng tôi:</strong>
                            </p>

                            <p><strong>Điều 1. Định nghĩa chung</strong></p>

                            <ul>
                                <li><strong>Bên A:</strong> là Công ty Cổ phần&nbsp;JAPANA Việt Nam</li>
                                <li><strong>Bên B</strong>: là các Nhà cung cấp đồng ý bán hàng trên website của chúng tôi.
                                </li>
                                <li><strong>Sàn giao dịch:</strong> là hoạt động thương mại điện tử trên website của siêu
                                    thị hàng Nhật Bản JAPANA&nbsp;đã được đăng ký với cơ quan quản lý nhà nước có thẩm
                                    quyền.</li>
                                <li><strong>Khách hàng: </strong>là người đặt mua hàng hóa qua thanh công cụ mua hàng được
                                    tích hợp trên website : <a href="https://japana.vn/&ZeroWidthSpace;"
                                        target="_blank"><strong>https://japana.vn/&ZeroWidthSpace;</strong></a></li>
                                <li><strong>Đơn đặt hàng: </strong>là khách hàng lựa chọn và thực hiện các thao tác để đặt
                                    hàng hóa của bên B qua thanh công cụ mua hàng.</li>
                                <li><strong>Hàng hóa: </strong>là sản phẩm/dịch vụ của bên B và được đăng tải trên Sàn giao
                                    dịch.</li>
                                <li><strong>Bằng văn bản:</strong> bao gồm các hình thức thư xác nhận việc nhận được, thư
                                    được gửi trực tiếp hoặc gửi fax hoặc báo cáo trả lời từ máy fax, tin nhắn qua các phương
                                    tiện mạng xã hội khác như zalo, viber, facebook,… hoặc thư điện tử có xác nhận gửi đến
                                    địa chỉ email đăng ký của bên B.</li>
                                <li><strong>Thông tin hàng hóa và nội dung:</strong> bao gồm nhưng không giới hạn các thông
                                    tin sau: tên, tính năng, chất lượng, số lượng, xuất xứ, giá bán, thông số kỹ thuật, bảo
                                    hành, vận&nbsp; chuyển, hủy/đổi/trả lại và các thông tin nội dung khác liên quan đến mỗi
                                    hàng hóa.</li>
                                <li><strong>Thông tin pháp lý:</strong> bao gồm nhưng không giới hạn tên, địa chỉ, người đại
                                    diện thông tin về các loại giấy phép theo quy định của pháp luật và các thông tin khác
                                    của bên B.</li>
                                <li><strong>COD</strong>: là số tiền hàng còn lại sau khi trừ % phí hoa hồng của bên A, hay
                                    tiền thu hộ hay còn gọi là tiền COD.</li>
                                <li><strong>Bên vận chuyển:</strong> là nhân viên giao nhận của bên A hoặc các doanh nghiệp
                                    cung cấp dịch vụ vận chuyển để chuyển hàng hóa cho khách hàng.</li>
                            </ul>

                            <p><strong>Điều 2. Quyền và nghĩa vụ của Bên B.</strong></p>

                            <p><strong>Quyền hạn</strong></p>

                            <ul>
                                <li>Bên B đồng ý cho bên A sử dụng sản phẩm và hình ảnh các sản phẩm trên website của bên B
                                    để đăng tải lên website&nbsp;của bên A.</li>
                                <li>Được quyền đề nghị bên A thay đổi giá bán, thông tin sản phẩm cho phù hợp theo từng thời
                                    điểm cụ thể của bên B.</li>
                                <li>Được đảm bảo thực hiện theo đúng quy định của thỏa thuận này và các quy định trên Siêu
                                    Thị Nhật Bản Japana</li>
                            </ul>

                            <p><strong>Nghĩa vụ</strong></p>

                            <ul>
                                <li>Bên B có trách nhiệm cung cấp chính xác thông tin về số lượng, chất lượng, giá cả, xuất
                                    xứ, chính sách bảo hành và các thông tin khác của hàng hóa cho bên A.</li>
                                <li>Hàng hóa đăng tải trên Gian hàng thuộc quyền sở hữu hợp pháp của bên B. Hàng hóa không
                                    thuộc danh mục hàng hóa cấm quảng cáo, cấm kinh doanh và cấm đăng tải trên website
                                    japana.vn. Đối với hàng hóa thuộc danh mục kinh doanh có điều kiện thì bên B phải đảm
                                    bảo có đầy đủ điều kiện theo quy định của pháp luật khi kinh doanh hàng hóa này và cung
                                    cấp các giấy phép này ngay khi có yêu cầu của bên A. Nếu cung cấp sai, bên B chịu trách
                                    nhiệm với cơ quan chức năng theo quy định.</li>
                                <li>Thực hiện các nghĩa vụ bảo hành, hoàn trả lại hàng hóa và các cam kết khác như đã đăng
                                    tải thông tin trên website&nbsp;hoặc theo tiêu chuẩn của nhà sản xuất.</li>
                                <li>Chuẩn bị sẵn hàng hóa và các giấy tờ kèm theo để chuyển cho khách hàng, như: Phiếu bảo
                                    hành của hàng hóa nếu có; phiếu hướng dẫn sử dụng; phiếu giao hàng/xuất kho hoặc phiếu
                                    xuất kho kiêm vận chuyển nội bộ; hóa đơn GTGT.</li>
                                <li>Bằng chi phí và trách nhiệm của mình, bên B chịu trách nhiệm đối với toàn bộ rủi ro về
                                    thông tin hàng hóa, về nội dung bản quyền, về thông tin pháp lý và bảo hành đối với hàng
                                    hóa của mình.</li>
                                <li><em>Đảm bảo giao đúng </em><em>h</em><em>àng </em><em>h</em><em>óa đã được niêm yết trên
                                    </em><em>Sàn giao dịch</em><em> và trong </em><em>đ</em><em>ơn </em><em>đ</em><em>ặt
                                    </em><em>h</em><em>àng. </em><em>Bên B</em><em> có trách nhiệm nhận lại
                                    </em><em>h</em><em>àng </em><em>h</em><em>óa bị lỗi</em>/khuyết điểm/không tuân thủ và
                                    chịu trách nhiệm phát sinh từ/liên quan trong trường hợp này.</li>
                                <li>Tuân thủ và thực hiện đầy đủ các quy định được niêm yết công khai trên website. Bên B
                                    nhận thức được rằng: tất cả quy định được niêm yết trên website là công khai cho cả bên
                                    B và khách hàng. Bên B đồng ý với quy định này, không có bất kỳ khiếu nại và nghiêm
                                    chỉnh tuân thủ các quy định đó.</li>
                                <li>Trong mọi trường hợp, nếu bên B đã bán hết hàng hoặc không tiếp tục bán hàng đã đăng tải
                                    trên sàn giao dịch, thì bên B phải thông báo cho bên A ngay sau khi bên B bán hết hàng
                                    hoặc quyết định ngừng bán. Nếu bên B vi phạm quy định này thì bên A có quyền ngưng cung
                                    cấp dịch vụ và đơn phương chấm dứt hợp đồng.</li>
                                <li>Trong trường hợp bên A yêu cầu đổi trả lại hàng thì bên B có trách nhiệm đổi trả lại
                                    hàng cho bên A.</li>
                                <li>Khi có thay đổi giá bán, bên B phải thông báo bằng văn bản trước cho bên A từ một đến
                                    hai ngày để bên A thay đổi lại giá bán trên Website.</li>
                                <li>Cung cấp thông tin có liên quan về sản phẩm theo yêu cầu của bên A, thông tin cung cấp
                                    phải đầy đủ chính xác, trung thực và hoàn toàn chịu trách nhiệm pháp luật về những thông
                                    tin đưa ra.</li>
                                <li>Phải chịu toàn bộ trách nhiệm về tổn thất gây ra cho Khách Hàng nếu Khách Hàng chứng
                                    minh được lỗi do bên B gây ra; phải bồi thường cho Khách Hàng chậm nhất là một (01) ngày
                                    sau ngày Khách Hàng chứng minh được lỗi thuộc về bên B.</li>
                                <li>Chịu trách nhiệm trước pháp luật và giải trình với các cơ quan có thẩm quyền về chất
                                    lượng, tính hợp pháp của các sản phẩm/ dịch vụ do bên B cung cấp cũng như khiếu nại về
                                    sản phẩm/dịch vụ của khách hàng hoặc bên thứ ba.</li>
                                <li>Không được chiết khấu hoa hồng riêng cho nhân viên bên A, không được thuê; yêu cầu;
                                    khuyến khích nhân viên của bên A bán hoặc giới thiệu quản bá sản phẩm/dịch vụ của bên B
                                    (dưới mọi hình thức). Nếu bên B vi phạm bên A có quyền đơn phương chấm dứt hợp đồng,
                                    đồng thời bên A có quyền không thanh toán phần công nợ đang còn cho bên B.</li>
                                <li>Có trách nhiệm xuất hóa đơn tài chính trong vòng 2 (hai) ngày làm việc kể từ ngày bên A
                                    yêu cầu.</li>
                            </ul>

                            <p><strong>Điều 3. Hoạt động dịch vụ của bên A</strong></p>

                            <ul>
                                <li>Dịch vụ bán hàng chuyên nghiệp của bên A trên website <strong>Siêu thị Nhật Bản
                                        JAPANA</strong>&nbsp;mang đến một tập hợp các đặc điểm thiết kế cụ thể trên Sàn giao
                                    dịch, giúp bên B có thể giới thiệu một cách trực quan thông qua trang quảng cáo sản phẩm
                                    chuyên nghiệp riêng biệt cho bên B hoặc theo các danh mục, nhóm sản phẩm cùng loại liên
                                    quan.</li>
                                <li>Công cụ tìm kiếm Marketing: giúp chạy các từ khóa có liên quan đến hàng hóa và/hoặc bên
                                    B trên các công cụ tìm kiếm điện tử.</li>
                                <li>Quảng cáo trên mạng lưới hiển thị trên cả khu vực và mạng lưới google (mạng công cụ hiển
                                    thị của google).</li>
                                <li>Hàng hóa, dịch vụ giới thiệu trên website&nbsp;được cung cấp thông tin chính xác, trung
                                    thực và theo đúng tiêu chuẩn của nhà sản xuất.</li>
                            </ul>

                            <p><strong>Điều 4. Quyền và nghĩa vụ bên A</strong></p>

                            <p><strong>Quyền lợi</strong></p>

                            <ul>
                                <li>Sử dụng hình ảnh các sản phẩm thực tế và hình ảnh trên các website của bên B để đăng tải
                                    công khai lên website&nbsp;của bên A .</li>
                                <li>Sửa đổi/bổ sung/ban hành mới các quy định, thông báo có liên quan đến việc bán hàng của
                                    bên B tại bất kỳ thời điểm bao gồm cả thời gian thỏa thuận này còn hiệu lực.</li>
                                <li>Bên A không có nghĩa vụ phải thanh toán cho bên B bất kỳ phí bản quyền hoặc phí khác
                                    liên quan đến việc sử dụng thông tin nêu trên.</li>
                                <li>Sử dụng có chọn lọc hình ảnh các sản phẩm thực tế của bên B để đăng tải công khai lên
                                    website của bên A</li>
                            </ul>

                            <p><strong>Nghĩa vụ</strong></p>

                            <ul>
                                <li>Sử dụng và niêm yết chính xác về số lượng, chất lượng, giá cả, xuất xứ, chính sách bảo
                                    hành và các thông tin khác của hàng hóa, sản phẩm trên website&nbsp;do bên B cung cấp.
                                </li>
                                <li>Kiểm tra hàng hóa trước khi nhận giao cho khách hàng, như: số lượng, móp, méo, xước,
                                    bong sơn… (nếu có).</li>
                                <li>Tuân thủ các quy định theo quy định của pháp luật Việt Nam liên quan đến hoạt động kinh
                                    doanh Online.</li>
                                <li>Bên A chịu trách nhiệm liên quan đến dịch vụ theo thỏa thuận do bên A cung cấp, bên A
                                    không chịu trách nhiệm các vấn đề phát sinh khác (nếu có) đối với bên B.</li>
                                <li>Xuất hóa đơn tài chính cho bên B sau khi thực hiện xong dịch vụ và đối soát.</li>
                            </ul>

                            <p><strong>Điều 5. </strong><strong>Phí dịch v</strong><strong>ụ và</strong> <strong>tiến
                                    độ</strong><strong> phương thức thanh toán:</strong></p>

                            <p><strong>Phí Hoa hồng:</strong> Là khoản phí mà bên A được hưởng dựa trên giá bán khi tham gia
                                bán hàng cho bên B.</p>

                            <p><strong>Phương thức thanh toán: </strong></p>

                            <ul>
                                <li>Bên A sẽ giữ lại % hoa hồng/Tổng giá trị các đơn hàng (không bao gồm chi phí vận chuyển
                                    và các khoản phí khác nếu có), số tiền hàng còn lại (tiền thu hộ hay còn gọi là tiền
                                    COD) bên A sẽ chuyển khoản hoặc tiền mặt cho bên B vào ngày 15 và 30 mỗi tháng sau khi
                                    hai bên xác nhận biên bản đối soát bằng văn bản.</li>
                                <li>Vào trước ngày thanh toán từ 1 đến 2 ngày và tổng tiền làm đối soát phải trên 1 triệu
                                    đồng (nếu dưới sẽ chuyển sang đối soát vào đợt tiếp theo) bên B gửi biên bản đối soát
                                    tổng số lượng hàng hóa cho bên A để đối chiếu. Nếu có sự chênh lệch bản đối soát giữa
                                    hai bên, hai bên sẽ tìm nguyên nhân chênh lệch trong vòng một (01) ngày làm việc, nếu
                                    không tìm được nguyên nhân thì bản đối soát của bên A được sử dụng là kết quả cuối cùng
                                    để hai Bên thanh toán Tiền Hàng và phí xử lý đơn hàng (nếu có).</li>
                            </ul>

                            <p><strong>Điều 6. </strong><strong>Phương thức vận chuyển và sử dụng bao bì của bên A đối với
                                    khách hàng.</strong></p>

                            <ul>
                                <li>Khi giao hàng, bên B có trách nhiệm chuẩn bị sẵn hàng hóa và các giấy tờ kèm theo để
                                    chuyển cho khách hàng, như: Phiếu bảo hành của hàng hóa nếu có; phiếu hướng dẫn sử dụng;
                                    phiếu giao hàng/xuất kho hoặc phiếu xuất kho kiêm vận chuyển nội bộ; hóa đơn GTGT (nếu
                                    khách hàng yêu cầu).</li>
                                <li>Bên A có trách nhiệm thỏa thuận với khách hàng về hình thức và chi phí vận chuyển hàng
                                    hóa.</li>
                                <li>Phí vận chuyển được bên A giữ lại để thanh toán cho bên vận chuyển, bên A chỉ thanh toán
                                    tiền hàng (COD) cho bên B.</li>
                                <li>Phí vận chuyển gồm: cước phí vận chuyển, phí COD (phí giao hàng và trả tiền), phí chuyển
                                    hoàn, phí hàng cồng kềnh (nếu có). Bảng phí vận chuyển để tính phí vận chuyển theo từng
                                    đơn đặt hàng online đã bao gồm thuế VAT.</li>
                                <li>Nếu phát sinh phí chuyển hoàn vì phải chuyển lại hàng hóa cho bên B do lỗi phát sinh từ
                                    chất lượng hàng hóa thì bên B phải chịu phí hoàn toàn.</li>
                                <li>Nếu Khách hàng từ chối nhận hàng do lỗi của khách hàng, phí chuyển hoàn bên A sẽ chịu.
                                </li>
                                <li>Trường hợp hàng hóa bị trả lại do móp méo thì thuộc trách nhiệm đền bù hoàn trả của bên
                                    vận chuyển.</li>
                                <li>Bên A được quyền sử dụng túi đựng sản phẩm riêng của mình để cung cấp hàng hóa cho khách
                                    hàng.</li>
                            </ul>

                            <p><strong>Điều 7. Tạm ngừng một phần hoặc toàn bộ dịch vụ</strong></p>

                            <p>Thỏa thuận này được tạm ngưng trong các trường hợp sau:</p>

                            <ul>
                                <li>Bên B gửi văn bản đề nghị bên A tạm ngừng một phần hoặc toàn bộ việc nêm yết bên B và
                                    dịch vụ nếu có, thời gian tạm ngừng tối đa là 30 ngày. Hết thời hạn, bên B phải thông
                                    báo khôi phục lại dịch vụ. Sau thời gian tạm ngừng bên B không khôi phục lại thì bên A
                                    hiểu là bên B từ chối tiếp tục thực hiện dịch vụ và Thỏa thuận này đã chấm dứt và không
                                    còn hiệu lực thi hành với bên A.</li>
                                <li>Bên A tạm ngừng cung cấp một phần hoặc toàn bộ dịch vụ trong các trường hợp sau:</li>
                                <li>Bên B vi phạm một trong các điều khoản thỏa thuận tại Thỏa thuận hoặc vi phạm quy định
                                    sử dụng trên website japana.vn hoặc theo quy định của cơ quan Nhà nước có thẩm quyền,
                                    hình thức giải quyết quyền lợi và nghĩa vụ trong trường hợp này như sau: Dịch vụ được
                                    bên A thực hiện tiếp sau khi bên B chấm dứt hành vi vi phạm, thời gian tạm ngừng vẫn
                                    được tính là thời gian thực hiện Thỏa thuận và bên B phải bồi thường thiệt hại (nếu có)
                                    cho bên A. Trong trường hợp sau 10 ngày kể từ ngày vi phạm, bên B không chấm dứt hành vi
                                    vi phạm bên A có quyền đơn phương chấm dứt Thỏa thuận.</li>
                                <li>Trường hợp tạm ngừng do bất khả kháng thì phí dịch vụ và chi phí phát sinh sẽ chia đều
                                    cho mỗi bên.</li>
                            </ul>

                            <p><strong>Điều 8. Bất khả kháng</strong></p>

                            <p>Mọi tình huống xảy ra sau và trong khi Thỏa thuận có hiệu lực do các yếu tố không lường trước
                                và không tránh được như: chiến tranh, các cuộc nổi loạn, bạo loạn, các hành động phá hoại,
                                các cuộc đình công, bãi công, các đạo luật hay quy chế của Chính phủ thay đổi, cháy, nổ hay
                                các tai nạn không thể tránh được khác, lũ lụt, bão, động đất hay các hiện tượng tự nhiên
                                không bình thường khác, hacker, lỗi kỹ thuật ngoài sự kiểm soát của các Bên trong Thỏa thuận
                                và ảnh hưởng trực tiếp đến việc thực hiện toàn bộ hoặc một phần nghĩa vụ Thỏa Thuận, được
                                coi là bất khả kháng.</p>

                            <p><strong>Điều 9. Quy định về cung cấp thông tin và bảo mật thông tin</strong></p>

                            <p>Hai bên cam kết mọi thông tin, tài liệu liên quan đến Bên kia sẽ được bảo mật tuyệt đối,
                                không tiết lộ cho bất kỳ bên thứ ba ngoại trừ các bên như tòa án, viện kiểm sát, cảnh sát,
                                công an, quản lý thị trường, cơ quan thuế, văn phòng luật sư, trung tâm bảo vệ người tiêu
                                dùng, các cơ quan quản lý nhà nước khác, hoặc công ty làm về bảo mật yêu cầu cung cấp thông
                                tin theo các quy định của pháp luật Việt Nam, các bên có quyền cung cấp thông tin theo yêu
                                cầu với mục đích bảo vệ quyền lợi, thương hiệu, tài sản chính đáng của các bên yêu cầu cung
                                cấp.</p>

                            <p>Các thông tin chỉ được cung cấp cho Bên thứ ba khi có sự chấp thuận bằng văn bản của cả hai
                                Bên.</p>

                            <p><strong>Điều 10.</strong> <strong>Giải quyết tranh chấp và khiếu nại</strong></p>

                            <p>Thỏa thuận này được điều chỉnh bởi pháp luật Việt Nam.</p>

                            <p>Mọi mâu thuẫn, tranh chấp phát sinh liên quan tới Thỏa thuận này, trước hết sẽ được hai bên
                                thống nhất giải quyết bằng thương lượng, hòa giải. Trong trường hợp các bên không Thỏa thuận
                                được với nhau thì&nbsp; trong vòng ba mươi (30) ngày kể từ ngày hai bên không đạt được hòa
                                giải thì một trong hai bên có quyền đưa vụ việc ra Trung tâm trọng tài quốc tế Việt Nam
                                (VIAC) để giải quyết theo quy tắc tố tụng của VIAC. Nơi giải quyết tranh chấp là nơi đặt trụ
                                sở chính của japana.vn (bên A), ngôn ngữ là Tiếng Việt. Phán quyết của VIAC là phán quyết
                                cuối cùng có giá trị ràng buộc các bên phải thực hiện, bên thua kiện sẽ phải chịu mọi chi
                                phí theo quy định của pháp luật hiện hành.</p>

                            <p><strong>CHỦ TỊCH HĐQT</strong></p>

                            <p>NGUYỄN NGỌC</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!--Phần Slider Của Chuyên Mục THông Tin -->
    @include('layout.modalPolicy')

@endsection
