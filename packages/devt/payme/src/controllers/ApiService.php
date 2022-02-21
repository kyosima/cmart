<?php 

namespace Devt\Payme\Controllers;

use Devt\Payme\core\Crypt\Crypt_RSA;
use Devt\Payme\core\Crypt\CryptoJSAES;
use Devt\Payme\Models\SettingPaymentPayme;
use Illuminate\Support\Facades\Http;

class ApiService
{
	public function __construct($isSecurity = false, $domain = '', $appId = '', $privateKey = '', $publicKey = '', $accessToken = '')
    {
      $this->isSecurity = $isSecurity;
      $this->domain = $domain;
      $this->privateKey = $privateKey;
      $this->accessToken = $accessToken;
      $this->publicKey = $publicKey;
      $this->appId = $appId;
    }

    public function PayMEApi($url, $method = 'POST', $payload = [])
    {
      return $this->call($url, $method, $payload);
    }

    private function call($url, $method = 'POST', $payload = []){

      $encryptKey = rand(10000000, 99999999);
      $rsa = new Crypt_RSA();
      $rsa->loadKey($this->publicKey);
      $xAPIKey = base64_encode($rsa->encrypt($encryptKey));
  
      $xApiAction = CryptoJSAES::encrypt($url, $encryptKey);
      $payloadString = json_encode($payload, JSON_FORCE_OBJECT);
  
      if ($payloadString) {
        $xApiMessage =  CryptoJSAES::encrypt($payloadString, $encryptKey);
      }
      $objValidate = [
        'xApiAction' => $xApiAction,
        'method' => strtoupper($method),
        'accessToken' => $this->accessToken
      ];
  
      if($payload){
        $objValidate['x-api-message'] = $xApiMessage;
      }
      $xAPIValidate = md5(implode('', $objValidate) . $encryptKey);
  
      $response = Http::withHeaders([
        "Authorization" => $objValidate['accessToken'],
        "x-api-client" => $this->appId,
        "x-api-key" => $xAPIKey,
        "x-api-validate" => $xAPIValidate,
        "x-api-action" => $xApiAction,
        "Content-Type" => "application/json"
  
      ])->post($this->domain, [
        'x-api-message' => $xApiMessage
      ]);
  
      $result = json_decode($response, true);
  
      if(count($result) > 1){
          $array = array(
            'code' => 1071997,
            'message' => 'Thực hiện không thành công' 
          );
          return json_encode($array);
        }
      $headers = $response->headers();
  
      $xAPIKey = !empty($headers['x-api-key']) ? $headers['x-api-key'][0] : '';
      $xAPIValidate = !empty($headers['x-api-validate']) ? $headers['x-api-validate'][0] : '';
      $xApiAction = !empty($headers['x-api-action']) ? $headers['x-api-action'][0] : '';
      $xAPIMessage = $result['x-api-message'];
  
      return $this->decryptResponse(strtoupper($method), $xAPIKey, $xAPIMessage, $xAPIValidate, $objValidate['accessToken'], $this->privateKey, $xApiAction);
  
    }

    
    private function decryptResponse($method, $xAPIKey, $xAPIMessage, $xAPIValidate, $accessToken, $privateKey, $xAPIAction)
    {
      try {
        if (empty($xAPIKey) || empty($xAPIMessage) || empty($xAPIValidate) || empty($xAPIAction)) {
          throw new Exception('Thông tin "x-api-validate" không chính xác');
        }
        $key = new Crypt_RSA();
        $key->loadKey($privateKey);
        $encryptKey = $key->decrypt(base64_decode($xAPIKey));
        if (!$encryptKey) {
          throw new Exception('Thông tin "x-api-key" không chính xác');
        }
        $objValidate = [
          'x-api-action' => $xAPIAction,
          'method' => $method,
          'accessToken' => $accessToken,
          'x-api-message' => $xAPIMessage
        ];
        $validate = md5(implode('', $objValidate) . $encryptKey);
        if ($validate !== $xAPIValidate) {
          throw new Exception('Thông tin "x-api-validate" không chính xác');
        }
        $result = null;
        $result = CryptoJSAES::decrypt($xAPIMessage, $encryptKey);
        if ($result == null) {
          throw new Exception('Thông tin "x-api-message" không chính xác');
        }
        return $result;
      } catch (Exception $e) {
        return $e;
      }
    }
}