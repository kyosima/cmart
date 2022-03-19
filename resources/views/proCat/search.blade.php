@extends('layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/danhmucsanpham.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/pagination.css') }}">

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
                    <span class="active">Tìm kiếm sản phẩm</span>

                </nav>
            </div>
        </div>
    </section>

    <!-- main -->
    <section>
        <!-- Trang sản phẩm -->
        <div class="category-page container">
            <div class="row">
                <!-- bên trái -->
                <div id="shopsidebar" class="shop-sidebar col-12 col-md-3">
                    <!-- danh mục -->
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
                        <div class="">
                            <div id="category_search" class="widget-product-categories">
                                <ul class="check-side category-menu">
                                    @foreach ($categories as $item)
                                        @if (count($item->childrenCategories) > 0)
                                            <li class="menu-item menu-item-has-children py-1 has-child">
                                                <a href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                                                <button class="toggle">
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </button>
                                                @include('proCat.danhmuc-sidebar', [
                                                'child_categories' => $item->childrenCategories,
                                                ])
                                            </li>
                                        @else
                                            <li class="menu-item py-1">
                                                <a href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
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
                        </div>
                    </aside>
                </div>

                <!-- bên phải -->
                <div class="shop-container col-lg-9 col-md-12 col-sm-12">
                    <div class="shop-container-inner">
                        <!-- TITLE -->
                        @if (count($products) > 0)
                            <h2 class="title-filter d-none d-lg-block text-uppercase"><span>
                                    Có ({{ count($products) }}
                                    sản
                                    phẩm) với từ khóa <b>{{ $keyword }}</b>

                                </span></h2>
                        @else
                            <h2 class="title-filter d-none d-lg-block text-center"><span>
                                    Không tìm thấy sản phẩm.<br /> Quý Khách
                                    Hàng vui lòng liên hệ đến các kênh kết nối chính thức của C-Mart để được hỗ trợ ngay và
                                    luôn.
                                </span></h2>
                        @endif
                        <!-- Bộ lọc -->
                        {{-- <div class="filter-cate">
                            <ul>
                                <li class="d-lg-inline d-none">Sắp xếp theo:</li>
                                <li class="li-filter-cate">
                                    <a href="javascript:order();" class="active">Mặc định</a>
                                </li>
                                <li class="li-filter-cate">
                                    <a href="javascript:order('regular_price desc');" class="">Giá cao</a>
                                </li>
                                <li class="li-filter-cate">
                                    <a href="javascript:order('regular_price asc');" class="">Giá thấp</a>
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
                        </div> --}}

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
                                            {!! getTagSale($item) !!}

                                        </div>
                                        <div class="box-text col-lg-12 col-md-8 col-8">
                                            <div class="title-wrapper">
                                                <a href="{{ route('san-pham.show', $item->slug) }}">
                                                    <p class="product-title">{{ $item->name }}</p>
                                                </a>
                                            </div>
                                            <div class="price-wrapper">
                                                <span class="price">
                                                    <span class="amount">
                                                        {{ formatPriceOfLevel($item) }}
                                                    </span>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        {{-- <div class="text-center">
                            <div class="nav_pager">
                                {{ $products->links('product.include.pagination') }}
                            </div>
                        </div> --}}
                    </div>
                </div>
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
                $('.toggle').css('display', 'block');
            } else {
                $('.toggle').css('display', 'none');
                $('.sub-menu').css({
                    "display": "block",
                    "padding-left": "0",
                    'border': '0',
                    'margin': '0'
                });
            }
        }
    </script>


    <script src="{{ asset('public/js/danhmucsanpham.js') }}"></script>
@endpush
