<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductCategory;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCategoryController extends Controller
{
    //
    public function index($slug, Request $request){        

        // KIỂM TRA XEM GIÁ TRỊ CỦA ORDER CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        if ($request->order != '' || $request->order != null) {
            $order = explode(' ', $request->order); 
            if( count($order) != 2 || ($order[0] != 'regular_price' && $order[0] != 'name') ||  ($order[1] != 'asc' && $order[1] != 'desc')  ) {
                return redirect()->route('proCat.index', $slug);
            }
        } 
        // KIỂM TRA XEM GIÁ TRỊ CỦA SALE CÓ ĐÚNG GIÁ TRỊ CHO PHÉP
        else if($request->sale != 2 && $request->sale != '') {
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
        $categoryIds = ProductCategory::where('category_parent', $parentId = ProductCategory::where('slug', $slug)->value('id'))
            ->pluck('id')
            ->push($parentId)
            ->all();

        // KIỂM TRA XEM CÓ FILTER THEO CATEGORY KH
        if (isset($request->category) && !in_array(null, $request->category)) {
            // KIỂM TRA XEM CATEGORY TRONG REQUEST CÓ NẰM TRONG ARRAY DANH MỤC HIỆN TẠI
            if( count(array_intersect($request->category, $categoryIds)) == 0  ) {
                return redirect()->route('proCat.index', $slug);
            }
            $products = Product::whereIn('category_id', $request->category)
                                ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                                ->paginate(16);
            $subcategory = ProductCategory::whereIn('id', array_intersect($request->category, $categoryIds))->get();
        }
        // KIỂM TRA XEM CÓ FILTER THEO BRAND KH
        if (isset($request->id_brand) && !in_array(null, $request->id_brand)) {
            // LẤY RA BRAND ĐỂ SO SÁNH
            $brandIds = Product::whereIn('category_id', $categoryIds)->pluck('brand')->toArray();
            
            // KIỂM TRA XEM BRAND TRONG REQUEST CÓ NẰM TRONG ARRAY BRAND HIỆN TẠI
            if( count(array_intersect($request->id_brand, $brandIds)) == 0  ) {
                return redirect()->route('proCat.index', $slug);
            }
            $products = Product::whereIn('category_id', $categoryIds)
                                ->whereIn('brand', $request->id_brand)
                                ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                                ->paginate(16);
            $categoryIds = $products->pluck('category_id')->toArray();
            $subcategory = ProductCategory::whereIn('id', $categoryIds)
                                        ->where('id', '!=', $proCat->id)
                                        ->get();
        }
        // NẾU FILTER CẢ DANH MỤC VÀ BRAND THÌ VÀO ĐÂY
        if ( (isset($request->id_brand) && !in_array(null, $request->id_brand)) && 
                    (isset($request->category) && !in_array(null, $request->category)) ) {
            $products = Product::whereIn('category_id', $request->category)
                            ->whereIn('brand', $request->id_brand)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->paginate(16);
            $subcategory = ProductCategory::whereIn('id', array_intersect($request->category, $categoryIds))->get();
        } 
        // KHÔNG FILTER DANH MỤC VÀ BRAND THÌ VÔ ĐÂY
        else if ( !isset($request->id_brand) && !isset($request->category)) {
            $products = Product::whereIn('category_id', $categoryIds)
                            ->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')
                            ->paginate(16);
            $subcategory = ProductCategory::whereIn('id', $categoryIds)->where('id', '!=', $proCat->id)->get();
        }

        // SORT THEO ORDER
        if ($request->order != null || $request->order != '') {
            if($order[1] == 'asc') {
                $products = $products->sortBy($order[0])->paginate(16);
            } else {
                $products = $products->sortByDesc($order[0])->paginate(16);
            }
        }

        // SORT THEO SALE
        else if($request->sale == 2) {
            $products = $products->where('shock_price', '>', 0)
                                ->where('shock_price', '!=', null)
                                ->paginate(16);
        } 

        // LẤY RA BRAND ĐỂ SHOW KHÔNG BỊ TRÙNG LẶP 
        $brandIds = $products->pluck('brand')->toArray();
        $brands = array_unique($brandIds);
        $brands = Brand::whereIn('id', $brands)->get();

        // ARRAY BRAND 
        // VỚI KEY = BRAND ID
        // VALUE = SỐ LƯỢNG SP THUỘC BRAND
        $countBrand = array_count_values($brandIds);                                    

        return view('proCat.danhmucsanpham', compact('proCat', 'products', 'brands', 'slug', 'countBrand', 'subcategory'));
    }

    public function showAll()
    {
        $categories = ProductCategory::where('category_parent', 0)
            ->where('id', '!=', 1)
            ->with(['childrenCategories.products', 'products'])
            ->get();
        
        return view('proCat.allProCat', compact('categories'));
    }

}