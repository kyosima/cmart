<?php

use App\Admin\Controllers\AdminProductCategoryController;
use App\Admin\Controllers\AdminProductController;
use App\Admin\Controllers\BlogCategoryController;
use App\Admin\Controllers\BlogController;
use App\Admin\Controllers\BrandController;
use App\Admin\Controllers\CalculationUnitController;
use App\Admin\Controllers\WarehouseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// ADMIN

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/login', function () {
        return view('admin.login');
    });
    Route::get('/don-hang', function () {
        return view('admin.don-hang');
    });
    Route::get('/phan-quyen', function () {
        return view('admin.phan-quyen');
    });
    Route::get('/profile', function () {
        return view('admin.profile');
    });
    Route::get('/setting', function () {
        return view('admin.setting');
    });

    // ĐƠN VỊ TÍNH
    Route::get('/don-vi-tinh', [CalculationUnitController::class, 'index'])->name('don-vi-tinh.index');
    Route::get('/don-vi-tinh/getDatatable', [CalculationUnitController::class, 'indexDatatable'])->name('don-vi-tinh.indexDatatable');
    Route::get('/don-vi-tinh/modal-edit', [CalculationUnitController::class, 'modalEdit'])->name('don-vi-tinh.modalEdit');
    Route::post('/don-vi-tinh', [CalculationUnitController::class, 'store'])->name('don-vi-tinh.store');
    Route::put('/don-vi-tinh/update', [CalculationUnitController::class, 'update'])->name('don-vi-tinh.update');
    Route::put('/don-vi-tinh', [CalculationUnitController::class, 'updateStatus'])->name('don-vi-tinh.updateStatus');
    Route::delete('/don-vi-tinh', [CalculationUnitController::class, 'destroy'])->name('don-vi-tinh.delete');

    // PRODUCT CATEGORIES
    Route::get('/nganh-nhom-hang', [AdminProductCategoryController::class, 'index'])->name('nganh-nhom-hang.index');
    Route::post('/nganh-nhom-hang', [AdminProductCategoryController::class, 'store'])->name('nganh-nhom-hang.store');
    Route::get('/nganh-nhom-hang/modal-edit', [AdminProductCategoryController::class, 'modalEdit'])->name('nganh-nhom-hang.modalEdit');
    Route::put('/nganh-nhom-hang/update/{id}', [AdminProductCategoryController::class, 'update'])->name('nganh-nhom-hang.update');
    Route::put('/nganh-nhom-hang/{id}', [AdminProductCategoryController::class, 'updateStatus'])->name('nganh-nhom-hang.updateStatus');
    Route::delete('/nganh-nhom-hang/{id}', [AdminProductCategoryController::class, 'destroy'])->name('nganh-nhom-hang.delete');
    Route::get('/nganh-nhom-hang/get-category', [AdminProductCategoryController::class, 'getCategory'])->name('nganh-nhom-hang.getCategory');
    // Route::get('/nganh-nhom-hang/test/{id}/{status}/{levelChange}', [AdminProductCategoryController::class, 'recursive'])->name('nganh-nhom-hang.recursive');

    // PRODUCT
    Route::get('/san-pham', [AdminProductController::class, 'index'])->name('san-pham.index');
    Route::get('/tao-san-pham', [AdminProductController::class, 'create'])->name('san-pham.create');
    Route::post('/san-pham', [AdminProductController::class, 'store'])->name('san-pham.store');
    Route::get('/san-pham/edit/{id}', [AdminProductController::class, 'edit'])->name('san-pham.edit');
    Route::put('/san-pham/update/{id}', [AdminProductController::class, 'update'])->name('san-pham.update');
    Route::delete('/san-pham/delete/{id}', [AdminProductController::class, 'destroy'])->name('san-pham.delete');
    Route::get('/san-pham/get-category', [AdminProductController::class, 'getCategory'])->name('san-pham.getCategory');

    // BRAND
    Route::get('/thuong-hieu', [BrandController::class, 'index'])->name('thuong-hieu.index');
    Route::get('/thuong-hieu/getDatatable', [BrandController::class, 'indexDatatable'])->name('thuong-hieu.indexDatatable');
    Route::get('/thuong-hieu/modal-edit', [BrandController::class, 'modalEdit'])->name('thuong-hieu.modalEdit');
    Route::post('/thuong-hieu', [BrandController::class, 'store'])->name('thuong-hieu.store');
    Route::put('/thuong-hieu/update', [BrandController::class, 'update'])->name('thuong-hieu.update');
    Route::put('/thuong-hieu', [BrandController::class, 'updateStatus'])->name('thuong-hieu.updateStatus');
    Route::delete('/thuong-hieu', [BrandController::class, 'destroy'])->name('thuong-hieu.delete');

    // WAREHOUSE 
    Route::get('/ton-kho-dai-ly', [WarehouseController::class, 'index'])->name('warehouse.index');
    Route::post('/ton-kho-dai-ly', [WarehouseController::class, 'store'])->name('warehouse.store');
    Route::post('/ton-kho-dai-ly/add-product', [WarehouseController::class, 'addProductToWarehouse'])->name('warehouse.addProductToWarehouse');
    Route::put('/ton-kho-dai-ly', [WarehouseController::class, 'update'])->name('warehouse.update');
    Route::delete('/ton-kho-dai-ly', [WarehouseController::class, 'delete'])->name('warehouse.destroy');
    Route::get('/get-location', [WarehouseController::class, 'getLocation'])->name('warehouse.getLocation');
    Route::get('/get-warehouse', [WarehouseController::class, 'getWarehouse'])->name('warehouse.getWarehouse');
    Route::get('/ton-kho-dai-ly/modal-edit', [WarehouseController::class, 'modalEdit'])->name('warehouse.modalEdit');

    // BLOG CATEGORY
    Route::get('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'index'])->name('chuyenmuc-baiviet.index');
    Route::get('/chuyen-muc-bai-viet/getDatatable', [BlogCategoryController::class, 'indexDatatable'])->name('chuyenmuc-baiviet.indexDatatable');
    Route::get('/chuyen-muc-bai-viet/modal-edit', [BlogCategoryController::class, 'modalEdit'])->name('chuyenmuc-baiviet.modalEdit');
    Route::post('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'store'])->name('chuyenmuc-baiviet.store');
    Route::put('/chuyen-muc-bai-viet/update', [BlogCategoryController::class, 'update'])->name('chuyenmuc-baiviet.update');
    Route::delete('/chuyen-muc-bai-viet', [BlogCategoryController::class, 'destroy'])->name('chuyenmuc-baiviet.delete');
    
    // BLOG
    Route::get('/tat-ca-bai-viet', [BlogController::class, 'index'])->name('baiviet.index');
    Route::get('/tat-ca-bai-viet/create', [BlogController::class, 'create'])->name('baiviet.create');
    Route::get('/tat-ca-bai-viet/edit/{id}', [BlogController::class, 'edit'])->name('baiviet.edit');
    Route::post('/tat-ca-bai-viet', [BlogController::class, 'store'])->name('baiviet.store');
    Route::put('/tat-ca-bai-viet/update/{id}', [BlogController::class, 'update'])->name('baiviet.update');
    Route::put('/tat-ca-bai-viet/{id}', [BlogController::class, 'updateStatus'])->name('baiviet.updateStatus');
    Route::delete('/tat-ca-bai-viet/{id}', [BlogController::class, 'destroy'])->name('baiviet.delete');
});
// END ADMIN

Route::get('/product', [ProductController::class, 'product']);
Route::get('/danh-muc-san-pham', [ProductCategoryController::class, 'getdanhmucsanpham']);
Route::get('/', [HomeController::class, 'home']);


Route::get('/huong-dan-dat-hang', [PolicyController::class,'hddh'])->name('policy.hddh');
Route::get('/chinh-sach-thanh-toan', [PolicyController::class,'cstt'])->name('policy.cstt');
Route::get('/chinh-sach-giao-nhan', [PolicyController::class,'csgn'])->name('policy.csgn');
Route::get('/chinh-sach-doi-tra', [PolicyController::class,'csdt'])->name('policy.csdt');
Route::get('/chinh-sach-bao-hanh', [PolicyController::class,'csbh'])->name('policy.csbh');
Route::get('/quy-dinh-ban-hang', [PolicyController::class,'qddk'])->name('policy.qddk');
Route::get('/khach-hanh-dat-biet', [PolicyController::class,'khdb'])->name('policy.khdb');
Route::get('/doi-tac', [PolicyController::class,'dt'])->name('policy.dt');
Route::get('/goi-thieu', [PolicyController::class, 'gt'])->name('policy.gt');

Route::get('/khuyen-mai', function () {
    return view('cart.khuyenmai');
});

Route::get('/gio-hang', function () {
    return view('cart.giohang');
});

Route::get('/thanh-toan', function () {
    return view('cart.thanhtoan');
});

//Route - Theo dõi đơn hàng
Route::get('/theo-doi-don-hang', function () {
    return view('order_tracking.theo-doi-don-hang_main-layout');
});

//Route - Đơn hàng sau khi tra cứu
Route::get('/don-hang-sau-khi-tra-cuu', function () {
    return view('order_tracking.don-hang-sau-khi-tra-cuu');
});

//Route - Liên hệ
Route::get('/lien-he', function () {
    return view('contact.lien-he');
});

//Route - Tài Khoản
Route::get('/tai-khoan', function () {
    return view('account.account');
});

Route::get('/quen-mat-khau', function () {
    return view('account.quen-mat-khau');
});
