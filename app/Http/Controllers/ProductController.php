<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Brand;
use App\Models\ProductRating;
use Illuminate\Support\Facades\URL;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductController extends Controller
{
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
        // if (Auth::check()) {
            //
            $user = Auth::user();
            $product = Product::whereSlug($slug)->firstorfail();

            SEOMeta::setTitle($product->name);
            SEOMeta::addMeta('robots', 'noindex, nofollow');
            SEOMeta::addMeta('name', $product->name, 'itemprop');
            SEOMeta::setDescription($product->meta_desc);
            SEOMeta::addKeyword(explode(",", $product->meta_keyword));

            OpenGraph::setTitle($product->name)
                // ->setDescription('Some Article')
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
            $related_product = $product->productUpsell($product->id);
            $lastview_product = Product::latest()->paginate(10);
            $ratings = $product->ratings()->latest()->get();
            $rating_sum = $product->ratings()->sum('value');
            $rating_count = $product->ratings()->count();

            $rating_average = $rating_sum > 0 ?  number_format($rating_sum / $rating_count, 1) : 0;
            $rating_list = [
                $product->ratings()->whereValue(5)->count(),
                $product->ratings()->whereValue(4)->count(),
                $product->ratings()->whereValue(3)->count(),
                $product->ratings()->whereValue(2)->count(),
                $product->ratings()->whereValue(1)->count()
            ];
            $stores = $product->stores()->get();
            return view('product.product_detail', ['user' => $user, 'stores' => $stores, 'related_product' => $related_product, 'ratings' => $ratings, 'rating_list' => $rating_list, 'rating_count' => $rating_count, 'rating_average' => $rating_average, 'product' => $product, 'categoryIds' => $categoryIds, 'new_products' => $new_products, 'lastview_product' => $lastview_product]);
        // } else {
            
        //     Session::put('url_back', URL::current());

        //     return redirect()->route('account');
        // }
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
