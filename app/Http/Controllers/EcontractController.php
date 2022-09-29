<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcontractController extends Controller
{
    //

    public function index(Request $request){
        $user = Auth::user();
        if($user->is_econtract == 0){
            if($user->econtract_id == null){
                $contractId  = $this->sendContract($request);
            }else{
                $contractId = $user->econtract_id;
            }
            return view('econtract.index', compact('contractId'));
        }else{
            return redirect()->route('home');
        }
    }

    public function signSuccess(Request $request){
        $user = Auth::user();
        $user->is_econtract = 1;
        $user->save();
        return redirect()->route('account.info')->with('success', 'Ký thành công hợp đồng giao dịch');
    }
    public function getToken(Request $request){
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/auth-service/oauth/token';
        $client_id = 'cmart.client@econtract.vnpt.vn';
        $client_secret = 'JZynPTg7TuD56dJGA32qQNcxZU9GCdQb';
        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'client_credentials',
        ];
        $ch = curl_init($endPoint);
        $headers = array(
            "Content-Type: application/json",
        );
        //  $headers[] = "Content-Type: application/json";
        //  $headers[] = "api-key: ".$apiKey;
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
        $request->session()->put('token', $result['access_token']);

    }
    public function getAccesstokenAccount(Request $request){
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/auth-service/oauth/token';
        $client_id = 'cmart.client@econtract.vnpt.vn';
        $client_secret = 'JZynPTg7TuD56dJGA32qQNcxZU9GCdQb';
        $user = Auth::user();
        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'username' =>'0316959402',
            'password' => 'Abc@12345',
            'grant_type' => 'password',
            'domain' => 'econtract-demo.vnptit3.vn',
        ];
        $ch = curl_init($endPoint);
        $headers = array(
            "Content-Type: application/json",
        );
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
        return $result['access_token'];
    }

    public function getListContract(Request $request){
        $template_id = '62be942ccf717cfd274ab40c';
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/template-service/api/templates/v1/'.$template_id.'/all-config';
        $ch = curl_init($endPoint);
        $token =  $request->session()->get('token');
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, TRUE);
        return $result;
    }

    public function renderContract(Request $request){
        $user = Auth::user();
        $template_id = '62c68476931048a04d4c26e5';
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/template-service/api/templates/app/v1/'.$template_id.'/render';
        $domain = 'econtract-demo.vnptit3.vn';
        $this->getToken($request);
        $token =  $request->session()->get('token');
        $data = [
            'domain' => $domain,
            '${maB}' => $user->code_customer,
            '${ngay}' => date('d'),
            '${thang}' => date('m'),
            '${nam}' => date('Y'),
            '${tenB}' => $user->hoten,
            '${giaytoB}' => $user->type_cmnd.'-'.$user->cmnd,
            '${sdtB}' => $user->phone,
            '${daidienB}' => $user->hoten,
            
        ];
        $ch = curl_init($endPoint);
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        );
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, TRUE);
        return $result['object']['urlDownload'];
    }
    

    public function createContract(Request $request){
        $user = Auth::user();
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/esolution-service/contracts/create-draft-from-file-raw';
        $fields = array();
        $customer = [
            "email"=> "",
            "sdt"=> $user->phone,
            "userType"=> "CONSUMER",
            "ten"=> "Nguyễn Chính Hưng",
            "noiCap"=> "da nang",
            "tenToChuc"=> "to chuc test ne",
            "mst"=> "09924523234",
            "loaiGtId"=> "1",
            "noiCap"=> "",
            "soDkdn"=> "",
            "ngayCapSoDkdn"=> "2021-12-22",
            "noiCapDkkd"=> "",
        ];

        $contract = [
            "autoRenew"=> "true",
            "callbackUrl" => "test url",
            "contractValue"=> "",
            "creationNote"=> "",
            "endDate"=> "2022-11-17",
            "flowTemplateId"=> "",
            "sequence"=> 1,
            "signFlow"=> [
                [
                  "signType"=> "APPROVE",
                  "signForm"=> [
                    "NO_AUTHEN",
                  ],
                  "userId"=> "ledaicuong.info@gmail.com",
                  "sequence"=> 1,
                  "limitDate"=> 3
                ],
              
              ],
            "signForm"=> [
                "NO_AUTHEN",
            ],
            "templateId"=> "62c68476931048a04d4c26e5",
            "title"=> "Hợp đồng nguyên tắc giao dịch số HĐ ".$user->code_customer,
            "validDate"=> "2022-7-17",
            "verificationType"=> "NONE"
        
        ];
        $token =  $request->session()->get('token');

        $cFile = new \CURLFile($this->renderContract($request), 'application/pdf', 'receipt');
        
        $data = [
            'customer' => json_encode($customer),
            'contract' => json_encode($contract),
            'fields' => json_encode($fields),
            ''=> $cFile,
        ];

        $ch = curl_init($endPoint);
        $headers = [
            "Content-Type: multipart/form-data",
            "Authorization: Bearer ".$token,
        ];
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, TRUE);
        $user->econtract_id = $result['object']['contractId'];
        $user->save();
        return $result['object']['contractId'];
    }
    
    public function sendContract(Request $request){
        $contractId = $this->createContract($request);
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/esolution-service/contracts/'.$contractId.'/submit-contract';
        $ch = curl_init($endPoint);
        $token =  $request->session()->get('token');

        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        ];
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, TRUE);
        $this->requestSignContract($contractId, $request);
        return $contractId;

    }

    public function requestSignContract($contractId, Request $request){
        $endPoint = 'https://apigateway-econtract-demo.vnptit3.vn/esolution-service/contracts/'.$contractId.'/electronic-sign';
        $ch = curl_init($endPoint);
        $token =  $request->session()->get('token');
        $headers = [
            "Content-Type: application/json",
            "Authorization: Bearer ".$token,
        ];
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, '');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        // $result = json_decode($result, TRUE);
        return $result;
    }
}
