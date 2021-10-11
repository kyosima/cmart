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
        $roles = Role::all();
        return view('admin.manager_admin.manager-admin', compact('admins', 'roles'));
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
            'in_name' => 'required|min:3|unique:App\Models\Admin,name|',
            'in_email' => 'required|min:3|email|unique:App\Models\Admin,email',
            'in_password' => 'required|min:3',
            'in_confirm_password' => 'required|min:3|same:in_password',
        ]);
        if($validator->fails()){
            return response($validator->errors(), 400);
        }
        if(!Str::isAscii($request->in_name) || Str::contains($request->in_name, ' ')){
            return Response::json(['error' => ['Please enter field name must not special charactor and space']], 400);
        }
        $admin = Admin::create([
            'name' => $request->in_name,
            'email' => $request->in_email,
            'password' => bcrypt($request->in_password)
        ]);
        $admin->assignRole($request->sel_role);
        $role_name = $request->sel_role;
        $type = 'addAdmin';
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
