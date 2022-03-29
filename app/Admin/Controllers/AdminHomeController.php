<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Models\PointC;
use App\Models\PointCHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class AdminHomeController extends Controller
{
    public function test(){
        Log::info("Hello everyone");
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function login(){
        if(Auth::guard('admin')->check()){
            return redirect('/admin');
        }
        return view('admin.login');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('get.admin.login');
    }
    public function postLogin(Request $request){
        if(Auth::guard('admin')->attempt($request->only('email','password'))){
           
            return redirect('/admin');
        }
        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return back();
    }

    public function getChangePassword(Request $request){
        return view('admin.change_password');
    }
    public function postChangePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
          
        ], [
            'old_password.required' => 'Mật khẩu hiện tại không được để trống',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu mới phải trên 8 ký tự',
        ]);
        $admin = auth('admin')->user();

        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password =  Hash::make($request->new_password);
            return back()->with('message', 'Đổi mật khẩu thành công');
        }else{
            return back()->with('message', 'Mật khẩu hiện tại không đúng');
        }

    }
}
