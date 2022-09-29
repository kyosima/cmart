<?php

namespace App\Http\Traits;
use App\Models\Product;
use App\Models\Province;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait getProduct {

    function getProductWithPrice($slug){
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $user->level = $user->user_level()->first();
            $product = Product::whereSlug($slug)->with(['product_type', 'product_price', 'product_detail', 'product_variations', 'product_brand', 'product_category',
            'product_price.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            },
            'product_variations.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            } ])->firstorfail();
        }else{
            $product = Product::whereSlug($slug)->with(['product_type', 'product_price', 'product_detail', 'product_variations', 'product_brand', 'product_category',
            'product_price.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            },
            'product_variations.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            } ])->firstorfail();
        }
        return $product;
    }
}

