@extends('layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/category.css') }}">
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
                    <a href="{{ url('/') }}">Trang chủ</a>
                    <span class="divider">/</span>
                    @if (isset($proCat))
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
                    @else
                        <span class="active">Tất cả danh mục sản phẩm</span>
                    @endif
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
                                    @foreach ($categories_root as $item)
                                        @if (count($item->childrenCategories) > 0)
                                            <li class="menu-item menu-item-has-children py-1 has-child menu-border">
                                                @if ($item->linkToCategory != null)
                                                    <a
                                                        href="{{ route('proCat.index', $item->linkToCategory->slug) }}">{{ $item->name }}</a>
                                                @else
                                                    <a
                                                        href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                                                @endif
                                                <button class="toggle" data-id="{{ $item->id }}"
                                                    data-url="{{ route('proCat.getCatChild') }}"
                                                    onclick="getCategoryChild(this)">
                                                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                                                </button>
                                                {{-- @include('proCat.danhmuc-sidebar', [
                                                'child_categories' => $item->childrenCategories,
                                            ]) --}}
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
                        </div>
                    </aside>
                </div>

                <!-- bên phải -->
                <div class="shop-container col-lg-9 col-md-12 col-sm-12">
                    <div class="shop-container-inner">
                        @foreach ($categories as $category)
                            @if ($category->feature_img != null)
                                <div class="banner row">
                                    <div class="col-12">
                                        <a href="{{ route('proCat.index', $category->slug) }}" class="box-big-img"
                                            title="{{ $category->name }}">
                                            <img src="{{ $category->feature_img }}" alt="{{ $category->name }}">
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="product-block bg-white p-2">
                                <div class="row d-flex align-items-center">
                                    <div class="col col-12">
                                        <div class="section-title-container">
                                            <p class="section-title section-title-normal">
                                                <span class="section-title-main" style="color:rgb(54, 53, 51);">
                                                    <a
                                                        href="{{ isset($category->slug) ? route('proCat.index', $category->slug) : '' }}">
                                                        {{ isset($category->name) ? $category->name : '' }}
                                                    </a>
                                                </span>
                                                <a href="{{ isset($category->slug) ? route('proCat.index', $category->slug) : '' }}"
                                                    class="view-more  text-right">
                                                    Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col col-12 col-lg-12">
                                        <div class="product-p c">
                                            <div class="silder-product-1">
                                                <div class="items">
                                                    @include('include.recursive_product', [
                                                        'parent' => $category,
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                       
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
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
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
    </script>

    <script type='text/javascript'>
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

            $('.items').slick({
                infinite: true,
                slidesToShow: 5,
                slidesToScroll: 3,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 3,
                            infinite: true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    }
                ]
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

    {{-- <script src="{{ asset('public/js/danhmucsanpham.js') }}"></script> --}}
@endpush
