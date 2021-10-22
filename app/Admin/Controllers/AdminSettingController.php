<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminSettingController extends Controller
{
    //

    public function maintenanceMode(){
        Artisan::call("down");
    }
}
