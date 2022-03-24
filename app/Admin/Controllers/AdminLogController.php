<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use App\Models\Log;

class AdminLogController extends Controller
{
    //
    public function index(){
        $logs = Log::latest()->get();
        return view('admin.log', compact('logs'));
    }

    public function createLog($admin, $tab, $handling, $content, $object_link = null){
        Log::create([
            'admin_id' => $admin->id,
            'fullname' => $admin->fullname,
            'email' => $admin->email,
            'tab' => $tab,
            'handling' => $handling,
            'content' => $content,
            'object_link' => $object_link
        ]);
    }
}
