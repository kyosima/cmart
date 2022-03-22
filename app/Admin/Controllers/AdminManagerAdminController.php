<?php

namespace App\Admin\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;


class AdminManagerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::with('roles')->get();
        // return $admins;
        $permissions = Permission::all();
        return view('admin.manager_admin.manager-admin', compact('admins', 'permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'in_name' => 'required|min:3|unique:App\Models\Admin,name',
            'in_email' => 'required|min:3|email|unique:App\Models\Admin,email',
            'in_password' => 'required|min:3',
            'in_confirm_password' => 'same:in_password',
            'sel_role' => 'required'
        ], [
            'in_name.unique' => 'Tên này đã tồn tại',
            'in_name.min' => 'Ít nhất 3 ký tự',
            'in_email.min' => 'Ít nhất 3 ký tự',
            'in_email.unique' => 'Email này đã tồn tại',
            'in_password.min' => 'Ít nhất 3 ký tự',
            'in_confirm_password.same' => 'Mật khẩu không khớp',
            'sel_role.required' => 'Vui lòng chọn vai trò'
        ]);
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        if(!Str::isAscii($request->in_name) || Str::contains($request->in_name, ' ')){
            return Response::json(['error' => ['Tên không chứa ký tự đặc biệt và khoảng cách']], 400);
        }
        $admin = Admin::create([
            'name' => $request->in_name,
            'email' => $request->in_email,
            'DVCQ' => $request->DVCQ,
            'password' => bcrypt($request->in_password)
        ]);
        $admin->givePermissionTo($request->sel_permission);
        $role_name = $request->sel_role;
        $type = 'admin';
        $html = view('admin.template-render.render', compact('admin', 'type', 'role_name'))->render();
        return $html;
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
        $admin = Admin::find($id);
        
        $roles = Role::all()->pluck('name');
        $type = 'adminRole'; 
        return view('admin.template-render.render', compact('admin', 'type', 'roles'))->render();
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
        $validator = Validator::make($request->all(), [
            'in_name_edit' => ['required', 'min:3', Rule::unique('admins', 'name')->ignore($request->in_id_edit)],
            'in_email_edit' => ['required', 'min:3', Rule::unique('admins', 'email')->ignore($request->in_id_edit)],
            'in_confirm_new_password' => 'same:in_new_password',
            'sel_role_edit' => 'required'
        ], [
            'in_name.unique' => 'Tên này đã tồn tại',
            'in_name.min' => 'Ít nhất 3 ký tự',
            'in_email.min' => 'Ít nhất 3 ký tự',
            'in_email.unique' => 'Email này đã tồn tại',
            'in_password.min' => 'Ít nhất 3 ký tự',
            'in_confirm_password.same' => 'Mật khẩu không khớp',
            'sel_role_edit.required' => 'Vui lòng chọn vai trò'
        ]);
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        if(!Str::isAscii($request->in_name) || Str::contains($request->in_name, ' ')){
            return Response::json(['error' => ['Tên không chứa ký tự đặc biệt và khoảng cách']], 400);
        }
        $admin = Admin::find($request->in_id_edit);
        $admin->name = $request->in_name_edit;
        $admin->email = $request->in_email_edit;
        if ($request->in_new_password != null) {
            $admin->password = bcrypt($request->in_new_password);
        }

        $admin->save();
        $admin->syncRoles($request->sel_role_edit);
        $role_name = $request->sel_role_edit;
        $type = 'admin';
        $html = view('admin.template-render.render', compact('admin', 'type', 'role_name'))->render();
        return $html;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        return response('Thành công', 200);
    }

    public function multiple(Request $request){
        $this->validate($request, [
            'action' => 'required',
            'id' => 'required'
        ]);
        if($request->action == 'delete'){
            foreach($request->id as $value){
                Admin::find($value)->delete();
            }
            Session::flash('success', 'Thực hiện thành công');
        }
        elseif($request->action == 'show'){
            Admin::whereIn('id', $request->id)->update(['status' => 1]);
        }
        elseif($request->action == 'hidden'){
            Admin::whereIn('id', $request->id)->update(['status' => 0]);
        }
        else{
            Session::flash('warning', 'Thực hiện không thành công');
        }
        return back();
    }
}
