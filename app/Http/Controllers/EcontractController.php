<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EcontractController extends Controller
{
    //
    public function getToken(){
        $endPoint = 'https://apigateway-econtract.vnptit3.vn/auth-service/oauth/token';
        $client_id = 'cmart.client@econtract.vnpt.vn';
        $client_secret = 'kAkZuX2hE7bhfEacGyVp8sZT3tuFLPrd';
        $domain = 'econtract.vnpt.vn';
        $data = [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'client_credentials',
            'domain' => $domain,
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
        return $result['access_token'];
    }

    public function getListContract(){
        $template_id = '621701090fb6397b52e87bc9';
        $endPoint = 'https://apigateway-econtract.vnptit3.vn/template-service/api/templates/v1/'.$template_id.'/all-config';
        $ch = curl_init($endPoint);
        
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->getToken(),
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $endPoint);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, TRUE);
        return $result;
    }

    public function renderContract(){
        $template_id = '621701090fb6397b52e87bc9';
        $endPoint = 'https://apigateway-econtract.vnptit3.vn/template-service/api/templates/app/v1/'.$template_id.'/render';
        $domain = 'econtract.vnpt.vn';

        $data = [
            'domain' => $domain,
        ];
        $ch = curl_init($endPoint);
        $headers = array(
            "Content-Type: application/json",
            "Authorization: Bearer ".$this->getToken(),
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

    public function createContract(){
        $user = Auth::user();
        $template_id = '621701090fb6397b52e87bc9';
        $endPoint = 'https://apigateway-econtract.vnptit3.vn/esolution-service/contracts/create-draft-from-file-raw';
        $domain = 'econtract.vnpt.vn';
        $fields = array();
        $customer = [
            "email"=> "kirabboytt@gmail.com",
            "sdt" => "0944556332",
            "userType"=> "CONSUMER",
            "ten"=> "test email ne",
            "noiCap"=> "da nang",
            "tenToChuc"=> "to chuc test ne",
            "mst"=> "09924523234",
            "loaiGtId"=> "1",
            "noiCap"=> "",
            "soDkdn"=> "",
            "ngayCapSoDkdn"=> "2021-12-22",
            "noiCapDkkd"=> ""
        ];

        $contract = [
            "autoRenew"=> "true",
            "callbackUrl" => "test url",
            "contractValue"=> "20000",
            "creationNote"=> "",
            "endDate"=> "2021-11-17",
            "flowTemplateId"=> "59789bc9-688a-4ae2-9ec9-bd514f716770",
            "sequence"=> 2,
            "signFlow"=> [
                [
                  "signType"=> "DRAFT",
                  "signForm"=> [
                    "OTP",
                    "EKYC",
                    "OTP_EMAIL",
                    "NO_AUTHEN",
                    "EKYC_EMAIL",
                    "USB_TOKEN",
                    "SMART_CA"
                  ],
                  "userId"=> "",
                  "sequence"=> 1,
                  "limitDate"=> 3
                ],
                [
                  "signType"=> "APPROVE",
                  "signForm"=> [
                    "OTP",
                    "EKYC",
                    "OTP_EMAIL",
                    "NO_AUTHEN",
                    "EKYC_EMAIL",
                    "USB_TOKEN",
                    "SMART_CA"
                  ],
                  "departmentId"=> "",
                  "userId"=> "",
                  "sequence"=> 2,
                  "limitDate"=> 3
                ]
              ],
            "signForm"=> [
                "OTP",
                "SMART_CA"
            ],
            "templateId"=> "621701090fb6397b52e87bc9",
            "title"=> "test create ".time(),
            "validDate"=> "2021-11-17",
            "verificationType"=> "NONE"
        
        ];
     
        // $cFile = curl_file_create(asset('public/contract/60f83c54-58eb-48e8-aee1-0b5f511b0cf3.pdf'),'pdf','file.pdf');
        $cFile = new \CURLFile($this->renderContract(), 'application/pdf', 'receipt');
        
        $data = [
            'customer' => json_encode($customer),
            'contract' => json_encode($contract),
            'fields' => json_encode($fields),
            ''=> $cFile,
        ];

        $ch = curl_init($endPoint);
        $headers = [
            "Content-Type: multipart/form-data",
            "Authorization: Bearer ".$this->getToken(),
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
        // $result = json_decode($result, TRUE);
        return $result;
    }
    
}
