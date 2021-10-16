<div class="sidebar open">
    <div class="logo-details">
        <div class="logo_name"><h3>C-Mart</h3></div>
        <i class='fa fa-bars' id="btn" ></i>
    </div>

    <ul class="nav-list p-0">
        <li class="dropdown">
            <a href="{{route('admin.index')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name">Dashboard</span>
            </a>
         </li>
         @if(auth()->guard('admin')->user()->can('Xem bài viết', 'Xem danh mục bài viết'))
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Quản lý bài viết <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            <span class="dropdown-content">
                @if(auth()->guard('admin')->user()->can('Xem danh mục bài viết'))
                    <a href="{{route('chuyenmuc-baiviet.index')}}">Chuyên mục bài viết</a>
                @endif
                @if(auth()->guard('admin')->user()->can('Xem bài viết'))
                    <a href="{{route('baiviet.index')}}">Bài viết</a>
                @endif
            </span>
         </li>
         @endif
         @if(auth()->guard('admin')->user()->can('Xem sản phẩm', 'Xem danh mục sản phẩm', 'Xem thương hiệu', 'Xem đơn vị tính'))
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Quản lý sản phẩm <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            <span class="dropdown-content">
                @if(auth()->guard('admin')->user()->can('Xem danh mục sản phẩm'))
                    <a href="{{route('nganh-nhom-hang.index')}}">Ngành/Nhóm hàng</a>
                @endif
                @if(auth()->guard('admin')->user()->can('Xem sản phẩm'))
                <a href="{{route('san-pham.index')}}">Thông tin sản phẩm</a>
                @endif
                @if(auth()->guard('admin')->user()->can('Xem thương hiệu'))
                    <a href="{{route('thuong-hieu.index')}}">Thương hiệu</a>
                @endif
                @if(auth()->guard('admin')->user()->can('Xem đơn vị tính'))
                <a href="{{route('don-vi-tinh.index')}}">Đơn vị tính</a>
                @endif
            </span>
         </li>
         @endif
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Cài đặt khuyến mãi <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            <span class="dropdown-content">
                <a href="cau-hinh-khuyen-mai.html">Cấu hình khuyến mại</a>
                <a href="loai-khuyen-mai.html">Loại khuyến mãi</a>
            </span>
         </li>
         <li class="dropdown">
            <a href="don-hang.html" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Đơn hàng <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
         </li>
         @if (auth()->guard('admin')->user()->can('Xem kho'))
         <li class="dropdown">
            <a href="{{route('warehouse.index')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Tồn kho <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
         </li>
         @endif
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Manager Admin <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            <span class="dropdown-content">
                <a href="{{route('roles.index')}}">Roles</a>
                <a href="{{route('permissions.index')}}">Permission</a>
                <a href="{{route('manager-admin.index')}}">List Admin</a>
            </span>
         </li>
         <li class="dropdown">
            <a href="{{URL::to('/admin/log-viewer/logs')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Follow Action Admin <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
         </li>
         <li class="dropdown">
            <a href="setting.html" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name">Setting</span>
            </a>
         </li>
        <li class="profile">
            <div class="profile-details">
                <img src="./image/header/avatar.jpg" alt="profileImg">
                <div class="name_job">
                <div class="name">Tom E. Riddler</div>
                <div class="job">Science Technology</div>
            </div>
            </div>
            <i class='bx bx-log-out' id="log_out" ></i>
        </li>
    </ul>
</div>