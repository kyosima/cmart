<?php

namespace Devt\Ninepay\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Devt\Ninepay\core\HMACSignature;
use Devt\Ninepay\core\MessageBuilder;
use Illuminate\Support\Facades\Http;
use Devt\Ninepay\Models\SettingNinepay;
use Devt\Ninepay\Models\HistoryPaymentNinepay;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class ConnectController extends Controller
{
    protected $setting;

    public function __construct($method = 'ATM_CARD', $invoiceNo = '', $description = 'Mô tả giao dịch', $amount = 0){
    	$this->description = $description;
        $this->invoiceNo = $invoiceNo;
        $this->method = $method;
        $this->amount = $amount;
        $this->setting = SettingNinepay::whereEnvironment(config('custom-config.environment.ninepay'))->first();
    }

    public function call(){
        try {
            $returnUrl = route('ninepay.back');
            $backUrl = route('ninepay.call.back');
            $time = time();
            $data = array(
                'merchantKey' => $this->setting->merchant_key,           
                'time' => $time,
                'invoice_no' => $this->invoiceNo ? 'CM'.$time.'-'.$this->invoiceNo : 'CM-'.$time,
                'amount' => $this->amount,
                'method' => $this->method,
                'description' => $this->description,
                'back_url' => $backUrl,
                'return_url' => $returnUrl,
            );
            $message = MessageBuilder::instance()
                ->with($time, $this->setting->end_point . '/payments/create', 'POST')
                ->withParams($data)
                ->build();

            $hmacs = new HMACSignature();

            $signature = $hmacs->sign($message, $this->setting->merchant_secret_key);
            $httpData = [
                'baseEncode' => base64_encode(json_encode($data, JSON_UNESCAPED_UNICODE)),
                'signature' => $signature,
            ];
            $redirectUrl = $this->setting->end_point . '/portal?' . http_build_query($httpData);
            return response()->json([
                'status' => 200,
                'message' => 'Xử lý thành công.',
                'data' => $redirectUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Thanh toán đang gặp vấn đề vui lòng liên hệ với chúng tôi để được hỗ trợ.',
            ]);
        }
        
    }

    public function back(Request $request){
        // try {
            $hashChecksum = strtoupper(hash('sha256', $request->result . $this->setting->key_checksum));
            // Check checksum code
            if ($hashChecksum === $request->checksum) {
                // Received payment information
                $result = $this->urlsafeB64Decode($request->result);
                $payment = json_decode($result);
                $status = $payment->status;
                $link = '';
                $order_code = explode('-', $payment->invoice_no)[1];
                HistoryPaymentNinepay::create([
                    'order_code' => $order_code,
                    'link' => $link,
                    'data' => $result
                ]);

                if($status == 5){
                    $order = Order::whereOrderCode($order_code)->first();
                    $order->update([
                        'status' => 1,
                        'is_payment' => 1
                    ]);
                    return redirect()->route('checkout.orderSuccess', ['order_code' => $order_code ]);
                    // return response()->json([
                    //     'status' => 200,
                    //     'message' => 'Giao dịch thành công.',
                    //     'data' => $payment,
                    // ]);
                }
                elseif($status == 2 || $status == 3 || $status == 6){
		            return redirect()->route('paymentFail');

                    // return response()->json([
                    //     'status' => 202,
                    //     'message' => 'Giao dịch đang xử lý.',
                    //     'data' => $payment,
                    // ]);
                }else{
		            return redirect()->route('paymentFail');

                    // return response()->json([
                    //     'status' => 400,
                    //     'message' => 'Giao dịch không thành công.',
                    // ]);
                }
            }
		    return redirect()->route('paymentFail');
            // return response()->json([
            //     'status' => 401,
            //     'message' => 'Thông tin không trùng khớp vui lòng liên hệ với cửa hàng để được xử lý.',
            // ]);

        // } catch (\Exception $e) {
		//     return redirect()->route('paymentFail');
        //     // return response()->json([
        //     //     'status' => 500,
        //     //     'message' => 'Thanh toán đang gặp vấn đề vui lòng liên hệ với chúng tôi để được hỗ trợ.',
        //     // ]);
        // }
    }

    public function callBack(Request $request){
        try {

            $hashChecksum = strtoupper(hash('sha256', $request->result . $this->setting->key_checksum));

            // Check checksum code
            if ($hashChecksum === $request->checksum) {
                // Received payment information
                $result = $this->urlsafeB64Decode($request->result);
                $payment = json_decode($result);
                $status = $payment->status;
                
                if(HistoryPaymentNinepay::where('order_code', $payment->invoice_no)->exists()){
                    HistoryPaymentNinepay::where('order_code', $payment->invoice_no)->update([
                        'data' => $result
                    ]);
                }
                else{
                    HistoryPaymentNinepay::create([
                        'order_code' => $payment->invoice_no,
                        'data' => $result
                    ]);
                }
                if($status == 5){
                    $order = Order::find($payment->invoice_no);
                    $order->update([
                        'status' => 1
                    ]);
                    return response()->json([
                        'status' => 200,
                        'message' => 'Giao dịch thành công.',
                        'data' => $payment,
                    ]);
                }
                elseif($status == 2 || $status == 3){
                    return response()->json([
                        'status' => 202,
                        'message' => 'Giao dịch đang xử lý.',
                        'data' => $payment,
                    ]);
                }else{
                    return response()->json([
                        'status' => 400,
                        'message' => 'Giao dịch không thành công.',
                    ]);
                }
            }
            // return response()->json([
            //     'status' => 401,
            //     'message' => 'Thông tin không trùng khớp vui lòng liên hệ với cửa hàng để được xử lý.',
            // ]);
                return redirect('/');
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Thanh toán đang gặp vấn đề vui lòng liên hệ với chúng tôi để được hỗ trợ.',
            ]);
        }
    }

    public function urlsafeB64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padlen = 4 - $remainder;
            $input .= str_repeat('=', $padlen);
        }
        return base64_decode(strtr($input, '-_', '+/'));
    }
}