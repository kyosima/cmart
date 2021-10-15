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
        if(Auth::guard('admin')->attempt(['name' => $request->in_name, 'password' => $request->in_password])){
            return redirect('/admin');
        }
        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return back();
    }
}
