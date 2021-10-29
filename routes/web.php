<?php
use Illuminate\Support\Facades\Route;

use App\Admin\Controllers\AdminProductCategoryController;
use App\Admin\Controllers\AdminProductController;
use App\Admin\Controllers\BlogCategoryController;
use App\Admin\Controllers\AdminHomeController;
use App\Admin\Controllers\AdminRolesController;
use App\Admin\Controllers\BlogController;
use App\Admin\Controllers\BrandController;
use App\Admin\Controllers\CalculationUnitController;
use App\Admin\Controllers\WarehouseController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\shippingController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\OrderController;

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
]);

Route::get('lay-quan-huyen-theo-tinh-thanh', [ShippingController::class, 'districtOfProvince']);

Route::get('lay-phuong-xa-theo-quan-huyen', [ShippingController::class, 'wardOfDistrict']);
// Route::get('danhsach',[UserController::class, 'getDanhsach']);

Route::group(['prefix'=>'admin'], function() {
    Route::group(['prefix'=>'user'], function() {
        Route::get('danhsach','UserController@getDanhsach');

        Route::get('profile/{id}','UserController@getEdit');
        Route::post('profile/{id}','UserController@postEdit');
    });
});
Route::post('/login', [HomeController::class, 'postLogin']);
Route::get('/tai-khoan', [HomeController::class, 'getAccessAccount']);

Route::post('/register', [HomeController::class, 'postRegister']);

Route::get('/logout', [HomeController::class, 'getLogout']);

Route::get('/thong-tin-tai-khoan', [HomeController::class, 'getProfile']);
Route::post('/thong-tin-tai-khoan', [HomeController::class, 'postProfile']);
