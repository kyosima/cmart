<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Brand;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::latest()->paginate(12);
        $subcategory = ProductCategory::latest()->get();
        $brandIds = $products->pluck('brand')->toArray();
        $brands = array_unique($brandIds);
        $brands = Brand::whereIn('id', $brands)->get();
        $countBrand = array_count_values($brandIds);                                    

        return view('product.category', compact('products', 'subcategory', 'brands', 'countBrand'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        {
            //
            $product = Product::whereSlug($slug)->leftJoin('product_price', 'products.id', '=', 'product_price.id_ofproduct')->firstorfail();
            $categoryIds = ProductCategory::where('id', $parentId = ProductCategory::where('id', $product->category_id)
            ->pluck('category_parent')->toArray())
            ->pluck('category_parent')
            ->merge($parentId)
            ->merge($product->category_id)
            ->toArray();
            $categoryIds = array_diff( $categoryIds, [0] );
            $new_products = Product::latest()->paginate(5);
            $lastview_product = Product::latest()->paginate(10);

            return view('product.product_detail', ['product' => $product, 'categoryIds' => $categoryIds, 'new_products'=>$new_products, 'lastview_product'=>$lastview_product]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
