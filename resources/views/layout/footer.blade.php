<footer class="site-footer">
    <div class="container">

        <div class="top-footer  ">
            <div class="info-company col-lg-12  col-md-12 col-sm-12 col-xs-12 col-12 ">
                <p class="title-info titlecmart text-center ">CÔNG TY TNHH THƯƠNG MẠI DỊCH VỤ C-MART</p>
                {{-- <a href="https://goo.gl/maps/5P7Kwf6A4KK9rstD9"> --}}
                    <p class="des  text-dark" style="font-size: 16px"><span class=" text-dark"><i
                                class="fas fa-map-marker-alt"></i> Địa chỉ công ty: </span>Số 730/32/6 đường Lạc Long Quân, Phường 9, Quận Tân Bình, Thành phố Hồ Chí Minh</p>
                {{-- </a> --}}
                <p class="des text-dark" style="font-size: 16px"><span class=" text-dark"><i
                            class="fas fa-id-card"></i>
                        Mã số doanh nghiệp: </span> 0316959402 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp ngày
                    20/09/2021</p>

            </div>
            <div class="info-company col-lg-12  col-md-12 col-sm-12 col-xs-12 col-12 ">
                <div class="row">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p>© 2021 - Bản quyền thuộc về Công ty TNHH TM-DV C-Mart</p>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <p>© 2021 C-Mart. Tất cá quyền được bảo lưu</p>
                    </div>
                </div>
            </div>
            {{-- <div class="info-company col-lg-12  col-md-12 col-sm-12 col-xs-12 col-12 ">
                <div class="row">
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-xs-12 text-center mb-3">
                        <p class="title-info">Kênh CSKH Trực tuyến C-A-Z</p>
                        <a href="https://zalo.me/3597490523695148504"><img src="{{ asset('/public/image/zalo.png') }}" alt="" width="50px"></a>

                    </div>
                </div>
            </div> --}}
            {{-- <div class="ketnoi col-12">
                <div class="box-hotline-f col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">

                    <div class="social-pc row">

                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12 ">
                            <!--<p class="title-info">TẢI ỨNG DỤNG TRÊN ĐIỆN THOẠI</p>-->
                            <!--<div class="app d-flex">-->
                            <!--    <div class="d7e-f7453d d7e-57f266 d7e-a20916"><a aria-label="app store" href="#"><img data-src="https://media3.scdn.vn/img4/2020/12_16/5lUTWdk3DXr8nlC9MDII.png" src="https://media3.scdn.vn/img4/2020/12_16/5lUTWdk3DXr8nlC9MDII.png" alt="app-store" class="a25-374f6b lazyloaded"></a></div>-->
                            <!--    <div class="d7e-f7453d d7e-57f266 d7e-a20916"><a aria-label="google play" href="#"><img data-src="https://media3.scdn.vn/img4/2020/12_16/cNCdLw5GOKAorF6nosY1.png" src="https://media3.scdn.vn/img4/2020/12_16/cNCdLw5GOKAorF6nosY1.png" alt="google-play" class="a25-374f6b lazyloaded"></a></div>-->
                            <!--</div>-->
                        </div>
                        <!-- <div class=" col-lg-4 col-md-12 col-sm-12 col-xs-12 col-12  ">
                            <p class="title-info text-center">KẾT NỐI VỚI CHÚNG TÔI</p>
                            <div class="d-flex justify-content-center ">
                                <a rel="noreferrer" href="#" class="icon" target="_blank" title="Zalo"><i class="icon tikicon icon-footer-zalo mr-4"></i></a>
                                <a rel="noreferrer" href="#" class="icon" target="_blank" title="Facebook"><img src="https://frontend.tikicdn.com/_desktop-next/static/img/footer/fb.svg" width="32" alt=""></a>
                            </div>
                        </div> -->
                        <div class="col-lg-4  col-md-12 col-sm-12 col-xs-12 col-12">
                            <p class="title-info">Kênh CSKH Trực tuyến C-A-Z</p>
                        </div>
                    </div>


                </div>
            </div> --}}
        </div>
    </div>

    <div class="socials-footer">
        <div class="col-box">
            <ul class="d-flex justify-content-center">
                <li><a rel="nofollow" href="#" title="title"><i class="icon-m icon-s1"></i></a></li>
                <li><a rel="nofollow" href="#" title="title"><i class="icon-m icon-s2"></i></a></li>
                <li><a rel="nofollow" href="#" title="title"><i class="icon-m icon-s3"></i></a></li>
                <li><a rel="nofollow" href="#" title="title"><i class="icon-m icon-s4"></i></a></li>
            </ul>
        </div>
    </div>

    <!--<div class="bottom-footer mt-4">-->
    <!--    <div class="container d-flex justify-content-center ">-->
    <!--        <p>© 2021-Mevivu</p>-->
    <!--    </div>-->
    <!--</div>-->

    <a id="button"></a>
    <script>
        var btn = $('#button');

        $(window).scroll(function() {
            if ($(window).scrollTop() > 300) {
                btn.addClass('show');
            } else {
                btn.removeClass('show');
            }
        });

        btn.on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: 0
            }, '300');
        });
    </script>
</footer>


</body>

</html>
