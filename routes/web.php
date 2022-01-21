<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PolicyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductBrandController;
use App\Http\Controllers\shippingController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InfoCompanyController;

use App\Http\Controllers\CPointController;
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
Route::get('/thuong-hieu/{slug}', [ProductBrandController::class, 'index'])->name('proBrand.index');
Route::get('/', [HomeController::class, 'home']);


// Route::get('/huong-dan-dat-hang', [PolicyController::class,'hddh'])->name('policy.hddh');
// Route::get('/chinh-sach-thanh-toan', [PolicyController::class,'cstt'])->name('policy.cstt');
// Route::get('/chinh-sach-giao-nhan', [PolicyController::class,'csgn'])->name('policy.csgn');
// Route::get('/chinh-sach-doi-tra', [PolicyController::class,'csdt'])->name('policy.csdt');
// Route::get('/chinh-sach-bao-hanh', [PolicyController::class,'csbh'])->name('policy.csbh');
// Route::get('/quy-dinh-ban-hang', [PolicyController::class,'qddk'])->name('policy.qddk');
// Route::get('/khach-hanh-dat-biet', [PolicyController::class,'khdb'])->name('policy.khdb');
// Route::get('/doi-tac', [PolicyController::class,'dt'])->name('policy.dt');
// Route::get('/goi-thieu', [PolicyController::class, 'gt'])->name('policy.gt');

Route::get('/khuyen-mai', function () {
    return view('cart.khuyenmai');
});

Route::prefix('gio-hang')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'addCart'])->name('cart.add');
    Route::post('update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('delete', [CartController::class, 'deleteCart'])->name('cart.delete');
    Route::get('update-checkout', [CartController::class, 'updateCheckout'])->name('cart.updateCheckout');
    Route::post('checkout', [CartController::class, 'toCheckout'])->name('cart.checkout');


});

Route::prefix('thanh-toan')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('post', [CheckoutController::class, 'postOrder'])->name('checkout.post');
    Route::get('get-address', [CheckoutController::class, 'getAddress'])->name('checkout.getAddress');
    Route::get('thanh-cong', [CheckoutController::class, 'orderSuccess'])->name('checkout.orderSuccess');
    Route::get('cal-ship', [CheckoutController::class, 'calShip'])->name('checkout.calship');
    Route::get('cal-ship-cmart', [CheckoutController::class, 'calCmartShip'])->name('checkout.calCmartShip');

});

Route::get('tim-kiem', [ProductCategoryController::class, 'getSearch'])->name('search');
Route::get('tim-kiem/goi-y', [ProductCategoryController::class, 'getSearchSuggest'])->name('search.suggest');

//Route - Liên hệ
Route::get('/lien-he', function () {
    return view('contact.lien-he');
});

//Route - Tài Khoản

Route::get('/quen-mat-khau', function () {
    return view('account.quen-mat-khau');
});

// Route::resources([
//     'san-pham' => ProductController::class
// ]);

Route::prefix('san-pham')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('san-pham.index');
    Route::get('/{slug}', [ProductController::class, 'show'])->name('san-pham.show');

    Route::post('danh-gia', [ProductController::class, 'postRating'])->name('san-pham.danhgia');
});

// Route::prefix('theo-doi-don-hang')->group(function () {
//     Route::get('/', [OrderController::class, 'index'])->name('don-hang.index');
//     Route::get('/{slug}', [OrderController::class, 'show'])->name('don-hang.show');

// });
Route::resources([
    'theo-doi-don-hang' => OrderController::class,
    'chinh-sach' => InfoCompanyController::class,
]);

Route::get('lay-quan-huyen-theo-tinh-thanh', [ShippingController::class, 'districtOfProvince']);

Route::get('lay-phuong-xa-theo-quan-huyen', [ShippingController::class, 'wardOfDistrict']);
// Route::get('danhsach',[UserController::class, 'getDanhsach']);


Route::get('/tai-khoan', [HomeController::class, 'getAccessAccount'])->name('account');
Route::post('/dang-nhap', [HomeController::class, 'postLogin'])->name('user.login');

Route::post('/dang-ky', [HomeController::class, 'postRegister'])->name('user.register');

Route::get('/dang-xuat', [HomeController::class, 'getLogout'])->name('logoutuser');

Route::get('/thong-tin-tai-khoan', [HomeController::class, 'getProfile'])->name('account.info');
Route::post('/thong-tin-tai-khoan', [HomeController::class, 'postProfile']);

Route::get('/xac-thuc-ho-so', [HomeController::class, 'getXacthuc']);

Route::get('/lichsu', [HomeController::class, 'getLichsu']);

Route::prefix('/cpoint')->group(function () {
    Route::get('/', [CPointController::class, 'index'])->name('account.cpoint_history');
});

Route::get('/test-api', [CheckoutController::class, 'getDistance']);