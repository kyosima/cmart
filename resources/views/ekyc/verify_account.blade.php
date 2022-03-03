@extends('layout.master')

@section('title', 'Thông tin tài khoản')

@push('css')
    <link href="{{ asset('public/css/ekyc.css') }}" rel="stylesheet" type="text/css">
@endpush

@section('content')
    <div class="container">
        @if (Session::has('message'))
            <p class="alert alert-danger text-center">{{ Session::get('message') }}</p>
        @endif
        <form action="{{ route('ekyc.postVerify') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <h4 class="text-center">XÁC THỰC HỒ SƠ KHÁCH HÀNG</h4>
                    <ul style="list-style: none">
                        <li>- Quý Khách Hàng vui lòng thực hiện theo hướng dẫn để xác minh nhanh nhân thân với công nghệ
                            eKYC.
                            C-Mart là một trong số các công ty thương mại điện tử tiên phong áp dụng công nghệ này để xác
                            minh
                            Khách Hàng là chính chủ của danh tính cung cấp chỉ trong vài phút.</li>

                        <li>- Giới thiệu sơ lược về công nghệ eKYC: eKYC là hình thức định danh Khách Hàng điện tử, đã được
                            Nhà
                            nước chấp thuận cấp phép. Theo Quyết định 149/QĐ-TTg về việc phê duyệt Chiến lược tài chính toàn
                            diện quốc gia đến năm 2025, định hướng đến năm 2030 của Thủ tướng Chính phủ “cho phép áp dụng
                            quy
                            trình nhận biết khách hàng đơn giản và gián tiếp từ xa bằng phương thức điện tử trực tuyến
                            (eKYC)
                            đối với việc mở tài khoản tại các tổ chức được cấp phép để phục vụ cho nhu cầu thanh toán giá
                            trị nhỏ của cá nhân và doanh nghiệp”. Điều này góp phần giúp xác minh danh tính của Khách Hàng
                            trực
                            tuyến và đánh giá rủi ro, phát hiện lừa đảo trong mỗi giao dịch,...</li>

                        <li>- C-Mart luôn muốn mang đến những trải nghiệm văn hóa phục vụ chuyên nghiệp, an toàn. Vì thế,
                            C-Mart
                            đã lựa chọn công nghệ hiện đại nhất để nâng cao độ bảo mật, nâng cao trải nghiệm Khách Hàng, đơn
                            giản hóa các thủ tục. Trong sự bảo vệ tối đa dành cho Quý Khách Hàng, mang đến sự an tâm khi
                            giao
                            dịch cùng C-Mart, mà vẫn đáp ứng nhu cầu của Khách Hàng ngày càng tốt hơn theo hướng One Stop
                            Shopping (Khách Hàng chỉ truy cập một nơi và đáp ứng mọi nhu cầu giao dịch của mình).</li>

                        <li>- Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm
                            túc, và chúng tôi thực hiện vô cùng nghiêm ngặt. Các thông tin này CHỈ DÙNG ĐỂ XÁC MINH nhằm
                            đảm bảo an toàn giao dịch theo quy định, và cho chính quyền lợi của Khách Hàng</li>
                    </ul>
                </div>
                <div class="col-lg-12 col-md-12 col-12">

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="accept_ekyc" id="accept-ekyc" value="1"
                            required oninvalid="this.setCustomValidity('Vui lòng đồng ý trước khi bắt đầu duyệt eKYC')"
                            checked>
                        <label class="form-check-label" for="accept-ekyc">Tôi đã đọc và đồng ý với Quy
                            định Điều khoản & Điều kiện eKYC</label>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12">
                    <h4>Cung cấp thông tin tài khoản</h4>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="form-group">
                        <div class="select-type-profile">
                            <select class="form-control" name="type_cmnd" aria-label="Default select example">
                                <option value="0" selected>Chọn loại giấy tờ tùy thân</option>
                                <option value="1">Chứng minh nhân dân</option>
                                <option value="2">Căn cước công dân</option>
                                <option value="3">Hộ chiếu</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="verify_image_front">
                        <label for="">Mời bạn chụp ảnh mặt trước giấy tờ</label>
                        <input id="image-front" type="hidden" name="image_front">
                        <input id="status-front" type="hidden" name="status_front" value="0">
                        <canvas id="preview-front" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="verify_image_back">
                        <label for="">Mời bạn chụp ảnh mặt sau giấy tờ</label>
                        <input id="image-back" type="hidden" name="image_back">
                        <input id="status-back" type="hidden" name="status_back" value="0">
                        <canvas id="preview-back" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="verify_image_portrait">
                        <label for="">Mời bạn chụp ảnh chân dung</label>
                        <input id="image-portrait" type="hidden" name="image_portrait">
                        <input id="status-portrait" type="hidden" name="status_portrait" value="0">
                        <canvas id="preview-portrait" width="800px" height="600px" max-width="100%"></canvas>
                    </div>
                    <div class="row tool-ekyc">
                        <div class="col-lg-6 col-md-6 col-12">
                            <button id="click-photo" class="btn btn-danger w-100" type="button">Chụp ảnh</button>
                        </div>
                        <div class="col-lg-6 col-md-6 col-12">
                            <button id="confirm-image" type="button" class="btn btn-primary w-100"
                                onclick="confirmImage()">Chọn
                                ảnh</button>
                        </div>
                    </div>
                    <div class="live_cam">
                        <hr>
                        <label for="">Camera</label>
                        <video id="video" max-width="100%" autoplay></video>
                    </div>
                    <button id="start-camera" class="btn btn-primary w-100" type="button">Bắt đầu EKYC</button>
                </div>
            </div>
            <div class="text-center check-ekyc">
                <button class="btn btn-danger" type="submit">Bắt đầu duyệt EKYC</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/ekyc.js') }}"></script>
@endpush
