<div class="shop-container-inner">
    <!-- TITLE -->
    <h2 class="title-filter d-none d-lg-block">{{ $proCat->name }}
        <span>(tổng cộng {{ count($products) }} sản phẩm)</span>
    </h2>
    <!-- Bộ lọc -->
    <div class="filter-cate">
        <p class="d-lg-inline d-none">Sắp xếp theo:</p>
        <select id="filter-products" class="form-control form-control-sm ms-2 d-lg-inline"
            style="max-width: 200px">
            <option value="" selected>Mặc định</option>
            <option value="name asc">A-Z</option>
            <option value="name desc">Z-A</option>
            <option value="regular_price asc">Giá tăng dần</option>
            <option value="regular_price desc">Giá giảm dần</option>
            {{-- <option value="mpoint asc">M tăng dần</option> --}}
            <option value="mpoint desc">M giảm dần</option>
            {{-- <option value="cpoint asc">C tăng dần</option> --}}
            <option value="cpoint desc">C giảm dần</option>
        </select>
        <button onclick="openSidebar()" class="form-control form-control-sm d-lg-none d-xl-none"
            style="width: fit-content;">Bộ lọc</button>
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

                    </div>
                    <div class="box-text col-lg-12 col-md-8 col-8">
                        <div class="title-wrapper">
                            <a href="{{ route('san-pham.show', $item->slug) }}">
                                <p class="product-title">{{ $item->name }}</p>
                            </a>
                        </div>
                        <div class="price-wrapper">
                            <span class="price">
                                <span
                                    class="amount">{{ formatPriceOfLevelCate($item->productPrice()->first()) }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="text-center">
        <div class="nav_pager">
            {{ $products->appends(request()->input())->links('product.include.pagination') }}
        </div>
    </div>

</div>