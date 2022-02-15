<?php

use Illuminate\Support\Facades\Route;
use Devt\Payme\controllers\ApiService;

Route::get('payme', [ApiService::class, 'test']);