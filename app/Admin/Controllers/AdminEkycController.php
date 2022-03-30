<?php

namespace App\Admin\Controllers;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\RequestEkyc;
use App\Models\User;
use App\Admin\Controllers\AdminLogController; 

class AdminEkycController extends Controller
{
    //
    public $logController;
    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function index(){
        $requests_ekyc = RequestEkyc::orderBy('status', 'asc')->get();
        return view('admin.ekyc.index', compact('requests_ekyc'));
    }

    public function changeStatus(Request $request){
        $id_request = $request->id_request;
        $status = $request->status;
        $request_ekyc = RequestEkyc::whereId($id_request)->first();
        $user = $request_ekyc->user()->first();

        if($request_ekyc->status ==0){
            switch($status){
                case 1:
                    $user->change_ekyc = 1;
                    $user->save();
                    $request_ekyc->status = 1;
                    $request_ekyc->save();
                    $admin = auth('admin')->user();
                    $this->logController->createLog($admin, 'EKYC', 'Duyệt', 'yêu cầu thay đổi EKYC'.$user->code_customer);
                   
                    break;
                case 2:
                    $request_ekyc->status = 2;
                    $request_ekyc->save();
                    $admin = auth('admin')->user();
                    $this->logController->createLog($admin, 'EKYC', 'Hủy', 'yêu cầu thay đổi EKYC'.$user->code_customer);

                    break;
            }
        }
        return back();
    }
}
