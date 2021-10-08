<?php
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AdminHomeController;
use App\Admin\Controllers\AdminRolesController;
use App\Admin\Controllers\AdminPermissionsController;
use App\Admin\Controllers\AdminManagerAdminController;


Route::group(['middleware' => ['admin']], function () {

    Route::group(['middleware' => ['role_or_permission:Boss,admin']], function () {
        //
        Route::get('/test', [AdminHomeController::class,'test']);
    });
    Route::get('/', [AdminHomeController::class,'dashboard']);
});





Route::get('/login', [AdminHomeController::class,'login']);
Route::post('/login', [AdminHomeController::class,'postLogin'])->name('admin.login');

Route::get('/don-hang', function () {
    return view('admin.don-hang');
});
Route::get('/don-vi-tinh', function () {
    return view('admin.don-vi-tinh');
});
Route::get('/danh-muc-san-pham', function () {
    return view('admin.productCategory');
});
Route::get('/san-pham', function () {
    return view('admin.product');
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
Route::get('/ton-kho', function () {
    return view('admin.ton-kho');
});

//quản lý admins

Route::resource('roles', AdminRolesController::class);

Route::resource('permissions', AdminPermissionsController::class);
Route::resource('manager-admin', AdminManagerAdminController::class);

//quản lý admins
