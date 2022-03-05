<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    //
    public function getVerifyAccount()
    {
        $user = Auth::user();
        return view('ekyc.verify_account');
    }

    public function postVerifyAccount(Request $request)
    {
        $image_front = $request->image_front;
        $image_back = $request->image_back;
        $image_portrait = $request->image_portrait;
        $result_recognition = json_decode($this->postRecognition($image_front));
        if ($result_recognition->result_code == 200) {
            if (count($result_recognition->warning) <2) {
                $result_verify =  json_decode($this->postVerification($image_front, $image_portrait));
                switch ($result_verify->verify_result) {
                    case 0:
                        return back()->with(['message' => 'Hệ thống đối chiếu thông tin không khớp. Quý Khách Hàng vui lòng thực hiện lại']);
                        break;
                    case 1:
                        return back()->with(['message' => 'Hệ thống đối chiếu thông tin không khớp. Quý Khách Hàng vui lòng thực hiện lại']);
                        break;
                    case 2:
                        $user = Auth::user();
                        $user->is_ekyc = 1;
                        $user->hoten = $result_recognition->name;
                        $user->cmnd = $result_recognition->id;
                        $user->type_cmnd = $request->type_cmnd;
                        $user->cmnd_image = $image_front;
                        $user->cmnd_image2 = $image_back;
                        $user->avatar = $image_portrait;
                        $user->save();

                        return back()->with(['message' => 'Tài khoản đã được xác minh thành công']);
                        break;
                }
            } else {
                foreach ($result_recognition->warning as $warning) {
                    switch ($warning) {
                        case 'giay_to_co_do_phan_giai_thap':
                            return back()->with(['message' => 'Giấy tờ có độ phân giải thấp']);
                        case 'giay_to_bi_mo':
                            return back()->with(['message' => 'Giấy tờ có bị mờ']);
                        case 'giay_to_bi_choi_sang':
                            return back()->with(['message' => 'Giấy tờ bị chói sáng']);
                        case 'chung_minh_nhan_dan_bi_mat_goc':
                            return back()->with(['message' => 'Chứng minh nhân dân bị mất góc']);
                        case 'thong_tin_bi_che_khuat':
                            return back()->with(['message' => 'Thông tin giấy tờ bị che khuất']);
                        case 'giay_to_qua_han':
                            return back()->with(['message' => 'Giấy tờ tùy thân bị hết hạn']);
                        case 'so_cmnd_cmnd_khong_hop_le':
                            return back()->with(['message' => 'Số CMND, CCCD không hợp lệ']);
                        case 'anh_giay_to_la_anh_photo':
                            return back()->with(['message' => 'Ảnh giấy tờ là ảnh photo']);
                    }
                }
            }
        } else {
            return back()->with(['message' => $result_recognition->result_message]);
        }
    }

    public function postRecognition($image_cmt)
    {
        $endPoint = 'http://ekyc2.mobifone.ai/v2/recognition';
        $apiKey = '169885e2-7e4a-11ec-9525-0c4de99e932e';
        $url = $endPoint;
        $data = [
            'image' => $image_cmt,
        ];
        $ch = curl_init($url);
        $headers = array(
            "Content-Type: application/json",
            "api-key: " . $apiKey,
        );
        //  $headers[] = "Content-Type: application/json";
        //  $headers[] = "api-key: ".$apiKey;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        // $result = json_encode($result, TRUE);Î
        curl_close($ch);
        return $result;
    }

    public function postVerification($image_cmt, $image_live)
    {
        $endPoint = 'http://ekyc2.mobifone.ai/v2/verification';
        $apiKey = '169885e2-7e4a-11ec-9525-0c4de99e932e';
        $url = $endPoint;

        // $dir_cmt = asset($image_cmt); 
        // $type_cmt = pathinfo($dir_cmt, PATHINFO_EXTENSION);
        // $data_cmt = file_get_contents($dir_cmt);
        // $base64_cmt = base64_encode($image_cmt);
        // $base64_cmt = 'data:image/' . $type_cmt . ';base64,' . base64_encode($data_cmt);
        $base64_cmt = $image_cmt;

        // $dir_live = asset('public/profile_image/potrait.jpg'); 
        // $type_live = pathinfo($dir_live, PATHINFO_EXTENSION);
        // $data_live= file_get_contents($dir_live);
        // $base64_live = 'data:image/' . $type_live . ';base64,' . base64_encode($data_live);
        $base64_live = $image_live;

        $curlFile_cmt = $base64_cmt;
        $curlFile_live = $base64_live;
        $data = [
            'image_cmt' => $curlFile_cmt,
            'image_live' => $curlFile_live
        ];
        $ch = curl_init($url);
        $headers = array(
            "Content-Type: application/json",
            "api-key: " . $apiKey,
        );
        //  $headers[] = "Content-Type: application/json";
        //  $headers[] = "api-key: ".$apiKey;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        // $result = json_encode($result, TRUE);Î
        curl_close($ch);
        return $result;
    }
}
