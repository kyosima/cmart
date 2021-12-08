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

class UserController extends Controller
{


    public function getDanhSach() {
        $user = User::all();
        return view('admin.user.listuser',['user'=>$user]);
    }

    public function postDanhsach(Request $request) {
        $user = User::all();
        $user->level = $request->levelUP;
        $user->save();
        return redirect('admin/danh-sach-user');
    }

    public function getEdit($id) {
        $user = User::find($id);
        $province = Province::select('matinhthanh', 'tentinhthanh')->get();
        $district = District::select('maquanhuyen', 'tenquanhuyen')->get();
        $ward = Ward::select('maphuongxa', 'tenphuongxa')->get();
        $orders = DB::table('users')->join('orders', 'orders.user_id', '=', 'users.id')
        ->where('orders.user_id','=',$user->id)->select('orders.*')->get();
        return view('admin.user.profile',['user'=>$user,'province'=>$province,
         'district'=>$district, 'ward'=>$ward],compact('orders'));
    }

    public function postEdit(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->level = $request->level;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->check_kyc = $request->check_kyc;
        $user->save();
        return redirect('admin/danh-sach-user');
    }

    public function nangcap(Request $request){
        $user = User::where('user_id',Auth::user()->id);
        return redirect('admin/danh-sach-user');
    }

}