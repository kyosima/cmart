<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductRating;
use App\Http\Traits\getProduct;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\OpenGraph;


class ProductController extends Controller
{
    use getProduct;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            $product = $this->getProductWithPrice($slug); 
            SEOMeta::setTitle($product->name);
            SEOMeta::addMeta('robots', 'noindex, nofollow');
            SEOMeta::addMeta('name', $product->name, 'itemprop');
            SEOMeta::setDescription($product->meta_desc);
            SEOMeta::addKeyword(explode(",", $product->meta_keyword));

            OpenGraph::setTitle($product->name)
                ->setSiteName('cmart.vn')
                ->setType('product')
                ->setUrl(URL::current())
                ->setDescription($product->meta_desc)
                ->addImage($product->feature_img)
                ->addProperty('og:image:secure_url', $product->feature_img)
                ->addProperty('locale', 'vi_VN')
                ->addProperty('og:image:width', 600)
                ->addProperty('og:image:height', 600);
            $categoryIds = ProductCategory::where('id', $parentId = ProductCategory::where('id', $product->category_id)
                ->pluck('category_parent')->toArray())
                ->pluck('category_parent')
                ->merge($parentId)
                ->merge($product->category_id)
                ->toArray();
            $categoryIds = array_diff($categoryIds, [0]);
            $new_products = Product::latest()->paginate(5);
            $relateds_product = $product->product_relateds()->with('product')->get();
            $lastview_product = Product::latest()->paginate(10);
            $stores = $product->store_product()->with('store')->get();
            return view('product.product_detail', [ 'stores'=>$stores, 'relateds_product' => $relateds_product,  'product' => $product, 'categoryIds' => $categoryIds, 'new_products' => $new_products, 'lastview_product' => $lastview_product]);
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


    public function postRating(Request $request)
    {
        $phone = $_POST['phone'];
        $value = $_POST['value'];
        $fullname = $_POST['fullname'];
        $comment = $_POST['comment'];
        $product_id = $_POST['product_id'];
        $check = ProductRating::wherePhone($phone)->whereProductId($product_id)->first();
        if ($check == null) {
            ProductRating::insert(['phone' => $phone, 'fullname' => $fullname, 'value' => $value, 'product_id' => $product_id, 'comment' => $comment]);
            return 'Gửi đánh giá thành công';
        } else {
            return  'Bạn đã đánh giá sản phẩm này rồi';
        }
    }
}
