<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\RequestEkyc;
use App\Models\User;

class AdminEkycController extends Controller
{
    //
    public function index(){
        $requests_ekyc = RequestEkyc::orderBy('status', 'asc')->get();
        return view('admin.ekyc.index', compact('requests_ekyc'));
    }

    public function changeStatus(Request $request){
        $id_request = $request->id_request;
        $status = $request->status;
        $request_ekyc = RequestEkyc::whereId($id_request)->first();
        if($request_ekyc->status ==0){
            switch($status){
                case 1:
                    $user = $request_ekyc->user()->first();
                    $user->change_ekyc = 1;
                    $user->save();
                    $request_ekyc->status = 1;
                    $request_ekyc->save();
                    break;
                case 2:
                    $request_ekyc->status = 2;
                    $request_ekyc->save();
                    break;
            }
        }
        return back();
    }
}
