<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Models\User;
use Carbon\Carbon;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('account.company_register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            'phone' => 'required|min:8|unique:users,phone',
            'password' => 'required|min:8|max:30',
            'repassword' => 'required|same:password',
            'company_licensen_id' => 'required|unique:user_company,company_licensen_id',
            'company_name' =>'required',
        ], [

            'password.min' => 'Mật khẩu ít nhất có 8 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'repassword.required' => 'Bạn chưa nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Số điện thoại ít nhất phải có 8 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'company_licensen_id' => 'Mã số thuế đã tồn tại',
        ]);
        $userToday = User::where('created_at', '>=', Carbon::today())->count();
        $userOrder = $userToday + 1;
        $dt = Carbon::now();
        $getday =  $dt->format("Ymd") * 10000;
        $userID = $getday + $userOrder;
        $user = User::create([
            'phone' => $request->phone,
            'code_customer' => $userID,
            'password' => bcrypt($request->password),
            'hoten' => $request->fullname,
            'is_company' => 1,
            'is_ekyc' => 1,
            'check_ekyc' => 1,
        ]);
        $user->address = $request->address;
        $user->id_phuongxa = $request->sel_ward;
        $user->id_quanhuyen = $request->sel_district;
        $user->id_tinhthanh = $request->sel_province;
        $user->save();
        $user_company = UserCompany::create([
            'id_user' => $user->id,
            'company_name' => $request->company_name,
            'company_licensen_id' => $request->company_licensen_id,
        ]);
        if($request->hasFile('company_licensen_image_front') && $request->hasFile('company_licensen_image_back')){
            $licensen_front = $request->company_licensen_image_front;
            $licensen_back = $request->company_licensen_image_back;
            $name_licensen_front = time() . '.' . $licensen_front->getClientOriginalExtension();
            $name_licensen_back = time() . '.' . $licensen_back->getClientOriginalExtension();
            $destinationPath = public_path('/company_licensen');
            $licensen_front->move($destinationPath, $name_licensen_front);
            $licensen_back->move($destinationPath, $name_licensen_back);
            $user_company->company_licensen_image_front = $name_licensen_front;
            $user_company->company_licensen_image_back = $name_licensen_back;
            $user_company->save();
        }
        return redirect('tai-khoan')->with('thongbao', 'Đăng ký thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
