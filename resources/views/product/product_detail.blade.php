@extends('layout.master')

@section('title', 'Chi tiết sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('public/css/fotorama.css')}}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}

@endpush

    @section('content')
    <main>
        <div class="category-product">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    @foreach ( $categoryIds as $category_id)
                    <?php $category = App\Models\ProductCategory::find($category_id); ?>
                        <li><a href="{{route('proCat.index',$category->slug)}}">{{$category->name}} </a></li>
                    @endforeach
                    <li class="ml-1"> {{$product->name}}</li>
                </ul>
            </div>
        </div>
        <!-- search-mobile-fixed -->
            <div class="search">
                <div class="search_d">
                    <img src="{{asset('public/image/icon/arrow-prev.jpg')}}" alt="">
                    <input type="text" placeholder="Tìm sản phẩm bạn mong muốn ..." id="search" name="search">
                    <img src="{{asset('public/image/icon/shopping-cart.jpg')}}" alt="">
                </div>
            </div>
        <section class="product__detail">
            <div class="container">
                <div class="row row-detail">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="fotorama" data-width="700" data-ratio="3/2" data-nav="thumbs" data-thumbheight="48">
                            <img src="{{asset($product->feature_img)}}" alt="">
                            @foreach ( explode(',',$product->gallery) as $item)
                            <img src="{{asset($item)}}" alt="">

                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="short-desc">
                            <div class="title">
                                <h2>{{$product->name}}</h2>
                            </div>
                            <div class="code info-detail">
                                <p><span>SKU:</span>{{$product->sku}}</p>
                                <p class="quycach"><span>Quy cách:</span>{{$product->productCalculationUnit()->value('name')}}</p>
                            </div>
                            <div class="trademark info-detail">
                                <p><span>Thương hiệu:</span>{{$product->productBrand()->value('name')}}</p>
                            </div>
                            <div class="origin info-detail">
                                <p><span>Xuất xứ:</span>Nhật Bản</p>
                            </div>
                            <div class="manufacture info-detail">
                                <p><span>Sản xuất tại:</span>Nhật Bản</p>
                            </div>
                            <div class="all-price">
                                @if ($product->shock_price != null || $product->shock_price != 0)
                                    <p class="new-price">{{formatPrice($product->shock_price)}}</p>
                                    <p class="old-price"></p>
                            @else
                                    <p class="new-price">{{formatPrice($product->regular_price)}}</p>
                            @endif
                            </div>
                            <div class="promo-intro">
                                <p class="title-promo">Tiết kiệm {{formatPrice($product->regular_price - $product->shock_price)}} Ngay Hôm Nay !</p>
                            </div>
                            <div class="star-mobile">
                                <div class="star">
                                    <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                    <img src="{{asset('public//image/icon/star.svg')}}" alt="">
                                    <img src="{{asset('public//image/icon/star.svg')}}" alt="">
                                    <img src="{{asset('public//image/icon/star.svg')}}" alt="">
                                    <img src="{{asset('public//image/icon/star.svg')}}" alt="">
                                    <span>5</span>
                                </div>
                                <div class="sold">
                                    <span>Đã bán 1877</span>
                                </div>
                            </div>
                            <div class="quantity">
                                <form id="form-add-to-cart" method="POST" action="{{route('cart.add')}}">
                                    <input type="hidden" class="card-quality-input" name="product_id" value="{{$product->id_ofproduct}}">
                                    <input type="number" class="card-quality-input" name="qty" value="1">
                                    <button class="quantity_btn add-cart" type="submit">
                                        <p>Thêm vào giỏ</p>
                                    </button>
                                </form>
                            </div>
                            <div class="product_bonus">
                                <div class="title">
                                    <h2>Mua cùng giảm thêm</h2>
                                </div>
                                <div class="product_bonus-d">
                                    <input type="checkbox" name="vehicle1" value="Bike">
                                    <img src="{{asset('public/image/product-small-1.jpg')}}" alt="">
                                    <p>Viên uống rau củ DHC Nhật Bản 240 Viên</p>
                                    <p class="price">335.000 đ</p>
                                </div>
                                <div class="product_bonus-d">
                                    <input type="checkbox" name="vehicle1" value="Bike">
                                    <img src="{{asset('public/image/product-small-1.jpg')}}" alt="">
                                    <p>Viên uống rau củ DHC Nhật Bản 240 Viên</p>
                                    <p class="price">335.000 đ</p>
                                </div>
                                <div class="total">
                                    <span>Tổng cộng:<p>914.000 đ</p></span>
                                    <div class="addtoCart">
                                        <span>Thêm tất cả vào giỏ hàng</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 freeship">
                        <div class="freeship_d">
                            <img src="{{asset('public/image/car.jpg')}}" alt="">
                            <p>Miễn phí vận chuyển cho đơn từ 1.500.000đ</p>
                        </div>
                    </div>
                    <div class="ads-mobile">
                        <img src="{{asset('public/image/ads-mobile.jpg')}}" alt="">
                    </div>
                    <div class="quality">
                        <div class="quality-control">
                            <img src="{{asset('public/image/icon/quality-star.jpg')}}" alt="">
                            <p>100% sản phẩm được kiểm soát chất lượng</p>
                        </div>
                        <div class="commit">
                            <img src="{{asset('public/image/icon/circle-return.jpg')}}" alt="">
                            <p>Cam kết 90 ngày đổi trả miễn phí</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="product__des">
            <div class="container">
                <div class="row row-des">
                    <div class="col-sm-12 col-md-10 col-lg-10">
                        <div class="product__des-content">
                            <div class="title">
                                <ul>
                                    <li id="li-mobile">Thông tin chi tiết</li>
                                    <li id="li-pc">Mô tả sản phẩm</li>
                                </ul>
                            </div>
                            <div class="text">
                                <div class="text_d p-4">
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
                                <div class="row row-mobile">
                                    <div class="col-sm-12 col-md-9 col-lg-9">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="{{asset('public/image/chinhhang.jpg')}}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Chính hãng</p>
                                                        <p class="p2">100%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="{{asset('public/image/doitra.jpg')}}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Miễn phí đổi trả</p>
                                                        <p class="p2">LÊN ĐẾN 90 NGÀY</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="{{asset('public/image/giaohanh.jpg')}}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Giao hàng</p>
                                                        <p class="p2">NHANH CHÓNG</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="note_list">
                                                    <ul><li><a href="#">* Bạn có thể mua hàng ngay tại website bằng cách nhấn vào nút Mua Ngay, hoặc liên hệ với chúng tôi qua các thông tin bên dưới.</a></li>
                                                        <li><a href="#">*cam kết bán hàng chính hãng từ Nhật Bản. Những thông tin bên trên được nhà sản xuất đưa ra, các sản phẩm làm đẹp và sức khỏe tùy vào cơ địa của mỗi khách hàng sẽ có hiệu quả tương thích.</a></li>
                                                        <li><a href="#">* Mẫu mã của sản phẩm có thể được thay đổi khi bạn mua hàng.</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="product product1">
                                            <div class="product1_img">
                                                <img src="{{asset($product->feature_img)}}" alt="">
                                            </div>
                                            <div class="product1_text">
                                                <p>{{$product->name}}</p>
                                                <h5>{{formatPrice($product->regular_price)}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="contact">
                                            <div class="contact_item fb">
                                                <img src="{{asset('public/image/icon/facebook.jpg')}}" alt="">
                                            </div>
                                            <div class="contact_item phone">
                                                <img src="{{asset('public/image/icon/telephone.jpg')}}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="evaluate evaluate-navigation">
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="evaluate__title">
                                            <img src="{{asset('public/image/icon/arrow-prev.jpg')}}" alt="">
                                            <h3>Khách hàng đánh giá</h3>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12 evaluate__star">
                                        <div class="evaluate__star-number">
                                            <span>5</span>
                                        </div>
                                        <div class="evaluate__star-icon">
                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                        </div>
                                        <div class="evaluate__star-text">
                                            <p>1 đánh giá</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6 col-lg-6 evaluate__number">
                                            <div class="evaluate__number-d">
                                                <p><span>5</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></p>
                                                <span id="span-line"></span>
                                                <p class="number-small">1</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>4</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>3</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>2</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                            <div class="evaluate__number-d">
                                                <p><span>1</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></p>
                                                <span id="span-line" class="line-1"></span>
                                                <p class="number-small">0</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-6 col-lg-6 evaluate__img">
                                            <div class="evaluate__img-content">
                                                <p>Tất cả hình ảnh (1)</p>
                                                <img src="{{asset('public/image/evaluate-img.jpg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg0-12 tab_navigation">
                                            <div class="col-sm-12 col-md-12 col-lg-12 evaluate__img">
                                                <div class="evaluate__img-tab">
                                                    <div class="title">
                                                        <p>Lọc xem theo:</p>
                                                    </div>
                                                    <ul>
                                                        <li class="active"><span>5</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></li>
                                                        <li><span>4</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></li>
                                                        <li><span>3</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></li>
                                                        <li><span>2</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></li>
                                                        <li><span>1</span><img src="{{asset('public/image/icon/star.svg')}}" alt=""></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg0-12 tab_comment-area">
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="5-star">
                                                <div class="comment-item">
                                                    <div class="customer">
                                                        <div class="avar item">
                                                            <p>S</p>
                                                        </div>
                                                        <div class="sup item">
                                                            <p>Support</p>
                                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                                            <img src="{{asset('public/image/icon/star.svg')}}" alt="">
                                                        </div>
                                                        <div class="date item">
                                                            <p>(08/09/2021)</p>
                                                        </div>
                                                    </div>
                                                    <div class="content">
                                                        <p>Cảm ơn ac đã ủng hộ siêu thị nhật bản japana bên em ạ.
                                                                Dịch quá các shiper không đi giao đc bên em cố gắng dùng xe riêng đi giao cho khách yêu ạ.
                                                            Nhưng chỉ giao đc ít nơi k bị rào chắn, các nơi bị chắn rào xe không vào đc mong ac mình chờ thêm ạ.
                                                        </p>
                                                    </div>
                                                    <div class="image">
                                                        <img src="{{asset('public/image/evaluate-img.jpg')}}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="4-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="{{asset('public/image/sad.jpg')}}" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="3-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="{{asset('public/image/sad.jpg')}}" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="2-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="{{asset('public/image/sad.jpg')}}" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12 tab_comment comment" id="1-star">
                                                <div class="comment-item tab-item">
                                                    <div class="image ">
                                                        <img src="{{asset('public/image/sad.jpg')}}" alt="" id="iconSad">
                                                    </div>
                                                    <div class="content">
                                                        <p>Không tìm thấy nhận xét phù hợp</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="comment-review">
                                            <div class="btn btn-showall">
                                                <p>Xem tất cả đánh giá</p>
                                            </div>
                                            <div class="btn btn-write">
                                                <p>Viết đánh giá</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 category">
                        <div>
                            <div class="title">
                                <p>Sản phẩm cùng danh mục</p>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="{{asset('public/image/product-1.jpg')}}" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống đẹp da Fine Pure Collagen Q 375 viên</p>
                                    <h5>2.860.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                    <h5>450.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="{{asset('public/image/product-3.jpeg')}}" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống Collagen DHC 2.05mg 360 viên (60 ngày)</p>
                                    <h5>325.000 đ</h5>
                                    <h5 id="h5">349.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="{{asset('public/image/product-4.jpeg')}}" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên nhai bổ sung Collagen Orihiro Most Chewable 180 viên</p>
                                    <h5>389.000 đ</h5>
                                </div>
                            </div>
                            <div class="product">
                                <div class="product_img">
                                    <img src="{{asset('public/image/product-5.jpeg')}}" alt="">
                                </div>
                                <div class="product_text">
                                    <p>Viên uống Collagen DHC 2.050mg 540 viên (90 ngày)</p>
                                    <h5>750.000 đ</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="slide_product">
            <div class="container">
                <div class="row row-slide">
                    <div class="col-sm-12 col-md-12 col-lg-12 product-seen">
                        <div class="title">
                            <p>Sản phẩm đã xem</p>
                        </div>
                        <div class="fotorama" id="slide-controls" data-width="700" data-ratio="3/2">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-3 col-lg-2">
                                    <div class="product">
                                        <div class="product_img">
                                            <img src="{{asset('public/image/product-2.jpeg')}}" alt="">
                                        </div>
                                        <div class="product_text">
                                            <p>Viên uống bổ sung Collagen Maihada 180 viên</p>
                                            <h5>450.000 đ</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @endsection


@push('scripts')
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/fotorama.js')}}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
@endpush
