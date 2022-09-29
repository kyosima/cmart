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

class UserController extends Controller
{
    //
    public function getAccessAccount(){
        return view('account.access');
    }

    public function postRegister(Request $request){
        $this->validate($request, [
            'phone' => 'required|min:8|unique:users,phone',
            'password' => 'required|min:8|max:30',
            'passwordAgain' => 'required|same:password',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'address' => 'required'
        ], [

            'password.min' => 'Mật khẩu ít nhất có 8 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Số điện thoại ít nhất phải có 8 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'province_id' => 'Chưa chọn tỉnh thành',
            'district_id' => 'Chưa chọn quận huyện',
            'ward_id' => 'Chưa chọn phường xã',
            'address' => 'Chưa nhập địa chỉ'
        ]);
        $count_user = User::where('created_at', '>=', Carbon::today())->count();
        $dt = Carbon::now();
        $getday =  $dt->format("Ymd") * 10000;
        $userID = $getday + $count_user+1;
        $data_user = $request->only('phone', 'is_company');
        $data_user['password'] = Hash::make($request->password);
        $user = User::create($data_user);
        $data_user_info = $request->only('province_id', 'district_id', 'ward_id', 'address',);
        $user->user_info()->create($data_user_info);
        return back()->with('thongbao', 'Đăng ký tài khoản thành công');

    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|min:8|numeric',
            'password' => 'required|min:8|max:30',
        ], [
            'phone.required' => 'Bạn chưa nhập số điện thoại đăng nhập',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu bạn nhập không chính xác',
            'password.max' => 'Mật khẩu bạn nhập không chính xác',
        ]);

        if (Auth::guard('user')->attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::guard('user')->user();
            if($user->status == 0){
                Auth::logout();
               return redirect('tai-khoan')->with('thongbao', 'Hồ Sơ Khách Hàng ngưng hoạt động');
            }
                // if ($user->is_ekyc == 0) {
                //     return redirect()->route('vnpt.index');
                // }elseif($user->is_econtract == 0 ){
                //     return redirect()->route('econtract.index');

                // }
            return redirect('/');
        } else {
            return redirect('tai-khoan')->with('thongbao', 'Hồ Sơ Khách Hàng không tồn tại');
        }
    }
    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('user.access');
    }

}
