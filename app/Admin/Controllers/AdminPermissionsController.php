<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class AdminPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::select('name', 'id')->get();
        return view('admin.manager_admin.permissions', compact('permissions'));
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
        //
        $validator = Validator::make($request->all(), [
            'in_name' => 'required|unique:Spatie\Permission\Models\Permission,name'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $permission = Permission::create(['guard_name' => 'admin', 'name' => $request->in_name]);
        $type = 'permission';
        $html = view('admin.template-render.render', compact('permission', 'type'))->render();
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
        //
        $validator = Validator::make($request->all(), [
            'in_name_edit' => ['required', Rule::unique('permissions', 'name')->ignore($request->in_id_edit)],
            'in_id_edit' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response($validator->errors(), 400);
        }
        $permission = Permission::find($request->in_id_edit);
        $permission->name = $request->in_name_edit;
        $permission->updated_at = Carbon::now();
        $permission->save();
        $type = 'permission';
        $html = view('admin.template-render.render', compact('permission', 'type'))->render();
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
        Permission::find($id)->delete();
        return response('Thành công', 200);
    }
}