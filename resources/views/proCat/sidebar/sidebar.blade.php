@if (count($subcategory) > 0)
    <aside class="widget danhmuc">
        <h3 class="widget-title mb-1">Danh mục</h3>
        <div class="widget-search">
            <input autocomplete="off" id="input_category_search" type="text" class="form-control input_search"
                placeholder="Tìm kiếm..." onkeyup="searchText('category_search')">
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
                                <a href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                            @endif
                            <button class="toggle" data-id="{{ $item->id }}"
                                data-url="{{ route('proCat.getCatChild') }}" onclick="getCategoryChild(this)">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </button>

                        </li>
                    @else
                        <li class="menu-item menu-border py-1">
                            @if ($item->linkToCategory != null)
                                <a
                                    href="{{ route('proCat.index', $item->linkToCategory->slug) }}">{{ $item->name }}</a>
                            @else
                                <a href="{{ route('proCat.index', $item->slug) }}">{{ $item->name }}</a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </aside>
@endif

<form action="{{ url('/') . '/' . Request::path() }}" method="get" id="filter_form">
    <!-- lọc giá -->
    <aside class="widget">
        <div class="title-box d-lg-none">
            <span>Bộ lọc</span>
            <button type="button" class="close-filter" onclick="closeSidebar()"></button>
        </div>
        <div class="slider-price">
            <h3 class="widget-title">Giá</h3>
            <div class="widget-filter-price">
                <div class="price-range-slider">
                    <div id="slider-range" class="range-bar"></div>
                </div>
            </div>
            <input type="hidden" name="minprice" id="minprice" value="{{ $minPrice }}">
            <input type="hidden" name="beginMinPrice" id="minprice1"
                @if ($beginMinPrice == 0) value="{{ $minPrice }}" @else value="{{ $beginMinPrice }}" @endif>
            <input type="hidden" name="maxprice" id="maxprice" value="{{ $maxPrice }}">
            <input type="hidden" name="endMaxPrice" id="maxprice1"
                @if ($endMaxPrice == 0) value="{{ $maxPrice }}" @else value="{{ $endMaxPrice }}" @endif>
            <div class="widget-price">
                <div class="form-group trai">
                    <p class="title-range">Tối thiểu</p>
                    <div class="box-input">
                        <input type="text" class="form-control slider_price_textbox" id="amount1" disabled="">
                        <span>đ</span>
                    </div>
                </div>
                <div class="form-group phai">
                    <p class="title-range">Tối đa</p>
                    <div class="box-input">
                        <input type="text" class="form-control slider_price_textbox" id="amount2" disabled="">
                        <span>đ</span>
                    </div>
                </div>
            </div>
            <button class="btn-price" type="submit">Áp dụng</button>
        </div>
    </aside>

    <!-- thương hiệu -->
    <aside class="widget thuonghieu">
        <h3 class="widget-title">Cửa hàng</h3>
        <div class="widget-search">
            <input autocomplete="off" id="input_brand_search" type="text" class="form-control input_search"
                placeholder="Tìm kiếm..." onkeyup="searchBrand('brand_search')">
            <button type="button">
                <i class="search-icon"></i>
            </button>
        </div>
        <div class="scrollbar">
            <div id="brand_search" class="widget-product-categories">
                @foreach ($stores_id as $id)
                    @php
                        $store = App\Models\Store::whereId($id)->first();
                    @endphp
                    <div class="check-side">
                        <label class="check-custom">
                            {{ $store->name }}
                            <input name="id_stores[]" class="submit_click" type="checkbox" value="{{ $store->id }}">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="footer-filter d-lg-none">
            <button type="button" class="clear_filter" onclick="closeSidebar()">Xóa lọc</button>
            <button type="submit" class="submit_click">Áp dụng</button>
        </div>
    </aside>
    <input type="hidden" id="order" name="order" value="">
    <input type="hidden" id="sale" name="sale" value="">
</form>
