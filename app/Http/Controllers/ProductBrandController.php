<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function index($slug, Request $request)
    {
        // KIỂM TRA XEM GIÁ TRỊ CỦA ORDER CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        if ($request->order != '' || $request->order != null) {
            $order = explode(' ', $request->order);
            if (count($order) != 2 || ($order[0] != 'regular_price' && $order[0] != 'name' && $order[0] != 'cpoint' && $order[0] != 'mpoint') ||  ($order[1] != 'asc' && $order[1] != 'desc')) {
                return redirect()->route('proBrand.index', $slug);
            }
        }
        // KIỂM TRA XEM GIÁ TRỊ CỦA SALE CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        else if ($request->sale != 2 && $request->sale != '') {
            return redirect()->route('proBrand.index', $slug);
        }

        
        $products = Product::where('brand', $slug)
        ->where('status', 1)
        ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
        ->paginate(16);
        
        $beginMinPrice = 0;
        $endMaxPrice = 0;
        $minPrice = 0;
        $maxPrice = 0;

        if(count($products) > 0) {
            $minPrice = $products->sortBy('regular_price')->first()->regular_price;
            $maxPrice = $products->sortByDesc('regular_price')->first()->regular_price;
        }

        // KIỂM TRA XEM KHOẢNG GIÁ KHÁCH HÀNG CHỌN CÓ ĐÚNG ĐỊNH DẠNG?
        if (isset($request->beginMinPrice) && isset($request->endMaxPrice)) {
            if (
                $request->beginMinPrice != '' && $request->endMaxPrice != '' &&
                $request->endMaxPrice <= $maxPrice && $request->beginMinPrice >= $minPrice
            ) {
                $beginMinPrice = $request->beginMinPrice;
                $endMaxPrice = $request->endMaxPrice;
                $products = $products->whereBetween('regular_price', [$request->beginMinPrice, $request->endMaxPrice])->paginate(16);
            } else {
                return redirect()->route('proBrand.index', $slug);
            }
        }

        // SORT THEO ORDER
        if ($request->order != null || $request->order != '') {
            if ($order[1] == 'asc') {
                $products = $products->sortBy($order[0])->paginate(16);
            } else {
                $products = $products->sortByDesc($order[0])->paginate(16);
            }
        }
        // SORT THEO SALE
        else if ($request->sale == 2) {
            $products = $products->where('shock_price', '>', 0)
            ->where('status', 1)
            ->where('shock_price', '!=', null)
            ->paginate(16);
        }

        // add class active vào nút "mặc định" trên thanh sắp xếp
        $isDefault = $request->query();

        return view('proBrand.thuonghieu_sanpham', compact('products', 'slug', 'minPrice', 'maxPrice', 'beginMinPrice', 'endMaxPrice', 'isDefault'));
    }

    // public function showAll()
    // {
    //     $categories = ProductCategory::where('category_parent', 0)
    //     ->where('id', '!=', 1)
    //     ->where('status', 1)
    //     ->with(['childrenCategories.products', 'products'])
    //     ->get();

    //     $arrProducts = [];
    //     foreach($categories as $proCat) {
    //         $products = $proCat->products->where('status', 1)->merge($proCat->subproducts->where('status', 1))->sortBy(['created_at', 'desc']);
    //         array_push($arrProducts, $products);
    //     }

    //     return view('proCat.allProCat', compact('categories', 'arrProducts'));
    // }
}
