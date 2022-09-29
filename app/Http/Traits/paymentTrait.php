<?php

namespace App\Http\Traits;
use App\Models\Province;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait paymentTrait {
    function getPaymentMethodAvailable($order){
        $payment_method_avai = [];
        foreach ($order->order_stores()->get() as $order_store) {
            foreach($order_store->order_products()->get() as $order_product){
                $product = $order_product->product()->with('product_payment')->first();
                if(isset($product->product_payment)){
                    $payment_method_avai = array_merge($payment_method_avai, $product->product_payment->pluck('payment_id')->toArray());

                }
            }
        }

        $payment_method_avai = array_unique($payment_method_avai);
        return $payment_method_avai;
    }
}