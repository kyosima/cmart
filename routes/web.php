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
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\shippingController;
use App\Admin\Controllers\AdminHomeController;
use App\Admin\Controllers\AdminRolesController;

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

// Route::get('/san-pham/{slug}', [ProductController::class, 'product'])->name('product.index');
Route::get('/danh-muc-san-pham/{slug}', [ProductCategoryController::class, 'index'])->name('proCat.index');
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

Route::prefix('gio-hang')->group(function () {
    Route::get('/', [CartController::Class, 'index'])->name('cart.index');
    Route::post('add', [CartController::Class, 'addCart'])->name('cart.add');
    Route::post('update', [CartController::Class, 'updateCart'])->name('cart.update');
    Route::post('delete', [CartController::Class, 'deleteCart'])->name('cart.delete');
});

Route::prefix('thanh-toan')->group(function () {
    Route::get('/', [CheckoutController::Class, 'index'])->name('checkout.index');
    Route::post('post', [CheckoutController::Class, 'postOrder'])->name('checkout.post');
    Route::get('thanh-cong', [CheckoutController::Class, 'orderSuccess'])->name('checkout.orderSuccess');

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

Route::resources([
    'san-pham' => ProductController::class
]);


Route::get('lay-quan-huyen-theo-tinh-thanh', [ShippingController::class, 'districtOfProvince']);

Route::get('lay-phuong-xa-theo-quan-huyen', [ShippingController::class, 'wardOfDistrict']);