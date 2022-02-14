<div class="sidebar open">
    <div class="logo-details">
        <div class="logo_name">
            <h3>C-Mart</h3>
        </div>
        <i class='fa fa-bars' id="btn"></i>
    </div>

    <ul class="nav-list p-0">
        {{-- <li class="dropdown">
            <a href="{{ route('admin.index') }}" class="dropbtn">
                <i class="fa fa-tachometer-alt"></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li> --}}
        @if (auth()->guard('admin')->user()->can('Xem DS đơn hàng'))
            <li class="dropdown">
                <a href="{{ route('order.index') }}" class="dropbtn">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="links_name w-100 align-items-center d-flex">Đơn hàng</span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Xem cửa hàng'))
            <li class="dropdown">
                <a href="{{ route('store.index') }}" class="dropbtn">
                    <i class="fa fa-laptop-house"></i>
                    <span class="links_name w-100 align-items-center d-flex">Kho hàng/Cửa hàng <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Xem sản phẩm', 'Xem danh mục sản phẩm', 'Xem thương hiệu', 'Xem đơn vị tính'))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fa fa-cube"></i>
                    <span class="links_name w-100 align-items-center d-flex">Quản lý sản phẩm <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    @if (auth()->guard('admin')->user()->can('Xem danh mục sản phẩm'))
                        <a href="{{ route('nganh-nhom-hang.index') }}">Ngành/Nhóm hàng</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Xem sản phẩm'))
                        <a href="{{ route('san-pham.index') }}">Thông tin sản phẩm</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Xem HTTT'))
                        <a href="{{ route('payment.index') }}">Hình thức thanh toán</a>
                    @endif
                </span>
            </li>
        @endif
        <li class="dropdown">
            <a href="{{ route('coupon.index') }}" class="dropbtn">
                <i class="fa fa-tag"></i>
                <span class="links_name w-100 align-items-center d-flex">Quản lý mã ưu đãi</span>
            </a>

        </li>
        <li class="dropdown">
            <a href="#" class="dropbtn">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span class="links_name w-100 align-items-center d-flex">Quản lý khách hàng <i
                        class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
            <span class="dropdown-content">
                <a href="{{url('admin/danh-sach-user')}}">Danh sách khách hàng</a>
                <a href="{{route('tongdiemuser')}}">Danh sách điểm khách hàng</a>
                <a href="{{route('chuyendiem')}}">Chuyển điểm</a>
                <a href="{{route('napC')}}">Nạp điểm</a>
            </span>
            @endif
         </li>
         <li class="dropdown">
            <a href="#" class="dropbtn">
            <i class="fas fa-history"></i>
             <span class="links_name w-100 align-items-center d-flex">Lịch sử CPoint <i class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
            </a>
            @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
            <span class="dropdown-content">
                <a href="{{route('lichsuchuyenkhoan')}}">Lịch sử chuyển khoản</a>
                <a href="{{route('lichsutichluy')}}">Lịch sử tích luỹ</a>
                <a href="{{route('lichsutietkiem')}}">Lịch sử thanh toán tiết kiệm C</a>
                <a href="{{route('lichsudonhanghuy')}}">Lịch sử hoàn đơn hàng huỷ</a>
                <a href="{{route('lichsudiemm')}}">Lịch sử điểm tích luỹ M</a>
            </span>
            @endif
        </li>
        @role('Boss', 'admin')
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fas fa-user-shield"></i>
                    <span class="links_name w-100 align-items-center d-flex">Quản lý Admin <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    <a href="{{ route('roles.index') }}">Vai trò</a>
                    <a href="{{ route('permissions.index') }}">Quyền</a>
                    <a href="{{ route('manager-admin.index') }}">DS Admin</a>
                    <!-- <a href="{{ URL::to('/admin/log-viewer/logs') }}">Theo dõi Admin</a> -->
                </span>
            </li>
        @endrole
        @if (auth()->guard('admin')->user()->can('QL thông tin'))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fas fa-book"></i>
                    <span class="links_name w-100 align-items-center d-flex">Trang - banner <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
                        <a href="{{ route('info-company.index') }}">Trang</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Xem DS trang đơn'))
                        <a href="{{ route('admin.banner.index') }}">Banner</a>
                    @endif
                </span>
            </li>
        @endif
        @hasanyrole('Manager|Boss', 'admin')
            <li class="dropdown">
                <a href="{{ route('setting.index') }}" class="dropbtn">
                    <i class="fas fa-cog"></i>
                    <span class="links_name">Cài đặt</span>
                </a>
            </li>
        @endhasanyrole
        <li class="profile">
            <div class="profile-details">
                <img src="https://ict-imgs.vgcloud.vn/2020/09/01/19/huong-dan-tao-facebook-avatar.jpg" alt="profileImg">
                <div class="name_job">
                    <div class="name">{{ auth()->guard('admin')->user()->name }}</div>
                    <div class="job">{{ auth()->guard('admin')->user()->getRoleNames()[0] }}</div>
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
                <a href="{{ route('logout') }}" class="btn btn-danger">Đăng xuất</a>
            </div>
        </div>
    </div>
</div>
