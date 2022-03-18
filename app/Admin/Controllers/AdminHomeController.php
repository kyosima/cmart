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
            $user = User::all();
            foreach ($user->where('id','!=',1) as $us) {
                $datePoint = $us->created_at->addMonth('1')->startOfDay();
                if (Carbon::now() >= $datePoint) {
                    $us->created_at = $us->created_at->addMonth('1')->startOfDay();
                    $notelichsu = Carbon::parse($us->created_at)->format('Y-m-d');
                    
                    $pointC = PointC::where('user_id','=',$us->id)->first();
                    $amount = round($pointC->point_c * 0.01, 0);
                    $pointTietKiem = $pointC->point_c + $amount;
    
                    $id_user_chuyen = User::where('id','=',1)->first()->id;
                    $vi_user_chuyen = PointC::where('user_id','=',$id_user_chuyen)->first();
                    // luu lich su 
                    
                    $lichsu_chuyen = new PointCHistory;
                    $lichsu_chuyen->point_c_idnhan = $us->id;
                    $lichsu_chuyen->point_past_nhan = $pointC->point_c;
                    $lichsu_chuyen->point_present_nhan = $pointTietKiem;
                    $lichsu_chuyen->makhachhang = $us->code_customer;
                    $lichsu_chuyen->note = 'Tiết kiệm ngày '.$notelichsu.' từ TK '.$us->code_customer;
                    $lichsu_chuyen->amount = $amount;
                    $lichsu_chuyen->type = 3;
                    $lichsu_chuyen->created_at = $us->created_at->startOfDay();

                    $lichsu_chuyen->point_c_idchuyen = $vi_user_chuyen->id;
                    $lichsu_chuyen->point_past_chuyen = $vi_user_chuyen->point_c;
                    $lichsu_chuyen->point_present_chuyen = $vi_user_chuyen->point_c - $amount;
                    $lichsu_chuyen->makhachhang_chuyen = 202201170001;
                    $lichsu_chuyen->save();
    
                    $pointC->point_c = $pointTietKiem;
                    $vi_user_chuyen->point_c -= $amount;
                    $vi_user_chuyen->save();
                    $pointC->save();
    
                    $us->save();
                }
            }
            return redirect('/admin');
        }
        Session::flash('error', 'Tài khoản hoặc mật khẩu không đúng');
        return back();
    }
}
