<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCompany;
use App\Models\User;


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
            'phone' => 'required|min:8|unique:users,name,phone',
            'password' => 'required|min:8|max:30',
            'repassword' => 'required|same:password',
            'company_name' => 'required|min:8',
            'company_license_id' => 'required',
            'user_name' => 'required',
            'company_licensen_image_front' => 'required',
            'company_licensen_image_back' => 'required',
            'sel_province' => 'required',
            'sel_district' => 'required',
            'sel_ward' => 'required',
            'address' => 'required'
        ], [

            'password.min' => 'Mật khẩu ít nhất có 8 ký tự',
            'password.max' => 'Mật khẩu chỉ có nhìu nhất 30 ký tự',
            'repassword.required' => 'Bạn chưa nhập lại mật khẩu',
            'repassword.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Số điện thoại ít nhất phải có 8 số',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
        ]);
        $user = User::create([
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'fullname' => $request->fullname,

        ]);
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
