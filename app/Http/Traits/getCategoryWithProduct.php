<?php

namespace App\Http\Traits;
use App\Models\Province;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait getCategoryWithProduct {
    function getAllCategoriesWithProduct(){
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $user->level = $user->user_level()->first();
            $categories = ProductCategory::where('category_parent', 0)->with(['products','products.product_detail', 'products.product_price', 'products.product_price.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            },
            'products.product_variations.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            }
            ,'childrenRecursive.products', 'childrenRecursive.products.product_detail','childrenRecursive.products.product_price','childrenRecursive.products.product_price.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id);
            },'childrenRecursive.products.product_variations.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id);
            }
            ])->get();
        }else{
            $categories = ProductCategory::where('category_parent', 0)->with(['products','products.product_detail', 'products.product_price', 'products.product_price.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            }, 'products.product_variations.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            }
            ,'childrenRecursive.products', 'childrenRecursive.products.product_detail','childrenRecursive.products.product_price','childrenRecursive.products.product_price.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1);
            },'childrenRecursive.products.product_variations.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1);
            }])->get();
        }
        return $categories;
       
    }

    function getProductofCategory($slug){
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $user->level = $user->user_level()->first();
            $category = ProductCategory::where('slug', $slug)->with(['products','products.product_detail', 'products.product_price', 'products.product_price.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            },
            'products.product_variations.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id); 
                
            }
            ,'childrenRecursive.products', 'childrenRecursive.products.product_detail','childrenRecursive.products.product_price','childrenRecursive.products.product_price.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id);
            },'childrenRecursive.products.product_variations.product_price_details' => function($query) use ($user) {
                $query->where('user_price_id', '=', $user->level->user_price_id);
            }
            ])->first();
        }else{
            $category = ProductCategory::where('slug', $slug)->with(['products','products.product_detail', 'products.product_price', 'products.product_price.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            }, 'products.product_variations.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1); 
                
            }
            ,'childrenRecursive.products', 'childrenRecursive.products.product_detail','childrenRecursive.products.product_price','childrenRecursive.products.product_price.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1);
            },'childrenRecursive.products.product_variations.product_price_details' => function($query) {
                $query->where('user_price_id', '=', 1);
            }])->first();
        }
        return $category;
    }

    
}
