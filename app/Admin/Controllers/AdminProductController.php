<?php

namespace App\Admin\Controllers;

use DataTables;
use App\Models\Brand;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Province;
use App\Models\UserLevel;
use App\Models\UserPrice;
use App\Models\ProductType;
use Illuminate\Support\Str;
use App\Models\ProductBrand;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\CalculationUnit;
use App\Models\ProductCategory;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Admin\Traits\ajaxProductTrait;
use App\Admin\Controllers\AdminLogController; 

class AdminProductController extends Controller
{
    use ajaxProductTrait;
    public function index()
    {

        return view('admin.product.index');
    }

    public function create()
    {
        $payments = PaymentMethod::select('id', 'name')->oldest()->get();
        $product_types = ProductType::select('id', 'name')->oldest()->get();
        $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
        $product_brands = ProductBrand::select('id', 'name')->orderBy('id', 'asc')->get();
        return view('admin.product.create', compact( 'payments', 'product_types', 'user_prices', 'product_brands'));
    }

    public function store(Request $request)
    {    
        $data_product = $request->only('title','sku','category_id','brand_id', 'product_type_id','is_variation', 'is_ecard','status');
        $product = Product::create($data_product);
    

        $data_product_detail = $request->only('feature_img','gallery','weight','height','width','length','meta_desc','meta_keyword');
        $product->product_detail()->create($data_product_detail);
        $data_product_price = $request->only('cpoint','mpoint','fee_process','tax_gtgt','tax_ttdb','tax_nt_tndn','tax_nt_gtgt');
        $product_price = $product->product_price()->create($data_product_price);

        foreach($request->payment_ids as $payment_id){
            $product->product_payment()->create([
                'payment_id' => $payment_id
            ]);
        }
        if($request->product_related_id != null){
            foreach($request->product_related_id as $product_related_id){
                $product->product_relateds()->create([
                    'product_related_id' => $product_related_id
                ]);
            }
        }
     

        switch($request->is_variation){
            case 0:
                $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
                foreach($user_prices as $item){
                    $product_price->product_price_details()->create([
                        'user_price_id' => $item->id,
                        'price' =>  $_POST['price'.$item->id],
                    ]);
                }
                break;
            case 1:
                foreach($request->order as $order){
                    $product_variation = $product->product_variations()->create([
                        'name' => $_POST['variation_name'.$order],
                        'sku' => $_POST['variation_sku'.$order]
                    ]);
                    $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
                    foreach($user_prices as $item){
                        $product_variation->product_price_details()->create([
                            'user_price_id'=> $item->id,
                            'price' => $_POST['price'.$item->id.$order]
                        ]);
                    }
                }
                break;
        }

        return redirect()->route('product.edit', $product->id)->with('success', 'Thêm sản phẩm thành công');
    }

    public function getPriceForm(Request $request){
        $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
        switch ($request->is_variation){
            case 0:
                $html = view('admin.product.price.price_normal', compact('user_prices'))->render();
                break;
            case 1:
                $order = 1;
                $html = view('admin.product.price.price_variation_list', compact('user_prices', 'order'))->render();
                break;
        }
        return $html;
    }
    
    public function getMoreVariation(Request $request){
        $order = $request->order + 1;
        $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
        $html =  view('admin.product.price.price_variation', compact('user_prices', 'order'))->render();
        return response()->json(['html' => $html, 'order' => $order]);
    }

   

    public function edit($id)
    {
        $product = Product::whereId($id)->with('product_relateds.product','product_detail', 'product_category','product_brand','product_type' ,'product_price.product_price_details.user_price', 'product_payment', 'product_variations.product_price_details.user_price')->first();   
        $payments = PaymentMethod::select('id', 'name')->oldest()->get();
        $product_types = ProductType::select('id', 'name')->oldest()->get();
        $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
        $product_brands = ProductBrand::select('id', 'name')->orderBy('id', 'asc')->get();
        // return($product->product_variations[0]);
        return view('admin.product.edit', compact('product', 'payments', 'product_types', 'user_prices', 'product_brands'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::whereId($id)->first();
        $data_product = $request->only('title','sku','category_id','brand_id', 'product_type_id','is_variation', 'is_ecard','status');
        $product->update($data_product);  

        $data_product_detail = $request->only('feature_img','gallery','weight','height','width','length','meta_description','meta_keyword', 'description');
        $product->product_detail()->update($data_product_detail);
        $data_product_price = $request->only('cpoint','mpoint','fee_process','tax_gtgt','tax_ttdb','tax_nt_tndn','tax_nt_gtgt');
        $product_price = $product->product_price()->first();
        $product_price->update($data_product_price);
        $product_variation_ids = $product->product_variations()->pluck('id')->toArray();

        if($request->product_related_id != null){
            foreach($request->product_related_id as $product_related_id){
                $product->product_relateds()->updateOrCreate(['product_related_id'=>$product_related_id],[]);
            }
        }
        foreach($request->payment_ids as $payment_id){
            $product->product_payment()->updateOrCreate(['payment_id'=>$payment_id],[]);
        }
 
        switch($request->is_variation){
            case 0:
                $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
                foreach($user_prices as $item){
                    $product_price->product_price_details()->updateOrCreate([
                        'user_price_id' => $item->id,
                    ], [
                        'price' =>  $_POST['price'.$item->id]
                    ]);
                }
                break;
            case 1:
                $user_prices = UserPrice::select('id', 'label')->orderBy('id', 'asc')->get();
                foreach($request->order as $variation_id){
                    $product_variation = $product->product_variations()->updateOrCreate(['id'=>$variation_id],[
                        'name' => $_POST['variation_name'.$variation_id],
                        'sku' => $_POST['variation_sku'.$variation_id]
                    ]);
                    foreach($user_prices as $item){
                        $product_variation->product_price_details()->updateOrCreate([
                            'product_variation_id'=> $product_variation->id,
                            'user_price_id' => $item->id
                        ],[
                            'price' => $_POST['price'.$item->id.$variation_id]
                        ]);
                    }
                }
                $remove_variations = array_diff($product_variation_ids, $request->order);

                foreach ($remove_variations as $remove_variation){
                    $product_variation = $product->product_variations()->whereId($remove_variation)->first();
                    $product_variation->product_price_details()->delete();
                    $product_variation->delete();
                }
                break;
        }

        
        return back()->with('success', 'Cập nhật sản phẩm thành công');

    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);

        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Sản phẩm', 'Xóa', 'sản phẩm '.$product->name);


        return redirect()->route('san-pham.index');
    }

    public function multiChange(Request $request) {
        if ($request->id == null) {
            return redirect()->back();
        }    
        else {
            if ($request->action == 'delete') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    Product::destroy($item);

    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            else if($request->action == 'show') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    $product->status = 1;
                    $product->save();

                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            else if($request->action == 'hidden') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    $product->status = 0;
                    $product->save();
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            return redirect()->back();
        }
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search, $request->id)
        ]);
    }

    public function getProCat(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProCat($request->search, 0)
        ]);
    }

    public function indexDatatable()
    {
        $products = Product::latest()->with('product_detail', 'product_category','product_brand','product_type' ,'product_price.product_price_details.user_price', 'product_payment', 'product_variations.product_price_details.user_price')->get();
        return datatables()->of($products)->toJson();
    }
}
