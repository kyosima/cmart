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
                      <li><a href="">Giáo dục - Đào tạo, Văn hóa - Giải trí, Truyền thông - Quảng cáo</a></li>
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

                      <li><a rel="nofollow" href="{{ route('policy.gt')}}" title="Chính sách vận chuyển">Giới thiệu C-Mart</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.cstt')}}" title="Điều khoản giao dịch">Chính sách thanh toán</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.csgn')}}" title="Phương thức thanh toán">Chính sách giao nhận</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.csdt')}}" title="Thời gian giao hàng">Chính sách đổi trả</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.csbh')}}" title="Chính sách bảo hành">Chính sách bảo hành</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.qddk')}}" title="Chính sách bảo mật">Quy định bán hàng</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.khdb')}}" title="Chính sách đổi trả và hoàn tiền">Khách hàng đặc biệt</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.dt')}}" title="Hướng dẫn mua hàng">Đối tác</a></li>
                      <li><a rel="nofollow" href="{{ route('policy.hddh')}}" title="Quyền lợi VIP">Hướng dẫn đặt hàng</a></li>
                     
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
                  <a class="btn btn-light text-dark" href="{{url('/xac-thuc-ho-so')}}"><i class="fas fa-user text-dark"></i> {{ Auth::user()->phone}}</a>
                  <button type="button" class="btn  btn-light text-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu text-dark">
                    <a class="dropdown-item text-dark" href="{{url('/xac-thuc-ho-so')}}">Thông tin tài khoản</a>
                    <a class="dropdown-item text-dark" href="{{url('/lichsu')}}">Lịch sử đơn hàng</a>
                    <a class="dropdown-item text-dark" href="{{url('/cpoint')}}">Lịch sử nhận point</a>
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
              <a rel="nofollow" href="{{url('/theo-doi-don-hang ')}}" title="Theo dõi đơn hàng">
                <i class="icon-all-new icon-follow icon-follow-header"></i>
                <span class="text-color-white">Theo dõi<br>đơn hàng</span>
              </a>
            </div>
            <div class="cart other">
              <a rel="nofollow" href="{{url('/gio-hang')}}" title="Giỏ hàng">
                <i class="icon-all-new icon-cart icon-cart-header"></i>
                <span class="number-cart"><abbr class="count-giohang">{{ Cart::instance('shopping')->count() > 0 ? Cart::instance('shopping')->count() : '0' }}</abbr></span>
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
      <p>Mọi liên hệ nên thực hiện từ Số điện thoại xác nhận giao dịch và đến kênh giao dịch chính thức của C-Mart.</p>
    </div>

  </header>
  <!-- menu-tablet-mobile -->
  <header class="header-tablet-mobile">
    <a class="banner-header" href="{{url('/khuyen-mai')}}" title="Sức khỏe">
      <img src="https://japana.vn/uploads/banner/1629687032-topbar-new-mb.gif" alt="Sức khỏe">
    </a>
    <div class="top-header">
      <div class="container">
        <div class="d-flex justify-content-between  align-items-center pb-2">
          <div class="icon-nav">
            <a href="#>" data-trigger="navbar_main" class="fas fa-bars"></a>


          </div>
          <div class="logo-nav">
            <a rel="nofollow" href="{{url('/')}}" title="Siêu thị Nhật Bản Japana.vn">
              <img src="{{asset('public/image/logo-c-v.png')}}" alt="Siêu thị Nhật Bản Japana.vn">
            </a>

          </div>
          <div class="cart-nav">

            <a class="number-cart" rel="nofollow" href="{{url('/gio-hang')}}" title="giỏ hàng">
              <i class="icon-2020 icon-cart-2020"></i>
              <span class="count-item count-giohang">{{ Cart::instance('shopping')->count() > 0 ? Cart::instance('shopping')->count() : '0' }}</span>
            </a>

          </div>
        </div>
        <form method="GET" name="frm" id="frm" action="#" enctype="multipart/form-data" class="form-search">
          <div class="header-search">

            <i class="fas fa-search"></i>
            <input class="form-control ipt-search" type="text" placeholder="Tìm kiếm sản phẩm..." id="search" name="search">
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
                <div class="item">
                  <h4 class="title">
                    <a href="#" title="Sản Phẩm Bán Chạy">
                      <img src="https://japana.vn/uploads/category/1612510003-1557111695-asset-10.png" alt="Sản Phẩm Bán Chạy">
                      Sản Phẩm Bán Chạy </a>
                    <span class="expand-menu">

                    </span>
                  </h4>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    <a href="#" title="Collagen">
                      <img src="https://japana.vn/uploads/category/1545300977-collagen.png" alt="Collagen">
                      Collagen </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>

                  <ul id="collapse1" class="collapse sub-nav">
                    <li>
                      <a title="Nước Uống Collagen" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nước Uống Collagen </a>
                    </li>
                    <li>
                      <a title="Collagen Dạng Bột - Thạch Ăn" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Collagen Dạng Bột - Thạch Ăn </a>
                    </li>
                    <li>
                      <a title="Collagen Dạng Viên Uống" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Collagen Dạng Viên Uống </a>
                    </li>
                  </ul>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="flase" aria-controls="collapse3">
                    <a href="#" title="Thực Phẩm Làm Đẹp">
                      <img src="https://japana.vn/uploads/category/1536632955-icon2.png" alt="Thực Phẩm Làm Đẹp">
                      Thực Phẩm Làm Đẹp </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>

                  <ul id="collapse3" class="collapse sub-nav">
                    <li>
                      <a title="Trắng Da - Trị Nám" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Trắng Da - Trị Nám </a>
                    </li>
                    <li>
                      <a title="Nhau Thai - Placenta" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nhau Thai - Placenta </a>
                    </li>
                    <li>
                      <a title="Giấm Đen - Nghệ Đen - Tỏi Đen" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Giấm Đen - Nghệ Đen - Tỏi Đen </a>
                    </li>
                    <li>
                      <a title="Sữa Ong Chúa - Chống Lão Hóa" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sữa Ong Chúa - Chống Lão Hóa </a>
                    </li>
                  </ul>
                </div>
                <div class="item">
                  <h4 class="title">
                    <a href="#" title="Giảm cân">
                      <img src="https://japana.vn/uploads/category/1536632988-icon4.png" alt="Giảm cân">
                      Giảm cân </a>
                    <span class="expand-menu">

                    </span>
                  </h4>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <a href="#" title="Chăm Sóc Sức Khỏe">
                      <img src="https://japana.vn/uploads/category/1536633007-icon5.png" alt="Chăm Sóc Sức Khỏe">
                      Chăm Sóc Sức Khỏe </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>

                  <ul id="collapse4" class="collapse sub-nav">
                    <li>
                      <a title="Tảo Xoắn" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Tảo Xoắn </a>
                    </li>
                    <li>
                      <a title="Nấm Linh Chi" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nấm Linh Chi </a>
                    </li>
                    <li>
                      <a title="Hỗ Trợ Điều Trị Ung Thư" href="#/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hỗ Trợ Điều Trị Ung Thư </a>
                    </li>
                    <li>
                      <a title="Hỗ Trợ Xương Khớp" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hỗ Trợ Xương Khớp </a>
                    </li>
                    <li>
                      <a title="Hỗ Trợ Điều Trị Tai Biến" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hỗ Trợ Điều Trị Tai Biến </a>
                    </li>
                    <li>
                      <a title="Hỗ Trợ Não &amp; Trí Nhớ" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hỗ Trợ Não &amp; Trí Nhớ </a>
                    </li>
                    <li>
                      <a title="Thải Độc Gan" href=#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Thải Độc Gan </a>
                    </li>
                    <li>
                      <a title="Sức Khỏe &amp; Sinh Lý Nam" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sức Khỏe &amp; Sinh Lý Nam </a>
                    </li>
                    <li>
                      <a title="Sức Khỏe &amp; Sinh Lý Nữ" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sức Khỏe &amp; Sinh Lý Nữ </a>
                    </li>
                    <li>
                      <a title="Chăm Sóc Mắt" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chăm Sóc Mắt </a>
                    </li>
                    <li>
                      <a title="Chăm Sóc Hệ Tiêu Hóa" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chăm Sóc Hệ Tiêu Hóa </a>
                    </li>
                    <li>
                      <a title="Vitamin Tổng Hợp" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Vitamin Tổng Hợp </a>
                    </li>
                    <li>
                      <a title="Điều Trị Khác" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Điều Trị Khác </a>
                    </li>
                  </ul>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                    <a href="#" title="Trang Điểm">
                      <img src="https://japana.vn/uploads/category/1539922102-Make-up.png" alt="Trang Điểm">
                      Trang Điểm </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                  </button>

                  <ul id="collapse5" class="collapse sub-nav">
                    <li>
                      <a title="Phấn Nền - Kem Nền" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Phấn Nền - Kem Nền </a>
                    </li>
                    <li>
                      <a title="Son Môi" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Son Môi </a>
                    </li>
                    <li>
                      <a title="Tẩy Trang" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Tẩy Trang </a>
                    </li>
                    <li>
                      <a title="Trang Điểm Mắt - Mi - Mày" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Trang Điểm Mắt - Mi - Mày </a>
                    </li>

                  </ul>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
                    <a href="#" title="Chăm Sóc Da Mặt">
                      <img src="https://japana.vn/uploads/category/1536633054-icon7.png" alt="Chăm Sóc Da Mặt">
                      Chăm Sóc Da Mặt </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                  </button>

                  <ul id="collapse6" class="collapse sub-nav">

                    <li>
                      <a title="Dưỡng Trắng" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Dưỡng Trắng </a>
                    </li>
                    <li>
                      <a title="Chống Lão Hóa" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chống Lão Hóa </a>
                    </li>
                    <li>
                      <a title="Dưỡng Ẩm" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Dưỡng Ẩm </a>
                    </li>
                    <li>
                      <a title="Chống Nắng" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chống Nắng </a>
                    </li>
                    <li>
                      <a title="Đặc Trị Nám" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Đặc Trị Nám </a>
                    </li>
                    <li>
                      <a title="Đặc Trị Mụn" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Đặc Trị Mụn </a>
                    </li>
                    <li>
                      <a title="Serum - Tinh Chất" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Serum - Tinh Chất </a>
                    </li>
                    <li>
                      <a title="Kem Dưỡng Mắt" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Kem Dưỡng Mắt </a>
                    </li>
                    <li>
                      <a title="Sữa Rửa Mặt" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sữa Rửa Mặt </a>
                    </li>
                    <li>
                      <a title="Mặt Nạ" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Mặt Nạ </a>
                    </li>
                    <li>
                      <a title="Nước Hoa Hồng &amp; Cân Bằng" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nước Hoa Hồng &amp; Cân Bằng </a>
                    </li>
                    <li>
                      <a title="Bộ Chăm Sóc Da Mặt" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bộ Chăm Sóc Da Mặt </a>
                    </li>
                    <li>
                      <a title="Kem Dưỡng Da Mặt" href="#" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Kem Dưỡng Da Mặt </a>
                    </li>

                  </ul>
                </div>
                <div class="item ">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                    <a href="#" title="Chăm Sóc Cơ Thể">
                      <img src="https://japana.vn/uploads/category/1536633071-icon8.png" alt="Chăm Sóc Cơ Thể">
                      Chăm Sóc Cơ Thể </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>

                  <ul id="collapse7" class="collapse sub-nav">


                    <li>
                      <a title="Chăm Sóc Tóc" href="https://japana.vn/dau-goi-dau-xa/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chăm Sóc Tóc </a>
                    </li>
                    <li>
                      <a title="Sữa Tắm" href="https://japana.vn/sua-tam/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sữa Tắm </a>
                    </li>
                    <li>
                      <a title="Dưỡng Thể" href="https://japana.vn/kem-duong-toan-than/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Dưỡng Thể </a>
                    </li>
                    <li>
                      <a title="Vệ Sinh Cá Nhân" href="https://japana.vn/cham-soc-ve-sinh-ca-nhan/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Vệ Sinh Cá Nhân </a>
                    </li>
                    <li>
                      <a title="Tẩy Tế Bào Chết" href="https://japana.vn/tay-te-bao-chet/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Tẩy Tế Bào Chết </a>
                    </li>
                    <li>
                      <a title="Bộ Chăm Sóc Cơ Thể" href="https://japana.vn/combo-san-pham/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bộ Chăm Sóc Cơ Thể </a>
                    </li>
                  </ul>
                </div>
                <div class="item">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">

                    <a href="#" title="Mẹ &amp; Bé">
                      <img src="https://japana.vn/uploads/category/1536633117-icon9.png" alt="Mẹ &amp; Bé">
                      Mẹ &amp; Bé </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>
                  <ul id="collapse8" class="collapse sub-nav">
                    <li>
                      <a title="Sữa Nhật" href="https://japana.vn/sua-nhat/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sữa Nhật </a>
                    </li>
                    <li>
                      <a title="Bỉm - Tã Nhật" href="https://japana.vn/bim-ta-cho-be/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bỉm - Tã Nhật </a>
                    </li>
                    <li>
                      <a title="Bình Sữa - Phụ Kiện" href="https://japana.vn/binh-sua-va-phu-kien/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bình Sữa - Phụ Kiện </a>
                    </li>
                    <li>
                      <a title="Ngũ Cốc Nhật Bản" href="https://japana.vn/ngu-coc-dinh-duong-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Ngũ Cốc Nhật Bản </a>
                    </li>
                    <li>
                      <a title="Thực Phẩm Ăn Dặm" href="https://japana.vn/sua-va-thuc-pham-cho-be/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Thực Phẩm Ăn Dặm </a>
                    </li>
                    <li>
                      <a title="Sức Khỏe Cho Bé" href="https://japana.vn/be-khoe/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Sức Khỏe Cho Bé </a>
                    </li>
                    <li>
                      <a title="Thực Phẩm Tăng Chiều Cao" href="https://japana.vn/thuoc-tang-chieu-cao/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Thực Phẩm Tăng Chiều Cao </a>
                    </li>
                    <li>
                      <a title="Chăm Sóc Vệ Sinh" href="https://japana.vn/cham-soc-ve-sinh-cho-be/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Chăm Sóc Vệ Sinh </a>
                    </li>
                    <li>
                      <a title="Cặp Chống Lưng Gù" href="https://japana.vn/cap-chong-lung-gu-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Cặp Chống Lưng Gù </a>
                    </li>
                    <li>
                      <a title="Dành Cho Mẹ" href="https://japana.vn/danh-cho-me/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Dành Cho Mẹ </a>
                    </li>
                  </ul>
                </div>
                <div class="item">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
                    <a href="#" title="Nhà Cửa &amp; Đời Sống">
                      <img src="https://japana.vn/uploads/category/1536633130-icon10.png" alt="Nhà Cửa &amp; Đời Sống">
                      Nhà Cửa &amp; Đời Sống </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>
                  <ul id="collapse9" class="collapse sub-nav">
                    <li>
                      <a title="Bình Giữ Nhiệt" href="https://japana.vn/binh-giu-nhiet/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bình Giữ Nhiệt </a>
                    </li>
                    <li>
                      <a title="Hộp Đựng Thức Ăn" href="https://japana.vn/hop-dung-thuc-an/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hộp Đựng Thức Ăn </a>
                    </li>
                    <li>
                      <a title="Nồi Cơm Điện Nhật Bản" href="https://japana.vn/noi-com-dien-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nồi Cơm Điện Nhật Bản </a>
                    </li>
                    <li>
                      <a title="Nồi Ủ Nhật Bản" href="https://japana.vn/noi-u-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nồi Ủ Nhật Bản </a>
                    </li>
                    <li>
                      <a title="Bình Thủy - Phích Nước" href="https://japana.vn/binh-thuy-phich-nuoc/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bình Thủy - Phích Nước </a>
                    </li>
                    <li>
                      <a title="Máy Sấy Tóc" href="https://japana.vn/may-say-toc/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Máy Sấy Tóc </a>
                    </li>
                    <li>
                      <a title="Bàn Ủi" href="https://japana.vn/ban-ui/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bàn Ủi </a>
                    </li>
                    <li>
                      <a title="Máy Xay Đa Năng" href="https://japana.vn/may-xay-da-nang/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Máy Xay Đa Năng </a>
                    </li>
                    <li>
                      <a title="Lò Vi Sóng" href="https://japana.vn/lo-vi-song/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Lò Vi Sóng </a>
                    </li>
                    <li>
                      <a title="Máy Hút Bụi" href="https://japana.vn/may-hut-bui/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Máy Hút Bụi </a>
                    </li>
                    <li>
                      <a title="Giặt Ủi &amp; Vệ Sinh Nhà Cửa" href="https://japana.vn/giat-ui-va-ve-sinh-nha-cua/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Giặt Ủi &amp; Vệ Sinh Nhà Cửa </a>
                    </li>
                    <li>
                      <a title="Máy Lọc Nước" href="https://japana.vn/may-loc-nuoc/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Máy Lọc Nước </a>
                    </li>
                    <li>
                      <a title="Dụng Cụ &amp; Thiết Bị Gia Đình" href="https://japana.vn/dung-cu-thiet-bi-gia-dinh/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Dụng Cụ &amp; Thiết Bị Gia Đình </a>
                    </li>
                    <li>
                      <a title="Nội Thất" href="https://japana.vn/noi-that-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Nội Thất </a>
                    </li>
                  </ul>
                </div>
                <div class="item">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
                    <a href="https://japana.vn/thuc-pham-nhat-ban/" title="Thực Phẩm Nhật Bản">
                      <img src="https://japana.vn/uploads/category/1536633142-icon11.png" alt="Thực Phẩm Nhật Bản">
                      Thực Phẩm Nhật Bản </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>
                  <ul id="collapse10" class="collapse sub-nav">
                    <li>
                      <a title="Bánh Kẹo" href="https://japana.vn/banh-keo-rong-bien/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Bánh Kẹo </a>
                    </li>
                    <li>
                      <a title="Trà Nhật Bản" href="https://japana.vn/tra-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Trà Nhật Bản </a>
                    </li>
                    <li>
                      <a title="Hộp Quà Tết" href="https://japana.vn/gio-qua-tet/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Hộp Quà Tết </a>
                    </li>
                    <li>
                      <a title="Rượu Nhật Bản" href="https://japana.vn/ruou-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Rượu Nhật Bản </a>
                    </li>
                    <li>
                      <a title="Đồ Uống &amp; Giải Khát" href="https://japana.vn/do-uong-giai-khat/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Đồ Uống &amp; Giải Khát </a>
                    </li>
                    <li>
                      <a title="Thực Phẩm Khô" href="https://japana.vn/thuc-pham-kho/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Thực Phẩm Khô </a>
                    </li>
                    <li>
                      <a title="Gia Vị" href="https://japana.vn/gia-vi-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Gia Vị </a>
                    </li>
                  </ul>
                </div>
                <div class="item">
                  <button class="title" type="button" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
                    <a href="#" title="Hương Thơm Nhật Bản">
                      <img src="https://japana.vn/uploads/category/1574674189-huong-thom-nhat-ban.png" alt="Hương Thơm Nhật Bản">
                      Hương Thơm Nhật Bản </a>
                    <span class="expand-menu">
                      <i class="fas fa-angle-right"></i>
                    </span>
                  </button>
                  <ul id="collapse11" class="collapse sub-nav">
                    <li>
                      <a title="Trầm Hương" href="https://japana.vn/tram-huong-nhat-ban/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Trầm Hương </a>
                    </li>
                    <li>
                      <a title="Đầu Đốt - Giá Đỡ" href="https://japana.vn/dau-dot-gia-do/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Đầu Đốt - Giá Đỡ </a>
                    </li>
                    <li>
                      <a title="Card - Sáp Thơm Ô tô" href="https://japana.vn/card-sap-thom-o-to/" class="sub-nav-item">
                        <i class="icon-m icon-child-m"></i>
                        Card - Sáp Thơm Ô tô </a>
                    </li>
                  </ul>
                </div>
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
    </nav>
    <span class="screen-darken"></span>

  </header>
  <div class="toolbar2 ">
    <ul class="d-flex justify-content-around  align-items-center">
      <li><a id="home" href="{{url('/')}}" title="Trang chủ"><i class="icon-2020 icon-home-2020"></i><br><span>Trang chủ</span></a></li>
      <li><a id="goidien" href="{{url('/')}}" title="phone"><i class="icon-2020 icon-phone-2020"></i><br><span>Gọi điện</span></a></li>
      <li><a id="chatzalo" href="{{url('/')}}" title="zalo"><i class="icon-2020 icon-zalo-2020"></i><br><span>Chat zalo</span></a></li>
      <li><a id="chatfb" href="{{url('/')}}" title="facebook"><i class="icon-2020 icon-facebook-2020"></i><br><span>Chat facebook</span></a></li>
    </ul>
  </div>



  <script type="text/javascript">
    $(document).ready(function() {
      $(document).click(function() {
        // if($(".navbar-collapse").hasClass("in")){
        $('.list-group-menu').collapse('hide');
        // }
      });
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