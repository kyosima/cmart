@extends('layout.master')

@section('title', 'Tài khoản')

@push('css')
    <link href="{{ asset('css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
<div class="container">
    <div class="form-box">
        <div class="button-box">
            <div id="btn"></div>
            <button type="button" class="toggle-btn" onclick="login();">Đăng Nhập</button>
            <button type="button" class="toggle-btn" onclick="register();">Đăng ký</button>
        </div>
        <form id="login" class="input-group">
            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-user"></i>
                </div>
                <input type="text" placeholder="Email hoặc số điện thoại" class="form-control ipt-text">
            </div>
            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-lock"></i>
                </div>
                <input type="password" placeholder="Mật khẩu" class="form-control ipt-text">
            </div>

            <button type="submit" class="btn-red">Đăng nhập</button>
            <p style="margin-top: 10px;color: red;" id="error-login"></p>
            <div class="box-check login-popup">
                <label class="check-custom">Ghi nhớ tài khoản
                    <a href="#" title="Quên mật khẩu?" data-toggle="modal" class="forgot-pass"
                        onclick="forgotpassword()">Quên mật khẩu?</a>
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>


        <form id="register" class="input-group">
            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-user"></i>
                </div>
                <input type="text" placeholder="Họ và tên" class="form-control ipt-text">
            </div>

            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-envelope"></i>
                </div>
                <input type="email" placeholder="Email" class="form-control ipt-text">
            </div>
            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-phone"></i>
                </div>
                <input type="tel" placeholder="Số điện thoại" class="form-control ipt-text">
            </div>

            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-lock"></i>
                </div>
                <input type="password" placeholder="Mật khẩu" class="form-control ipt-text">
            </div>
            <div class="box-input form-group">
                <div class="icon-form">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                </div>
                <input type="password" placeholder="Xác nhận mật khẩu" class="form-control ipt-text">
            </div>


            <div class="box-check">
                <label class="check-custom">Bạn đã đọc và đồng ý với điều khoản sử dụng, mua bán và bảo
                    mật của <a href="#" title="japana">Japana.vn</a>
                    <input type="checkbox" id="check-rule" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div>
            <div class="box-check2">
                <label class="check-custom">Đăng ký nhận khuyến mãi từ chúng tôi
                    <input type="checkbox" id="check-promo" checked="checked">
                    <span class="checkmark"></span>
                </label>
            </div>
            <button type="submit" name="regis-btn" class="btn-red">Tạo
                tài khoản</button>
        </form>




        <form id="forgot-password" class="input-group">
            <p class="title-log">Lấy lại mật khẩu</p>
            <form>
                <p class="intro-log">
                    Vui lòng nhập địa chỉ email của bạn vào ô bên dưới. Bạn sẽ nhận được một liên kết để thiết lập lại
                    mật khẩu.
                </p>
                <div class="box-input form-group">
                    <div class="icon-form">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input type="email" placeholder="Nhập email của bạn" class="form-control ipt-text">
                </div>

                <button onclick="funcuser.losspass('https://japana.vn/');" type="button" class="btn-red">Lấy lại
                    mật khẩu</button>
                <a href="#Login" class="link-return"><i class="fa fa-angle-double-left"></i> Quay lại trang đăng
                    nhập</a>
            </form>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var x = document.getElementById("login")
        var y = document.getElementById("register")
        var z = document.getElementById("forgot-password")
        var v = document.getElementById("btn")

        function register() {
            x.style.left = "-550px";
            y.style.left = "50px";
            z.style.left = "-550px"
            v.style.left = "145px";
        }

        function login() {
            x.style.left = "50px";
            y.style.left = "550px";
            z.style.left = "50px"
            v.style.left = "0px";
        }
    </script>
@endpush
