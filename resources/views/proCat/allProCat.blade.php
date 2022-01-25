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
                    @if (isset($proCat))
                        @if ($proCat->parents != null)
                            @if ($proCat->parents->categories != null)
                                <a
                                    href="{{ route('proCat.index', $proCat->parents->categories->slug) }}">{{ $proCat->parents->categories->name }}</a>
                                <span class="divider">/</span>
                            @endif
                            <a
                                href="{{ route('proCat.index', $proCat->parents->slug) }}">{{ $proCat->parents->name }}</a>
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
                                    @foreach ($categories as $item)
                                    @if (count($item->childrenCategories) > 0)
                                        <li class="menu-item menu-item-has-children py-1 has-child menu-border">
                                            @if ($item->linkToCategory != null)
                                                <a href="{{route('proCat.index', $item->linkToCategory->slug)}}">{{ $item->name }}</a>
                                            @else
                                                <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
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
                                                <a href="{{route('proCat.index', $item->linkToCategory->slug)}}">{{ $item->name }}</a>
                                            @else
                                                <a href="{{route('proCat.index', $item->slug)}}">{{ $item->name }}</a>
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
                        @foreach ($categories as $key => $proCat)
                            
                            {{-- BANNER --}}
                            @if ($proCat->feature_img != null)
                            <div class="banner row">
                                <div class="col-12">
                                    <a href="{{route('proCat.index', $proCat->slug)}}" class="box-big-img" title="{{$proCat->name}}">
                                        <img src="{{$proCat->feature_img}}" alt="{{$proCat->name}}">
                                    </a>
                                </div>
                            </div>
                            @endif
                            <div class="row d-flex align-items-center">
                                <div class="col col-12">
                                    <div class="section-title-container px-2">
                                        <p class="section-title section-title-normal">
                                            <b></b>
                                            <span class="section-title-main" style="color:rgb(54, 53, 51); ">
                                                <a href="{{route('proCat.index', $proCat->slug)}}">
                                                    {{$proCat->name}}
                                                </a>
                                            </span>
                                            <b></b>
                                            <a href="{{route('proCat.index', $proCat->slug)}}" class="view-more text-dark text-right">
                                                Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- SẢN PHẨM -->
                            <div class="product-p c">
                                <div class="silder-product-1">
                                    <div class="items">
                                        @foreach ($arrProducts[$key] as $item)
                                            <div class="sp">
                                                <div class="box3item">
                                                    <div class="box-img">
                                                        <a href="{{route('san-pham.show', $item->slug)}}" title="{{$item->name}}" tabindex="0">
                                                            <img src="{{asset($item->feature_img)}}" alt="{{$item->name}}">
                                                        </a>
                                                        @if ($item->productPrice->shock_price != null || $item->productPrice->shock_price != 0)
                                                            @php
                                                                $percent = (1 - ($item->productPrice->shock_price/$item->productPrice->regular_price))*100;
                                                            @endphp
                                                            <div class="block-sale">
                                                                <img alt="{{$item->slug}}" src="{{ asset('public/image/bg-sale.png') }}">
                                                                <span class="sale">-{{round($percent)}}%</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="detail">
                                                        <h3 class="title">
                                                            <a href="{{route('san-pham.show', $item->slug)}}" title="{{$item->name}}" tabindex="0">
                                                                {{$item->name}}</a>
                                                        </h3>
                                                        <ul class="box-price">
                                                            @if ($item->productPrice->shock_price != null || $item->productPrice->shock_price != 0)
                                                            <li class="price">
                                                                <span>{{number_format($item->productPrice->shock_price)}}đ</span>
                                                            </li>
                                                            <li class="old-price">
                                                                <span>{{number_format($item->productPrice->regular_price)}} đ</span>
                                                            </li>
                                                        @else
                                                            <li class="price">
                                                                <span>{{number_format($item->productPrice->shock_price)}}đ</span>
                                                            </li>
                                                        @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                    li[i].getElementsByTagName("a")[0].style.display = "";
                } else {
                    li[i].getElementsByTagName("a")[0].style.display = "none";
                }
            }
            if(filter == '') {
                $('.sub-menu').css({"display": "none", "padding-left": "15px", 'border-left':'1px solid #ddd', 'margin':'0 0 10px 3px'});
                $('.toggle').css('display','inline-block');
                $('li.menu-item').addClass('py-1 menu-border');
            } else {
                $('.toggle').css('display','none');
                $('.sub-menu').css({"display": "block", "padding-left": "0", 'border':'0', 'margin':'0'});
                $('li.menu-item').removeClass('py-1 menu-border');
            }
        }
    </script>

<script type='text/javascript'>
    $(document).ready(function() {

        $(document).on("click", "button.toggle", function(){
            if(!$(this).parent().hasClass('active')) {
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
            responsive: [
                {
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