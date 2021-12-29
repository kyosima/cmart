<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ProductController extends Controller
{
    //
    public function product($slug){
        $product = Product::where('slug', '=', $slug)->firstOrFail();
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

        return view('product', compact('product'));
    }
}
