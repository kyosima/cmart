<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;
use Illuminate\Pagination\Paginator;
class ProductCategoryController extends Controller
{
    //
    public function index($slug, Request $request)
    {
        // KIỂM TRA XEM GIÁ TRỊ CỦA ORDER CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        if ($request->order != '' || $request->order != null) {
            $order = explode(' ', $request->order);
            if (count($order) != 2 || ($order[0] != 'regular_price' && $order[0] != 'name' && $order[0] != 'cpoint' && $order[0] != 'mpoint') ||  ($order[1] != 'asc' && $order[1] != 'desc')) {
                return redirect()->route('proCat.index', $slug);
            }
        }
        // KIỂM TRA XEM GIÁ TRỊ CỦA SALE CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        else if ($request->sale != 2 && $request->sale != '') {
            return redirect()->route('proCat.index', $slug);
        }

        // LẤY RA CATEGORY HIỆN TẠI -> KÈM THEO ĐÓ LÀ RELATIONS BÊN MODAL
        // MỤC ĐÍCH ĐỂ COUNT TỔNG SP
        // VÀ SHOW CÁC DANH MỤC CON ĐỂ TICK CHỌN
        // https://laracasts.com/discuss/channels/laravel/get-all-products-from-parent-category-and-its-all-sub-categories
        $proCat = ProductCategory::where('slug', $slug)->with(['childrenCategories.products', 'products'])->first();
        $proCat->products->merge($proCat->subproducts);

        // SEO
        SEOMeta::setTitle($proCat->name);
        SEOMeta::addMeta('robots', 'noindex, nofollow');
        SEOMeta::addMeta('name', $proCat->name, 'itemprop');
        SEOMeta::setDescription($proCat->meta_desc);
        SEOMeta::addKeyword(explode(",", $proCat->meta_keyword));

        OpenGraph::setTitle($proCat->name)
            // ->setDescription('Some Article')
            ->setSiteName('cmart.vn')
            ->setType('product')
            ->setUrl(route('proCat.index', $slug))
            ->setDescription($proCat->meta_desc)
            ->addImage($proCat->feature_img)
            ->addProperty('og:image:secure_url', $proCat->feature_img)
            ->addProperty('locale', 'vi_VN');

        // LẤY RA TOÀN BỘ ID DANH MỤC HIỆN TẠI & DANH MỤC CON CỦA NÓ
        // LINK TRO GIUP: https://stackoverflow.com/questions/41414434/laravel-return-all-the-ids-of-descendants
        $subcategory = ProductCategory::where('category_parent', $proCat->id)->get();
        $categoryIds = $proCat->getAllChildren();
        $arrCatIds = $categoryIds->pluck('id')->push($proCat->id)->toArray();
        foreach ($categoryIds as $category) {
            if ($category->linkToCategory != null) {
                $cat = ProductCategory::where('id', $category->linkToCategory->id)->first();
                array_push($arrCatIds, $cat->id);
                $arrCatIds = array_merge($arrCatIds, $cat->getAllChildren()->pluck('id')->toArray());
            }
        }
        $categoryIds = $arrCatIds;
        $products = Product::whereIn('category_id', $categoryIds)
        ->where('status', 1)
         ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
        ->orderBy('products.id', 'desc')
        ->get();
        $stores_id = [];
        foreach($products as $product){
            $stores_id = array_merge($stores_id ,$product->store_products()->pluck('id_ofstore')->toArray());
        }
        $stores_id = array_unique($stores_id);
        if ($request->order != null || $request->order != '') {
            $order = explode(' ', $request->order);
            if ($order[0] == 'name') {
                setlocale(LC_COLLATE, 'vi-VN.UTF8', 'vi.UTF8');
                if ($order[1] == 'asc') {

                    $products = Product::whereIn('category_id', $categoryIds)
                        ->where('status', 1)
                         ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                        ->orderBy('products.name', 'asc')
                        ->get();
                } else {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('products.name', 'desc')
                    ->get();                }
            } elseif($order[0] == 'regular_price') {
                if ($order[1] == 'asc') {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.regular_price', 'asc')
                    ->get();
                } else {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.regular_price', 'desc')
                    ->get();
                }
            }elseif($order[0] == 'cpoint') {
                if ($order[1] == 'asc') {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.cpoint', 'asc')
                    ->get();
                } else {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.cpoint', 'desc')
                    ->get();
                }
            }elseif($order[0] == 'mpoint') {
                if ($order[1] == 'asc') {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.mpoint', 'asc')
                    ->get();
                } else {
                    $products = Product::whereIn('category_id', $categoryIds)
                    ->where('status', 1)
                     ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                    ->orderBy('product_price.mpoint', 'desc')
                    ->get();
                }
            }
        }else{
            $products = Product::whereIn('category_id', $categoryIds)
                        ->where('status', 1)
                         ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                        ->orderBy('products.id', 'desc')
                        ->get();
        }
        // LẤY RA BRAND ĐỂ SHOW KHÔNG BỊ TRÙNG LẶP 
        $brandIds = $products->pluck('brand')->toArray();
        $brands = array_unique($brandIds);

        // ARRAY BRAND 
        // VỚI KEY = BRAND ID
        // VALUE = SỐ LƯỢNG SP THUỘC BRAND
        $countBrand = array_count_values($brandIds);

        $beginMinPrice = 0;
        $endMaxPrice = 0;
        $minPrice = 0;
        $maxPrice = 0;

        if (count($products) > 0) {
            $minPrice = $products->sortBy('regular_price')->first()->regular_price;
            $maxPrice = $products->sortByDesc('regular_price')->first()->regular_price;
        }
        if (isset($request->beginMinPrice) && isset($request->endMaxPrice)) {
            if (
                $request->beginMinPrice != '' && $request->endMaxPrice != '' &&
                $request->endMaxPrice <= $maxPrice && $request->beginMinPrice >= $minPrice
            ) {
                $beginMinPrice = $request->beginMinPrice;
                $endMaxPrice = $request->endMaxPrice;
                $products = $products->whereBetween('regular_price', [$request->beginMinPrice, $request->endMaxPrice]);
            } else {
                return redirect()->route('proCat.index', $slug);
            }
        }
        // KIỂM TRA XEM CÓ FILTER THEO BRAND KH
        if (isset($request->id_stores) && !in_array(null, $request->id_stores)) {
            // LẤY RA BRAND ĐỂ SO SÁNH
            $temp_pr =  [];
            foreach($products as $product){
                $stores_id_temp = $product->store_products()->pluck('id_ofstore')->toArray();
                if(count(array_intersect($stores_id_temp, $request->id_stores))>0){
                    $temp_pr []= $product;
                }
            }
            $products = $temp_pr;

            // // KIỂM TRA XEM BRAND TRONG REQUEST CÓ NẰM TRONG ARRAY BRAND HIỆN TẠI
            // if (count(array_intersect($request->id_brand, $brandIds)) == 0) {
            //     return redirect()->route('proCat.index', $slug);
            // }
            // $products = Product::whereIn('category_id', $categoryIds)
            //     ->where('status', 1)
            //     ->whereIn('brand', $request->id_brand)
            //      ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')->get();
        }
        // SORT THEO ORDER

        // SORT THEO SALE
        // else if ($request->sale == 2) {
        //     $products = $products->where('shock_price', '>', 0)
        //         ->where('status', 1)
        //         ->where('shock_price', '!=', null);
        // }

        // KIỂM TRA XEM KHOẢNG GIÁ KHÁCH HÀNG CHỌN CÓ ĐÚNG ĐỊNH DẠNG?
        

        // add class active vào nút "mặc định" trên thanh sắp xếp
        $isDefault = $request->query();
        $products = new Paginator($products, 16);

        return view('proCat.danhmucsanpham', compact('stores_id','proCat', 'products', 'brands', 'slug', 'countBrand', 'subcategory', 'minPrice', 'maxPrice', 'beginMinPrice', 'endMaxPrice', 'isDefault'));
    }

    public function showAll()
    {

        $categories_root = ProductCategory::whereCategoryParent(0)->whereStatus(1)->orderBy('priority')->get();
        $categories = ProductCategory::where('category_parent', 0)
            ->where('id', '!=', 1)
            ->where('status', 1)
            ->with(['childrenCategories.products', 'products'])
            ->orderBy('priority')
            ->get();

        $arrProducts = [];
        foreach ($categories as $proCat) {
            $products = $proCat->products->where('status', 1)->merge($proCat->subproducts->where('status', 1))->sortByDesc('id');
            array_push($arrProducts, $products);
        }
        return view('proCat.allProCat', compact('categories', 'arrProducts', 'categories_root'));
    }

    public function getSearch(Request $request)
    {
        $keyword =  $request->keyword;
        $categories = ProductCategory::where('category_parent', 0)
            ->where('id', '!=', 1)
            ->with(['childrenCategories.products', 'products'])
            ->get();
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('sku', 'LIKE', '%' . $keyword . '%')->whereStatus(1)->get();

        return view('proCat.search', compact('categories', 'products', 'keyword'));
    }

    public function getSearchSuggest(Request $request)
    {
        $keyword =  $request->keyword;
        $products = Product::where('name', 'LIKE', '%' . $keyword . '%')->orWhere('sku', 'LIKE', '%' . $keyword . '%')->whereStatus(1)->get();
        return view('proCat.search_suggest', ['products' => $products])->render();
    }

    public function getMenuCategoryChild(Request $request){
        $category = ProductCategory::whereId($request->id_cat)->first();
        $child_categories = $category->childrenCategoriesOnly()->get();
        $html = view('proCat.sidebar.menu_child', ['child_categories'=>$child_categories]);
        return $html;
    }
    
    public function getMenuCategoryChildMobile(Request $request){
        $category = ProductCategory::whereId($request->id_cat)->first();
        $child_categories = $category->childrenCategoriesOnly()->get();
        $html = view('layout.menu_child', ['child_categories'=>$child_categories, 'category'=>$category]);
        return $html;
    }
}
