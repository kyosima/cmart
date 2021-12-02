<!DOCTYPE html>
<html lang="en">


<!-- Pc -->
<header class="header-site" id="top">
    <div id="button"> <i class="fas fa-chevron-up"></i></div>

    <!-- Some content to fill up the page -->

    <div class="bottom-header">
      <div class="container">
        <div class="d-flex flex-lg-row flex-md-row flex-column align-items-center ">
          <div class="logo-header ">
            <h1 title="Siêu thị Nhật Bản Japapa.vn" style="margin: 0;">
              <a href="{{url('/')}}" title="Siêu thị Nhật Bản Japana.vn">
                <img src="{{asset('public/image/logo-c.png')}}" alt="Siêu Thị C-Mart">
              </a>
            </h1>

          </div>

          <div class="search-menu">
            <div class="box-search">
              <form method="GET" name="frm" id="frm" action="{{route('search')}}" enctype="multipart/form-data">
                <div class="form-group">
                  <input data-url="{{route('search.suggest')}}" onkeyup="showSearchSuggest(this)" autocomplete="off" x-webkit-speech_off="" x-webkit-grammar_off="builtin:search" id="search-input" name="keyword" minlength="3"  class="form-control ipt-search" placeholder="Tìm kiếm sản phẩm ..." type="text" value="">
                  <button onclick="" type="submit" class="icon-search"><i class="fas fa-search"></i></button>
                  <div id="showsearch">
                    <ul></ul>
                  </div>
                </div>
              </form>
            </div>
            <div class="menu-demuc d-flex justify-content-between">
              <div class="cate-menu" id="main-menu">
                <a href="{{route('proCat.showAll')}}">
                  <p class="title-cate"> Danh mục sản phẩm <i class="fas fa-bars"></i></p>
                </a>
            
              </div>
                        <div class="tag-top">
                            <ul class="d-flex dv-ht">
                                <li class="text-color-white dropdowncmart">
                                    <a class="text-color-white" href="#">
                                        Dịch Vụ của C-Mart

                                    </a>
                                    <!--Start of Dropdown-->
                                    <ul class="dropdown-navcmart dvcmart">
                                        <li><a href="">Hỗ trợ,Tư vấn thông tin</a></li>
                                        <li><a href="">Đi chợ hộ - Mua sắm hộ, Đặt hàng theo mọi yêu cầu</a></li>
                                        <li><a href="">Gói quà</a></li>
                                        <li><a href="">Chăm sóc Nhà cửa</a></li>
                                        <li><a href="">Chăm sóc Cá nhân</a></li>
                                        <li><a href="">Thanh toán hóa đơn</a></li>
                                        <li><a href="">Kinh tế, Tài chính, Bảo hiểm, Pháp chế</a></li>
                                        <li><a href="">Tin học văn phòng, In ấn, Photocopy, Scan, Fax ...</a></li>
                                        <li><a href="">
                                                Logistics, Giao thông - Vận tải tận nơi, nhanh chóng</a></li>
                                        <li><a href="">Giáo dục - Đào tạo, Văn hóa - Giải trí, Truyền thông - Quảng
                                                cáo</a></li>
                                        <li><a href="">Hành chính - Nội vụ, Lễ tân</a></li>

                                    </ul>
                                </li>

                            </ul>

                        </div>
                        <div class="tag-top">

                            <ul class="d-flex dv-ht">
                                <li class=" text-color-white dropdowncmart">
                                    <a class="text-color-white" href="#">Hỗ Trợ C-A-Z của C-Mart</a>
                                    <!--Start of Dropdown-->
                                    <ul class="dropdown-navcmart">
                                        @php
                                            $pages = App\Models\InfoCompany::get();
                                        @endphp
                                        @foreach ( $pages as $page )
                                            <li><a rel="nofollow" href="{{ route('chinh-sach.show', $page->slug) }}"
                                                title="{{$page->name}}">{{$page->name}}</a></li>
                                        @endforeach
                                        
                                       
                                    </ul>
                                </li>
                                <!-- <li><a class="text-color-white" href="#" title="mặt nạ">Dịch Vụ của C-Mart</a></li> -->
                            </ul>
                        </div>
                    </div>

                </div>

                <nav class="navbar navbar-expand-lg navbar-light">
                    <!-- <div class="item item-custom d-flex ">
            <div class="time-top">
              <i class="fas fa-clock"></i>
            </div>
            <p id="working-time-header"> Giờ làm: 8h - 17h00 (T2 - CN) </p>
               </div> -->

                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ml-auto">
                            <!-- <li class="nav-item">
                <a class="nav-link" href="#">
                  www.facebook.com/japana.sieuthinhat <i class="fab fa-facebook-f"></i></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  (028) 7108 8889 <i class="fas fa-phone-alt"></i></a>
              </li> -->
              @if (Auth::check()) 
             
              <li class="nav-item">
                <div class="btn-group">
                  <a class="btn btn-light text-dark" href="{{url('/xac-thuc-ho-so')}}"><i class="fas fa-user text-dark"></i> {{ Auth::user()->name}}</a>
                  <button type="button" class="btn  btn-light text-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu text-dark">
                    <a class="dropdown-item text-dark" href="{{url('/xac-thuc-ho-so')}}">Thông tin tài khoản</a>
                    <a class="dropdown-item text-dark" href="{{url('/lichsu')}}">Lịch sử đơn hàng</a>
                    <a class="dropdown-item text-dark" href="#">Ví của bạn</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{route('logoutuser')}}">Đăng xuất</a>
                  </div>
                </div>
                
                </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{url('/tai-khoan')}}"> Đăng nhập</a>
              </li>
              <li class="nav-item">
                <a class="nav-link gach" href="{{url('/tai-khoan')}}">Đăng ký</a>
              </li>
              @endif
               

                        </ul>
                    </div>
                </nav>
                <div class="item other-top item-follow-order">
                    <div class="follow-order other">
                        <a rel="nofollow" href="{{ url('/theo-doi-don-hang ') }}" title="Theo dõi đơn hàng">
                            <i class="icon-all-new icon-follow icon-follow-header"></i>
                            <span class="text-color-white">Theo dõi<br>đơn hàng</span>
                        </a>
                    </div>
                    <div class="cart other">
                        <a rel="nofollow" href="{{ url('/gio-hang') }}" title="Giỏ hàng">
                            <i class="icon-all-new icon-cart icon-cart-header"></i>
                            <span class="number-cart"><abbr
                                    class="count-giohang">{{ Cart::instance('shopping')->count() > 0 ? Cart::instance('shopping')->count() : '0' }}</abbr></span>
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <div class=" d-flex flex-column justify-center align-items-center bannercmart" id="gradient">
        <span data-title=" Chào mừng Quý Khách đến với Cửa hàng trực tuyến C-Mart" class="text">
            Chào mừng Quý Khách đến với Cửa hàng trực tuyến C-Mart
        </span>
        <p>Mọi liên hệ nên thực hiện từ Số điện thoại xác nhận giao dịch và đến kênh giao dịch chính thức của C-Mart.
        </p>
    </div>

</header>
<!-- menu-tablet-mobile -->
<header class="header-tablet-mobile">
    <a class="banner-header" href="{{ url('/khuyen-mai') }}" title="Sức khỏe">
        <img src="https://japana.vn/uploads/banner/1629687032-topbar-new-mb.gif" alt="Sức khỏe">
    </a>
    <div class="top-header">
        <div class="container">
            <div class="d-flex justify-content-between  align-items-center pb-2">
                <div class="icon-nav">
                    <a href="#>" data-trigger="navbar_main" class="fas fa-bars"></a>
                </div>
                <div class="logo-nav">
                    <a rel="nofollow" href="{{ url('/') }}" title="Siêu thị Nhật Bản Japana.vn">
                        <img src="{{ asset('public/image/logo-c-v.png') }}" alt="Siêu thị Nhật Bản Japana.vn">
                    </a>
                </div>
                <div class="cart-nav">
                    <a class="number-cart" rel="nofollow" href="{{ url('/gio-hang') }}" title="giỏ hàng">
                        <i class="icon-2020 icon-cart-2020"></i>
                        <span
                            class="count-item count-giohang">{{ Cart::instance('shopping')->count() > 0 ? Cart::instance('shopping')->count() : '0' }}</span>
                    </a>
                </div>
            </div>
            <form method="GET" name="frm" id="frm" action="#" enctype="multipart/form-data" class="form-search">
                <div class="header-search">
                    <i class="fas fa-search"></i>
                    <input class="form-control ipt-search" type="text" placeholder="Tìm kiếm sản phẩm..." id="search"
                        name="search">
                </div>
            </form>
        </div>
    </div>
    <nav id="navbar_main" class="mobile-offcanvas navbar navbar-expand-lg navbar-dark bg-light">
        <div class="custumtab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#list" role="tab" data-toggle="tab">Danh Mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#acc" role="tab" data-toggle="tab">Tài khoản</a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="list">
                    <div class="box-tab">
                        <div class="menu-mobile">
                          @php
                              $categories = App\Models\ProductCategory::where('category_parent', 0)
                                                                    ->where('id', '!=', 1)
                                                                    ->where('status', 1)
                                                                    ->with(['childrenCategories.products', 'products'])
                                                                    ->get();
                          @endphp
                          @foreach ($categories as $item)
                          @if (count($item->childrenCategories) < 1)
                            <div class="item">
                                <h4 class="title">
                                    <a href="{{ route('proCat.index', $item->slug) }}" title="{{$item->name}}">{{$item->name}}</a>
                                </h4>
                            </div>
                          @else
                            <div class="item ">
                              <li>
                                <button class="title collapsed" type="button" data-toggle="collapse"
                                    data-target="#collapse-{{$item->id}}" aria-expanded="false" aria-controls="collapse-{{$item->id}}">
                                    <a href="{{ route('proCat.index', $item->slug) }}" title="{{$item->name}}">{{$item->name}}</a>
                                    <span class="expand-menu">
                                        <i class="fas fas-custom fa-angle-right"></i>
                                    </span>
                                </button>

                                <ul id="collapse-{{$item->id}}" class="collapse sub-nav">
                                    @foreach ($item->childrenCategories as $children)
                                        @include('layout.mobilemenu', ['children' => $children])
                                    @endforeach
                                </ul>
                              </li>
                            </div>
                          @endif
                          @endforeach
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane " id="acc">
                    <div class="box-item">
                        <ul>
                          @if (Auth::check()) 
                          <li><a id="profile-btn" href="{{url('/xac-thuc-ho-so')}}" title="title"><i class="fas fa-user"></i><span>{{ Auth::user()->name}}</span></a></li>
                          @else
                          <li><a id="register-btn" href="{{url('/tai-khoan')}}" title="title"><i class="fas fa-user"></i><span>Đăng ký tài khoản</span></a></li>
                          <li><a id="login-btn" href="{{url('/tai-khoan')}}" title="title"><i class="fas fa-sign-in-alt"></i></i><span>Đăng nhập</span></a></li>
                          @endif
                          <li><a href="{{url('/theo-doi-don-hang ')}}" title="title"><i class="far fa-sticky-note"></i><span>Tra cứu đơn hàng</span></a></li>
                        </ul>
                      </div>
                </div>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane " id="acc">
           
        </div>
    </nav>
    <span class="screen-darken"></span>

</header>
<div class="toolbar2 ">
    <ul class="d-flex justify-content-around  align-items-center">
        <li><a id="home" href="{{ url('/') }}" title="Trang chủ"><i
                    class="icon-2020 icon-home-2020"></i><br><span>Trang chủ</span></a></li>
        <li><a id="goidien" href="{{ url('/') }}" title="phone"><i
                    class="icon-2020 icon-phone-2020"></i><br><span>Gọi điện</span></a></li>
        <li><a id="chatzalo" href="{{ url('/') }}" title="zalo"><i
                    class="icon-2020 icon-zalo-2020"></i><br><span>Chat zalo</span></a></li>
        <li><a id="chatfb" href="{{ url('/') }}" title="facebook"><i
                    class="icon-2020 icon-facebook-2020"></i><br><span>Chat facebook</span></a></li>
    </ul>
</div>



<script type="text/javascript">
    $(document).ready(function() {
        $(document).click(function() {
            // if($(".navbar-collapse").hasClass("in")){
            $('.list-group-menu').collapse('hide');
            // }
        });
        $(document).on('click', '.expand-menu', function(){
          console.log($(this).parent().hasClass('collapsed'));
          if($(this).parent().hasClass('collapsed')) {
            $(this).find("i").removeClass('fa-angle-right')
            $(this).find("i").addClass('fa-angle-down')
          } else {
            $(this).find("i").addClass('fa-angle-right')
            $(this).find("i").removeClass('fa-angle-down')
          }
        })
    });

    function darken_screen(yesno) {
        if (yesno == true) {
            document.querySelector('.screen-darken').classList.add('active');
        } else if (yesno == false) {
            document.querySelector('.screen-darken').classList.remove('active');
        }
    }

    function close_offcanvas() {
        darken_screen(false);
        document.querySelector('.mobile-offcanvas.show').classList.remove('show');
        document.body.classList.remove('offcanvas-active');
    }

    function show_offcanvas(offcanvas_id) {
        darken_screen(true);
        document.getElementById(offcanvas_id).classList.add('show');
        document.body.classList.add('offcanvas-active');
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('[data-trigger]').forEach(function(everyelement) {

            let offcanvas_id = everyelement.getAttribute('data-trigger');

            everyelement.addEventListener('click', function(e) {
                e.preventDefault();
                show_offcanvas(offcanvas_id);

            });
        });

        document.querySelectorAll('.btn-close').forEach(function(everybutton) {

            everybutton.addEventListener('click', function(e) {
                e.preventDefault();
                close_offcanvas();
            });
        });

        document.querySelector('.screen-darken').addEventListener('click', function(event) {
            close_offcanvas();
        });

    });
    var btn = $('#button');

    $(window).scroll(function() {
        if ($(window).scrollTop() > 1800) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });

    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, '1800');
    });


    // DOMContentLoaded  end
</script>
