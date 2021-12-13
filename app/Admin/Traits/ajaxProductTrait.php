<?php

namespace App\Admin\Traits;
use App\Models\Product;
use App\Models\ProductCategory;

trait ajaxProductTrait {

    public function ajaxGetProduct($search, $id = 0) {
        $products = Product::where('name', 'LIKE', '%'.$search.'%')->where('id', '!=', $id)->get();
        return $products;
    }

    public function ajaxGetProCat($search) {
        $procats = ProductCategory::where('name', 'LIKE', '%'.$search.'%')->get();
        return $procats;
    }
}