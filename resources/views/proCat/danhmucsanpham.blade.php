@extends('layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/danhmucsanpham.css') }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}

@endpush


@section('content')

    <!-- breadcrumbs -->
    <section id="breadcrumbs">
        <div class="page-title shop-page-title">
            <div class="page-title-inner container">
                <nav class="breadcrumbs">
                    <a href="#">Trang chủ</a>
                    <span class="divider">/</span>
                    @if ($proCat->parents != null)
                        @if ($proCat->parents->categories != null)
                            <a
                                href="{{ route('proCat.index', $proCat->parents->categories->slug) }}">{{ $proCat->parents->categories->name }}</a>
                            <span class="divider">/</span>
                        @endif
                        <a href="{{ route('proCat.index', $proCat->parents->slug) }}">{{ $proCat->parents->name }}</a>
                        <span class="divider">/</span>
                        <span class="active">{{ $proCat->name }}</span>
                    @else
                        <span class="active">{{ $proCat->name }}</span>
                    @endif
                </nav>
            </div>
        </div>
    </section>

    <!-- slider -->
    @if ($proCat->feature_img != null)
        <section class="slider">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    @if ($proCat->gallery != null)
                        @php
                            $gallery = explode(', ', $proCat->gallery);
                            $i = 1;
                        @endphp
                        @foreach ($gallery as $item)
                            <li data-target="#myCarousel" data-slide-to="{{ $i++ }}"></li>
                        @endforeach
                    @endif
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ $proCat->feature_img }}" class="d-block w-100 banner1" alt="">
                    </div>
                    @if ($proCat->gallery != null)
                        @foreach ($gallery as $item)
                            <div class="carousel-item">
                                <img src="{{ $item }}" class="d-block w-100 banner2" alt="">
                            </div>
                        @endforeach
                    @endif
                </div>
                <!-- <ul class="text-carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                            </ul> -->
            </div>
        </section>
    @endif

    <!-- main -->
    <section>
        @if (count($products) < 1)

            <div class="category-page container">
                <div class="row">
                    <div class="col">
                        <p class="h4 text-center text-danger">Hiện chưa có sản phẩm nào trong danh mục này, CMart sẽ sớm cập
                            nhật để phục vụ quý khách</p>
                    </div>
                </div>
            </div>

        @else
            <!-- Trang sản phẩm -->
            <div class="category-page container">
                <div class="row">
                    <!-- bên trái -->
                    <div id="shopsidebar" class="shop-sidebar col-lg-3 col-md-12 col-sm-12">
                        <!-- danh mục -->
                        @if (count($subcategory) > 0)
                            <aside class="widget danhmuc">
                                <h3 class="widget-title mb-1">Danh mục</h3>
                                <div class="widget-search">
                                    <input autocomplete="off" id="input_category_search" type="text"
                                        class="form-control input_search" placeholder="Tìm kiếm..."
                                        onkeyup="searchText('category_search')">
                                    <button type="button">
                                        <i class="search-icon"></i>
                                    </button>
                                </div>
                                <div id="category_search" class="widget-product-categories">
                                    <ul class="check-side category-menu">
                                        @foreach ($subcategory as $item)
                                            @if (count($item->childrenCategories) > 0)
                                                <li class="menu-item menu-item-has-children py-1 has-child menu-border">
                                                    @if ($item->linkToCategory != null)
                                                        <a
                                                            href="{{ route('proCat.index', $item->linkToCategory->slug) }}">{{ $item->name }}</a>
                                                    @else
                                                        <a
                                                            href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                                                    @endif
                                                    <button class="toggle">
                                                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                    </button>
                                                    @include('proCat.danhmuc-sidebar', [
                                                    'child_categories' => $item->childrenCategories,
                                                    ])
                                                </li>
                                            @else
                                                <li class="menu-item menu-border py-1">
                                                    @if ($item->linkToCategory != null)
                                                        <a
                                                            href="{{ route('proCat.index', $item->linkToCategory->slug) }}">{{ $item->name }}</a>
                                                    @else
                                                        <a
                                                            href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    {{-- @foreach ($categories as $item)
                                <div class="check-side">
                                    <label class="py-1">
                                        <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
                                    </label>
                                </div>
                                @endforeach --}}
                                </div>
                            </aside>
                            {{-- <aside class="widget danhmuc">
                                <h3 class="widget-title">Danh mục</h3>
                                <div class="widget-search">
                                    <input autocomplete="off" id="input_category_search" type="text" class="form-control input_search" placeholder="Tìm kiếm..." onkeyup="searchText('category_search')">
                                    <button type="button">
                                        <i class="search-icon"></i>
                                    </button>
                                </div>
                                <div class="scrollbar">
                                    <div id="category_search" class="widget-product-categories">
                                        @foreach ($subcategory as $item)
                                            @if (count($item->products) > 0)
                                                <div class="check-side">
                                                    <label class="check-custom">
                                                        {{$item->name}}
                                                        <span class="count-item"> ({{count($item->products)+count($item->subproducts)}})</span>
                                                        <input name="category[]" class="submit_click" type="checkbox" value="{{$item->id}}">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            @elseif (count($item->products) < 1 && $item->linkToCategory != null)
                                                <div class="check-side">
                                                    <label class="check-custom">
                                                        {{$item->linkToCategory->name}}
                                                        <span class="count-item"> ({{count($item->linkToCategory->products)+count($item->linkToCategory->subproducts)}})</span>
                                                        <input name="category[]" class="submit_click" type="checkbox" value="{{$item->linkToCategory->id}}">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </aside> --}}
                        @endif

                        <form action="{{ url('/') . '/' . Request::path() }}" method="get" id="filter_form">
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
                                    <input type="hidden" name="minprice" id="minprice" value="{{ $minPrice }}">
                                    <input type="hidden" name="beginMinPrice" id="minprice1" @if ($beginMinPrice == 0) value="{{ $minPrice }}" @else value="{{ $beginMinPrice }}" @endif>
                                    <input type="hidden" name="maxprice" id="maxprice" value="{{ $maxPrice }}">
                                    <input type="hidden" name="endMaxPrice" id="maxprice1" @if ($endMaxPrice == 0) value="{{ $maxPrice }}" @else value="{{ $endMaxPrice }}" @endif>
                                    <div class="widget-price">
                                        <div class="form-group trai">
                                            <p class="title-range">Min</p>
                                            <div class="box-input">
                                                <input type="text" class="form-control slider_price_textbox" id="amount1"
                                                    disabled="">
                                                <span>đ</span>
                                            </div>
                                        </div>
                                        <div class="form-group phai">
                                            <p class="title-range">Max</p>
                                            <div class="box-input">
                                                <input type="text" class="form-control slider_price_textbox" id="amount2"
                                                    disabled="">
                                                <span>đ</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn-price" type="submit">Áp dụng</button>
                                </div>
                            </aside>

                            <!-- thương hiệu -->
                            <aside class="widget thuonghieu">
                                <h3 class="widget-title">Thương hiệu</h3>
                                <div class="widget-search">
                                    <input autocomplete="off" id="input_brand_search" type="text"
                                        class="form-control input_search" placeholder="Tìm kiếm..."
                                        onkeyup="searchBrand('brand_search')">
                                    <button type="button">
                                        <i class="search-icon"></i>
                                    </button>
                                </div>
                                <div class="scrollbar">
                                    <div id="brand_search" class="widget-product-categories">
                                        @foreach ($brands as $item)
                                            <div class="check-side">
                                                <label class="check-custom">
                                                    {{ $item->name }}
                                                    <span class="count-item"> ({{ $countBrand[$item->id] }})</span>
                                                    <input name="id_brand[]" class="submit_click" type="checkbox"
                                                        value="{{ $item->id }}">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="footer-filter d-lg-none">
                                    <button type="button" class="clear_filter">Xóa lọc</button>
                                    <button type="button" class="submit_click">Áp dụng</button>
                                </div>
                            </aside>
                            <input type="hidden" id="order" name="order" value="">
                            <input type="hidden" id="sale" name="sale" value="">
                        </form>
                    </div>

                    <!-- bên phải -->
                    <div class="shop-container col-lg-9 col-md-12 col-sm-12">
                        <div class="shop-container-inner">
                            <!-- TITLE -->
                            <h2 class="title-filter d-none d-lg-block">{{ $proCat->name }}
                                <span>({{ count($products) }} sản
                                    phẩm)</span></h2>
                            <!-- Bộ lọc -->
                            <div class="filter-cate">
                                <ul>
                                    <li class="d-lg-inline d-none">Sắp xếp theo:</li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order();" class="order-default">Mặc định</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('regular_price desc');" class="">Giá cao</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('regular_price asc');" class="">Giá thấp</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('cpoint desc');" class="">Điểm C cao</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('cpoint asc');" class="">Điểm C thấp</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('mpoint desc');" class="">Điểm M cao</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('mpoint asc');" class="">Điểm M thấp</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:order('name asc');" class="">A-z</a>
                                    </li>
                                    <li class="li-filter-cate">
                                        <a href="javascript:sale('2');" class="">Sale</a>
                                    </li>
                                    <li class="
                                    d-lg-none">
                                        <a href="javascript:void(0)" class="filter-btn" onclick="openSidebar()">Lọc</a>
                                    </li>
                                </ul>
                            </div>

                            <!-- SẢN PHẨM -->
                            <div class="products">
                                @foreach ($products as $item)
                                    <div class="item">
                                        <div class="product-box row">
                                            <div class="box-image col-lg-12 col-md-4 col-4">
                                                <div class="image-cover">
                                                    <a href="{{ route('san-pham.show', $item->slug) }}">
                                                        <img src="{{ asset($item->feature_img) }}" alt="">
                                                    </a>
                                                </div>
                                                @if ($item->shock_price != null || $item->shock_price != 0)
                                                    @php
                                                        $percent = (1 - $item->shock_price / $item->regular_price) * 100;
                                                    @endphp
                                                    <div class="block-sale">
                                                        <img alt="" src="{{ asset('image/bg-sale.png') }}">
                                                        <span class="sale">-{{ round($percent) }}%</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="box-text col-lg-12 col-md-8 col-8">
                                                <div class="title-wrapper">
                                                    <a href="{{ route('san-pham.show', $item->slug) }}">
                                                        <p class="product-title">{{ $item->name }}</p>
                                                    </a>
                                                </div>
                                                <div class="price-wrapper">
                                                    @if ($item->shock_price != null || $item->shock_price != 0)
                                                        <span class="price">
                                                            <span
                                                                class="amount">{{ number_format($item->shock_price) }}đ</span>
                                                        </span>
                                                        <span class="price-old">
                                                            <span
                                                                class="amount">{{ number_format($item->regular_price) }}đ</span>
                                                        </span>
                                                    @else
                                                        <span class="price">
                                                            <span
                                                                class="amount">{{ number_format($item->regular_price) }}đ</span>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="text-center">
                                <div class="nav_pager">
                                    {{ $products->links('product.include.pagination') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Mô tả -->
        @if ($proCat->description != null || $proCat->description != '')
            <div class="container d-none d-lg-block">
                <div class="box-detail-cate">
                    {!! $proCat->description !!}
                </div>
            </div>
        @endif
    </section>
@endsection


@push('scripts')
<script src="{{ asset('public/js/danhmucsanpham.js') }}"></script>

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
    {{-- <script src="{{ asset('js/danhmucsanpham.js') }}"></script> --}}
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"
        integrity="sha256-hlKLmzaRlE8SCJC1Kw8zoUbU8BxA+8kR3gseuKfMjxA=" crossorigin="anonymous"></script>

    <script>
        jQuery(function() {
            initSlidePrice()
        });

        function order(id) {
            $("#sale").val('');
            $("#order").val(id);
            $("#filter_form").submit()
        }

        function sale(id) {
            $("#order").val('');
            $("#sale").val(id);
            $("#filter_form").submit();
        }

        function searchText(id) {
            var input, filter, li, a, i, txtValue;
            input = $('#input_' + id);
            filter = input.val().toUpperCase();
            li = $('#' + id + ' .check-side .menu-item');
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].getElementsByTagName("a")[0].style.display = "";
                } else {
                    li[i].getElementsByTagName("a")[0].style.display = "none";
                }
            }
            if (filter == '') {
                $('.sub-menu').css({
                    "display": "none",
                    "padding-left": "15px",
                    'border-left': '1px solid #ddd',
                    'margin': '0 0 10px 3px'
                });
                $('.toggle').css('display', 'inline-block');
                $('li.menu-item').addClass('py-1 menu-border');
            } else {
                $('.toggle').css('display', 'none');
                $('.sub-menu').css({
                    "display": "block",
                    "padding-left": "0",
                    'border': '0',
                    'margin': '0'
                });
                $('li.menu-item').removeClass('py-1 menu-border');
            }
        }

        function searchBrand(id) {
            var input, filter, li, a, i, txtValue;
            input = $('#input_' + id);
            filter = input.val().toUpperCase();
            li = $('#' + id + ' .check-side');
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("label")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }

        var initSlidePrice = function() {
            var min_price1 = parseInt(jQuery("#minprice").val());
            var max_price1 = parseInt(jQuery("#maxprice").val());
            if (($("#minprice1")).val()) {
                var min_price = parseInt(jQuery("#minprice1").val())
            } else {
                var min_price = parseInt(jQuery("#minprice").val())
            }
            if (($("#maxprice1")).val()) {
                var max_price = parseInt(jQuery("#maxprice1").val())
            } else {
                var max_price = parseInt(jQuery("#maxprice").val())
            }
            jQuery("#slider-range").slider({
                range: !0,
                min: min_price1,
                max: max_price1,
                values: [min_price, max_price],
                slide: function(event, ui) {
                    jQuery("#amount").html("$" + ui.values[0] + " - $" + ui.values[1]);
                    var amount1 = formatCurrency(ui.values[0]);
                    var amount2 = formatCurrency(ui.values[1]);
                    jQuery("#amount1").val(amount1);
                    jQuery("#amount2").val(amount2);
                    jQuery("#minprice1").val(ui.values[0]);
                    jQuery("#maxprice1").val(ui.values[1])
                }
            });
            jQuery("#amount").html("$" + jQuery("#slider-range").slider("values", 0) + " - $" + jQuery("#slider-range")
                .slider("values", 1));
            var from1st = formatCurrency(min_price);
            var to1st = formatCurrency(max_price);
            $("#amount1").val(from1st);
            $("#amount2").val(to1st);
            jQuery(".slider_price_textbox").on("keypress,keyup", function(e) {
                var code = e.charCode || e.keyCode;
                if (code == '8') return !0;
                if (String.fromCharCode(code).match(/[^0-9]/g)) {
                    return !1
                }
                return !0
            });
            jQuery(".slider_price_textbox").focusout(function() {
                jQuery(this).val(formatCurrency(jQuery(this).val()))
            });
            jQuery(".slider_price_submit").click(function() {
                var from = formatNumber(jQuery("#amount1").val());
                var to = formatNumber(jQuery("#amount2").val());
                var sliderPriceURL = "http://japana.vn";
                sliderPriceURL = sliderPriceURL.replace("amshopby_slider_from", from);
                sliderPriceURL = sliderPriceURL.replace("amshopby_slider_to", to);
                jQuery(".slider_price_form").attr("action", sliderPriceURL);
                return !0
            });
            jQuery("#min-price").val(jQuery("#slider-range").slider("values", 0));
            jQuery("#max-price").val(jQuery("#slider-range").slider("values", 1));

            function formatCurrency(val) {
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            }

            function formatNumber(val) {
                return val.toString().split('.').join("")
            }

            function isNumberKey(evt) {
                var charCode = (evt.which) ? evt.which : event.keyCode;
                if (charCode == 59 || charCode == 46)
                    return !0;
                if (charCode > 31 && (charCode < 48 || charCode > 57))
                    return !1;
                return !0
            }
        }

        $(document).ready(function() {
            $(document).on("click", "button.toggle", function() {
                if (!$(this).parent().hasClass('active')) {
                    $(this).parent().addClass('active');
                    $(this).find('i').removeClass('fa-angle-down')
                    $(this).find('i').addClass('fa-angle-up')
                } else {
                    $(this).parent().removeClass('active');
                    $(this).find('i').removeClass('fa-angle-up')
                    $(this).find('i').addClass('fa-angle-down')
                }
            })


            $(".submit_click").click(function() {
                $("#filter_form").submit()
            });

            // category.forEach(element => {
            //     $('.submit_click[value="' + element + '"]').prop('checked', true)
            // });

            brand.forEach(element => {
                $('.submit_click[value="' + element + '"]').prop('checked', true)
            });

            // $('li.li-filter-cate').each(element => {
            //     $(element).addClass('abc')
            // });

            $('li.li-filter-cate > a').each(function() {
                if ($(this).attr('href').includes(orders) && orders != '') {
                    $("#order").val(orders);
                    $(this).addClass('active')
                } else if ($(this).attr('href').includes(sales) && sales != '') {
                    $("#sale").val(sales);
                    $(this).addClass('active')
                } else if (orders == '' && sales == '') {
                    $('li.li-filter-cate > a.order-default').addClass('active')
                } else {
                    $(this).removeClass('active')
                }
            });

        });

        const urlSearchParams = new URLSearchParams(window.location.search);
        // var category = urlSearchParams.getAll("category[]");
        var brand = urlSearchParams.getAll("id_brand[]");
        var orders = urlSearchParams.get("order");
        var sales = urlSearchParams.get("sale");
    </script>

@endpush
