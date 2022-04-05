<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;
use Illuminate\Support\Facades\Auth;

class EkycVNPTController extends Controller
{
    //
    public function index(Request $request){
        if(!Auth::check()){
            return redirect()->route('account');
        }
        return view('ekyc_vnpt.index');
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
        }elseif( $result['compare']['object']['msg'] == 'MATCH'){
            $user->temp_ekyc = 1;
            $user->hoten = $result['ocr']['object']['name'];
            $user->cmnd = $result['ocr']['object']['id'];
            $user->type_cmnd = $result['ocr']['object']['card_type'];
            $user->cmnd_image = $result['base64_doc_img']['img_front'];
            $user->cmnd_image2 = $result['base64_doc_img']['img_back'];
            $user->avatar = $result['base64_face_img']['img_face_near'];
            $user->save();            
            return response()->json(['<div class="btn-redemo bg-success" id=""><span>THÀNH CÔNG, XÁC NHẬN KẾT QUẢ</span></div>'] ,200);

        }

    }
}
