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
        @if (auth()->guard('admin')->user()->can('Truy cập mục Đơn hàng') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="{{ route('order.index') }}" class="dropbtn">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="links_name w-100 align-items-center d-flex">Đơn hàng</span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Quản lý thông báo'))

            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="links_name w-100 align-items-center d-flex">Thông báo<i class="fa fa-speaker float-end"
                            aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    <a href="{{ route('notice.index') }}">Danh sách thông báo</a>

                    <a href="{{ route('notice.create') }}">Tạo thông báo</a>
                </span>


            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập CH') ||
        auth()->guard('admin')->user()->can('Chỉnh sửa Tồn kho cho CH chỉ định') ||
        auth()->guard('admin')->user()->can('Tạo+xóa+sửa CH') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="{{ route('store.index') }}" class="dropbtn">
                    <i class="fa fa-laptop-house"></i>
                    <span class="links_name w-100 align-items-center d-flex">Kho hàng/Cửa hàng <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng') ||
    auth()->guard('admin')->user()->can('Truy cập mục TTSP') ||
    auth()->guard('admin')->user()->can('Truy cập mục HTTT + ẩn') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fa fa-cube"></i>
                    <span class="links_name w-100 align-items-center d-flex">Sản phẩm/Thanh toán<i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('nganh-nhom-hang.index') }}">Ngành/Nhóm hàng</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Truy cập mục TTSP') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('san-pham.index') }}">Thông tin sản phẩm</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Truy cập mục HTTT + ẩn') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('payment.index') }}">Hình thức thanh toán</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Truy cập mục HTTT + ẩn') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('paymentmethod.index') }}">Đơn vị thanh toán</a>
                    @endif
                </span>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập mục Ưu đãi') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="{{ route('coupon.index') }}" class="dropbtn">
                    <i class="fa fa-tag"></i>
                    <span class="links_name w-100 align-items-center d-flex">Ưu đãi</span>
                </a>

            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập mục KH') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span class="links_name w-100 align-items-center d-flex">Khách hàng <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    <a href="{{ url('admin/danh-sach-user') }}">Danh sách khách hàng</a>
                    <a href="{{ route('ekyc.index') }}">Danh sách yêu cầu thay đổi thông tin tài khoản</a>
                </span>


            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập mục TTL') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fas fa-history"></i>
                    <span class="links_name w-100 align-items-center d-flex">Tiền tích lũy C <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content" style="top: -170px;">
                    <a href="{{ route('point.getStatistical') }}">Tài khoản C / HSKH</a>
                    @if (auth()->guard('admin')->user()->can('Chuyển C từ TK C-Mart') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('point.Transfer') }}">Chuyển C</a>
                    @endif
                    <a href="{{ route('point.account') }}">Tài khoản C / C-Mart</a>
                    <a href="{{ route('point.historyReceiver') }}">Lịch sử nhận C</a>
                    <a href="{{ route('point.historyTransfer') }}">Lịch sử chuyển khoản C</a>
                    <a href="{{ route('point.historyAccumulation') }}">Lịch sử thanh toán tích luỹ C</a>
                    <a href="{{ route('point.getHistorySaving') }}">Lịch sử thanh toán tiết kiệm C</a>
                    <a href="{{ route('point.historyAccumulationM') }}">Lịch sử thanh toán tích luỹ M</a>
                    <a href="{{ route('point.historyRefund') }}">Lịch sử hoàn đơn hàng huỷ</a>
                </span>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập mục Admin') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fas fa-user-shield"></i>
                    <span class="links_name w-100 align-items-center d-flex">Admin <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    {{-- <a href="{{ route('roles.index') }}">Vai trò</a> --}}
                    <a href="{{ route('permissions.index') }}">Quyền</a>
                    <a href="{{ route('manager-admin.index') }}">DS Admin</a>
                    <!-- <a href="{{ URL::to('/admin/log-viewer/logs') }}">Theo dõi Admin</a> -->
                </span>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Trang') ||
    auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Banner') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="#" class="dropbtn">
                    <i class="fas fa-book"></i>
                    <span class="links_name w-100 align-items-center d-flex">Thông tin <i
                            class="fa fa-angle-double-right float-end" aria-hidden="true"></i></span>
                </a>
                <span class="dropdown-content">
                    @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Trang') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('info-company.index') }}">Trang</a>
                    @endif
                    @if (auth()->guard('admin')->user()->can('Truy cập+tạo+sửa+xóa+ẩn mục Banner') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                        <a href="{{ route('admin.banner.index') }}">Banner</a>
                    @endif
                </span>
            </li>
        @endif
        @if (auth()->guard('admin')->user()->can('Truy cập lịch sử thao tác hệ thống') ||
    auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
            <li class="dropdown">
                <a href="{{ route('log') }}" class="dropbtn">
                    <i class="fa fa-clock-o"></i>
                    <span class="links_name">Lịch sử thao tác hệ thống</span>
                </a>
            </li>
            @endif
            @if (auth()->guard('admin')->user()->can(config('custom-config.name-all-permission')))
                <li class="dropdown">
                    <a href="{{ route('setting.index') }}" class="dropbtn">
                        <i class="fas fa-cog"></i>
                        <span class="links_name">Cài đặt</span>
                    </a>
                </li>
            @endif
            <li class="profile">
                <div class="profile-details">
                    <img src="https://ict-imgs.vgcloud.vn/2020/09/01/19/huong-dan-tao-facebook-avatar.jpg"
                        alt="profileImg">
                    <div class="name_job">
                        <div class="name">{{ auth()->guard('admin')->user()->fullname }}</div>
                        <div class="job">Admin</div>
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
