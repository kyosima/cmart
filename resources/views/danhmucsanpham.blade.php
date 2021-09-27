@extends('layout.master')

@section('title', 'Danh mục sản phẩm')

@push('css')
<link rel="stylesheet" href="{{ asset('css/danhmucsanpham.css') }}">
@endpush


@section('content')
    <!-- breadcrumbs -->
<section id="breadcrumbs">
    <div class="page-title shop-page-title">
        <div class="page-title-inner container">
            <nav class="breadcrumbs">
                <a href="#">Trang chủ</a>
                <span class="divider">/</span>
                <a href="#" class="active">Chăm Sóc Sức Khỏe</a>
            </nav>
        </div>
    </div>
</section>

<!-- slider -->
<section class="slider">
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('image/banner/banner2.jpeg') }}" class="d-block w-100 banner1" alt="">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('image/banner/banner1.jpeg') }}" class="d-block w-100 banner2" alt="">
            </div>
        </div>
        <!-- <ul class="text-carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
            </ul> -->
    </div>
</section>

<!-- main -->
<section>
    <!-- Trang sản phẩm -->
    <div class="category-page container">
        <div class="row">
            <!-- bên trái -->
            <div id="shopsidebar" class="shop-sidebar col-lg-3 col-md-12 col-sm-12">
                <!-- danh mục -->
                <aside class="widget danhmuc">
                    <h3 class="widget-title">Danh mục</h3>
                    <div class="widget-search">
                        <input type="text" class="form-control input_search" placeholder="Tìm kiếm...">
                        <button type="button">
                            <i class="search-icon"></i>
                        </button>
                    </div>
                    <div class="scrollbar">
                        <div class="widget-product-categories">
                            <label class="check-custom">
                                Chăm Sóc Hệ Tiêu Hóa
                                <span class="count-item"> (30)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Chăm Sóc Mắt
                                <span class="count-item"> (22)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Hỗ Trợ Não & Trí Nhớ
                                <span class="count-item"> (17)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Hỗ Trợ Xương Khớp
                                <span class="count-item"> (30)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Hỗ Trợ Điều Trị Tai Biến
                                <span class="count-item"> (10)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Hỗ Trợ Điều Trị Ung Thư
                                <span class="count-item"> (21)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Nấm Linh Chi
                                <span class="count-item"> (3)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Sức Khỏe & Sinh Lý Nam
                                <span class="count-item"> (29)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Sức Khỏe & Sinh Lý Nữ
                                <span class="count-item"> (18)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Tảo Xoắn
                                <span class="count-item"> (11)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Thải Độc Gan
                                <span class="count-item"> (34)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Vitamin Tổng Hợp
                                <span class="count-item"> (42)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Điều Trị Khác
                                <span class="count-item"> (36)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                </aside>

                <!-- lọc giá -->
                <aside class="widget">
                    <div class="title-box d-lg-none">
                        <span>Bộ lọc</span>
                        <button class="close-filter" onclick="closeSidebar()"></button>
                    </div>

                    <div class="slider-price">
                        <h3 class="widget-title">Giá</h3>
                        <div class="widget-filter-price">
                            <div class="price-range-slider">
                                <div id="slider-range" class="range-bar"></div>
                            </div>
                        </div>
                        <div class="widget-price">
                            <div class="form-group trai">
                                <p class="title-range">Min</p>
                                <div class="box-input">
                                    <input type="text" class="form-control" id="amount1" disabled="">
                                    <span>đ</span>
                                </div>
                            </div>
                            <div class="form-group phai">
                                <p class="title-range">Max</p>
                                <div class="box-input">
                                    <input type="text" class="form-control" id="amount2" disabled="">
                                    <span>đ</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn-price" type="button">Áp dụng</button>
                    </div>
                </aside>

                <!-- thương hiệu -->
                <aside class="widget thuonghieu">
                    <h3 class="widget-title">Thương hiệu</h3>
                    <div class="widget-search">
                        <input type="text" class="form-control input_search" placeholder="Tìm kiếm...">
                        <button type="button">
                            <i class="search-icon"></i>
                        </button>
                    </div>
                    <div class="scrollbar">
                        <div class="widget-product-categories">
                            <label class="check-custom">
                                Ably
                                <span class="count-item"> (3)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                AFC
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                AFC Efushi Group
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Aojiru
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                API
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Asahi
                                <span class="count-item"> (3)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Ashirira
                                <span class="count-item"> (2)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                B3
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Beauty Mirai
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Beauty Rose Crystal
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Bella Fora
                                <span class="count-item"> (1)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Cosmic Pharmaceutical Inc
                                <span class="count-item"> (2)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <label class="check-custom">
                                Daiichi Sankyo
                                <span class="count-item"> (36)</span>
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>
                    <div class="footer-filter d-lg-none">
                        <button type="button" class="clear_filter">Xóa lọc</button>
                        <button type="button" class="submit_click">Áp dụng</button>
                    </div>
                </aside>
            </div>

            <!-- bên phải -->
            <div class="shop-container col-lg-9 col-md-12 col-sm-12">
                <div class="shop-container-inner">
                    <!-- TITLE -->
                    <h2 class="title-filter d-none d-lg-block">Collagen <span>(67 sản phẩm)</span></h2>
                    <!-- Bộ lọc -->
                    <div class="filter-cate">
                        <ul>
                            <li class="d-lg-inline d-none">Sắp xếp theo:</li>
                            <li>
                                <a href="#" class="active">Mặc định</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="">Giá cao</a>
                                </li>
                                <li>
                                    <a href="
                                    #"
                                    class="">Giá thấp</a>
                                </li>
                                <li>
                                    <a href="
                                    #"
                                    class="">A-z</a>
                                </li>
                                <li>
                                    <a href="
                                    #"
                                    class="">Sale</a>
                                </li>
                                <li class="
                                    d-lg-none">
                                    <a href="javascript:void(0)" class="filter-btn" onclick="openSidebar()">Lọc</a>
                            </li>
                        </ul>
                    </div>

                    <!-- SẢN PHẨM -->
                    <div class="products">
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/1.jpg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/2.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/3.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                    <div class="block-sale2">
                                        <img alt="" src="{{ asset('image/bg-sale2.png') }}">
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/6.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                    <div class="block-sale2">
                                        <img alt="" src="{{ asset('image/bg-sale2.png') }}">
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Bộ đôi nâng hạng nhan sắc Collagen Venus Charge
                                                và tăng cường sinh lý nam Josephine Oyster Extract</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/4.jpg') }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/5.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/7.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                    <div class="block-sale2">
                                        <img alt="" src="{{ asset('image/bg-sale2.png') }}">
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="product-box row">
                                <div class="box-image col-lg-12 col-md-4 col-4">
                                    <div class="image-cover">
                                        <a href="#">
                                            <img src="{{ asset('image/product/8.jpg') }}" alt="">
                                        </a>
                                    </div>
                                    <div class="block-sale">
                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                        <span class="sale">-13%</span>
                                    </div>
                                    <div class="block-sale2">
                                        <img alt="" src="{{ asset('image/bg-sale2.png') }}">
                                    </div>
                                </div>
                                <div class="box-text col-lg-12 col-md-8 col-8">
                                    <div class="title-wrapper">
                                        <a href="#">
                                            <p class="product-title">Nước uống Collagen Venus Charge 20,000mg (Hộp 10
                                                chai x 50ml)</p>
                                        </a>
                                    </div>
                                    <div class="price-wrapper">
                                        <span class="price">
                                            <span class="amount">490.000 đ</span>
                                        </span>
                                        <span class="price-old">
                                            <span class="amount">500.000 đ</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="nav-pager">
                        <ul id="pagination">
                            <li><a class="page-arrow" href="#"><i class="fa fa-angle-double-left"></i></a></li>
                            <li><a class="page-arrow" href="#"><i class="fa fa-angle-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li><a href="#" class="active">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a class="d-none d-lg-inline-block    " href="#">4</a></li>
                            <li><a class="page-arrow" href="#"><i class="fa fa-angle-right"></i></a></li>
                            <li><a class="page-arrow" href="#"><i class="fa fa-angle-double-right"></i></a></li>
                        </ul>
                        <div class="select-option d-none d-lg-block">
                            <select class="custom-select">
                                <option value="20" selected="">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <i class="fa fa-caret-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mô tả -->
    <div class="container d-none d-lg-block">
        <div class="box-detail-cate">
            <h2><strong>Đôi nét về Collagen : </strong></h2>

            <p><strong><a href="#">Collagen Nhật Bản</a></strong> thường được nhắc tới như là thần dược trong việc làm
                đẹp và ngày càng được ưa chuộng rộng rãi. Các dạng collagen điển hình có thể kể đến
                như<strong>:&nbsp;</strong>dạng nước, dạng viên, thạch ăn... Thực chất, đây là một
                loại&nbsp;protein&nbsp;thường ở dạng sợi dài và được tìm thấy trong các mô xơ của dây chằn, gân, da và
                trong giác mạc, sun, xương, mạch máu, ruột, đĩa đệm ở động vật. Đặc biệt&nbsp;<strong>Collagen
                </strong><strong>của Nhật </strong>cũng&nbsp;là thành phần chính của mô thịt, mô liên kết và là
                loại&nbsp;protein&nbsp;có nhiều nhất trong các loài động vật có vú, nó&nbsp;chiếm khoảng 25% đến 35%
                lượng&nbsp;Protein&nbsp;cơ thể....</p>

            <h3><strong>Công dụng&nbsp;của Collagen </strong><strong>Nhật</strong><strong>:</strong></h3>

            <p>Collagen&nbsp;đóng vai trò gắn kết các mô trong cơ thể lại với nhau, vì thế nó &nbsp;được&nbsp;coi như
                một chất keo dính, nếu thiếu nó&nbsp;thì cơ thể chỉ là các phần rời rạc.&nbsp;Đây cũng chính là lý do vì
                sao, các nhà khoa học cho rằng Collagen là một thành tố không thể thiếu đối với con người. Một số tác
                dụng cơ bản của collagen với cơ thể người được nhắc đến như:</p>

            <p><strong>Với làn da:</strong>&nbsp;Collagen có tác dụng hỗ trợ sản sinh ra các tế bào da mới, giúp làn da
                hồi sinh nhanh chóng. Chính vì thế, chúng có khả năng giúp vết thương nhanh lành sẹo, đồng thời các vết
                thâm cũng mờ dần.</p>

            <p><strong>Với mạch máu: </strong>Collagen có vai trò rất quan trọng đối với những người bị xơ cứng động
                mạch não cũng như mắc phải chứng nhồi máu cơ tim và chứng cao huyết áp. Bởi chúng là hợp chất sản sinh
                ra máu nên có thể đề phòng được những chứng bệnh này.</p>

            <p><strong>Với mắt:&nbsp; </strong>Do collagen cũng là dạng kết tinh tồn tại nhiều trong giác mạc và thủy
                tinh thể. Tuổi tăng cao, sẽ làm lượng Collagen sụt giảm, từ đó khiến giác mạc hoạt động kém, làm ảnh
                hưởng đến thị lực và làm cho thủy tinh thể mờ đi do chất Amino bị lão hóa. Vì thế nó cũng góp phần quan
                trọng với mắt.</p>

            <p><strong>Với xương:&nbsp; </strong>Bên cạnh canxi, <strong>Collagen</strong><strong> của Nhật</strong>
                cũng là thành phần quan trọng trong cấu tạo của xương. Nó đóng vai trò là các sợi liên kết khung xương
                với nhau. Xương sẽ bị giảm tính đàn hồi và dẻo dai khi collagen suy yếu. Do đó, bổ sung collagen được
                xem như giải pháp giúp xương chắc khỏe, phòng bệnh loãng xương.</p>

            <p><strong>Với sụn:&nbsp;</strong>Collagen chiếm 50% trong cơ cấu thành phần sụn, việc thiếu collagen sẽ
                khiến độ ma sát giữa các khớp xương lớn hơn, gây ra tình trạng xương bị biến dạng. Do đó, ngoài việc
                ngăn ngừa và giảm thiểu các bệnh liên quan đến xương, collagen còn giúp phòng chống các bệnh như đau
                thắt lưng, thoát vị đĩa đệm.</p>

            <p><strong>Với tóc, móng chân – tay:&nbsp;</strong>Tác dụng của Collagen là cung cấp chất dinh dưỡng hỗ trợ
                hoạt động của chất sừng. Do đó, việc bổ sung uống Collagen giúp cho tóc và móng chân, móng tay chắc
                khỏe, cũng như giúp tóc bóng mượt, bớt rụng.</p>

            <p><strong>Với hệ miễn dịch và não bộ:&nbsp;</strong>Collagen có khả năng hỗ trợ hoạt động của các vi khuẩn
                có lợi trong hệ miễn dịch. Ngoài ra, Collagen còn có tác dụng tăng cường hoạt động của não.</p>

            <h2><strong>Mua Collagen&nbsp;của Nhật Bản tại Japana:</strong></h2>

            <p>Đến với Japana bạn có thể yên tâm vì chất lượng sản phẩm Collagen Nhật Bản, chúng tôi cam kết phân phối
                sản phẩm chính hãng từ Nhật Bản. Ngoài ra, bạn sẽ có cơ hội tiếp cận được với những chương trình khuyến
                mãi như có thể mua được những sản phẩm với mức giá ưu đãi bất ngờ tại đây. Hãy cùng trải nghiệm Siêu thị
                Nhật Bản mua sắm trực tuyến Japana.vn bạn nhé, bạn sẽ có được thật nhiều niềm vui!</p>

            <h4><a href="#" target="_blank"><img alt="" src="{{ asset('image/detail/1.jpeg') }}"
                        style="width: 476px; height: 249px; float: left;"></a></h4>

            <h3><strong>Collagen dạng nước Nhật Bản</strong></h3>

            <p><strong>Công dụng: </strong>Giúp da căng mịn, săn chắc, tươi trẻ, ngăn ngừa và cải thiện lão hoá. Giúp
                xương khớp chắc khỏe. Hỗ trợ cho răng, tóc, móng luôn ở trạng thái chắc khỏe, bóng đẹp.</p>

            <p><strong>Ưu điểm: </strong>Collagen dạng nước Nhật Bản dễ dàng sử dụng, cơ thể dễ dàng hấp thu</p>

            <p><strong>Thương hiệu: </strong>Nitta Gelatin Inc, Fuji Health, Astalift Japan,...</p>

            <h3>&nbsp;</h3>

            <p>&nbsp;</p>

            <p>&nbsp;</p>

            <h4><a href="#" target="_blank"><img alt="" src="{{ asset('image/detail/2.jpeg') }}"
                        style="width: 476px; height: 249px; float: left;"></a></h4>

            <h3><strong>Collagen dạng viên uống Nhật Bản</strong></h3>

            <p><strong>Công dụng: </strong>Trợ giúp gân, xương, khớp khỏe mạnh, linh hoạt, ngăn chặn sự thoái hóa sụn
                khớp và tái tạo lại sụn khớp, giúp các khớp tăng tính bôi trơn. Giúp tăng cường sự dẻo dai của mạch máu
                phòng xơ cứng động mạch và bệnh cao huyết áp.</p>

            <p><strong>Ưu điểm:</strong> Sản phẩm dạng viên rất dễ sử dụng và dễ bảo quản.</p>

            <p><strong>Thương hiệu:</strong> Fine Co., Shiseido, Astalift Japan,...</p>

            <p>&nbsp;</p>

            <p>&nbsp;</p>

            <h4><a href="#" target="_blank"><img alt="" src="{{ asset('image/detail/3.jpeg') }}"
                        style="width: 476px; height: 249px; float: left;"></a></h4>

            <h3><strong>Collagen dạng bột - thạch ăn Nhật Bản</strong></h3>

            <p><strong>Công dụng: </strong>Duy trì độ ẩm cho da, bổ sung Collagen Nhật cho da và cơ thể. Giúp làn da
                luôn săn chắc và dẻo dai hơn, giảm thiểu các nếp trên bề mặt da, chống chảy xệ, giúp da tươi mới và căng
                mịn. Ngăn ngừa và chống lại quá trình lão hoá da.</p>

            <p><strong>Ưu điểm:</strong> Dạng bột pha ít calo dễ uống, có thể pha với nước hoặc thức uống ưa thích, sữa
                chua</p>

            <p><strong>Thương hiệu: </strong>Shiseido, Kinohimitsu, Itoh, Meiji, Otsuka, AFC Efushi, Nitta Gelatin
                Inc...</p>
        </div>
    </div>
</section>
@endsection


@push('scripts')
    <script type='text/javascript'>
        function openSidebar() {
            document.getElementById("shopsidebar").style.zIndex = "1000";
            document.body.style.overflow = "hidden";
        }

        function closeSidebar() {
            document.getElementById("shopsidebar").style.zIndex = "0";
            document.body.style.overflow = "auto";
        }
    </script>
<script src="{{ asset('js/danhmucsanpham.js') }}"></script>
@endpush