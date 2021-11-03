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
         @if(auth()->guard('admin')->user()->can('Xem DS đơn hàng'))
         <li class="dropdown">
            <a href="{{route('order.index')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Đơn hàng <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
         </li>
         @endif
         @if (auth()->guard('admin')->user()->can('Xem kho'))
         <li class="dropdown">
            <a href="{{route('warehouse.index')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Tồn kho <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
         </li>
         @endif
         @role('Boss', 'admin')
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Quản lý Admin <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            <span class="dropdown-content">
                <a href="{{route('roles.index')}}">Vai trò</a>
                <a href="{{route('permissions.index')}}">Quyền</a>
                <a href="{{route('manager-admin.index')}}">DS Admin</a>
                <a href="{{URL::to('/admin/log-viewer/logs')}}">Theo dõi Admin</a>
            </span>
         </li>
         @endrole
         @if (auth()->guard('admin')->user()->can('QL thông tin'))
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Thông tin <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
            <span class="dropdown-content">
                <a href="{{route('info-company.index')}}">Trang</a>
            </span>
            @endif
         </li>
         <li class="dropdown">
            <a href="#" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name w-100 align-items-center d-flex">Quản lý user <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
            <span class="dropdown-content">
                <a href="{{url('admin/danh-sach-user')}}">Danh sách user</a>
            </span>
            @endif
         </li>
         @endif
         @hasanyrole('Manager|Boss', 'admin')
         <li class="dropdown">
            <a href="{{route('setting.index')}}" class="dropbtn">
             <i class="fa fa-frown-o" aria-hidden="true"></i>
             <span class="links_name">Cài đặt</span>
            </a>
         </li>
         @endhasanyrole
        <li class="profile">
            <div class="profile-details">
                <img src="https://ict-imgs.vgcloud.vn/2020/09/01/19/huong-dan-tao-facebook-avatar.jpg" alt="profileImg">
                <div class="name_job">
                <div class="name">{{auth()->guard('admin')->user()->name}}</div>
                <div class="job">{{auth()->guard('admin')->user()->getRoleNames()[0]}}</div>
            </div>
            </div>
            <i class='bx bx-log-out' id="log_out" data-bs-toggle="modal" data-bs-target="#modalLogout"></i>
        </li>
    </ul>
</div>
<div id="modalLogout" class="modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Đăng xuất</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Bạn có muốn đăng xuất ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <a href="{{route('logout')}}" class="btn btn-danger">Đăng xuất</a>
      </div>
    </div>
  </div>
</div>