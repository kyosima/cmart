@extends('layout.master')

@section('title', 'Chi tiết sản phẩm')

@push('css')
<link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/fotorama.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/lastview_product.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/rating.css') }}">
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    div.loading {
        z-index: 99;
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(16, 16, 16, 0.5);
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-ms-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-webkit-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes uil-ring-anim {
        0% {
            -ms-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -webkit-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -ms-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -webkit-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .uil-ring-css {
        margin: auto;
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        width: 200px;
        height: 200px;
    }

    .uil-ring-css>div {
        position: absolute;
        display: block;
        width: 160px;
        height: 160px;
        top: 20px;
        left: 20px;
        border-radius: 80px;
        box-shadow: 0 6px 0 0 #ffffff;
        -ms-animation: uil-ring-anim 1s linear infinite;
        -moz-animation: uil-ring-anim 1s linear infinite;
        -webkit-animation: uil-ring-anim 1s linear infinite;
        -o-animation: uil-ring-anim 1s linear infinite;
        animation: uil-ring-anim 1s linear infinite;
    }

    /* breadcrumbs */
    section#breadcrumbs {
        padding-bottom: 10px;
    }

    .page-title.shop-page-title {
        background-color: #fff;
        padding: 10px 0;
        box-shadow: -1px 1px 4px 0px rgb(137 152 172 / 30%);
    }

    .page-title.shop-page-title .breadcrumbs a {
        color: #999;
    }

    .page-title.shop-page-title .breadcrumbs a.active,
    .page-title.shop-page-title .breadcrumbs a:hover,
    .page-title.shop-page-title .breadcrumbs span {
        color: #007aff;
    }

    /* mô tả chiết khấu C, M */
    .manufacture span.text-dark {
        position: relative;
    }
    .tt {
        display: inline-block;
    }
    .tt .ttt {
        visibility: hidden;
        top: -10px;
        width: 400px;
        background-color: #0000008c;
        color: #fff !important;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;
        position: absolute;
        z-index: 1;
    }
    .tt:hover .ttt {
        visibility: visible;
    }
    /* sản phẩm liên quan */
    .row-des .category .product_img{
        max-width: 130px;
        margin: 0 auto;
    }
    @media only screen and (max-width: 576px) {
        .tt .ttt {
            width: calc(100vw - 30px);
            left: 0;
        }
    }
</style>
@endpush

@section('content')
<div class="loading">
    <div class='uil-ring-css' style='transform:scale(0.79);'>
        <div></div>
    </div>
</div>
<main>
    <!-- breadcrumbs -->
    <section id="breadcrumbs">
        <div class="page-title shop-page-title">
            <div class="page-title-inner container">
                <nav class="breadcrumbs">
                    <a href="{{url('/')}}">Trang chủ</a>
                    <span class="divider">/</span>
                    @foreach ($categoryIds as $category_id)
                    <?php $category = App\Models\ProductCategory::find($category_id); ?>
                    <a href="{{ route('proCat.index', $category->slug) }}">{{ $category->name }} </a>
                    <span class="divider">/</span>
                    @endforeach
                    <span class="active">{{ $product->name }}</span>
                </nav>
            </div>
        </div>
    </section>
    </div>
    <!-- search-mobile-fixed -->
    <div class="search">
        <div class="search_d">
            <img src="{{ asset('public/image/icon/arrow-prev.jpg') }}" alt="">
            <input type="text" placeholder="Tìm sản phẩm bạn mong muốn ..." id="search" name="search">
            <img src="{{ asset('public/image/icon/shopping-cart.jpg') }}" alt="">
        </div>
    </div>
    <section class="product__detail">
        <div class="container">
            <div class="row row-detail">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <div class="fotorama" data-width="700" data-ratio="3/2" data-nav="thumbs" data-thumbheight="48">
                        <img src="{{ asset($product->feature_img) }}" alt="">
                        @foreach (explode(',', $product->gallery) as $item)
                        <img src="{{ asset($item) }}" alt="">
                        @endforeach
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <form id="form-add-to-cart" method="POST" action="{{ route('cart.add') }}">

                        <div class="short-desc">
                            <div class="title">
                                <h2>{{ $product->name }}</h2>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    <div class="code info-detail">
                                        <p><span>Mã sản phẩm:</span>{{ $product->sku }}</p>
                                    </div>
                                    <div class="trademark info-detail">
                                        <p><span>Thương hiệu:</span><a href="{{ route('proBrand.index', $product->brand) }}">{{ $product->brand }}</a>
                                        </p>
                                    </div>
                                    @if (Auth::check())
                                    @if (!in_array(Auth::user()->level, [3, 4]))
                                    <div class="manufacture info-detail">
                                        <p>

                                            <span class="text-dark" style="font-weight: 300">Chiết khấu C
                                                <span class="tt"><i class="text-danger fa fa-question-circle-o"></i><span class="ttt text-justify p-1"> Tiền Tích Lũy C là chiết
                                                        khấu nhận được khi mua sản phẩm, có giá trị thanh toán
                                                        tại C-Mart và các Đối Tác Liên Kết, có giá trị tích lũy
                                                        tốt theo Chính sách Tiết Kiệm Tích Tài C-Saving, có giá
                                                        trị lưu trữ không giới hạn
                                                    </span></span>:</span><span class="text-dark" style="font-weight: 600">{{ number_format($product->productPrice()->value('cpoint'), 0, '.', ',') }}
                                            </span>

                                        </p>
                                        <p>

                                            <span class="text-dark" style="font-weight: 300">Chiết khấu M
                                                <span class="tt"><i class="text-danger fa fa-question-circle-o"></i><span class="ttt text-justify p-1">Điểm Dịch Vụ M là chiết
                                                        khấu nhận được khi mua sản phẩm, có chức năng giảm trừ
                                                        theo giá trị tương ứng cho mọi loại phí dịch vụ (phí vận
                                                        chuyển, phí thanh toán...). Số dư M còn lại sẽ được hoàn
                                                        vào Tài khoản Tiền Tích Lũy của HSKH đặt hàng. Thời gian
                                                        tra soát: 30 ngày kể từ ngày đơn hàng hoàn thành
                                                    </span></span>:</span><span class="text-dark" style="font-weight: 600">{{ number_format($product->productPrice()->value('mpoint'), 0, '.', ',') }}
                                            </span>

                                        </p>
                                    </div>
                                    @endif
                                    @else
                                    <div class="manufacture info-detail">
                                        <p>

                                            <span class="text-dark" style="font-weight: 300">Chiết khấu C <span class="tt"><i class="text-danger fa fa-question-circle-o"></i><span class="ttt"> Tiền Tích Lũy C là chiết khấu nhận
                                                        được khi mua sản phẩm, có giá trị thanh toán tại C-Mart và
                                                        các Đối Tác Liên Kết, có giá trị tích lũy tốt theo Chính
                                                        sách Tiết Kiệm Tích Tài C-Saving, có giá trị lưu trữ không
                                                        giới hạn
                                                    </span></span>:</span><span class="text-dark" style="font-weight: 600">{{ number_format($product->productPrice()->value('cpoint'), 0, '.', ',') }}
                                            </span>

                                        </p>
                                        <p>

                                            <span class="text-dark" style="font-weight: 300">Chiết khấu M <span class="tt"><i class="text-danger fa fa-question-circle-o"></i><span class="ttt">Điểm Dịch Vụ M là chiết khấu nhận
                                                        được khi mua sản phẩm, có chức năng giảm trừ theo giá trị
                                                        tương ứng cho mọi loại phí dịch vụ (phí vận chuyển, phí
                                                        thanh toán...). Số dư M còn lại sẽ được hoàn vào Tài khoản
                                                        Tiền Tích Lũy của HSKH đặt hàng. Thời gian tra soát: 30 ngày
                                                        kể từ ngày đơn hàng hoàn thành
                                                    </span></span>:</span><span class="text-dark" style="font-weight: 600">{{ number_format($product->productPrice()->value('mpoint'), 0, '.', ',') }}
                                            </span>

                                        </p>
                                    </div>
                                    @endif


                                    <div class="all-price">
                                        @if ($product->is_ecard == 1)
                                        <input type="number" placeholder="Mời nhập giá bạn muốn mua" value="" name="price" class="form-control">
                                        @elseif($product->is_shipping == 1)
                                        @else
                                        <p class="new-price">{{ formatPriceOfLevel($product) }}</p>
                                        @endif
                                        {{-- @if ($product->shock_price != null || $product->shock_price != 0)
                                        <p class="new-price">{{ formatPrice($product->shock_price) }}</p>
                                        <p class="old-price">{{ formatPrice($product->regular_price) }}</p>
                                        @else
                                        <p class="new-price">{{ formatPrice($product->regular_price) }}</p>
                                        @endif --}}
                                    </div>

                                    {{-- <div class="promo-intro">
                                        <p class="title-promo">Tiết kiệm
                                            {{ formatPrice($product->regular_price - $product->shock_price) }} Ngay Hôm Nay !
                                        </p>
                                    </div>
                                    <div class="star-mobile">
                                        <div class="star">
                                            <img src="{{ asset('public/image/icon/star.svg') }}" alt="">
                                            <img src="{{ asset('public//image/icon/star.svg') }}" alt="">
                                            <img src="{{ asset('public//image/icon/star.svg') }}" alt="">
                                            <img src="{{ asset('public//image/icon/star.svg') }}" alt="">
                                            <img src="{{ asset('public//image/icon/star.svg') }}" alt="">
                                            <span>5</span>
                                        </div>
                                        <div class="sold">
                                            <span>Đã bán 1877</span>
                                        </div>
                                    </div> --}}
                                            
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-6">
                                    @if (Auth::check())
                                    <input type="hidden" class="card-quality-input" name="product_id" value="{{ $product->id }}">
                                    {{-- <div class="form-group">

                                            <label for="sl-store">Chọn cửa hàng</label>
                                            <select name="store_id" id="sl-store" class="form-control">
                                                <option value="0">---Chọn cửa hàng---</option> --}}
                                    <p><b>Danh sách cửa hàng</b></p>
                                    @foreach ($stores as $store)
                                    @if (in_array($user->level, array_diff(explode(',', $store->getOriginal('pivot_for_user')), [''])))
                                    {{-- <option value="{{ $store->id }}"
                                    @if ($store->getOriginal('pivot_soluong') == 0) disabled @endif>
                                    {{ $store->name }} còn
                                    {{ $store->getOriginal('pivot_soluong') }} sản
                                    phẩm</option> --}}
                                    @if ($store->getOriginal('pivot_soluong') > 0)
                                    <div class="form-group d-flex justify-content-start align-items-center">
                                        <input type="radio" id="store-{{ $store->id }}" name="store_id" value="{{ $store->id }}">
                                        <label style="margin-bottom: 0; padding-left: 3px" for="store-{{ $store->id }}"> {{ $store->name }} (còn
                                            {{ $store->getOriginal('pivot_soluong') }} sản
                                            phẩm)</label>
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                    {{-- </select> --}}
                                    <p class="text-danger" id="notice-store" style="display:none">Chọn cửa hàng
                                        trước khi thêm</p>
                                    {{-- </div> --}}
                                    @endif
                                </div>
                            </div>





                            <div class="quantity">


                                <div class="qty-block">
                                    @if($product->is_shipping == 1)
                                    <div class="input-product-shipping">
                                        <label for="">Thông tin vận chuyển</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" placeholder="Nhập khối lượng vận chuyển">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" placeholder="Nhập Chiều dài vận chuyển">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" placeholder="Nhập Chiều cao vận chuyển">
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" placeholder="Nhập Chiều rộng vận chuyển">
                                                </div>
                                            </div>
                                        </div>
                                        <label for="">Địa chỉ gửi</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp tỉnh<sup class="text-danger">*</sup></label>
                                                    <select name="sel_province" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp huyện<sup class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="sel_district" data-placeholder="---Chọn quận huyên---" required>

                                                        <option value="">Cấp huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp xã<sup class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="sel_ward" data-placeholder="---Chọn phường xã---" required>

                                                        <option value="">Cấp xã</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Địa chỉ chi tiết<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="address" class="form-control" value="" placeholder="Mời nhập địa chỉ" required>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="">Địa chỉ nhận</label>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp tỉnh<sup class="text-danger">*</sup></label>
                                                    <select name="sel_province_to" class="form-control select2" data-placeholder="---Chọn tỉnh thành---" required>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp huyện<sup class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="sel_district_to" data-placeholder="---Chọn quận huyên---" required>

                                                        <option value="">Cấp huyện</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Cấp xã<sup class="text-danger">*</sup></label>
                                                    <select class="form-control select2" name="sel_ward_to" data-placeholder="---Chọn phường xã---" required>

                                                        <option value="">Cấp xã</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label for="">Địa chỉ chi tiết<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="address_to" class="form-control" value="" placeholder="Mời nhập địa chỉ" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($product->is_shipping == 1)
                                    <input type="hidden" name="qty" maxlength="12" value="1" title="" class="input-text" />
                                    @else
                                    <div class="qty">
                                        <input type="text" name="qty" maxlength="12" value="1" title="" class="input-text" />
                                        <div class="qty_inc_dec">
                                            <i class="increment" onclick="incrementQty()">+</i>
                                            <i class="decrement" onclick="decrementQty()">-</i>
                                        </div>
                                    </div>
                                    @endif
                                    @if (Auth::check())
                                    <button type="submit" title="Add to Cart" class="btn-cart">Thêm vào
                                        giỏ hàng</button>
                                    @else
                                    <button onclick="location.href='{{ route('account') }}'" title="Add to Cart" class="btn-cart">Thêm vào
                                        giỏ hàng</button>
                                    @endif
                                </div>
                            </div>



                        </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12 freeship">
                    <div class="freeship_d">
                        <img src="{{ asset('public/image/car.png') }}" alt="">
                        <p>Miễn phí vận chuyển cho đơn từ 1.500.000đ</p>
                    </div>
                </div>
                <div class="ads-mobile">
                    <img src="{{ asset('public/image/ads-mobile.jpg') }}" alt="">
                </div>
                <div class="quality">
                    <div class="quality-control">
                        <img src="{{ asset('public/image/quality-star.png') }}" alt="">
                        <p>100% sản phẩm được kiểm soát chất lượng</p>
                    </div>
                    <div class="commit">
                        <img src="{{ asset('public/image/circle-return.png') }}" alt="">
                        <p>Cam kết 90 ngày đổi trả miễn phí</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product__des">
        <div class="container">
            <div class="row row-des">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="product__des-content">
                        <div class="title">
                            {{-- <ul>
                                    <li id="li-mobile">Thông tin chi tiết</li>
                                    <li id="li-pc">Mô tả sản phẩm</li>
                                </ul> --}}
                            <h5 class="text-center">Thông tin sản phẩm</h5>
                        </div>
                        <div class="text">
                            <div class="text_d long-desc-product">
                                {!! $product->long_desc !!}
                            </div>
                            <div class="text-mb tab_mobile-detail">
                                <div class="code info-detail">
                                    <p><span>SKU:</span>001AB1496</p>
                                    <p><span>Quy cách:</span>Gói</p>
                                </div>
                                <div class="trademark info-detail">
                                    <p><span>Thương hiệu:</span>Pasode</p>
                                </div>
                                <div class="origin info-detail">
                                    <p><span>Xuất xứ:</span>Nhật Bản</p>
                                </div>
                                <div class="manufacture info-detail">
                                    <p><span>Sản xuất tại:</span>Nhật Bản</p>
                                </div>
                            </div>


                        </div>
                        {{-- <div class="product-comment">
                                <h5>Hỏi đáp & đánh giá sản phẩm</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 text-center" style="border-right: 1px solid #ddd">
                                        <div class="counter-rating-left d-flex align-items-center justify-content-center">
                                            <span class="rating-number">{{ $rating_average }}</span> <span>({{ $rating_count }} đánh giá)</span>
                    </div>
                    <div class="counter-rating d-flex align-items-center justify-content-center">
                        <div class="counter-rating-right">
                            <div class="star-ratings">
                                <div class="fill-ratings" style="width: {{$rating_average/5*100}}%;">
                                    <span>★★★★★</span>
                                </div>
                                <div class="empty-ratings">
                                    <span>★★★★★</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="rating-product text-center">
                        <button type="button" class="btn btn-primary btn-outline" data-toggle="modal" data-target="#rating-modal">
                            Đánh giá sản phẩm
                        </button>
                    </div>

                </div>
                {{-- <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="bar-list">
                                            <div class="bar-statistic d-flex align-items-center">
                                                <div class="bar-icon"><i class="fas fa-star"></i>5</div>
                                                <div class="bar-view">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar"
                                                        style="width: {{  $rating_list[0] == 0 ? 0 : ($rating_list[0] / $rating_count) * 100 }}%"
                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            </div>
        </div>
        </div>
        <div class="bar-counter"><span>{{ $rating_list[0] }}</span></div>
        </div>
        <div class="bar-statistic d-flex align-items-center">
            <div class="bar-icon"><i class="fas fa-star"></i>4</div>
            <div class="bar-view">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{  $rating_list[1] == 0 ? 0:($rating_list[1] / $rating_count) * 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="bar-counter"><span>{{ $rating_list[1] }}</span></div>
        </div>
        <div class="bar-statistic d-flex align-items-center">
            <div class="bar-icon"><i class="fas fa-star"></i>3</div>
            <div class="bar-view">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{  $rating_list[2] == 0 ? 0:($rating_list[2] / $rating_count) * 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="bar-counter"><span>{{ $rating_list[2] }}</span></div>
        </div>
        <div class="bar-statistic d-flex align-items-center">
            <div class="bar-icon"><i class="fas fa-star"></i>2</div>
            <div class="bar-view">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{  $rating_list[3] == 0 ? 0:($rating_list[3] / $rating_count) * 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="bar-counter"><span>{{ $rating_list[3] }}</span></div>
        </div>
        <div class="bar-statistic d-flex align-items-center">
            <div class="bar-icon"><i class="fas fa-star"></i>1</div>
            <div class="bar-view">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{  $rating_list[4] ==0 ? 0:($rating_list[4] / $rating_count) * 100 }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
            <div class="bar-counter"><span>{{ $rating_list[4] }}</span></div>
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
        <hr>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="d-flex align-items-center justify-content-center vh-100">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-lg-12">
                                <h5>{{$rating_count}} đánh giá</h5>
                            </div>
                        </div>
                        <div class="row  mb-4">
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="comments">
                                    @foreach ($ratings as $rating)

                                    <div class="comment d-flex mb-4">
                                        <div class="flex-shrink-0">
                                            <div class="avatar avatar-sm rounded-circle">
                                                <span class="avatar-img">
                                                    <span>{{substr($rating->fullname, 0,1)}}</span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-2 ms-sm-3">
                                            <div class="comment-meta d-flex align-items-baseline align-items-center">
                                                <h6 class="me-2 mr-1">{{$rating->fullname}}</h6>
                                                <span class="text-muted">{{date('d/m/y H:i:s', strtotime($rating->created_at))}}</span>
                                            </div>
                                            <div class="rating-body counter-rating">
                                                <div class="star-ratings">
                                                    <div class="fill-ratings" style="width: {{$rating->value/5 *100}}%;">
                                                        <span>★★★★★</span>
                                                    </div>
                                                    <div class="empty-ratings">
                                                        <span>★★★★★</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="comment-body">
                                                {{$rating->comment}}
                                            </div>


                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="rating-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Đánh giá sản phẩm
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-2">
                                <img src="{{ asset($product->feature_img) }}" alt="" class="w-100">
                            </div>
                            <div class="col-8">
                                <p>{{ $product->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <section class='rating-widget'>
                            <!-- Rating Stars Box -->
                            <div class='success-box text-center'>
                                <div class='text-message'></div>
                            </div>
                            <div class='rating-stars text-center'>
                                <ul id='stars'>
                                    <li class='star' title='Poor' data-value='1'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Fair' data-value='2'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Good' data-value='3'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='Excellent' data-value='4'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                    <li class='star' title='WOW!!!' data-value='5'>
                                        <i class='fa fa-star fa-fw'></i>
                                    </li>
                                </ul>
                            </div>
                            <form id="form-comment" method="post" action="{{ route('san-pham.danhgia') }}">
                                <div class="error-rating alert alert-warning text-center" style="display: none">
                                    <p></p>
                                </div>
                                <input type="hidden" name="value" value="0">
                                <input type="hidden" name="product_id" value="{{ $product->id }}" min="1">

                                <div class="form-group comment-text-area">
                                    <label for="">Nhập bình luận</label>
                                    <textarea class="form-control" rows="3" minlength="10" name="comment" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Họ và tên</label>
                                    <input type="text" class="form-control" name="fullname" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Số điện thoại</label>
                                    <input type="number" class="form-control" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-danger w-100" type="submit">Gửi đánh
                                        giá</button>
                                </div>
                            </form>


                        </section>

                    </div>

                </div>
            </div>
        </div>
        </div> --}}
        </div>

        </div>
        <div class="col-sm-12 col-md-3 col-lg-3 category">
            <div>
                <div class="title">
                    <p>Sản phẩm liên quan</p>
                </div>
                @if ($related_product[0] != null)
                @foreach ($related_product as $item)
                <div class="product">
                    <div class="product_img">
                        <a href="{{ route('san-pham.show', $item->slug) }}">

                            <img src="{{ asset($item->feature_img) }}" alt="">
                        </a>
                    </div>
                    <div class="product_text">
                        <a href="{{ route('san-pham.show', $item->slug) }}">

                            <p>{{ $item->name }}</p>
                        </a>
                        @if ($item->productPrice()->value('shock_price') != null || $item->productPrice()->value('shock_price') != 0)
                        <h5>{{ formatPrice($item->productPrice()->value('shock_price')) }}</h5>
                        <h5 id="h5">
                            {{ formatPrice($item->productPrice()->value('regular_price')) }}
                        </h5>
                        @else
                        <h5>{{ formatPrice($item->productPrice()->value('regular_price')) }}</h5>
                        @endif
                    </div>
                </div>
                @endforeach

                @endif
            </div>
        </div>
        </div>
        </div>
    </section>
    <section class="slide_product">
        <div class="container">
            <div class="row row-slide">
                <div class="col-sm-12 col-md-12 col-lg-12 product-seen">

                    <div class="product-carousel-header">Sản phẩm đã xem</div>
                    <div class="product-carousel">
                        @foreach ($lastview_product as $item)
                        <div class="product">
                            <div class="product-top">
                                <a href="{{ route('san-pham.show', $item->slug) }}">

                                    <img class="product-image" src="{{ asset($item->feature_img) }}" />
                                </a>
                                <div class="product-name">
                                    <a href="{{ route('san-pham.show', $item->slug) }}">
                                        <p class="product-title">{{ $item->name }}</p>
                                    </a>
                                </div>
                            </div>
                            <div class="product-bottom">
                                <p class="product-prices">
                                    @if ($item->productPrice()->value('shock_price') != null || $item->productPrice()->value('shock_price') != 0)
                                    <span class="price-was">{{ formatPrice($item->productPrice()->value('regular_price')) }}</span>
                                    <span class="price-save">{{ formatPrice($item->productPrice()->value('shock_price')) }}</span>
                                    @else
                                    <span class="price">
                                        <span class="amount">{{ formatPrice($item->productPrice()->value('regular_price')) }}</span>
                                    </span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection


@push('scripts')
<script src="{{ asset('public/js/address.js') }}"></script>
<script src="{{ asset('public/js/address_to.js') }}"></script>
<script src="{{ asset('public/js/fotorama.js') }}"></script>
<script src="{{ asset('public/js/main.js') }}"></script>
<script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
<script src="{{ asset('public/js/rating.js') }}"></script>
<script src="{{ asset('public/js/lastview_product.js') }}"></script>
@endpush