<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    //
    public function index($slug, Request $request){
        // LẤY RA CATEGORY HIỆN TẠI -> KÈM THEO ĐÓ LÀ RELATIONS BÊN MODAL
        // MỤC ĐÍCH ĐỂ COUNT TỔNG SP
        // VÀ SHOW CÁC DANH MỤC CON ĐỂ TICK CHỌN
        // https://laracasts.com/discuss/channels/laravel/get-all-products-from-parent-category-and-its-all-sub-categories
        $proCat = ProductCategory::where('slug', $slug)->with(['childrenCategories.products', 'products'])->first();
        $proCat->products->merge($proCat->subproducts);

        // LẤY RA TOÀN BỘ ID DANH MỤC HIỆN TẠI & DANH MỤC CON CỦA NÓ
        $categoryIds = ProductCategory::where('category_parent', $parentId = ProductCategory::where('slug', $slug)->value('id'))
            ->pluck('id')
            ->push($parentId)
            ->all();
        
        // NẾU NHƯ REQUEST CÓ TICK CHỌN DANH MỤC THÌ VÀO ĐÂY           
        if ($request->category != null || isset($request->category)) {
            $products = Product::whereIn('category_id', $request->category)
                        ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                        ->paginate(16);

            if ($request->order != null || $request->order != '') {
                $order = explode(' ', $request->order); 
                $products = Product::whereIn('category_id', $request->category)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->orderBy($order[0], $order[1])
                            ->paginate(16);
            }
            else if($request->sale == 2) {
                $products = Product::whereIn('category_id', $request->category)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->where('product_price.shock_price', '>', 0)
                            ->where('product_price.shock_price', '!=', null)
                            ->paginate(16);
            } 
        } 
        // KHÔNG CÓ THÌ VÀO ĐÂY
        else {
            if ($request->order != null || $request->order != '') {
                $order = explode(' ', $request->order); 
                $products = Product::whereIn('category_id', $categoryIds)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->orderBy($order[0], $order[1])
                            ->paginate(16);
            } 
            else if($request->sale == 2) {
                $products = Product::whereIn('category_id', $categoryIds)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->where('product_price.shock_price', '>', 0)
                            ->where('product_price.shock_price', '!=', null)
                            ->paginate(16);
            } 
            else {
                $products = Product::whereIn('category_id', $categoryIds)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->paginate(16);
            }
        }
        
        // LẤY RA BRAND ĐỂ SHOW KHÔNG BỊ TRÙNG LẶP (CHƯA TÌM RA CÁCH ĐỂ COUNT CÓ BAO NHIÊU SP)
        $brandIds = $products->pluck('brand')->toArray();
        $brands = array_unique($brandIds);
        $brands = Brand::whereIn('id', $brands)->get();

        return view('danhmucsanpham', compact('proCat', 'products', 'brands', 'slug'));
    }

}