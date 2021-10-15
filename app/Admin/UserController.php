<?php

namespace App\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function getDanhSach() {
        $user = User::all();
        return view('admin.user.listuser',['user'=>$user]);
    }

    public function getEdit($id) {
        $user = User::find($id);
        return view('admin.user.profile',['user'=>$user]);
    }

    public function postEdit(Request $request, $id) {
        $this->validate($request, ['name' => 'required|min:6'],);
        $user = User::find($id);
        $user->name = $request->name;
        $user->level = $request->level;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();
        return redirect('admin/user/danhsach');
    }


}
