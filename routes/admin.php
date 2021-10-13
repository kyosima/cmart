<?php
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

Route::group(['middleware' => ['admin']], function () {

    Route::group(['middleware' => ['role_or_permission:Boss,admin']], function () {
        //
        Route::get('/test', [AdminHomeController::class,'test']);
    });
    Route::get('/', [AdminHomeController::class,'dashboard'])->name('admin.index');
    //quản lý admins

    Route::resource('roles', AdminRolesController::class);

    Route::resource('permissions', AdminPermissionsController::class);
    Route::resource('manager-admin', AdminManagerAdminController::class);


    // PRODUCT
    // được phép xem sản phẩm
    Route::group(['middleware' => ['permission:Xem sản phẩm,admin']], function () {
        Route::get('/san-pham', [AdminProductController::class, 'index'])->name('san-pham.index');
    });

    // được phép thêm sản phẩm
    Route::group(['middleware' => ['permission:Thêm sản phẩm,admin']], function () {
        Route::get('/tao-san-pham', [AdminProductController::class, 'create'])->name('san-pham.create');
        Route::post('/san-pham', [AdminProductController::class, 'store'])->name('san-pham.store');
        Route::get('/san-pham/get-category', [AdminProductController::class, 'getCategory'])->name('san-pham.getCategory');
    });

    // được phép chỉnh sửa sản phẩm
    Route::group(['middleware' => ['permission:Chỉnh sửa sản phẩm,admin']], function () {
        Route::get('/san-pham/edit/{id}', [AdminProductController::class, 'edit'])->name('san-pham.edit');
        Route::put('/san-pham/update/{id}', [AdminProductController::class, 'update'])->name('san-pham.update');
        Route::get('/san-pham/get-category', [AdminProductController::class, 'getCategory'])->name('san-pham.getCategory');
    });

    // được phép XÓA sản phẩm
    Route::group(['middleware' => ['permission:Xóa sản phẩm,admin']], function () {
        Route::delete('/san-pham/delete/{id}', [AdminProductController::class, 'destroy'])->name('san-pham.delete');
    });


    // PRODUCT CATEGORIES
    // được phép xem danh mục sản phẩm
    Route::group(['middleware' => ['permission:Xem danh mục sản phẩm,admin']], function () {
        Route::get('/nganh-nhom-hang', [AdminProductCategoryController::class, 'index'])->name('nganh-nhom-hang.index');
    });

    // được phép thêm danh mục sản phẩm
    Route::group(['middleware' => ['permission:Thêm danh mục sản phẩm,admin']], function () {
        Route::post('/nganh-nhom-hang', [AdminProductCategoryController::class, 'store'])->name('nganh-nhom-hang.store');\
        Route::get('/nganh-nhom-hang/get-category', [AdminProductCategoryController::class, 'getCategory'])->name('nganh-nhom-hang.getCategory');
    });

    // được phép chỉnh sửa danh mục sản phẩm
    Route::group(['middleware' => ['permission:Chỉnh sửa danh mục sản phẩm,admin']], function () {
        Route::get('/nganh-nhom-hang/get-category', [AdminProductCategoryController::class, 'getCategory'])->name('nganh-nhom-hang.getCategory');
        Route::get('/nganh-nhom-hang/edit/{id}', [AdminProductCategoryController::class, 'edit'])->name('nganh-nhom-hang.edit');
        Route::get('/nganh-nhom-hang/modal-edit', [AdminProductCategoryController::class, 'modalEdit'])->name('nganh-nhom-hang.modalEdit');
        Route::put('/nganh-nhom-hang/update/{id}', [AdminProductCategoryController::class, 'update'])->name('nganh-nhom-hang.update');
        Route::put('/nganh-nhom-hang/{id}', [AdminProductCategoryController::class, 'updateStatus'])->name('nganh-nhom-hang.updateStatus');
    });

    // được phép XÓA danh mục sản phẩm
    Route::group(['middleware' => ['permission:Xóa danh mục sản phẩm,admin']], function () {
        Route::delete('/nganh-nhom-hang/{id}', [AdminProductCategoryController::class, 'destroy'])->name('nganh-nhom-hang.delete');
    });
    
    // Route::get('/nganh-nhom-hang/test/{id}/{status}/{levelChange}', [AdminProductCategoryController::class, 'recursive'])->name('nganh-nhom-hang.recursive');


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





Route::get('/login', [AdminHomeController::class,'login']);
Route::post('/login', [AdminHomeController::class,'postLogin'])->name('admin.login');

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
// Route::get('/setting', function () {
//     return view('admin.setting');
// });
// Route::get('/ton-kho', function () {
//     return view('admin.ton-kho');
// });

