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
        ->orderBy('products.id', 'desc')
        ->get();

        $beginMinPrice = 0;
        $endMaxPrice = 0;
        $minPrice = 0;
        $maxPrice = 0;

        if(count($products) > 0) {
            $minPrice = $products->sortBy('regular_price')->first()->regular_price;
            $maxPrice = $products->sortByDesc('regular_price')->first()->regular_price;
        }

        // SORT THEO ORDER
        if ($request->order != null || $request->order != '') {
            if ($order[0] == 'name') {
                setlocale(LC_COLLATE, 'vi.utf8');
                if ($order[1] == 'asc') {
                    $products = $products->sortBy($order[0], SORT_LOCALE_STRING);
                } else {
                    $products = $products->sortByDesc($order[0], SORT_LOCALE_STRING);
                }
                setlocale(LC_COLLATE, 0);
            } else {
                if ($order[1] == 'asc') {
                    $products = $products->sortBy($order[0]);
                } else {
                    $products = $products->sortByDesc($order[0]);
                }
            }
        }
        // SORT THEO SALE
        else if ($request->sale == 2) {
            $products = $products->where('shock_price', '>', 0)
            ->where('status', 1)
            ->where('shock_price', '!=', null);
        }
        
        // KIỂM TRA XEM KHOẢNG GIÁ KHÁCH HÀNG CHỌN CÓ ĐÚNG ĐỊNH DẠNG?
        if (isset($request->beginMinPrice) && isset($request->endMaxPrice)) {
            if (
                $request->beginMinPrice != '' && $request->endMaxPrice != '' &&
                $request->endMaxPrice <= $maxPrice && $request->beginMinPrice >= $minPrice
            ) {
                $beginMinPrice = $request->beginMinPrice;
                $endMaxPrice = $request->endMaxPrice;
                $products = $products->whereBetween('regular_price', [$request->beginMinPrice, $request->endMaxPrice]);
            } else {
                return redirect()->route('proBrand.index', $slug);
            }
        }

        // add class active vào nút "mặc định" trên thanh sắp xếp
        $isDefault = $request->query();
        $products = $products->paginate(16);

        return view('proBrand.thuonghieu_sanpham', compact('products', 'slug', 'minPrice', 'maxPrice', 'beginMinPrice', 'endMaxPrice', 'isDefault'));
    }
}
