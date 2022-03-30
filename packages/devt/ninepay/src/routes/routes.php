<?php

use Illuminate\Support\Facades\Route;
use Devt\Ninepay\Controllers\ConnectController;

Route::group(['middleware' => ['web']], function () {
    
    Route::get('ninepay', [ConnectController::class, 'call']);

    Route::get('ninepay-back', [ConnectController::class, 'back'])->name('ninepay.back');

    Route::get('ninepay-call-back', [ConnectController::class, 'callBack'])->name('ninepay.call.back');
});


