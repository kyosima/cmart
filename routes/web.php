<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\HomeController;
use App\Admin\Controllers\AdminHomeController;

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
