@extends('layout.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('public/css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/fotorama.css') }}">

    {!! SEOMeta::generate() !!}
    {!! OpenGraph::generate() !!}
@endpush


@section('content')
    <!-- breadcrumbs -->
    <section id="breadcrumbs" class="container">
        <div class="page-title shop-page-title">
            <div class="row">
                <div class="page-title-inner container col-md-6 col-sm-12 col-12">
                </div>
                <div class="col-md-6 col-sm-12 col-12 text-right">
                    <ul class="page-breadcrumbs"></ul>
                </div>
            </div>
        </div>
    </section>



    <!-- main -->
    <section>
        {{-- @if (count($products) < 1)
            <div class="category-page container">
                <div class="row">
                    <div class="col">
                        <p class="h4 text-center text-danger">Hiện chưa có sản phẩm nào trong danh mục này, C-Mart sẽ sớm cập
                            nhật để phục vụ quý khách</p>
                    </div>
                </div>
            </div>
        @else --}}
        <!-- Trang sản phẩm -->
        <div class="category-page container">
            <div class="row">
                <!-- bên trái -->
                <div id="shopsidebar" class="shop-sidebar col-lg-3 col-md-12 col-sm-12">

                </div>

                <!-- bên phải -->
                <div class="shop-container col-lg-9 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-title-inner">
                                
                                <h3 class="category-title"><span>{{ $category->name }}</span></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $item)
                            @include('proCat.include.product_box', $item)
                        @endforeach
                    </div>
                    <div class="text-center">
                        <div class="nav_pager">
                            {{ $products->appends(request()->input())->links('product.include.pagination') }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
        {{-- @endif --}}
        <!-- Mô tả -->
    </section>
@endsection


@push('scripts')
    {{-- <script src="{{ asset('public/js/danhmucsanpham.js') }}"></script> --}}
    <script src="{{ asset('public/js/category.js') }}"></script>
    <script src="{{ asset('public/js/fotorama.js') }}"></script>

    <script type='text/javascript'>
        function openSidebar() {
            document.getElementById("shopsidebar").style.opacity = "1";
            document.getElementById("shopsidebar").style.zIndex = "1000";
            document.getElementById("shopsidebar").style.visibility = "visible";
            document.body.style.overflow = "hidden";
        }

        function closeSidebar() {
            document.getElementById("shopsidebar").style.opacity = "0";
            document.getElementById("shopsidebar").style.zIndex = "0";
            document.getElementById("shopsidebar").style.visibility = "hidden";
            document.body.style.overflow = "auto";
        }
    </script>
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
                if (txtValue.toUpperCase().includes(filter)) {
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
                var sliderPriceURL = "https://cm.com.vn/";
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

            $('#filter-products').change(function() {
                order($(this).val());
            })

            $(".submit_click").click(function() {
                $("#filter_form").submit()
            });

            brand.forEach(element => {
                $('.submit_click[value="' + element + '"]').prop('checked', true)
            });

            if (orders != '' && orders != null) {
                $("#order").val(orders);
                // $(`li.li-filter-cate > a[href*="${orders}"]`).addClass('active')
                $(`#filter-products > option[value*='${orders}']`).attr('selected', 'selected')
            } else if (sales == '2') {
                $("#sale").val(sales);
                // $(`li.li-filter-cate > a[href*="${sales}"]`).addClass('active')
                $(`#filter-products > option[value*='${sales}']`).attr('selected', 'selected')
            } else {
                // $('li.li-filter-cate > a.order-default').addClass('active')
                $(`#filter-products > option[value='']`).attr('selected', 'selected')
            }
        });

        const urlSearchParams = new URLSearchParams(window.location.search);
        var brand = urlSearchParams.getAll("id_stores[]");
        var orders = urlSearchParams.get("order");
        var sales = urlSearchParams.get("sale");
    </script>
@endpush
