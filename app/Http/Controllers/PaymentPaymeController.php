<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Devt\Payme\Models\SettingPaymentPayme;
use Devt\Payme\Controllers\ApiService;
use App\Models\OrderPayme;
use App\Models\Order;



class PaymentPaymeController extends Controller
{
    //
    public function PaymentPayme($order, $pay_method = 'ATMCARD'){
        //lấy cấu hình
    	// $setting_payment_payme = SettingPaymentPayme::first();
        $setting_payment_payme = SettingPaymentPayme::whereEnvironment(config('custom-config.environment.payme'))->first();
        // đưa dữ liệu bảo mật.
        $apiService = new ApiService(true,  $setting_payment_payme->domain, $setting_payment_payme->app_id, $setting_payment_payme->private_key, $setting_payment_payme->public_key, $setting_payment_payme->accessToken);

        // url tạo đơn hàng
        $api_path = '/payment/web';
        $payload = array(
			'amount' => $order->total,
			// 'storeId' => $setting_payment_payme->store_id,
			'partnerTransaction' => $order->order_code,
			'payMethod' => $pay_method,
			'desc' => 'Thanh toán đơn hàng từ cmart',
			'expiryAt' => now()->addMinutes(120),
			'ipnUrl' => route('ipnUrl'),
			'redirectUrl' => route('redirectUrl'),
			'failedUrl' => route('failedUrl'),
			'extraData' => json_encode($order),
			'redirectTime' => 3,
		);
		
		$result = $apiService->PayMEApi($api_path, 'POST', $payload);
		// dd($result);
		return $result;
    }

	public function redirectUrl(Request $request){
		if($order_payme = OrderPayme::where('transaction_payme_id', $request->gwId )->first()){
			if($this->paymentQuery($order_payme->transaction_partner_id)){
				$order = Order::find($order_payme->order_id)->update([
					'status' => 1
				]);
				$order_payme->status = 1;
				$order_payme->save();
				return redirect()->route('checkout.orderSuccess', ['order_code' => $order_payme->transaction_partner_id ]);
			}
		}
		return redirect()->route('paymentFail');
    }

	public function refund($order){
		//lấy cấu hình
        $setting_payment_payme = SettingPaymentPayme::whereEnvironment(config('custom-config.environment.payme'))->first();
    	// $setting_payment_payme = SettingPaymentPayme::first();
        // đưa dữ liệu bảo mật.
        $apiService = new ApiService(true,  $setting_payment_payme->domain, $setting_payment_payme->app_id, $setting_payment_payme->private_key, $setting_payment_payme->public_key, $setting_payment_payme->accessToken);
        // dd($apiService);
        $api_path = '/payment/refund'; 
        $payload = array(
              "partnerTransaction" => 'CMART-'.time(),
              "transaction" => $order->order_payme->transaction_payme_id,
              "amount" => $order->total,
              "reason" => "Hoàn tiền đơn hàng ".$order->order_code
        );
        // dd($payload);
        $result = $apiService->PayMEApi($api_path, 'POST', $payload);
		return $result;
	}

    public function failedUrl(Request $request){
		return redirect()->route('paymentFail');
    }

	public function paymentFail(){
		return view('checkout.payment_faild_payme');
	}

	public function paymentQuery($partnerTransaction){
		//lấy cấu hình
        $setting_payment_payme = SettingPaymentPayme::whereEnvironment(config('custom-config.environment.payme'))->first();
    	// $setting_payment_payme = SettingPaymentPayme::first();
        // đưa dữ liệu bảo mật.
        $apiService = new ApiService(true,  $setting_payment_payme->domain, $setting_payment_payme->app_id, $setting_payment_payme->private_key, $setting_payment_payme->public_key, $setting_payment_payme->accessToken);
        $api_path = '/payment/query'; 
        $payload = array(
              "partnerTransaction" => $partnerTransaction
          );
        $result = $apiService->PayMEApi($api_path, 'POST', $payload);
		$result = json_decode($result);
		if($result->code != 105002){
			return false;
		}
		return $result->data->state == 'SUCCEEDED' ? true : false;
	}
}
