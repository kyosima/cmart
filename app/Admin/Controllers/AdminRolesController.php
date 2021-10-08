<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class AdminRolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::select('name', 'id')->whereNotIn('name', ['All Permissions'])->get();
        return view('admin.manager_admin.roles', compact('roles', 'permissions'));
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
            'in_name' => 'required|unique:Spatie\Permission\Models\Role,name', 
            'sel_permission' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $role = Role::create(['guard_name' => 'admin', 'name' => $request->in_name]);
        
        $permission = Permission::whereIn('id', $request->sel_permission)->get();

        foreach ($request->sel_permission as $value){
            if($value == 'All Permissions'){
                $permission = Permission::all();
                break;
            }
        }
        $role->givePermissionTo($permission);
        $type = 'roles';
        $html = view('admin.template-render.render', compact('role', 'permission','type'))->render();
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
        $role = Role::find($id);
        
        $type = 'Permissions Role';

        if($role->hasPermissionTo('All Permissions')){
            $permissions = Permission::whereNotIn('name', ['All Permissions'])->get();
            $type = 'All Permissions';
            return view('admin.template-render.render', compact('permissions','type'))->render();
        }
        $permissions = Permission::whereNotIn('name', ['All Permissions'])->with('roles')->get();
        return view('admin.template-render.render', compact('permissions', 'type', 'role'))->render(); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        
        $validator = Validator::make($request->all(), [
            'in_name_edit' => ['required', Rule::unique('roles', 'name')->ignore($request->in_id_edit)],
            'in_id_edit' => 'required', 
            'sel_permission_edit' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }

        $permission = Permission::whereIn('id', $request->sel_permission_edit)->get();

        foreach ($request->sel_permission_edit as $value){
            if($value == 'All Permissions'){
                $permission = Permission::all();
                break;
            }
        }
        $role = Role::find($request->in_id_edit);
        $role->name = $request->in_name_edit;
        $role->updated_at = Carbon::now();
        $role->save();

        $role->syncPermissions($permission);

        $type = 'roles';
        $html = view('admin.template-render.render', compact('role', 'permission','type'))->render();
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
        //
        Role::find($id)->delete();
        return response('Thành công', 200);
    }
}
