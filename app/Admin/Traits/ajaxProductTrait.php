<?php

namespace App\Admin\Traits;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

trait ajaxProductTrait {
    public function ajaxGetProduct($search) {
        $products = Product::select('id','title')->where('title', 'LIKE', '%'.$search.'%')
            ->orWhere('sku', 'LIKE', '%'.$search.'%')
            ->limit(25)
            ->get();
        return $products;
    }

    public function ajaxGetProCat($search, $id = 1) {
        $proCats = ProductCategory::where('id', '!=', $id)
                ->where('name', 'LIKE', '%'.$search.'%')
                ->limit(25)
                ->get();
        return $proCats;
    }
}