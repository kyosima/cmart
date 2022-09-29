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
    <link rel="stylesheet" href="{{ asset('public/css/product_detail.css') }}">
@endpush

@section('content')
    <div class="loading">
        <div class='uil-ring-css' style='transform:scale(0.79);'>
            <div></div>
        </div>
    </div>
    <div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-light"><i class="fa fa-shopping-cart"></i> Giỏ hàng</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="cartMessage"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="container">
            <section class="product__detail">
                <div class="row ">
                    <div class="col-sm-12 col-md-8 col-lg-8">
                        <div class="product-left">
                            <div class="product-images">
                                <div class="fotorama" data-width="700" data-ratio="3/2" data-nav="thumbs"
                                    data-thumbheight="48">
                                    <img src="{{ showImageWithError($product->feature_img) }}" alt="{{ $product->title }}">
                                    @foreach (explode(',', $product->gallery) as $item)
                                        <img src="{{ showImageWithError($item) }}" alt="{{ $product->title }}">
                                    @endforeach
                                </div>
                            </div>
                            <div class="product-long-content">
                                <p class="product-detail-section-tile">Thông tin sản phẩm</p>
                                <div class="product-long-content-text">
                                    {!! $product->product_detail->description !!}
                                </div>
                                <div class="bg-article">
                                    <div></div>
                                </div>


                            </div>
                            <div class="text-center p-3">
                                <span id="readmore-desc-product" class="text-primary">Xem thêm</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                        <div class="product-right product-sticky">
                            <form id="formAddProductToCart" method="POST" action="{{ route('cart.add.product') }}">

                                <div class="product-info">

                                    <nav class="breadcrumbs">
                                        <a href="{{ url('/') }}">Trang chủ</a>
                                        <span class="divider">/</span>
                                        @foreach ($categoryIds as $category_id)
                                            <?php $category = App\Models\ProductCategory::find($category_id); ?>
                                            <a href="{{ route('proCat.index', $category->slug) }}">{{ $category->name }}
                                            </a>
                                            <span class="divider">/</span>
                                        @endforeach
                                        <span class="active">{{ $product->title }}</span>
                                    </nav>
                                    <h2 class="product-title">{{ $product->title }}</h2>

                                    <ul class="product-info-detail">
                                        <li><span>Mã sản phẩm: </span><b>{{ $product->sku }}</b></li>
                                        <li><span>Thương hiệu: </span><b><a
                                                    href="{{ route('proBrand.index', $product->product_brand->slug) }}">{{ $product->product_brand->name }}</a></b>
                                        </li>
                                        <li class="manufacture">
                                            <span class="text-dark" style="font-weight: 300">Chiết khấu C
                                                <span class="tt"><i
                                                        class="text-danger fa fa-question-circle-o"></i><span
                                                        class="ttt text-justify p-1"> Tiền Tích Lũy C là chiết
                                                        khấu nhận được khi mua sản phẩm, có giá trị thanh toán
                                                        tại C-Mart và các Đối Tác Liên Kết, có giá trị tích lũy
                                                        tốt theo Chính sách Tiết Kiệm Tích Tài C-Saving, có giá
                                                        trị lưu trữ không giới hạn
                                                    </span></span>: </span><span class="text-dark"
                                                style="font-weight: 600">{{ formatNumber($product->product_price->cpoint) }}
                                            </span>
                                        </li>
                                        <li class="manufacture">
                                            <span class="text-dark" style="font-weight: 300">Chiết khấu M
                                                <span class="tt"><i
                                                        class="text-danger fa fa-question-circle-o"></i><span
                                                        class="ttt text-justify p-1">Điểm Dịch Vụ M là chiết
                                                        khấu nhận được khi mua sản phẩm, có chức năng giảm trừ
                                                        theo giá trị tương ứng cho mọi loại phí dịch vụ (phí vận
                                                        chuyển, phí thanh toán...). Số dư M còn lại sẽ được hoàn
                                                        vào Tài khoản Tiền Tích Lũy của HSKH đặt hàng. Thời gian
                                                        tra soát: 30 ngày kể từ ngày đơn hàng hoàn thành
                                                    </span></span>: </span><span class="text-dark"
                                                style="font-weight: 600">{{ formatNumber($product->product_price->mpoint) }}
                                            </span>
                                        </li>
                                    </ul>

                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    
                                    @switch ($product->is_variation)
                                        @case(0)
                                            <p class="price-single">
                                                <b>{{ formatPriceWithType($product->product_price->product_price_details[0]->price, $product->is_ecard) }}</b>
                                            </p>
                                        @break

                                        @case(1)
                                            @include('product.variation.list', $product)
                                        @break
                                    @endswitch

                                    @if ($product->is_ecard == 1)
                                        <div class="form-group">
                                            <input type="number" class="form-control" name="price"
                                                placeholder="Nhập số tiền muốn mua" required>
                                            <input type="hidden" name="is_ecard" value="1">
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <select name="store_id" class="form-control" id="" required>
                                            <option value="">Chọn cửa hàng</option>
                                            @foreach ($stores as $item)
                                                <option value="{{ $item->store->id }}">{{ $item->store->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @include('product.include.quantity')
                                </div>
                            </form>
                        </div>
                        <div class="product-related">
                            <p class="product-detail-section-tile">SẢN PHẨM LIÊN QUAN</p>
                            <div class="product-related-items">
                                @foreach ($relateds_product as $item)
                                    <div class="product-related-item">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12 col-12">
                                                <div class="box-image">
                                                    <div class="image-wrapper">
                                                        <a href="{{ route('san-pham.show', $item->product->slug) }}"
                                                            title="{{ $item->product->title }}" tabindex="0">
                                                            <img src="{{ showImageWithError('123123') }}"
                                                                alt="{{ $item->product->title }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-xs-12 col-sm-12 col-12">
                                                <div class="box-text">
                                                    <p class="product-title-text"> <a
                                                            href="{{ route('san-pham.show', $item->product->slug) }}">{{ $item->product->title }}</a>
                                                    </p>
                                                    <p class="product-price">{!! formatPriceWithVariation($item->product) !!} </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
                                            {{-- @if ($item->productPrice()->value('shock_price') != null || $item->productPrice()->value('shock_price') != 0)
                                                <span
                                                    class="price-was">{{ formatPrice($item->productPrice()->value('regular_price')) }}</span>
                                                <span
                                                    class="price-save">{{ formatPrice($item->productPrice()->value('shock_price')) }}</span>
                                            @else
                                                <span class="price">
                                                    <span
                                                        class="amount">{{ formatPrice($item->productPrice()->value('regular_price')) }}</span>
                                                </span>
                                            @endif --}}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
        </div>
    </main>
@endsection


@push('scripts')
    <script src="{{ asset('public/js/fotorama.js') }}"></script>
    <script src="{{ asset('public/js/main.js') }}"></script>
    <script src="https://kenwheeler.github.io/slick/slick/slick.js"></script>
    <script src="{{ asset('public/js/lastview_product.js') }}"></script>
    <script src="{{ asset('public/js/add_to_cart.js') }}"></script>
    <script src="{{ asset('public/js/product.js') }}"></script>
@endpush
