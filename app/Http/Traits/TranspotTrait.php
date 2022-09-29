<?php

namespace App\Http\Traits;
use App\Models\Province;
use App\Models\ProductCategory;
use App\Models\TranspotService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait TranspotTrait {
   
    function getWeight($cart_item){
        $weight = ceil(max($cart_item->product->product_detail->weight / 1000, (($cart_item->product->product_detail->height * $cart_item->product->product_detail->width * $cart_item->product->product_detail->length) / 3000)) * 1000);
        return $weight * $cart_item->quantity;
    }
    
    function getFeeCmartTranspot($total_weight, $user){
        $transpot_service = TranspotService::where('id',1)->where('type',1)->with(['transpot_prices_details'=> function($query) use ($user){
            $query->where('user_level_id', $user->level->id);
        }])->first();
        if(!isset($transpot_service->transpot_prices_details)){
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=>0, 'transpot_fee_fast'=>0, 'status'=> 404, 'message'=>'Chưa hỗ trợ vân chuyển địa chỉ này'  ];
        }else{
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=>max($transpot_service->transpot_prices_details[0]->fee_min, 
            $transpot_service->transpot_prices_details[0]->fee_default + $transpot_service->transpot_prices_details[0]->fee_package * ceil($total_weight,0)), 'transpot_fee_fast'=> 0, 'status'=>200];
        }
       
    }

    function getFeeProvinceTranspot($distance,$total_weight, $user){
        $transpot_service = TranspotService::where('id',2)->first();
        $transpot_price_default =  $transpot_service->transpot_prices_details()
        ->where('user_level_id', $user->level->id)->where('type',1)->first();
        $transpot_price_fast = $transpot_service->transpot_prices_details()
        ->where('user_level_id', $user->level->id)->where('type',2)->first();
        $fee_default = max($transpot_price_default->fee_min,
        $transpot_price_default->fee_default + $transpot_price_default->fee_weight 
        * ceil ($total_weight/1000) + $transpot_price_default->fee_package *ceil($total_weight) + 
        $transpot_price_default->fee_distance *  max(round($distance),3 ));
        
        $fee_fast = max($transpot_price_fast->fee_min,
        $transpot_price_fast->fee_default + $transpot_price_fast->fee_weight 
        * ceil ($total_weight/1000) + $transpot_price_fast->fee_package *ceil($total_weight) + 
        $transpot_price_fast->fee_distance *  max(round($distance),3 ));
        if(!isset($transpot_price_default) || !isset($transpot_price_fast)){
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=>0, 'transpot_fee_fast'=>0, 'status'=> 404, 'message'=>'Chưa hỗ trợ vân chuyển địa chỉ này'  ];
        }else{
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=>$fee_default, 'transpot_fee_fast'=>$fee_fast , 'status'=>200];

        }
    }

    function getFeeCrossProvinceTranspot($province, $transpot_to,$total_weight, $user){
        $transpot_service = TranspotService::where('id',3)->first();
        $transpot_variation_default = $transpot_service->transpot_variations()->where('province_id',$province)->where('transpot_to', $transpot_to)
       ->with(['transpot_prices_details'=> function($query) use ($user){
            $query->where('user_level_id', $user->level->id) ->where('type',1);
        }])->first();
        $transpot_variation_fast = $transpot_service->transpot_variations()->where('province_id',$province)->where('transpot_to', $transpot_to)
       ->with(['transpot_prices_details'=> function($query) use ($user){
            $query->where('user_level_id', $user->level->id)->where('type',2);
        }])->first();
        if(!isset($transpot_variation_default->transpot_prices_details) || !isset($transpot_variation_fast->transpot_prices_details)){
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=> 0, 'transpot_fee_fast'=>0, 'status'=> 404, 'message'=>'Chưa hỗ trợ vân chuyển địa chỉ này' ];
        }else{
            $fee_default = max($transpot_variation_default->transpot_prices_details[0]->fee_min, round($transpot_variation_default->transpot_prices_details[0]->fee_default + 
            $transpot_variation_default->transpot_prices_details[0]->fee_weight *ceil($total_weight) + $transpot_variation_default->transpot_prices_details[0]->fee_weight *
            ceil($total_weight) ) );
    
            $fee_fast = max($transpot_variation_fast->transpot_prices_details[0]->fee_min, round($transpot_variation_fast->transpot_prices_details[0]->fee_default + 
            $transpot_variation_fast->transpot_prices_details[0]->fee_weight *ceil($total_weight) + $transpot_variation_fast->transpot_prices_details[0]->fee_weight *
            ceil($total_weight) ) );
            return ['transpot_service' => $transpot_service, 'transpot_fee_default'=>$fee_default, 'transpot_fee_fast'=>$fee_fast, 'status'=>200 ];

        }
       

    }
}
