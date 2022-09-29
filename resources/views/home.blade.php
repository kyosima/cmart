 @extends('layout.master')

 @section('title', 'Trang chủ')

 @push('css')
     <link href="{{ asset('public/css/home.css') }}" rel="stylesheet" type="text/css">
 @endpush

 @section('content')
     <section class="home-pc">

         <div class="container">

             <div class="slider-pc">
                 <div id="demo" class="carousel slide carousel-fade" data-ride="carousel">

                     <div class="carousel-inner">
                         <div class="carousel-item active">
                             <a class="img-pc" href="#" title="Chung tay đánh bay COVID">
                                 <img src="https://s3.cloud.cmctelecom.vn/tinhte1/2018/06/4326778_banner-e-commerce.jpg"
                                     alt="Chung tay đánh bay COVID">
                             </a>
                             <a class="img-mobile" href="#" title="Chung tay đánh bay COVID">
                                 <img alt="Chung tay đánh bay COVID"
                                     src="https://s3.cloud.cmctelecom.vn/tinhte1/2018/06/4326778_banner-e-commerce.jpg">
                             </a>

                         </div>
                         <div class="carousel-item ">
                             <a class="img-pc" href="#" title="Chung tay đánh bay COVID">
                                 <img src="https://s3.cloud.cmctelecom.vn/tinhte1/2018/06/4326778_banner-e-commerce.jpg"
                                     alt="Chung tay đánh bay COVID">
                             </a>
                             <a class="img-mobile" href="#" title="Chung tay đánh bay COVID">
                                 <img alt="Chung tay đánh bay COVID"
                                     src="https://s3.cloud.cmctelecom.vn/tinhte1/2018/06/4326778_banner-e-commerce.jpg">
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
                     {{-- <ul class="carousel-indicators carousel-pc" style="" role="tablist"> --}}
                     <!--<li data-target="#demo" data-slide-to="0" class="active"><a class="pager-item" title="Chung tay đánh bay COVID"> Chung tay đánh bay COVID </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="1"><a class="pager-item" title="Thương Hiệu Tặng Quà 2 Triệu"> Thương Hiệu Tặng Quà 2 Triệu </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="2"><a class="pager-item" title="Top Bán Chạy Mua 2 Tặng 1"> Top Bán Chạy Mua 2 Tặng 1 </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="3" class=""><a class="pager-item" title="Vệ Sinh Nhà Cửa Chỉ Từ 29k"> Vệ Sinh Nhà Cửa Chỉ Từ 29k </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="4"><a class="pager-item" title="Khỏe Đẹp Tại Nhà Sale 52%"> Khỏe Đẹp Tại Nhà Sale 52% </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="5"><a class="pager-item" title="Mẹ và Bé Giảm 30%++"> Mẹ và Bé Giảm 30%++ </a></li>-->
                     <!--<li class="" data-target="#demo" data-slide-to="6"><a class="pager-item" title="Chăm Da Đẹp Dáng Giảm 50%"> Chăm Da Đẹp Dáng Giảm 50% </a></li>-->
                     {{-- </ul> --}}
                 </div>
             </div>
         </div>
         <div class="product">
             <div class="container">
                 @foreach ($categories as $category)
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
                                             @include('include.recursive_product', ['parent' => $category])
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 @endforeach

                 {{-- @foreach ($categories as $proCat)
                    @php
                        $products = $proCat->products->merge($proCat->subproducts)->sortBy(['created_at', 'desc']);
                    @endphp
                    @if (count($products) > 0)
                        <div class="product-block bg-white p-2">
                            <div class="row d-flex align-items-center">
                                <div class="col col-12">
                                    <div class="section-title-container">
                                        <p class="section-title section-title-normal">
                                            <b></b>
                                            <span class="section-title-main" style="color:rgb(54, 53, 51);">
                                                <a href="{{ route('proCat.index', $proCat->slug) }}">
                                                    {{ $proCat->name }}
                                                </a>
                                            </span>
                                            <b></b>
                                            <a href="{{ route('proCat.index', $proCat->slug) }}"
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
                                                @foreach ($products as $item)

                                                    <div class="sp">
                                                        <div class="box3item">
                                                            <div class="box-img">
                                                                <a href="{{ route('san-pham.show', $item->slug) }}"
                                                                    title="{{ $item->name }}" tabindex="0">
                                                                    <img src="{{ asset($item->feature_img) }}"
                                                                        alt="{{ $item->name }}">
                                                                </a>
                                                                {!! getTagSale($item) !!}
                                                            </div>
                                                            <div class="detail">
                                                                <h3 class="title">
                                                                    <a href="{{ route('san-pham.show', $item->slug) }}"
                                                                        title="{{ $item->name }}" tabindex="0">
                                                                        {{ $item->name }}</a>
                                                                </h3>
                                                                <ul class="box-price">
                                                                    <li class="price">
                                                                        <span>{{ formatPriceOfLevel($item) }}</span>
                                                                    </li>
                                                                 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col col-12">
                                    <div class="text-center mt-2">

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach --}}



             </div>

         </div>
         </div>

     </section>

 @endsection

 @push('scripts')
 @endpush
