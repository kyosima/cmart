<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class AdminSettingController extends Controller
{
    //

    public function index(){
        $check_maintenance_mode = file_exists(storage_path().'/framework/down') ? 1 : 0 ;
        return view('admin.setting', compact('check_maintenance_mode'));
    }
    public function maintenanceMode(Request $request){
        
        if($request->in_action == "on"){
            Artisan::call("down");
            Session::flash('success', 'Bật chế độ bảo trì thành công !');
            Log::info('Admin '.auth()->guard('admin')->user()->name.' Bật chế độ bảo trì', ['data' => $request->all()]);
            return back();
        }
        Artisan::call("up");
        Session::flash('success', 'Tắt chế độ bảo trì thành công !');
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Tắt chế độ bảo trì', ['data' => $request->all()]);
        return back();
    }
}
