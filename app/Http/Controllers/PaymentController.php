<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Http\Traits\paymentTrait;
use App\Models\PaymentMethodOption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    use paymentTrait;
    public function getPaymentMethod(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $user = Auth::guard('user')->user();
        $wallet = $user->wallet()->first();
        
        $payment_methods = PaymentMethod::orderBy('id', 'asc')->get();
        $check_shipping_method = true;
        foreach ($order->order_stores()->get() as $order_store) {
            if ($order_store->shipping_method == 2) {
                $check_shipping_method = false;
            }
        }
        $payment_method_avai = $this->getPaymentMethodAvailable($order);
        return view('checkout.payment_method', compact('payment_method_avai','order', 'user', 'wallet', 'check_shipping_method', 'payment_methods'));
    }    

    public function getPaymentDetail(Request $request)
    {
        $user = Auth::guard('user')->user();
        if (!$request->payment_method) {
            return back()->with('message', 'Mời chọn hình thức thanh toán');
        }
        $order = Order::whereOrderCode($request->order_code)->with('order_stores.store')->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        $payment_method_avai = $this->getPaymentMethodAvailable($order);
        $wallet = $user->wallet()->first();
        if (($payment_method->id == 1 && $wallet->cpoint < $order->total) ||($payment_method->status == 0) || (!in_array($payment_method->id, $payment_method_avai))){
            return back()->with('message', 'Hình thức thanh toán không khả dụng cho đơn hàng của bạn, mời chọn lại hình thức thanh toán khác');
        }
        $order->vat_services = $order->order_stores->sum('vat_services') + $payment_method->tax;
        $order->payment_method = $payment_method->id;
        $order->total_payment_services = round(max((max($order->transpot_price - $order->m_point, 0) * 108) / 100 + ($order->vat_services - max($order->m_point - $order->transpot_price, 0)), 0));
        $order->remaining_m_point = max($order->m_point - $order->transpot_price - $order->vat_services, 0);
        $order->tax_services =round(max((max($order->transpot_price - $order->m_point, 0) * 108) / 100 + ($order->vat_services - max($order->m_point - $order->transpot_price, 0)), 0) - 
        max((max($order->transpot_price - $order->m_point, 0) * 108) / 100 + ($order->vat_services - max($order->m_point - $order->transpot_price, 0)), 0) / 1.08);
        $order->total_tax_services = $order->vat_products + $order->tax_services;
        $order->order_stores->map(function($value) use($order, $payment_method){
            $value->vat_services = round($payment_method->fee * ($value->sub_total + $value->vat_products - $value->discount_products + max($value->transpot_price - $value->m_point, 0) * 1.08));
            $value->total = round($value->sub_total + $value->vat_services  + $value->vat_products + ($order->total_payment_services / $order->order_stores->count())  - $value->discount_products + $value->transpot_price);
            $value->discount_services = round( ($value->transpot_price * 108 / 100) + $value->vat_services - ($order->total_payment_services / $order->order_stores->count()) < 0 ? ($value->transpot_price * 108 / 100) + $value->vat_services : $order->total_payment_services / $order->order_stores->count());
            $value->vat = round($value->vat_products + $order->tax_services / $order->order_stores->count());
            $value->save();
            return $value;
        }); 
        $order->total = $order->order_stores->sum('total');
        $order->save();
        $order_vat = $order->order_vat()->first();
        return view('checkout.payment_info', compact('order', 'user', 'order_vat'));
    }

    public function postPayment(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $user = Auth::guard('user')->user();
        $payment_method = PaymentMethod::whereId($order->payment_method)->first();
        switch ($payment_method->type) {
            case 1:
                switch ($payment_method->id) {
                    case 1:
                        return redirect()->route('payment.C', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    case 2:
                        return redirect()->route('payment.Deposit', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    case 3:
                        return redirect()->route('payment.Send', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    case 5 || 6:
                        Session::put('order_code', $order->order_code);
                        $paymentPaymeController = new PaymentPaymeController();
                        $result = $paymentPaymeController->PaymentPayme($order, $pay_method = 'CREDITCARD');
                        $result = json_decode($result);

                        if ($result->code == '105000') {
                            $this->createOrderPayme($order->id, $order->order_code, $result->data->url, $result->data->transaction);
                            $this->processOrder($order);

                            return redirect($result->data->url);
                        } else {
                            return redirect()->route('paymentFail');
                        }
                        break;
                    case 9:
                        Session::put('order_code', $order->order_code);
                        $paymentPaymeController = new PaymentPaymeController();
                        $result = $paymentPaymeController->PaymentPayme($order);
                        $result = json_decode($result);

                        if ($result->code == '105000') {
                            $this->createOrderPayme($order->id, $order->order_code, $result->data->url, $result->data->transaction);
                            $this->processOrder($order);

                            return redirect($result->data->url);
                        } else {
                            return redirect()->route('paymentFail');
                        }
                        break;
                    default:
                        return redirect()->route('checkout.getPaymentMethod', ['order_code' => $order->order_code])->with(['message' => 'Hình thức thanh toán không khả dụng']);
                        break;
                }
            default:
                $this->processOrder($order);
                return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
                break;
        }
    }

    public function getPaymentSend(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)->first();

        if ($order->is_payment != 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        return view('checkout.payment.payment_send', compact('payment_method', 'order'));
    }

    public function postPaymentSend(Request $request)
    {
        $validation = $request->validate([
            'payment_option' => 'required',

        ], [
            'payment_option.required' => "Mời chọn đơn vị thanh toán",
        ]);
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->is_payment != 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $order->payment_method_option = $request->payment_option;
        $order->order_stores()->update(['payment_method_option'=>$request->payment_option]);
        $order->save();
        $this->processOrder($order);
        return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
    }

    public function getPaymentDeposit(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->is_payment != 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        return view('checkout.payment.payment_nap', compact('payment_method', 'order'));
    }
    public function postPaymentDeposit(Request $request)
    {

        $validation = $request->validate([
            'payment_option' => 'required',

        ], [
            'payment_option.required' => "Mời chọn đơn vị thanh toán",
        ]);
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->is_payment != 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $order->payment_method_option = $request->payment_option;
        $order->order_stores()->update(['payment_method_option'=>$request->payment_option]);

        $order->save();
        $this->processOrder($order);
        return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
    }

    public function getInfoPaymentOption(Request $request)
    {
        
        $payment_method = PaymentMethod::whereId($request->method_id)->first();
        $payment_option = PaymentMethodOption::whereId($request->option_id)->first();
        if ($payment_option->qr_image != null) {
            $payment_option->qr_image = asset($payment_option->qr_image);
        }
        return $payment_option;
    }

    public function orderSuccess(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->with('order_stores.order_products.product.product_price','order_stores.transpot_service',
         'order_address', 'order_address.province', 'order_address.district', 'order_address.ward',
        'order_info', 'user.user_info','user.user_level', 'order_vat','get_payment_method')->first();
        if (!$request->order_code || $order == null || $order->is_payment == 0) {
            return redirect('/');
        }

      
        return view('checkout.thanhcong', compact('order'));
    }


    public function processOrder($order)
    {
        $user = Auth::guard('user')->user();
        $order_status = true;
        foreach ($order->order_stores()->get() as $order_store) {
            $order_store->shipping_code = $order_store->order_store_code;
            $order_store->save();
            foreach($order_store->order_products()->whereNotNull('product_id')->get() as $order_product) {
                $store_product = $order_product->store_product()->first();
                if($store_product){
                    $store_product->quantity -= $order_product->quantity;
                    $store_product->save();
                }
              
            }
        }
        $carts = $user->carts()->whereIn('store_id', $order->order_stores()->pluck('store_id')->toArray())->get();
        foreach($carts as $cart){
            $cart->cart_item()->delete();
            $cart->delete();
        }
        if ($order->payment_method == 1) {
            
                    $transaction_code = $order->order_code;
                    $historyPointController = new HistoryPointController();
                    $historyPointController->createHistory($user, $order->total, 1, 1, $transaction_code, null, null);
                    $order->is_payment = 1;
                    $order->save();
        }
        $order->is_payment = 1;
        $order->save();

        Session::forget('store_ids');
    
      
    }

  
}
