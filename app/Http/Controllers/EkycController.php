<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EkycController extends Controller
{
    //
    public function postcUrl()
    {
        $endPoint = 'http://ekyc2.mobifone.ai/v2/recognition';
        $apiKey = '169885e2-7e4a-11ec-9525-0c4de99e932e';
        $url = $endPoint;
        $dir = asset('public/profile_image/test.jpeg'); // full directory of the file
        // $curlFile = curl_file_create($dir);
        $path = $dir;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        $curlFile = $base64;
        $data = [
            'image' => $curlFile,
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
