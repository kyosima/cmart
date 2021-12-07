@extends('layout.master')

@section('title', 'Tài khoản')

@push('css')
    <link href="{{ asset('public/css/account.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')

    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col col-lg-6 col-md-6 col-xs-12 col-sm-12 ">
                <section class="loginWrapper">

                    <ul class="tabs">
                        <li class="active">Đăng nhập</li>
                        <li>Đăng ký</li>
                    </ul>

                    <ul class="tab__content">

                        <li class="active">
                            <div class="content__wrapper">
                                <form method="POST" action="{{ route('user.login') }}">
                                    @csrf
                                    @if (count($errors) > 0)
                                        <div class="alert alert-danger">
                                            @foreach ($errors->all() as $err)
                                                {{ $err }}<br>
                                            @endforeach
                                        </div>
                                    @endif

                                    @if (session('thongbao'))
                                        <div class="alert alert-success">
                                            {{ session('thongbao') }}
                                        </div>
                                    @endif
                                    <input type="text" name="phone" placeholder="Số điện thoại">
                                    <input type="password" name="password" placeholder="Mật khẩu">
                                    <input type="submit" value="Login" name="Đăng nhập">
                                </form>

                            </div>
                        </li>

                        <li>
                            <div class="content__wrapper">
                                <form method="POST" action="{{ route('user.register') }}">
                                    @csrf
                                    <input type="number" name="phone" placeholder="Số điện thoại">
                                    <input type="password" name="password" placeholder="Mật khẩu">
                                    <input type="password" name="passwordAgain" placeholder="Nhập lại mật khẩu">
                                    <input type="submit" value="Register" name="Đăng ký">
                                </form>
                            </div>
                        </li>

                    </ul>

                </section>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/account.js') }}"></script>

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
