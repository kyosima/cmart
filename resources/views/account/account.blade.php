@extends('layout.master')

@section('title', 'Tài khoản')

@push('css')
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')

<style type="text/css">
.thongbao_register {
    border-radius: 5px;
    font-size: 14px;
    text-align: left;
}
.thongbao_register ul{
    list-style: none;
    padding: 0;
}
.loaigiayto {
    border: none;
    padding: 12px;
    background: #EEE;
    font-size: 16px;
    margin: 12px 0px;
    width: 100%;
    font-weight: 100;
    outline: none;
}
</style>

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-6 col-md-6 col-xs-12 col-sm-12 ">
                <section class="loginWrapper">
                    

                    <ul class="tabs">
                        <li class="active">Đăng nhập</li>
                        <li>Đăng ký</li>
                        <li>Quên mật khẩu</li>
                    </ul>

                    <ul class="tab__content">

                        <li class="active">
                            <div class="content__wrapper">
                                <form method="POST" action="{{ route('user.login') }}" role="form" enctype="multipart/form-data">
                                    @csrf
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}<br>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if(session('thongbao'))
                                    <div class="alert alert-success">
                                        {{session('thongbao')}} 
                                        <!--<br> Quý Khách Hàng vui lòng <strong><a class="alert-success" href="tai-khoan">Tạo mới Hồ Sơ Khách Hàng</a></strong>-->
                                    </div>
                                    @endif
                                    <input type="text" name="phone" placeholder="Tài khoản">
                                    <input type="password" name="password" placeholder="Mật khẩu">
                                    <input type="submit" value="Đăng nhập" name="Đăng nhập">
                                </form>

                            </div>
                        </li>
<!-- Register -->
                        <li>
                            <form method="POST" action="{{ route('user.register') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="content__wrapper">
                                <div class="thongbao_register ">
                                    <ul class="m-0">
                                        <li class="text-light">- Xin Quý Khách Hàng tin tưởng rằng C-Mart xem việc bảo mật thông tin là điều vô cùng nghiêm túc, 
                                            và chúng tôi thực hiện vô cùng nghiêm ngặt. 
                                        </li>
                                        <li class="text-light">- Các thông tin chỉ dùng để hướng đến sự chuyên nghiệp, tiện lợi hơn trong phục vụ Khách Hàng, 
                                            tạo sự kết nối thoải mái, hào hứng và tuyệt vời hơn bao giờ hết.
                                        </li>
                                    </ul>
                                </div>
                                    <input type="text" name="hoten" placeholder="Mời nhập họ và tên có dấu">
                                    <input type="text" name="phone" placeholder="Mời nhập số điện thoại đăng ký giao dịch">
                                    
                                    <input type="password" name="password" placeholder="Mời quý khách nhập mật khẩu lớn hơn hoặc bằng 8 ký tự">
                                    <input type="password" name="passwordAgain" placeholder="Mời quý khách nhập lại mật khẩu">
                                    
                                    <select class="loaigiayto" name="type_cmnd" aria-label="Default select example">
                                        <option value="0" selected>Chọn loại giấy tờ tùy thân</option>
                                        <option value="1">Chứng minh nhân dân</option>
                                        <option value="2">Căn cước công dân</option>
                                        <option value="3">Hộ chiếu</option>
                                    </select>

                                    <p class="m-0">Mời nhập ảnh CMND mặt trước</p>
                                    <input class="form-control" type="file" accept="image/*" onchange="loadFile(event)" name="image_cmnd">

                                    <label class="m-0">Mời nhập ảnh CMND mặt sau</label>
                                    <input class="form-control" type="file" accept="image/*" onchange="loadFile2(event)" name="image_cmnd2">


                                    <div class="row">
                                        <div class="col-md-12 pb-3">
                                            <input type="text" name="address" placeholder="Mời nhập địa chỉ">
                                        </div>
                                        <div class="col-md-6 pb-3">
                                            <input type="text" name="duong" placeholder="Mời nhập tên đường" style="margin: 0px; height: 37px; border-radius: 5px;">   
                                        </div>
                                        <div class="col-md-6 pb-3">
                                            <select name="sel_province" class="form-control select2"
                                                data-placeholder=" Cấp tỉnh " required>
                                                <option value=""> Cấp tỉnh </option>
                                                    @foreach ($province as $value)
                                                        <option value="{{ $value->matinhthanh }}">{{ $value->tentinhthanh }}
                                                        </option>
                                                    @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 pb-3">
                                            <select class="form-control select2" name="sel_district"
                                                data-placeholder=" Cấp huyện " required>
                                                <option value=""> Cấp huyện </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 pb-3">
                                            <select class="form-control select2" name="sel_ward"
                                                data-placeholder=" Cấp xã " required>
                                                <option value=""> Cấp xã </option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="submit" value="Đăng ký" name="Đăng ký">

                            </div>
                            </form>
                        </li>
<!-- End Register -->
                        <li>
                            <div class="content__wrapper">
                                <form method="POST" action="">
                                    @csrf
                                    <input type="text" name="phone" placeholder="Mời nhập số điện thoại để lấy mật khẩu">
                                    <input type="submit" value="Lấy mật khẩu (Giới hạn 3 lượt/ngày)" name="forgetPassword">
                                </form>
                            </div>
                        </li>
                    </ul>

                </section>
                
            </div>
            
        </div>
        <img src="https://s3.cloud.cmctelecom.vn/tinhte1/2018/06/4326778_banner-e-commerce.jpg" width="100%" alt="Chung tay đánh bay COVID">
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/account.js') }}"></script>
    <script type="text/JavaScript" 
src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js">
</script>
<script src="{{ asset('public/js/shipping.js') }}"></script>
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
        <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        var loadFile2 = function(event) {
            var output2 = document.getElementById('output2');
            output2.src = URL.createObjectURL(event.target.files[0]);
            output2.onload = function() {
                URL.revokeObjectURL(output2.src)
            }
        };
    </script>
@endpush
