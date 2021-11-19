<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PolicyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\shippingController;
use App\Http\Controllers\UserProfileController;
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
// Route::get('/san-pham/{slug}', [ProductController::class, 'product'])->name('product.index');
Route::get('/danh-muc-san-pham', [ProductCategoryController::class, 'showAll'])->name('proCat.showAll');
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
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'addCart'])->name('cart.add');
    Route::post('update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('delete', [CartController::class, 'deleteCart'])->name('cart.delete');
});

Route::prefix('thanh-toan')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('post', [CheckoutController::class, 'postOrder'])->name('checkout.post');
    Route::get('thanh-cong', [CheckoutController::class, 'orderSuccess'])->name('checkout.orderSuccess');

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

Route::prefix('san-pham')->group(function () {
    Route::post('danh-gia', [ProductController::class, 'postRating'])->name('san-pham.danhgia');
});



Route::get('lay-quan-huyen-theo-tinh-thanh', [ShippingController::class, 'districtOfProvince']);

Route::get('lay-phuong-xa-theo-quan-huyen', [ShippingController::class, 'wardOfDistrict']);
// Route::get('danhsach',[UserController::class, 'getDanhsach']);

// Route::group(['prefix'=>'admin'], function() {
//     Route::group(['prefix'=>'user'], function() {
//         Route::get('danhsach','UserController@getDanhsach');

//         Route::get('profile/{id}','UserController@getEdit');
//         Route::post('profile/{id}','UserController@postEdit');
//     });
// });
Route::get('/login', [HomeController::class, 'getLogin']);
Route::post('/login', [HomeController::class, 'postLogin']);

Route::get('/register', [HomeController::class, 'getRegister']);
Route::post('/register', [HomeController::class, 'postRegister']);

Route::get('/logout', [HomeController::class, 'getLogout']);

Route::get('/profileUser', [HomeController::class, 'getProfile']);
Route::post('/profileUser', [HomeController::class, 'postProfile']);