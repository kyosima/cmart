<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    //
    public function getProfile(){
        $user = Auth::guard('user')->user();
        $user->user_info = $user->user_info()->with('province', 'district', 'ward')->first();
        $user->level = $user->user_level()->first();
        $user->wallet = $user->wallet()->first();
        return view('account.profile', compact('user'));

    }

    public function postProfile(Request $request){
        $user = Auth::guard('user')->user();

        if ($request->changePassword == "on") {
            $this->validate($request, [
                'password' => 'required|min:8|max:30',
                'passwordAgain' => 'required|same:password'
            ], [
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
                'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return back()->with('success', 'Sửa thành công');
    }

    public function getOrder(){
        $user = Auth::guard('user')->user();
        $orders = $user->orders()->latest()->with('order_stores')->get();
        return view('account.order', compact('orders'));

    }

}
