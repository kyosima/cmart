<?php
use Illuminate\Support\Facades\Route;
use App\Admin\Controllers\AdminHomeController;

// Route::get('/test', [AdminHomeController::class, 'test']);
Route::group(['middleware' => ['can:Manager']], function () {
    Route::get('/test', [AdminHomeController::class, 'test']);
});
Route::get('/', function () {
    return view('admin.dashboard');
});
Route::get('/login', function () {
    return view('admin.login');
});
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