@extends('layout.master')

@section('title', 'Liên hệ')

@push('css')
    <link href="{{ asset('public/images/check1.png') }}" />
    <link href="{{ asset('css/order_tracking/style.css') }}" rel="stylesheet" type='text/css' />
@endpush

@section('content')
    <div class="site-inner">
        <div class="content-sidebar-wrap">
            <main class="contact content">
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.23029251409!2d106.62277041418271!3d10.79366606182825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752bff61bf4cb9%3A0x437ac5fb84a0c8cf!2zU2nDqnUgVGjhu4sgTmjhuq10IELhuqNuIE9ubGluZSAtIEphcGFuYS52bg!5e0!3m2!1svi!2s!4v1519717652110"
                        width="100%" height="640" style="border:0" allowfullscreen=""></iframe>
                    <div class="container">
                        <form method="POST" name="frmContact" id="frmContact">
                            <div class="box-contact form-group">
                                <h3 class="title">LIÊN HỆ VỚI CHÚNG TÔI</h3>
                                <p class="sapo">Để lại lời nhắn và chúng tôi sẽ giúp đỡ bạn nhanh nhất có thể</p>
                                <input placeholder="Tên" class="ipt-contact form-control ">
                                <input placeholder="Email" class="ipt-contact form-control">
                                <input placeholder="Số điện thoại" class="ipt-contact form-control">
                                <textarea placeholder="Bạn đang lo lắng điều gì?"
                                    class="ipt-contact form-control"></textarea>
                                <p class="sapo"></p>
                                <button type="button" class="btn-contact">Gửi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection