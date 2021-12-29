<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\Settings;

class AdminSettingController extends Controller
{
    //

    public function index(){
        $settings = Settings::select('key', 'plain_value')->get();
        
        $setting = array();
        
        foreach($settings->toArray() as $value){ 
            $arr = [$value['key'] => $value['plain_value']];
            $setting = $setting + $arr;
        }
        $check_maintenance_mode = file_exists(storage_path().'/framework/down') ? 1 : 0 ;
        return view('admin.setting', compact('check_maintenance_mode', 'setting'));
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

    public function store(Request $request){
        $array = $request->input(); 
        unset($array['_token']);
        foreach($array as $key => $value){
            Settings::updateOrCreate(
                ['key' => $key],
                ['plain_value' => $value]
            );
        }
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Thay đổi thông tin trong cài đặt', ['data' => $request->all()]);
        Session::flash('success', 'Thực hiện thành công !');
        return back();
    }
}
