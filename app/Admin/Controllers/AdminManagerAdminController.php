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
use App\Admin\Controllers\AdminLogController; 


class AdminManagerAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $logController;
    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function index()
    {
        //
        $admins = Admin::whereNotIn('email', ['admin@gmail.com'])->with('roles')->get();
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
            'fullname' => 'required|min:3|unique:App\Models\Admin,name',
            'in_email' => 'required|min:3|email|unique:App\Models\Admin,email',
            'in_password' => 'required|min:8',
            'in_confirm_password' => 'same:in_password',
            'sel_permission' => 'required'
        ], [
            'fullname.unique' => 'Tên này đã tồn tại',
            'fullname.min' => 'Ít nhất 3 ký tự',
            'in_email.min' => 'Ít nhất 3 ký tự',
            'in_email.unique' => 'Email này đã tồn tại',
            'in_password.min' => 'Mật khẩu Ít nhất 8 ký tự',
            'in_confirm_password.same' => 'Mật khẩu không khớp',
            'sel_permission.required' => 'Vui lòng chọn vai trò'
        ]);
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        // if(!Str::isAscii($request->in_name) || Str::contains($request->in_name, ' ')){
        //     return Response::json(['error' => ['Tên không chứa ký tự đặc biệt và khoảng cách']], 400);
        // }
        $admin = Admin::create([
            'fullname' => $request->fullname,
            'email' => $request->in_email,
            'DVCQ' => $request->DVCQ,
            'password' => bcrypt($request->in_password)
        ]);
        $admin->givePermissionTo($request->sel_permission);
        $permission_name = $request->sel_permission;
        $type = 'admin';
        $html = view('admin.template-render.render', compact('admin', 'type', 'permission_name'))->render();
        $ad = auth('admin')->user();
        $this->logController->createLog($ad, 'Quản lý Admin', 'Tạo', ' tài khoản admin, email: '.$request->in_email. ' ,Họ tên: '.$request->fullname);
      
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
        $permissions = Permission::all()->pluck('name');
        $type = 'adminPermission';
        return view('admin.template-render.render', compact('admin', 'type', 'permissions'))->render();
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
        if($request->is_changepass == 1){
            $validator = Validator::make($request->all(), [
                'in_fullname_edit' => ['required', 'min:3'],
                'in_confirm_new_password' => 'same:in_new_password',
                'sel_permission_edit' => 'required'
            ], [
                'in_name.min' => 'Ít nhất 3 ký tự',
                'in_email.min' => 'Ít nhất 3 ký tự',
                'in_email.unique' => 'Email này đã tồn tại',
                'in_password.min' => 'Mật khẩu Ít nhất 8 ký tự',
                'in_confirm_password.same' => 'Mật khẩu không khớp',
                'sel_role_edit.required' => 'Vui lòng chọn vai trò'
            ]);
        }else{
            $validator = Validator::make($request->all(), [
                'in_fullname_edit' => ['required', 'min:3'],
                'sel_permission_edit' => 'required'
            ], [
                'in_name.min' => 'Ít nhất 3 ký tự',
                'in_email.min' => 'Ít nhất 3 ký tự',
                'in_email.unique' => 'Email này đã tồn tại',
                'sel_role_edit.required' => 'Vui lòng chọn vai trò'
            ]);
        }
        
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        if(!Str::isAscii($request->in_name) || Str::contains($request->in_name, ' ')){
            return Response::json(['error' => ['Tên không chứa ký tự đặc biệt và khoảng cách']], 400);
        }
        $admin = Admin::find($request->in_id_edit);
        $message = 'admin email: '.$admin->email.', ';
        if($admin->fullname != $request->in_fullname_edit){
            $message .= 'họ và tên: '.$admin->fullname.' -> '.$request->in_fullname_edit.', ';
        }
        if($admin->DVCQ != $request->DVCQ){
            $message .= 'đơn vị chủ quản: '.$admin->DVCQ.' -> '.$request->DVCQ.', ';
        }
     
        $admin->fullname = $request->in_fullname_edit;
        $admin->DVCQ = $request->DVCQ;
        if($request->is_changepass == 1){
            if ($request->in_new_password != null) {
                $message .= 'mật khẩu, ';
                $admin->password = bcrypt($request->in_new_password);
            }
        }
   

        $admin->save();
        $admin = Admin::find($request->in_id_edit);
        $permissions_old = $admin->permissions;
        $admin->syncPermissions($request->sel_permission_edit);
        $permission_name = $request->sel_permission_edit;
        if($permissions_old != $admin->permissions){
            $message .= 'quyền: ';

            foreach($permissions_old as $permission){
                $message .= $permission->name.', ';
            }
    
            $message .= ' -> ';
            foreach($admin->permissions as $permission){
                $message .= $permission->name.', ';
            }
        }
      
        $type = 'admin';
        $html = view('admin.template-render.render', compact('admin', 'type', 'permission_name'))->render();
        if($message != ''){
            $ad = auth('admin')->user();
                $this->logController->createLog($ad, 'Quản lý Admin', 'Sửa',substr_replace($message ,"", -1));
        }
        
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
        $admin =Admin::find($id);
        Admin::find($id)->delete();
        $ad = auth('admin')->user();
        $this->logController->createLog($ad, 'Quản lý Admin', 'Xoá', ' tài khoản admin, email: '.$admin->email. ' ,Họ tên: '.$admin->fullname);
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
