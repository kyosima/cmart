<?php

use App\Admin\Controllers\AdminCouponController;
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AdminHomeController;
use App\Admin\Controllers\AdminRolesController;
use App\Admin\Controllers\AdminPermissionsController;
use App\Admin\Controllers\AdminManagerAdminController;
use App\Admin\Controllers\AdminProductCategoryController;
use App\Admin\Controllers\AdminProductController;
use App\Admin\Controllers\BlogCategoryController;
use App\Admin\Controllers\BlogController;
use App\Admin\Controllers\BrandController;
use App\Admin\Controllers\CalculationUnitController;
use App\Admin\Controllers\WarehouseController;
use App\Admin\Controllers\AdminOrderController;
use App\Admin\Controllers\AdminInfoCompanyController;
use App\Admin\Controllers\AdminSettingController;
use App\Admin\UserController;
use App\Admin\PointHistoryController;
use App\Admin\Controllers\InfoCompanyController;
use App\Admin\Controllers\PaymentController;
use App\Admin\Controllers\AdminBannerController;
use App\Admin\Controllers\AdminEkycController;
use App\Admin\Controllers\AdminLogController;
use App\Admin\Controllers\AdminNoticeController;
use App\Admin\Controllers\AdminStoreController;
use App\Admin\Controllers\PaymentMethodController;
use App\Admin\Controllers\AdminPointController;

Route::group(['middleware' => ['admin']], function () {
    // Route::resource('permissions', AdminPermissionsController::class);
    
    Route::get('doi-trang-thai-user/{id}', [UserController::class, 'changeStatusUser'])->name('user.changeStatus');
    Route::get('/nang-cap-vip/{id}', [UserController::class, 'upgrageVipUser'])->name('user.upgradeVip')->middleware('permission:Sửa+ẩn KH|'.config('custom-config.name-all-permission').',admin');
    Route::get('/nang-cap-user/{id}', [UserController::class, 'postDanhsach'])->middleware('permission:Sửa+ẩn KH|'.config('custom-config.name-all-permission').',admin');
    Route::get('/xac-minh/{id}', [UserController::class, 'verifyCompany'])->name('user.verifyCompany')->middleware('permission:Sửa+ẩn KH|'.config('custom-config.name-all-permission').',admin');

    Route::group(['prefix' => 'danh-sach-user', 'middleware' => ['permission:Truy cập mục KH|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/', [UserController::class, 'getDanhsach']);
        Route::get('{id}', [UserController::class, 'getEdit'])->name('user.detail');
        Route::post('{id}', [UserController::class, 'postEdit'])->middleware('permission:Sửa+ẩn KH|'.config('custom-config.name-all-permission').',admin');
    });
    Route::group(['prefix' => 'don-hang'], function () {
        Route::get('xem-c-bill', [AdminOrderController::class, 'viewCbill'])->name('order.viewCbill')->middleware('permission:Truy cập mục Đơn hàng|'.config('custom-config.name-all-permission').',admin');;
        Route::get('xem-c-bill-sign', [AdminOrderController::class, 'viewCbillSign'])->name('order.viewCbillSign');
        Route::get('down-c-bill', [AdminOrderController::class, 'downPDF'])->name('order.downPDF');
        Route::get('thong-ke', [AdminOrderController::class, 'getStatistical'])->name('order.getStatistical');
    });
    Route::get('/export', [UserController::class, 'export']);

    Route::get('lichsunhanC', [PointHistoryController::class, 'lichsunhanC'])->name('lichsunhanC');
    Route::get('lichsunhanC/download', [PointHistoryController::class, 'dowLichsunhanC']);

    Route::get('lichsuchuyenkhoan', [PointHistoryController::class, 'chuyenkhoan'])->name('lichsuchuyenkhoan');
    Route::get('lichsuchuyenkhoan/download/{type}', [PointHistoryController::class, 'dowChuyenKhoan']);

    Route::get('lichsutietkiem', [PointHistoryController::class, 'tietkiem'])->name('lichsutietkiem');
    Route::get('lichsutietkiem/download/{type}', [PointHistoryController::class, 'dowTietKiem']);

    Route::get('lichsutichluy', [PointHistoryController::class, 'tichluy'])->name('lichsutichluy');
    Route::get('lichsutichluy/download/{type}', [PointHistoryController::class, 'dowTichLuy']);

    Route::get('lichsudonhanghuy', [PointHistoryController::class, 'huydonhang'])->name('lichsudonhanghuy');
    Route::get('lichsudonhanghuy/download/{type}', [PointHistoryController::class, 'dowDonHangHuy']);

    Route::get('lichsudiemm', [PointHistoryController::class, 'lichsudiemM'])->name('lichsudiemm');

    //Danh sách lịch sử thao tác
    Route::group(['middleware' => ['permission:Truy cập lịch sử thao tác hệ thống|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/lich-su-thao-tac-he-thong', [AdminLogController::class, 'index'])->name('log');
    });
    //Danh sach vi diem
    Route::get('tongdiemuser', [PointHistoryController::class, 'tongdiem'])->name('tongdiemuser');
    Route::get('tongdiemuser/download/{type}', [PointHistoryController::class, 'dowTongdiem']);

    Route::get('chuyendiem', [PointHistoryController::class, 'chuyendiem'])->name('chuyendiem');
    Route::post('chuyendiem', [PointHistoryController::class, 'postChuyendiem'])->name('postChuyendiem');

    Route::get('napdiem', [PointHistoryController::class, 'napC'])->name('napC');
    Route::post('napdiem', [PointHistoryController::class, 'postNapC'])->name('postNapC');
    Route::get('tinhDiemNap', [PointHistoryController::class, 'tinhDiemNap'])->name('tinhDiemNap');


    Route::get('test', [PointHistoryController::class, 'test'])->name('test');
    // Route::get('',[UserController::class,'postDanhsach']);

    Route::get('logout', [AdminHomeController::class, 'logout'])->name('logout');
    Route::get('doi-mat-khau', [AdminHomeController::class, 'getChangePassword'])->name('admin.getChangePassword');
    Route::post('doi-mat-khau', [AdminHomeController::class, 'postChangePassword'])->name('admin.postChangePassword');
    Route::get('/', [AdminHomeController::class, 'dashboard'])->name('admin.index');
    //quản lý admins

    //đơn hàng
    // xem ds đơn Hàng
    Route::get('don-hang', [AdminOrderController::class, 'index'])->name('order.index')->middleware('permission:Truy cập mục Đơn hàng|'.config('custom-config.name-all-permission').',admin');
    Route::get('don-hang/change-status-order-store', [AdminOrderController::class, 'changeStatusOrderStore'])->name('order.changeStatus')->middleware('permission:Chuyển trạng thái đơn hàng từ DDH sang DXNTT|Chuyển trạng thái đơn hàng từ DVC sang HT|Chuyển trạng thái đơn hàng từ DXL sang DVC|Chuyển trạng thái đơn hàng từ DXNTT sang DXL|Chuyển trạng thái đơn hàng sang Hủy|'.config('custom-config.name-all-permission').',admin');
    Route::post('don-hang/change-status-order-store-bill', [AdminOrderController::class, 'changeStatusOrderStoreWithBill'])->name('order.changeStatusWithBill')->middleware('permission:Chuyển trạng thái đơn hàng từ DDH sang DXNTT|Chuyển trạng thái đơn hàng từ DVC sang HT|Chuyển trạng thái đơn hàng từ DXL sang DVC|Chuyển trạng thái đơn hàng từ DXNTT sang DXL|Chuyển trạng thái đơn hàng sang Hủy|'.config('custom-config.name-all-permission').',admin');

    // tạo đơn Hàng
    Route::get('lay-khach-hang', [AdminOrderController::class, 'getCustomer'])->middleware('permission:Xem DS đơn hàng,admin');
    // tạo đơn Hàng
    Route::get('lay-san-pham', [AdminOrderController::class, 'getProduct'])->middleware('permission:Xem DS đơn hàng,admin');

    // tạo đơn Hàng
    Route::get('tao-don-hang', [AdminOrderController::class, 'create'])->name('order.create')->middleware('permission:Xem DS đơn hàng,admin');

    Route::post('tao-don-hang', [AdminOrderController::class, 'store'])->name('order.store')->middleware('permission:Xem DS đơn hàng,admin');

    // tạo đơn Hàng
    Route::get('xuat-excel-tat-ca-don-hang', [AdminOrderController::class, 'export'])->name('order.exports')->middleware('permission:Xem DS đơn hàng,admin');

    // Xem đơn Hàng
    Route::get('chi-tiet-don-hang/{order:id}', [AdminOrderController::class, 'show'])->name('order.show')->middleware('permission:Chỉnh sửa Ghi chú đơn hàng|'.config('custom-config.name-all-permission').',admin');
    // sửa đơn Hàng
    Route::put('cap-nhat-don-hang/{order:id}', [AdminOrderController::class, 'update'])->name('order.update')->middleware('permission:Chỉnh sửa Ghi chú đơn hàng,admin');

    Route::post('hoan-tien-don-hang', [AdminOrderController::class, 'orderRefund'])->name('admin.order.refund')->middleware('permission:Xem DS đơn hàng,admin');

    // xóa đơn Hàng
    Route::match(['delete', 'get'], 'xoa-don-hang/{order:id}', [AdminOrderController::class, 'delete'])->name('order.delete')->middleware('permission:Xóa đơn hàng,admin');

    Route::post('xu-ly-nhieu-don-hang', [AdminOrderController::class, 'multiple'])->name('order.multiple');

    //Load ajax adrress
    Route::get('lay-quan-huyen-theo-tinh-thanh', [AdminOrderController::class, 'districtOfProvince']);

    Route::get('lay-phuong-xa-theo-quan-huyen', [AdminOrderController::class, 'wardOfDistrict']);

    // thông tin cty
    Route::group(['prefix' => 'info-company', 'middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Trang|'.config('custom-config.name-all-permission').',admin']], function () {

        //danh sách
        Route::get('/', [AdminInfoCompanyController::class, 'index'])->name('info-company.index');

        //tạo
        Route::get('create', [AdminInfoCompanyController::class, 'create'])->name('info-company.create');
        Route::post('store', [AdminInfoCompanyController::class, 'store'])->name('info-company.store');

        //sửa
        Route::get('edit/{info_company:id}', [AdminInfoCompanyController::class, 'edit'])->name('info-company.edit');
        Route::put('update/{info_company:id}', [AdminInfoCompanyController::class, 'update'])->name('info-company.update');

        //xóa
        Route::match(['delete', 'get'], 'delete/{info_company:id}', [AdminInfoCompanyController::class, 'delete'])->name('info-company.delete');
        Route::post('xu-ly-nhieu', [AdminInfoCompanyController::class, 'multiple'])->name('info-company.multiple');
    });

    //banner
    Route::group(['prefix' => 'banner', 'middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Banner|'.config('custom-config.name-all-permission').',admin']], function () {
        //danh sách
        Route::get('/', [AdminBannerController::class, 'index'])->name('admin.banner.index');
        Route::get('/create', [AdminBannerController::class, 'create'])->name('admin.banner.create');
        Route::post('store', [AdminBannerController::class, 'store'])->name('admin.banner.store');
        //sửa
        Route::get('edit/{id}', [AdminBannerController::class, 'edit'])->name('admin.banner.edit');
        Route::put('update', [AdminBannerController::class, 'update'])->name('admin.banner.update');
        Route::get('delete/{id}', [AdminBannerController::class, 'delete'])->name('admin.banner.delete');
        Route::get('changeStatus/{id}', [AdminBannerController::class, 'changeStatus'])->name('admin.banner.changeStatus');

    });

    Route::group(['middleware' => ['permission:Truy cập mục Admin|'.config('custom-config.name-all-permission').',admin']], function () {
        //
        Route::resource('roles', AdminRolesController::class);
        Route::resource('permissions', AdminPermissionsController::class);
        Route::resource('manager-admin', AdminManagerAdminController::class);
        Route::post('xu-ly-nhieu-role', [AdminRolesController::class, 'multiple'])->name('roles.multiple');
        Route::post('xu-ly-nhieu-permission', [AdminPermissionsController::class, 'multiple'])->name('permissions.multiple');
        Route::post('xu-ly-nhieu-admin', [AdminManagerAdminController::class, 'multiple'])->name('manager-admin.multiple');
    });


    Route::group(['middleware' => ['permission:Truy cập mục cài đặt|'.config('custom-config.name-all-permission').',admin']], function () {
        //setting
        Route::get('setting', [AdminSettingController::class, 'index'])->name('setting.index');

        //setting
        Route::post('setting/maintenance-mode', [AdminSettingController::class, 'maintenanceMode'])->name('post.maintenanceMode');

        //setting
        Route::post('setting', [AdminSettingController::class, 'store'])->name('post.setting');
    });

    // CỬA HÀNG
    Route::group(['middleware' => ['permission:Truy cập CH|Tạo+xóa+sửa CH|Chỉnh sửa Tồn kho cho CH chỉ định|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/cua-hang', [AdminStoreController::class, 'index'])->name('store.index');
    });

    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/cua-hang', [AdminStoreController::class, 'store'])->name('store.store');
    });
    
    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH|Chỉnh sửa Tồn kho cho CH chỉ định|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::put('/cua-hang/{id}', [AdminStoreController::class, 'update'])->name('store.update');
    });

    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH,admin']], function () {
        Route::get('/cua-hang/get-location', [AdminStoreController::class, 'getLocation'])->name('store.getLocation');
        Route::get('/cua-hang/list-owners', [AdminStoreController::class, 'getListOwner'])->name('store.getListOwner');
    });

    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH|Chỉnh sửa Tồn kho cho CH chỉ định|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/cua-hang/them-san-pham', [AdminStoreController::class, 'storeProduct'])->name('store.storeProduct');
        Route::delete('/cua-hang/san-pham/{id_store}/{id_product}', [AdminStoreController::class, 'deleteProductStore'])->name('store.deleteProductStore');
    });
    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH|Chỉnh sửa Tồn kho cho CH chỉ định|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/cua-hang/edit/{slug}/{id}', [AdminStoreController::class, 'edit'])->name('store.edit');
        Route::get('/cua-hang/searchProduct', [AdminStoreController::class, 'getProduct'])->name('store.getProduct');
        Route::get('/cua-hang/list-product', [AdminStoreController::class, 'getListProduct'])->name('store.getListProduct');
        Route::get('/cua-hang/thong-ke/{id}', [AdminStoreController::class, 'getStatistical'])->name('store.getStatistical');

    });

    Route::group(['middleware' => ['permission:Tạo+xóa+sửa CH|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/cua-hang/multiple-change', [AdminStoreController::class, 'multiChange'])->name('store.multiChange');
        Route::delete('/cua-hang/{id}', [AdminStoreController::class, 'delete'])->name('store.delete');
    });


    // COUPON
    // được phép xem mã ưu đãi
    Route::group(['middleware' => ['permission:Truy cập mục Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/coupon', [AdminCouponController::class, 'index'])->name('coupon.index');
        Route::get('/coupon/getDatatable', [AdminCouponController::class, 'indexDatatable'])->name('coupon.indexDatatable');
    });
    // được phép thêm mã ưu đãi
    Route::group(['middleware' => ['permission:Tạo+sửa Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/coupon/create', [AdminCouponController::class, 'create'])->name('coupon.create');
        Route::post('/coupon/create', [AdminCouponController::class, 'store'])->name('coupon.store');
    });
    // được phép chỉnh sửa mã ưu đãi
    Route::group(['middleware' => ['permission:Tạo+sửa Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/coupon/edit/{id?}', [AdminCouponController::class, 'edit'])->name('coupon.edit');
        Route::put('/coupon/{id}', [AdminCouponController::class, 'update'])->name('coupon.update');
    });
    // được phép XÓA mã ưu đãi
    Route::group(['middleware' => ['permission:Tạo+sửa Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::delete('/coupon/delete/{id}', [AdminCouponController::class, 'delete'])->name('coupon.delete');
        Route::delete('/coupon/multiple-delete', [AdminCouponController::class, 'multipleDestory'])->name('coupon.multipleDestroy');
    });
    Route::group(['middleware' => ['permission:Tạo+sửa Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/coupon/searchProduct', [AdminCouponController::class, 'getProduct'])->name('coupon.getProduct');
        Route::get('/coupon/searchProCat', [AdminCouponController::class, 'getProCat'])->name('coupon.getProCat');
        Route::get('/coupon/searchCustomer', [AdminCouponController::class, 'getCustomer'])->name('coupon.searchCustomer');
        Route::get('/coupon/searchCoupon', [AdminCouponController::class, 'getCoupon'])->name('coupon.getCoupon');
        Route::get('/coupon/select-product', [AdminCouponController::class, 'selectProduct'])->name('coupon.selectProduct');
        Route::get('/coupon/select-procat', [AdminCouponController::class, 'selectProCat'])->name('coupon.selectProCat');
        Route::get('/coupon/select-customer', [AdminCouponController::class, 'selectCustomer'])->name('coupon.selectCustomer');
        Route::get('/coupon/select-target', [AdminCouponController::class, 'selectTarget'])->name('coupon.selectTarget');
        Route::get('/coupon/select-coupon', [AdminCouponController::class, 'selectCoupon'])->name('coupon.selectCoupon');
        Route::get('/coupon/input-level', [AdminCouponController::class, 'inputLevel'])->name('coupon.inputLevel');

    });

    Route::group(['middleware' => ['permission:Tạo+sửa Ưu đãi|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/coupon/multiple-change', [AdminCouponController::class, 'multiChange'])->name('coupon.multiChange');
    });
    // Route::delete('/coupon/{id}', [AdminCouponController::class, 'deleteForm'])->name('coupon.deleteForm');

    // PRODUCT
    // được phép xem sản phẩm
    Route::group(['middleware' => ['permission:Truy cập mục TTSP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/san-pham', [AdminProductController::class, 'index'])->name('san-pham.index');
        Route::get('/san-pham/getDatatable', [AdminProductController::class, 'indexDatatable'])->name('san-pham.indexDatatable');
    });

    // được phép thêm sản phẩm
    Route::group(['middleware' => ['permission:Tạo+sửa+xóa SP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/tao-san-pham', [AdminProductController::class, 'create'])->name('san-pham.create');
        Route::post('/san-pham', [AdminProductController::class, 'store'])->name('san-pham.store');
    });

    // được phép chỉnh sửa sản phẩm
    Route::group(['middleware' => ['permission:Tạo+sửa+xóa SP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/san-pham/edit/{id}', [AdminProductController::class, 'edit'])->name('san-pham.edit');
        Route::put('/san-pham/update/{id}', [AdminProductController::class, 'update'])->name('san-pham.update');
    });

    // được phép XÓA sản phẩm
    Route::group(['middleware' => ['permission:Tạo+sửa+xóa SP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::delete('/san-pham/delete/{id}', [AdminProductController::class, 'destroy'])->name('san-pham.delete');
    });

    Route::group(['middleware' => ['permission:Truy cập mục TTSP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/san-pham/searchProduct', [AdminProductController::class, 'getProduct'])->name('san-pham.getProduct');
        Route::get('/san-pham/searchProductCategory', [AdminProductController::class, 'getProCat'])->name('san-pham.getProCat');
    });

    Route::group(['middleware' => ['permission:Truy cập mục TTSP|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/san-pham/multiple-change', [AdminProductController::class, 'multiChange'])->name('san-pham.multiChange');
    });


    // PRODUCT CATEGORIES
    // được phép xem danh mục sản phẩm
    Route::group(['middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/nganh-nhom-hang', [AdminProductCategoryController::class, 'index'])->name('nganh-nhom-hang.index');
        Route::get('/nganh-nhom-hang/show-child/{parentId}/level/{level}', [AdminProductCategoryController::class, 'showChild'])->name('nganh-nhom-hang.showChild');
    });

    // được phép thêm danh mục sản phẩm
    Route::group(['middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/nganh-nhom-hang', [AdminProductCategoryController::class, 'store'])->name('nganh-nhom-hang.store');
        Route::get('/nganh-nhom-hang/get-category', [AdminProductCategoryController::class, 'getCategory'])->name('nganh-nhom-hang.getCategory');
    });

    // được phép chỉnh sửa danh mục sản phẩm
    Route::group(['middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/nganh-nhom-hang/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('nganh-nhom-hang.edit');
        Route::get('/nganh-nhom-hang/modal-edit', [AdminProductCategoryController::class, 'modalEdit'])->name('nganh-nhom-hang.modalEdit');
        Route::put('/nganh-nhom-hang/update/{id}', [AdminProductCategoryController::class, 'update'])->name('nganh-nhom-hang.update');
        Route::put('/nganh-nhom-hang/update-model/{id}', [AdminProductCategoryController::class, 'modelUpdate'])->name('nganh-nhom-hang.modelUpdate');
        Route::put('/nganh-nhom-hang/{id}', [AdminProductCategoryController::class, 'updateStatus'])->name('nganh-nhom-hang.updateStatus');
        Route::get('/nganh-nhom-hang/select-procat', [AdminProductCategoryController::class, 'getProCat'])->name('nganh-nhom-hang.getProCat');
    });

    // được phép XÓA danh mục sản phẩm
    Route::group(['middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::delete('/nganh-nhom-hang/delete/{id}', [AdminProductCategoryController::class, 'destroy'])->name('nganh-nhom-hang.delete');
    });

    Route::group(['middleware' => ['permission:Truy cập+tạo+sửa+xóa+ẩn mục Ngành hàng|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/nganh-nhom-hang/multiple-change', [AdminProductCategoryController::class, 'multiChange'])->name('nganh-nhom-hang.multiChange');
    });

    // Route::get('/nganh-nhom-hang/test/{id}/{status}/{levelChange}', [AdminProductCategoryController::class, 'recursive'])->name('nganh-nhom-hang.recursive');
    //HistoryPoint

    Route::group(['prefix'=>'diem-tich-luy','middleware' => ['permission:Truy cập mục TTL|Nạp thêm C vào tk C-Mart|Truy cập mục chuyển C|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('lich-su-nhan-diem', [AdminPointController::class, 'getHistoryReceiverC'])->name('point.historyReceiver');
        Route::get('lich-su-tich-luy', [AdminPointController::class, 'getAccumulationC'])->name('point.historyAccumulation');
        Route::get('lich-su-chuyen-khoan', [AdminPointController::class, 'getHistoryTransfer'])->name('point.historyTransfer');
        Route::get('lich-su-hoan-don-hang-huy', [AdminPointController::class, 'getHistoryRefund'])->name('point.historyRefund');
        Route::get('thong-ke', [AdminPointController::class, 'getStatistical'])->name('point.getStatistical');
        Route::get('thanh-toan-tiet-kiem', [AdminPointController::class, 'getHistorySaving'])->name('point.getHistorySaving');
        Route::get('lich-su-tich-luy-m', [AdminPointController::class, 'getHistoryAccumulationM'])->name('point.historyAccumulationM');
        Route::get('tai-khoan-cmart', [AdminPointController::class, 'getStatisticalAccount'])->name('point.account');
        Route::post('nap-c', [AdminPointController::class, 'postDeposit'])->name('point.deposit')->middleware('permission:Nạp thêm C vào tk C-Mart|'.config('custom-config.name-all-permission').',admin');
        Route::get('thong-ke-so-du-c', [AdminPointController::class, 'getRememberC'])->name('point.getRememberC');
        Route::get('diem-tich-luy/chuyen-khoan', [AdminPointController::class, 'getTransfer'])->name('point.Transfer')->middleware('permission:Truy cập mục chuyển C|'.config('custom-config.name-all-permission').',admin');
        Route::post('diem-tich-luy/chuyen-khoan', [AdminPointController::class, 'postTransfer'])->name('point.postTransfer')->middleware('permission:Truy cập mục chuyển C|'.config('custom-config.name-all-permission').',admin');
    

    });
    Route::get('diem-tich-luy/chuyen-khoan', [AdminPointController::class, 'getTransfer'])->name('point.Transfer')->middleware('permission:Truy cập mục chuyển C|'.config('custom-config.name-all-permission').',admin');
    Route::post('diem-tich-luy/chuyen-khoan', [AdminPointController::class, 'postTransfer'])->name('point.postTransfer')->middleware('permission:Truy cập mục chuyển C|'.config('custom-config.name-all-permission').',admin');

    Route::group(['prefix'=>'thong-bao','middleware' => ['permission:Truy cập thông báo|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/', [AdminNoticeController::class, 'index'])->name('notice.index');
    });
    Route::group(['prefix'=>'thong-bao','middleware' => ['permission:Tạo thông báo|'.config('custom-config.name-all-permission').',admin']], function () {

        Route::get('tao-thong-bao', [AdminNoticeController::class, 'create'])->name('notice.create');
        Route::post('tao-thong-bao', [AdminNoticeController::class, 'store'])->name('notice.store');
        Route::get('tim-khach-hang', [AdminNoticeController::class, 'getUsers'])->name('notice.getUsers');
        Route::get('sua-thong-bao/{id}', [AdminNoticeController::class, 'edit'])->name('notice.edit');
        Route::post('sua-thong-bao/{id}', [AdminNoticeController::class, 'update'])->name('notice.update');
        Route::get('doi-trang-thai/{id}', [AdminNoticeController::class, 'changeStatus'])->name('notice.changeStatus');
        Route::get('xoa/{id}', [AdminNoticeController::class, 'destroy'])->name('notice.destroy');
    });

    // BLOG
    // được phép xem bài viết
    Route::group(['middleware' => ['permission:Xem bài viết,admin']], function () {
        Route::get('/tat-ca-bai-viet', [BlogController::class, 'index'])->name('baiviet.index');
    });

    // được phép thêm bài viết
    Route::group(['middleware' => ['permission:Thêm bài viết,admin']], function () {
        Route::get('/tat-ca-bai-viet/create', [BlogController::class, 'create'])->name('baiviet.create');
        Route::post('/tat-ca-bai-viet', [BlogController::class, 'store'])->name('baiviet.store');
    });

    // được phép chỉnh sửa bài viết
    Route::group(['middleware' => ['permission:Chỉnh sửa bài viết,admin']], function () {
        Route::get('/tat-ca-bai-viet/edit/{id}', [BlogController::class, 'edit'])->name('baiviet.edit');
        Route::put('/tat-ca-bai-viet/update/{id}', [BlogController::class, 'update'])->name('baiviet.update');
        Route::put('/tat-ca-bai-viet/{id}', [BlogController::class, 'updateStatus'])->name('baiviet.updateStatus');
    });

    // được phép XÓA bài viết
    Route::group(['middleware' => ['permission:Xóa bài viết,admin']], function () {
        Route::delete('/tat-ca-bai-viet/{id}', [BlogController::class, 'destroy'])->name('baiviet.delete');
        Route::post('/tat-ca-bai-viet/multiple-delete', [BlogController::class, 'multipleDestory'])->name('baiviet.multipleDestory');
    });

    // BLOG CATEGORY
    // được phép xem danh mục bài viết
    Route::group(['middleware' => ['permission:Xem danh mục bài viết,admin']], function () {
        Route::get('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'index'])->name('chuyenmuc-baiviet.index');
        Route::get('/chuyen-muc-bai-viet/getDatatable', [BlogCategoryController::class, 'indexDatatable'])->name('chuyenmuc-baiviet.indexDatatable');
    });

    // được phép thêm danh mục bài viết
    Route::group(['middleware' => ['permission:Thêm danh mục bài viết,admin']], function () {
        Route::post('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'store'])->name('chuyenmuc-baiviet.store');
    });

    // được phép chỉnh sửa danh mục bài viết
    Route::group(['middleware' => ['permission:Chỉnh sửa danh mục bài viết,admin']], function () {
        Route::get('/chuyen-muc-bai-viet/modal-edit', [BlogCategoryController::class, 'modalEdit'])->name('chuyenmuc-baiviet.modalEdit');
        Route::put('/chuyen-muc-bai-viet/update', [BlogCategoryController::class, 'update'])->name('chuyenmuc-baiviet.update');
    });

    // được phép XÓA danh mục bài viết
    Route::group(['middleware' => ['permission:Xóa danh mục bài viết,admin']], function () {
        Route::delete('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'destroy'])->name('chuyenmuc-baiviet.delete');
        Route::delete('/chuyen-muc-bai-viet/multiple-delete', [BlogCategoryController::class, 'multipleDestory'])->name('chuyenmuc-baiviet.multipleDestory');
    });

    Route::group(['middleware' => ['permission:Quản lý yêu cầu thay đổi thông tin tài khoản khách hàng|'.config('custom-config.name-all-permission').',admin']], function(){
        Route::get('/quan-ly-yeu-cau-thay-doi-thong-tin', [AdminEkycController::class, 'index'])->name('ekyc.index');
        Route::get('/quan-ly-yeu-cau-thay-doi-thong-tin/duyet', [AdminEkycController::class, 'changeStatus'])->name('ekyc.changeStatus');
    });


    // ĐƠN VỊ TÍNH
    // được phép xem đơn vị tính
    Route::group(['middleware' => ['permission:Xem đơn vị tính,admin']], function () {
        Route::get('/don-vi-tinh', [CalculationUnitController::class, 'index'])->name('don-vi-tinh.index');
        Route::get('/don-vi-tinh/getDatatable', [CalculationUnitController::class, 'indexDatatable'])->name('don-vi-tinh.indexDatatable');
    });

    // được phép thêm đơn vị tính
    Route::group(['middleware' => ['permission:Thêm đơn vị tính,admin']], function () {
        Route::post('/don-vi-tinh', [CalculationUnitController::class, 'store'])->name('don-vi-tinh.store');
    });

    // được phép chỉnh sửa đơn vị tính
    Route::group(['middleware' => ['permission:Chỉnh sửa đơn vị tính,admin']], function () {
        Route::get('/don-vi-tinh/modal-edit', [CalculationUnitController::class, 'modalEdit'])->name('don-vi-tinh.modalEdit');
        Route::put('/don-vi-tinh/update', [CalculationUnitController::class, 'update'])->name('don-vi-tinh.update');
        Route::put('/don-vi-tinh', [CalculationUnitController::class, 'updateStatus'])->name('don-vi-tinh.updateStatus');
    });

    // được phép XÓA đơn vị tính
    Route::group(['middleware' => ['permission:Xóa đơn vị tính,admin']], function () {
        Route::delete('/don-vi-tinh', [CalculationUnitController::class, 'destroy'])->name('don-vi-tinh.delete');
        Route::delete('/don-vi-tinh/multiple-delete', [CalculationUnitController::class, 'multipleDestory'])->name('don-vi-tinh.multipleDestory');
    });

    // HÌNH THỨC THANH TOÁN
    // được phép xem HTTT
    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::get('/payment/getDatatable', [PaymentController::class, 'indexDatatable'])->name('payment.indexDatatable');
    });
    // được phép thêm HTTT
    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    });


    // được phép chỉnh sửa HTTT
    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/payment/modal-edit', [PaymentController::class, 'modalEdit'])->name('payment.modalEdit');
        Route::put('/payment/update', [PaymentController::class, 'update'])->name('payment.update');
        Route::put('/payment/update-status', [PaymentController::class, 'updateStatus'])->name('payment.updateStatus');
    });
    // được phép XÓA HTTT
    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::delete('/payment/delete', [PaymentController::class, 'destroy'])->name('payment.delete');
        Route::delete('/payment/multiple-delete', [PaymentController::class, 'multipleDestroy'])->name('payment.multipleDestroy');
    });

    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::post('/payment/multiple-change', [PaymentController::class, 'multiChange'])->name('payment.multiChange');
    });
    // được phép thêm, xóa, sửa hình thức thanh toán cho đơn hàng
    Route::group(['middleware' => ['permission:Truy cập mục HTTT + ẩn|'.config('custom-config.name-all-permission').',admin']], function () {
        Route::get('/hinh-thuc-thanh-toan-don-hang', [PaymentMethodController::class, 'index'])->name('paymentmethod.index');
        Route::get('/hinh-thuc-thanh-toan-don-hang/getDatatable', [PaymentMethodController::class, 'indexDatatable'])->name('paymentmethod.indexDatatable');
        Route::post('/hinh-thuc-thanh-toan-don-hang', [PaymentMethodController::class, 'store'])->name('paymentmethod.store');
        Route::get('/hinh-thuc-thanh-toan-don-hang/modal-edit', [PaymentMethodController::class, 'modalEdit'])->name('paymentmethod.modalEdit');
        Route::post('/hinh-thuc-thanh-toan-don-hang/update', [PaymentMethodController::class, 'update'])->name('paymentmethod.update');
        Route::put('/hinh-thuc-thanh-toan-don-hang/update-status', [PaymentMethodController::class, 'updateStatus'])->name('paymentmethod.updateStatus');
        Route::delete('/hinh-thuc-thanh-toan-don-hang/delete', [PaymentMethodController::class, 'destroy'])->name('paymentmethod.delete');

    });

    // BRAND
    // được phép xem thương hiệu
    Route::group(['middleware' => ['permission:Xem thương hiệu,admin']], function () {
        Route::get('/thuong-hieu', [BrandController::class, 'index'])->name('thuong-hieu.index');
        Route::get('/thuong-hieu/getDatatable', [BrandController::class, 'indexDatatable'])->name('thuong-hieu.indexDatatable');
    });

    // được phép thêm thương hiệu
    Route::group(['middleware' => ['permission:Thêm thương hiệu,admin']], function () {
        Route::post('/thuong-hieu', [BrandController::class, 'store'])->name('thuong-hieu.store');
    });

    // được phép chỉnh sửa thương hiệu
    Route::group(['middleware' => ['permission:Chỉnh sửa thương hiệu,admin']], function () {
        Route::get('/thuong-hieu/modal-edit', [BrandController::class, 'modalEdit'])->name('thuong-hieu.modalEdit');
        Route::put('/thuong-hieu/update', [BrandController::class, 'update'])->name('thuong-hieu.update');
        Route::put('/thuong-hieu', [BrandController::class, 'updateStatus'])->name('thuong-hieu.updateStatus');
    });

    // được phép XÓA thương hiệu
    Route::group(['middleware' => ['permission:Xóa thương hiệu,admin']], function () {
        Route::delete('/thuong-hieu', [BrandController::class, 'destroy'])->name('thuong-hieu.delete');
        Route::delete('/thuong-hieu/multiple-delete', [BrandController::class, 'multipleDestroy'])->name('thuong-hieu.multipleDestroy');
    });

    Route::group(['middleware' => ['permission:Xóa thương hiệu|Chỉnh sửa thương hiệu,admin']], function () {
        Route::post('/thuong-hieu/multiple-change', [BrandController::class, 'multiChange'])->name('thuong-hieu.multiChange');
    });

    // WAREHOUSE 
    // được phép xem kho
    Route::group(['middleware' => ['permission:Xem kho,admin']], function () {
        Route::get('/ton-kho-dai-ly', [WarehouseController::class, 'index'])->name('warehouse.index');
    });
    Route::post('/ton-kho-dai-ly', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::post('/ton-kho-dai-ly/add-product', [WarehouseController::class, 'addProductToWarehouse'])->name('warehouse.addProductToWarehouse');
    Route::put('/ton-kho-dai-ly', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::delete('/ton-kho-dai-ly', [WarehouseController::class, 'delete'])->name('warehouse.destroy');
    Route::get('/get-location', [WarehouseController::class, 'getLocation'])->name('warehouse.getLocation');
    Route::get('/get-warehouse', [WarehouseController::class, 'getWarehouse'])->name('warehouse.getWarehouse');
    Route::get('/ton-kho-dai-ly/modal-edit', [WarehouseController::class, 'modalEdit'])->name('warehouse.modalEdit');
});




Route::get('/login', [AdminHomeController::class, 'login'])->name('get.admin.login');
Route::post('/login', [AdminHomeController::class, 'postLogin'])->name('admin.login');

// Route::get('/don-hang', function () {
//     return view('admin.don-hang');
// });
// Route::get('/don-vi-tinh', function () {
//     return view('admin.don-vi-tinh');
// });
// Route::get('/danh-muc-san-pham', function () {
//     return view('admin.productCategory');
// });
// Route::get('/san-pham', function () {
//     return view('admin.product');
// });
// Route::get('/phan-quyen', function () {
//     return view('admin.phan-quyen');
// });
// Route::get('/profile', function () {
//     return view('admin.profile');
// });

// Route::get('/ton-kho', function () {
//     return view('admin.ton-kho');
// });
