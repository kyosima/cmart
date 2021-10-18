@extends('layout.master')

@section('title', 'Chi tiết sản phẩm')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/fotorama.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/lastview_product.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/rating.css') }}">
    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}

@endpush

@section('content')
    <main>
        <div class="category-product">
            <div class="container">
                <ul>
                    <li><a href="#">Trang chủ</a></li>
                    @foreach ($categoryIds as $category_id)
                        <?php $category = App\Models\ProductCategory::find($category_id); ?>
                        <li><a href="{{ route('proCat.index', $category->slug) }}">{{ $category->name }} </a></li>
                    @endforeach
                    <li class="ml-1"> {{ $product->name }}</li>
                </ul>
            </div>
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
                        <div class="fotorama" data-width="700" data-ratio="3/2" data-nav="thumbs"
                            data-thumbheight="48">
                            <img src="{{ asset($product->feature_img) }}" alt="">
                            @foreach (explode(',', $product->gallery) as $item)
                                <img src="{{ asset($item) }}" alt="">

                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="short-desc">
                            <div class="title">
                                <h2>{{ $product->name }}</h2>
                            </div>
                            <div class="code info-detail">
                                <p><span>SKU:</span>{{ $product->sku }}</p>
                                <p class="quycach"><span>Quy
                                        cách:</span>{{ $product->productCalculationUnit()->value('name') }}</p>
                            </div>
                            <div class="trademark info-detail">
                                <p><span>Thương hiệu:</span>{{ $product->productBrand()->value('name') }}</p>
                            </div>
                            <div class="origin info-detail">
                                <p><span>Xuất xứ:</span>Nhật Bản</p>
                            </div>
                            <div class="manufacture info-detail">
                                <p><span>Sản xuất tại:</span>Nhật Bản</p>
                            </div>
                            <div class="all-price">
                                @if ($product->shock_price != null || $product->shock_price != 0)
                                    <p class="new-price">{{ formatPrice($product->shock_price) }}</p>
                                    <p class="old-price">{{ formatPrice($product->regular_price) }}</p>
                                @else
                                    <p class="new-price">{{ formatPrice($product->regular_price) }}</p>
                                @endif
                            </div>
                            <div class="promo-intro">
                                <p class="title-promo">Tiết kiệm
                                    {{ formatPrice($product->regular_price - $product->shock_price) }} Ngay Hôm Nay !</p>
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
                            </div>
                            <div class="quantity">
                                <form id="form-add-to-cart" method="POST" action="{{ route('cart.add') }}">
                                    <input type="hidden" class="card-quality-input" name="product_id"
                                        value="{{ $product->id_ofproduct }}">
                                    <input type="number" class="card-quality-input" name="qty" value="1">
                                    <button class="quantity_btn add-cart" type="submit">
                                        <p>Thêm vào giỏ</p>
                                    </button>
                                </form>
                            </div>
                           
                        </div>
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
                                                    <img src="{{ asset('public/image/chinhhang.png') }}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Chính hãng</p>
                                                        <p class="p2">100%</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="{{ asset('public/image/doitra.png') }}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Miễn phí đổi trả</p>
                                                        <p class="p2">LÊN ĐẾN 90 NGÀY</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-4 col-lg-4">
                                                <div class="item">
                                                    <img src="{{ asset('public/image/giaohanh.png') }}" alt="">
                                                    <div class="item__info">
                                                        <p class="p1">Giao hàng</p>
                                                        <p class="p2">NHANH CHÓNG</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-12 col-lg-12">
                                                <div class="note_list">
                                                    <ul>
                                                        <li><a href="#">* Bạn có thể mua hàng ngay tại website bằng cách
                                                                nhấn vào nút Mua Ngay, hoặc liên hệ với chúng tôi qua các
                                                                thông tin bên dưới.</a></li>
                                                        <li><a href="#">*cam kết bán hàng chính hãng từ Nhật Bản. Những
                                                                thông tin bên trên được nhà sản xuất đưa ra, các sản phẩm
                                                                làm đẹp và sức khỏe tùy vào cơ địa của mỗi khách hàng sẽ có
                                                                hiệu quả tương thích.</a></li>
                                                        <li><a href="#">* Mẫu mã của sản phẩm có thể được thay đổi khi bạn
                                                                mua hàng.</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <div class="product product1">
                                            <div class="product1_img">
                                                <img src="{{ asset($product->feature_img) }}" alt="">
                                            </div>
                                            <div class="product_text">
                                                <p>{{ $product->name }}</p>
                                                <h5 class="text-danger">{{ formatPrice($product->regular_price) }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-12">
                                        <div class="contact">
                                            <div class="contact_item fb">
                                                <img src="{{ asset('public/image/icon/facebook.jpg') }}" alt="">
                                            </div>
                                            <div class="contact_item phone">
                                                <img src="{{ asset('public/image/icon/telephone.jpg') }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="product-comment">
                                <h5>Hỏi đáp & đánh giá sản phẩm</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5 col-lg-5">
                                       <div class="star-score">
                                        5.0
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
                            @foreach ($new_products as $item)
                                <div class="product">
                                    <div class="product_img">
                                        <img src="{{ asset($item->feature_img) }}" alt="">
                                    </div>
                                    <div class="product_text">
                                        <p>{{ $item->name }}</p>
                                        @if ($item->productPrice()->value('shock_price') != null || $item->productPrice()->value('shock_price') != 0)
                                            <h5>{{formatPrice(  $item->productPrice()->value('shock_price') )}}</h5>
                                            <h5 id="h5">{{formatPrice(  $item->productPrice()->value('regular_price') )}}</h5>
                                        @else
                                            <h5>{{ formatPrice( $item->productPrice()->value('regular_price') )}}</h5>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                           
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
                                        <img class="product-image" src="{{ asset($item->feature_img) }}" />
                                        <div class="product-name">
                                            <a href="{{ route('san-pham.show', $item->slug) }}">
                                                <p class="product-title">{{ $item->name }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-bottom">
                                        <p class="product-prices">
                                            @if ($item->productPrice()->value('shock_price') != null || $item->productPrice()->value('shock_price') != 0)

                                                <span
                                                    class="price-was">{{formatPrice( $item->productPrice()->value('regular_price') )}}</span>
                                                <span
                                                    class="price-save">{{formatPrice( $item->productPrice()->value('shock_price') )}}</span>
                                            @else
                                                <span class="price">
                                                    <span
                                                        class="amount">{{ formatPrice($item->productPrice()->value('regular_price')) }}</span>
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
    <script src="{{ asset('public/js/jquery.js') }}"></script>
    <script src="{{ asset('public/js/fotorama.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>

    <script src="{{ asset('public/js/lastview_product.js') }}"></script>

@endpush
