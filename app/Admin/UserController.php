<?php

namespace App\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use Carbon\Carbon;

class UserController extends Controller
{


    public function getDanhSach() {
        $user = User::all();
        return view('admin.user.listuser',['user'=>$user]);
    }

    public function postDanhsach(Request $request,$id) {
        $user = User::find($id);
        $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.status')->get()->where('status','=',4)->count();

        if($user->level == 0 && ($orders >= 3 || $user->tichluyC >= 5000000)){
            $user->level = 1;
            $user->save();
            return back();
        }
        elseif($user->level == 1 && ($orders >= 5 || $user->tichluyC >= 300000000)) {
            $user->level = 2;
            $user->save();
            return back();
        }
        else 
            return back();


    }

    public function getEdit($id) {
        $user = User::find($id);
        $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
        $province = Province::select('matinhthanh', 'tentinhthanh')->get();
        $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
        $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.*')->get();

        if(($user->id_tinhthanh != null) || ($user->id_quanhuyen != null) || ($user->id_phuongxa != null)) {
            $tinh = DB::table('users')->join('province', 'province.matinhthanh', '=', 'users.id_tinhthanh')
            ->where('province.matinhthanh','=',$user->id_tinhthanh)->select('province.tentinhthanh')->first()->tentinhthanh;

            $quan = DB::table('users')->join('district', 'district.maquanhuyen', '=', 'users.id_quanhuyen')
            ->where('district.maquanhuyen','=',$user->id_quanhuyen)->select('district.tenquanhuyen')->first()->tenquanhuyen;

            $phuongxa = DB::table('users')->join('ward', 'ward.maphuongxa', '=', 'users.id_phuongxa')
            ->where('ward.maphuongxa','=',$user->id_phuongxa)->select('ward.tenphuongxa')->first()->tenphuongxa;
        } else {
            $tinh = DB::table('users')->join('province', 'province.matinhthanh', '=', 'users.id_tinhthanh')->first()->tentinhthanh;

            $quan = DB::table('users')->join('district', 'district.maquanhuyen', '=', 'users.id_quanhuyen')->first()->tenquanhuyen;

            $phuongxa = DB::table('users')->join('ward', 'ward.maphuongxa', '=', 'users.id_phuongxa')->first()->tenphuongxa;
        }
        // $tinh =DB::table("province")->where('province.matinhthanh','=',$user->matinhthanh)->pluck("tentinhthanh");
        $sodonhang = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.status')->get()->count();
        
        // dd($orders); die;


        return view('admin.user.profile',['user'=>$user,'province'=>$province,
         'district'=>$district, 'ward'=>$ward],compact('orders','sodonhang','tinh','quan','phuongxa'));
    }

    public function postEdit(Request $request, $id) {
        $user = User::find($id);
        $user->hoten = $request->hoten;
        $user->level = $request->level;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->check_kyc = $request->check_kyc;
        $user->type_cmnd = $request->type_cmnd;
        $user->id_tinhthanh = $request->sel_province;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_phuongxa = $request->sel_ward;
        $user->save();
        return redirect('admin/danh-sach-user');
    }

    public function nangcap(Request $request){
        $user = User::where('user_id',Auth::user()->id);
        return redirect('admin/danh-sach-user');
    }

}