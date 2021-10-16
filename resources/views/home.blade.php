@extends('layout.master')

@section('title', 'Trang chủ')

@push('css')
    <link href="{{ asset('public/css/home.css') }}" rel="stylesheet" type="text/css">
    
@endpush
    
@section('content')
<section class="home-pc">

    <div class="slider-pc">
        <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a class="img-pc" href="{{url('/khuyen-mai ')}}" title="Chung tay đánh bay COVID">
                        <img src="https://japana.vn/uploads/block/2021/09/09/1631167634-1600x400.jpg" alt="Chung tay đánh bay COVID">
                    </a>
                    <a class="img-mobile" href="{{url('/khuyen-mai ')}}" title="Chung tay đánh bay COVID">
                        <img alt="Chung tay đánh bay COVID" src="https://japana.vn/uploads/block/2021/09/09/1631167634-mb-ngoai.jpg">
                    </a>

                </div>
                <div class="carousel-item">

                    <a class="img-pc" href="{{url('/khuyen-mai ')}}" title="Chung tay đánh bay COVID">
                        <img src="https://japana.vn/uploads/block/2021/08/23/1629713073-sil-pc-th.jpeg" alt="Chicago">
                    </a>
                    <a class="img-mobile" href="{{url('/khuyen-mai ')}}" title="Chung tay đánh bay COVID">
                        <img alt="Thương Hiệu Tặng Quà 2 Triệu" src="https://japana.vn/uploads/block/2021/08/23/1629713073-sil-mb-th.jpeg">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{url('/khuyen-mai ')}}" class="img-pc">
                        <img src="https://japana.vn/uploads/block/2021/09/04/1630719824-1600x400-copy-2.jpg" alt="Chicago">
                    </a>
                    <a href="{{url('/khuyen-mai ')}}" class="img-mobile">
                        <img alt="Top Bán Chạy Mua 2 Tặng 1" src="https://japana.vn/uploads/block/2021/09/04/1630719825-750x600.jpg">

                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{url('/khuyen-mai')}}{{url('/khuyen-mai')}}" class="img-pc">
                        <img src="https://japana.vn/uploads/block/2021/08/27/1630027301-1600x400.jpeg" alt="Chicago">
                    </a>
                    <a href="{{url('/khuyen-mai')}}{{url('/khuyen-mai')}}" class="img-mobile">
                        <img alt="Vệ Sinh Nhà Cửa Chỉ Từ 29k" src="https://japana.vn/uploads/block/2021/08/27/1630027301-750x600.jpeg">
                    </a>


                </div>
                <div class="carousel-item">
                    <a href="#" class="img-pc">
                        <img src="https://japana.vn/uploads/block/2021/08/23/1629712796-1628577449-sidler-ngoai.jpeg" alt="Chicago">
                    </a>

                    <a href="#" class="img-mobile">
                        <img alt="Khỏe Đẹp Tại Nhà Sale 52%" src="https://japana.vn/uploads/block/2021/08/23/1629712796-1628657200-silder-ngoai-chinh.jpeg">

                    </a>

                </div>
                <div class="carousel-item">
                    <a href="#" class="img-pc">
                        <img src="https://japana.vn/uploads/block/2021/09/11/1631324911-pc-ngoai.jpg" alt="New York">
                    </a>
                    <a href="#" class="img-mobile">
                        <img alt="Mẹ và Bé Giảm 30%++" src="https://japana.vn/uploads/block/2021/09/11/1631324911-mb---ngoai.jpg">
                    </a>


                </div>
                <div class="carousel-item">
                    <a href="#" class="img-pc">

                        <img src="https://japana.vn/uploads/block/2021/08/25/1629854294-1600x400.jpeg" alt="Chicago">
                    </a>
                    <a href="#" class="img-mobile">

                        <img alt="Chăm Da Đẹp Dáng Giảm 50%" src="https://japana.vn/uploads/block/2021/08/25/1629854294-750x600.jpeg">
                    </a>

                </div>
            </div>
            <a class="carousel-control-prev" href="#demo" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#demo" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <ul class="carousel-indicators carousel-pc" style="" role="tablist">
                <li data-target="#demo" data-slide-to="0" class="active"><a class="pager-item" title="Chung tay đánh bay COVID"> Chung tay đánh bay COVID </a></li>
                <li class="" data-target="#demo" data-slide-to="1"><a class="pager-item" title="Thương Hiệu Tặng Quà 2 Triệu"> Thương Hiệu Tặng Quà 2 Triệu </a></li>
                <li class="" data-target="#demo" data-slide-to="2"><a class="pager-item" title="Top Bán Chạy Mua 2 Tặng 1"> Top Bán Chạy Mua 2 Tặng 1 </a></li>
                <li class="" data-target="#demo" data-slide-to="3" class=""><a class="pager-item" title="Vệ Sinh Nhà Cửa Chỉ Từ 29k"> Vệ Sinh Nhà Cửa Chỉ Từ 29k </a></li>
                <li class="" data-target="#demo" data-slide-to="4"><a class="pager-item" title="Khỏe Đẹp Tại Nhà Sale 52%"> Khỏe Đẹp Tại Nhà Sale 52% </a></li>
                <li class="" data-target="#demo" data-slide-to="5"><a class="pager-item" title="Mẹ và Bé Giảm 30%++"> Mẹ và Bé Giảm 30%++ </a></li>
                <li class="" data-target="#demo" data-slide-to="6"><a class="pager-item" title="Chăm Da Đẹp Dáng Giảm 50%"> Chăm Da Đẹp Dáng Giảm 50% </a></li>
            </ul>
        </div>
    </div>
    <div class="product">
        <div class="container">
            <div class="sp1 row">
                <div class=" col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12 ">
                    <a href="{{url('/khuyen-mai')}}" title="calbee">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483171-580x220-copy.jpg" alt="calbee">
                    </a>
                </div>
                <div class=" col-lg-6 col-md-12 col-sm-12 col-xs-12 col-12  ">
                    <a href="{{url('/khuyen-mai')}}" title="clodewash">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483172-580x220.jpg" alt="clodewash">
                    </a>

                </div>

            </div>
            <div class="sp2 row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                    <a href="{{url('/khuyen-mai')}}" title="covid">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483242-pc-copy.jpg" class="img" alt="covid">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                    <a href="{{url('/khuyen-mai')}}" title="covid">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483242-pc-copy.jpg" class="img" alt="covid">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                    <a href="{{url('/khuyen-mai')}}" title="covid">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483242-pc-copy.jpg" class="img" alt="covid">
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 col-6">
                    <a href="{{url('/khuyen-mai')}}" title="covid">
                        <img src="https://japana.vn/uploads/block/2021/09/01/1630483242-pc-copy.jpg" class="img" alt="covid">
                    </a>
                </div>
            </div>
            <div class="sp3 row">
                <div class="col-12">
                    <a href="{{url('/khuyen-mai')}}" title="ĐH">
                        <img src="https://japana.vn/uploads/block/2021/08/23/1629712512-dhpc.jpeg" class="img" alt="ĐH">
                    </a>
                </div>

            </div>
            <div class="sp3-mobile row">
                <div class="cpl-12">
                    <a href="{{url('/khuyen-mai')}}" title="ĐH"><img src="https://japana.vn/uploads/block/2021/08/23/1629712512-dhmb.jpeg" alt="ĐH">
                    </a>
                </div>
            </div>
            {{-- START HERE --}}
            <div class="product-block bg-white p-2">
                <div class="row">
                    <div class="col col-12">
                        <div class="section-title-container">
                            <p class="section-title section-title-normal">
                                <b></b>
                                <span class="section-title-main" style="color:rgb(54, 53, 51);">Danh mục sản phẩm</span>
                                <b></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-lg-3 d-none d-md-block">
                        <div class="banner row">
                            <div class="col col-12">
                                <a href="{{url('/khuyen-mai')}}" class="box-big-img" title="Chắm sóc sức khỏe">
                                    <img src="https://japana.vn/uploads/block/2021/08/23/1629681467-homepage-sk-pc.jpeg" alt="Chắm sóc sức khỏe">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-9">
                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="text-center mt-2">
                            <button class="btn btn-success">Xem thêm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-block bg-white p-2">
                <div class="row">
                    <div class="col col-12">
                        <div class="section-title-container">
                            <p class="section-title section-title-normal">
                                <b></b>
                                <span class="section-title-main" style="color:rgb(54, 53, 51);">Danh mục sản phẩm</span>
                                <b></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-lg-3 d-none d-md-block">
                        <div class="banner row">
                            <div class="col col-12">
                                <a href="{{url('/khuyen-mai')}}" class="box-big-img" title="Chắm sóc sức khỏe">
                                    <img src="https://japana.vn/uploads/block/2021/08/23/1629681467-homepage-sk-pc.jpeg" alt="Chắm sóc sức khỏe">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-9">
                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="text-center mt-2">
                            <button class="btn btn-success">Xem thêm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-block bg-white p-2">
                <div class="row">
                    <div class="col col-12">
                        <div class="section-title-container">
                            <p class="section-title section-title-normal">
                                <b></b>
                                <span class="section-title-main" style="color:rgb(54, 53, 51);">Danh mục sản phẩm</span>
                                <b></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-lg-3 d-none d-md-block">
                        <div class="banner row">
                            <div class="col col-12">
                                <a href="{{url('/khuyen-mai')}}" class="box-big-img" title="Chắm sóc sức khỏe">
                                    <img src="https://japana.vn/uploads/block/2021/08/23/1629681467-homepage-sk-pc.jpeg" alt="Chắm sóc sức khỏe">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-9">
                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="text-center mt-2">
                            <button class="btn btn-success">Xem thêm</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-block bg-white p-2">
                <div class="row">
                    <div class="col col-12">
                        <div class="section-title-container">
                            <p class="section-title section-title-normal">
                                <b></b>
                                <span class="section-title-main" style="color:rgb(54, 53, 51);">Danh mục sản phẩm</span>
                                <b></b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col col-12 col-lg-3 d-none d-md-block">
                        <div class="banner row">
                            <div class="col col-12">
                                <a href="{{url('/khuyen-mai')}}" class="box-big-img" title="Chắm sóc sức khỏe">
                                    <img src="https://japana.vn/uploads/block/2021/08/23/1629681467-homepage-sk-pc.jpeg" alt="Chắm sóc sức khỏe">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12 col-lg-9">
                        <div class="row">
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-6 col-lg-3">
                                <div class="sp">
                                    <div class="box3item">
                                        <div class="box-img">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                            </a>
                                            <div class="block-sale">
                                                <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                                <span class="sale">-40%</span>
                                            </div>
                                        </div>
                                        <div class="detail">
                                            <h3 class="title">
                                                <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                    Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                            </h3>
                                            <ul class="box-price">
                                                <li class="price">
                                                    <span>1.260.000đ</span>
                                                </li>
    
                                                <li class="old-price">
                                                    <span>2.099.000 đ</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-12">
                        <div class="text-center mt-2">
                            <button class="btn btn-success">Xem thêm</button>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="product-block">
                <div class="banner row">
                    <div class="col-12">
                        <a href="{{url('/khuyen-mai')}}" class="box-big-img" title="Chắm sóc sức khỏe">
                            <img src="https://japana.vn/uploads/block/2021/08/23/1629681467-homepage-sk-pc.jpeg" alt="Chắm sóc sức khỏe">
                        </a>
                    </div>
                </div>
                <!--san pham on-pc -->
                <div class="product-pc">
                    <div class="silder-product-1">
                        <div class="items">
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="sp">
                                <div class="box3item">
                                    <div class="box-img">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                        </a>
                                        <div class="block-sale">
                                            <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                            <span class="sale">-40%</span>
                                        </div>
                                    </div>
                                    <div class="detail">
                                        <h3 class="title">
                                            <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                                Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                        </h3>
                                        <ul class="box-price">
                                            <li class="price">
                                                <span>1.260.000đ</span>
                                            </li>

                                            <li class="old-price">
                                                <span>2.099.000 đ</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--on-mobile -->
                <div class="product-mobile">
                    <div class="sp-mb row ">
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="sp col-6">
                            <div class="box3item">
                                <div class="box-img">
                                    <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                        <img src="https://japana.vn/uploads/product/2020/04/02/268x268-1585836448-coidan-30-vien-sieu-thi-nhat-ban-japana-0-(2).jpeg" alt="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên">
                                    </a>
                                    <div class="block-sale">
                                        <img alt="hình" src="https://japana.vn/uploads/promotion/2021/03/11/1615432601-icon-giam-gia-2-02.png">
                                        <span class="sale">-40%</span>
                                    </div>
                                </div>
                                <div class="detail">
                                    <h3 class="title">
                                        <a href="{{url('/product')}}" title="Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan 30 viên" tabindex="0">
                                            Viên uống hỗ trợ điều trị ung thư Fine Japan Fucoidan... </a>
                                    </h3>
                                    <ul class="box-price">
                                        <li class="price">
                                            <span>1.260.000đ</span>
                                        </li>

                                        <li class="old-price">
                                            <span>2.099.000 đ</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="brand">
                <div class="brand-header">

                    <h2 class="title-client d-flex justify-content-between">Thương hiệu
                        <a href="#" title="thương hiệu">Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </a>
                    </h2>

                </div>
                <div class="brand-body">
                    <div class="items-brand">
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>
                        <div class="brand-item">
                            <a rel="nofollow" href="#" title="Nichiei Bussan" tabindex="-1" class="d-flex justify-content-center align-items-center">
                                <img class="img" src="https://japana.vn/uploads/brand/1604394846-colo.jpg" alt="Colo Colo">
                            </a>
                        </div>

                    </div>

                </div>
            </div>

            <div class="blogs">
                <div class="blog-header">
                    <h2 class="title-client d-flex justify-content-between">Thông tin tiêu dùng
                        <a href="#" title="thương hiệu">Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </a>
                    </h2>
                </div>
                <div class="blog-body">
                    <!-- on-pc -->
                    <div class="items-blog">
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                        <div class="blog-item d-flex flex-column">
                            <div class="box-img">
                                <a href="#" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                    <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                </a>
                            </div>
                            <div class="detail">
                                <div class="time-tag">
                                    <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                </div>
                                <h3 class="title">
                                    <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                </h3>
                                <div class="count-news">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- on-mobile-scroll -->
                    <div class="blog-mobile">


                        <div class="blogs-scroll">
                            <div class="blog-item-scroll">
                                <div class="box-img">
                                    <a href="https://japana.vn/infographic-6-thuoc-bo-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-news-1505.jp" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                        <img src="https://japana.vn/uploads/news/670x445-1617091838-o-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-0.jpg" alt="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="time-tag">
                                        <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                    </h3>
                                    <div class="count-news">
                                        <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                    </div>
                                </div>

                            </div>
                            <div class="blog-item-scroll">
                                <div class="box-img">
                                    <a href="https://japana.vn/infographic-6-thuoc-bo-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-news-1505.jp" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                        <img src="https://japana.vn/uploads/news/270x160-1617092613-top-3-loai-tao-nhat-ban-tot-nhat-hien-nay-2.jpg" alt="Top 3 loại tảo Nhật Bản tốt nhất hiện nay">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="time-tag">
                                        <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                    </h3>
                                    <div class="count-news">
                                        <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                    </div>
                                </div>

                            </div>
                            <div class="blog-item-scroll">
                                <div class="box-img">
                                    <a href="https://japana.vn/infographic-6-thuoc-bo-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-news-1505.jp" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                        <img src="https://japana.vn/uploads/news/270x160-1617092613-top-3-loai-tao-nhat-ban-tot-nhat-hien-nay-2.jpg" alt="Top 3 loại tảo Nhật Bản tốt nhất hiện nay">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="time-tag">
                                        <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                    </h3>
                                    <div class="count-news">
                                        <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                    </div>
                                </div>

                            </div>
                            <div class="blog-item-scroll">
                                <div class="box-img">
                                    <a href="https://japana.vn/infographic-6-thuoc-bo-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-news-1505.jp" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                        <img src="https://japana.vn/uploads/news/270x160-1617092613-top-3-loai-tao-nhat-ban-tot-nhat-hien-nay-2.jpg" alt="Top 3 loại tảo Nhật Bản tốt nhất hiện nay">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="time-tag">
                                        <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                    </h3>
                                    <div class="count-news">
                                        <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                    </div>
                                </div>

                            </div>
                            <div class="blog-item-scroll">
                                <div class="box-img">
                                    <a href="https://japana.vn/infographic-6-thuoc-bo-xuong-khop-cua-nhat-ban-chay-nhat-hien-nay-news-1505.jp" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" class="anima-hvr" tabindex="0">
                                        <img src="https://japana.vn/uploads/news/270x160-1617092613-top-3-loai-tao-nhat-ban-tot-nhat-hien-nay-2.jpg" alt="Top 3 loại tảo Nhật Bản tốt nhất hiện nay">
                                    </a>
                                </div>
                                <div class="detail">
                                    <div class="time-tag">
                                        <span><i class="fa fa-calendar-o" aria-hidden="true"></i> 02-02-2021 | 05:11</span>
                                    </div>
                                    <h3 class="title">
                                        <a href="" title="[Infographic] 6 thuốc bổ xương khớp của Nhật bán chạy nhất hiện nay" tabindex="0">[Infographic] 6 thuốc bổ xương khớp của Nhật bán...</a>
                                    </h3>
                                    <div class="count-news">
                                        <span><i class="fa fa-eye" aria-hidden="true"></i> 1113</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>
    </div>

</section>

@endsection
    
@push('scripts')
  
<script type='text/javascript'>
    $(document).ready(function() {

        $('.items').slick({
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 5
        });
        $('.items-brand').slick({
            infinite: true,
            slidesToShow: 6,
            slidesToScroll: 1,


            responsive: [{
                breakpoint: 1024,
                settings: {
                    speed: 1000,
                    autoplay: true,
                    autoplaySpeed: 2000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true,
                    dots: true
                }
            }]
        });
        $('.items-blog').slick({
            infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,



        });
    });
    </script>
@endpush

