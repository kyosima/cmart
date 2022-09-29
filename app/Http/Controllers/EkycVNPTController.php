<?php

namespace App\Http\Controllers;

use App\Models\RequestEkyc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EcontractController;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class EkycVNPTController extends Controller
{
    //
    public function __construct()
    {
        $this->econtractController = new EcontractController();
    }
    public function index(Request $request){

        if(Auth::check()){
            $user = Auth::user();
            if($user->change_ekyc == 1 || $user->is_ekyc  == 0){
                return view('ekyc_vnpt.index');
            }else{
                return redirect()->route('home');
            }
        }else{
            return redirect()->route('account');

        }
    }
    public function getRequestChangeEkyc(Request $request){
        if(Auth::check()){
            $user = Auth::user();
       
            $check = $user->request_ekyc()->whereStatus(0)->count();
            if($check==0){
                RequestEkyc::create([
                    'user_id' =>$user->id,
                    'content'=> $request->content,
                ]);
                return back()->with('message', 'Yêu cầu thay đổi thông tin tài khoản thành công');
            }else{
                return back()->with('message', 'Bạn đã gửi yêu cầu thay đổi thông tin tài khoản, vui lòng đợi duyệt');
            }
          
        }else{
            return redirect()->route('home');
        }

    }

    public function postResult(Request $request){
        $user = Auth::user();
        $result = ($request->result);
        if(count($result['ocr']['object']['tampering']['warning']) > 0){
            return response()->json(['<div class="btn-redemo  bg-danger" id=""><span>KHÔNG THÀNH CÔNG</span></div>'] ,200);
        }elseif($result['liveness_face']['object']['blur_face'] == "yes"){
            return response()->json(['<div class="btn-redemo  bg-danger" id=""><span>KHÔNG THÀNH CÔNG</span></div>'] ,200);
        }elseif($result['compare']['object']['match_warning'] == "yes"){
            return response()->json(['<div class="btn-redemo  bg-danger" id=""><span>KHÔNG THÀNH CÔNG</span></div>'] ,200);
        }elseif($result['liveness_face']['object']['liveness'] == "failure"){
            return response()->json(['<div class="btn-redemo  bg-danger" id=""><span>KHÔNG THÀNH CÔNG</span></div>'] ,200);
        }elseif( $result['compare']['object']['msg'] == 'MATCH'){
            $user->is_ekyc = 1;
            $user->change_ekyc = 0;
            $user->hoten = $result['ocr']['object']['name'];
            $user->cmnd = $result['ocr']['object']['id'];
            $user->type_cmnd = $result['ocr']['object']['card_type'];
            $user->cmnd_image = $result['base64_doc_img']['img_front'];
            $user->cmnd_image2 = $result['base64_doc_img']['img_back'];
            $user->avatar = $result['base64_face_img']['img_face_near'];
            $user->save();            
            return response()->json([
                '<div class="btn-redemo bg-success" id=""><a href="'.route('vnpt.confirmResult').'">'.'<span>THÀNH CÔNG, Chuyển tới bước tiếp theo</span></a></div>',
                ] ,200);
        }
    }

    public function confirmResult(Request $request){
        return redirect()->route('econtract.index');
    }

  
}
