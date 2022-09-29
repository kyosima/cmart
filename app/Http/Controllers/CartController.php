<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Ward;
use App\Models\Order;
use App\Models\Store;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AddressController;
use App\Admin\Traits\calculatorTranspotCmart;

class CartController extends Controller
{
    //
    use calculatorTranspotCmart;

    public function addProductToCart(Request $request){
        if(Auth::guard('user')->check()){
            $user = Auth::guard('user')->user();
            $user->level = $user->user_level()->first();
          
            $store_product = StoreProduct::whereProductId($request->product_id)->whereStoreId($request->store_id)
            ->with(['storeproduct_userlevels' => function($query) use ($user) {
                $query->where('userlevel_id', '=', $user->level->id); 
            }
            , 'product', 'store'])->first();
            if($store_product->storeproduct_userlevels->count()>0){
                $data = $request->all();
                $cart = Cart::updateOrCreate([
                    'user_id' => $user->id,
                    'store_id' => $data['store_id']
                ]);
                if($request->has('variation_id')){
                    switch($request->has('price')){
                        case true:
                            $item_exist = $cart->cart_item()->where('price', $request->price)->where('variation_id', $request->variation_id)->where('product_id', $request->product_id)->first();
                            break;
                        case false:
                            $item_exist = $cart->cart_item()->where('variation_id', $request->variation_id)->where('product_id', $request->product_id)->first();
                            break;
                    }
                }else{
                    $item_exist = $cart->cart_item()->where('product_id', $request->product_id)->first();
                    switch($request->has('price')){
                        case true:
                            $item_exist = $cart->cart_item()->where('price', $request->price)->where('product_id', $request->product_id)->first();
                            break;
                        case false:
                            $item_exist = $cart->cart_item()->where('product_id', $request->product_id)->first();
                            break;
                    }
                }

                if($item_exist){
                    if($request->has('price')){
                        $cart->cart_item()->updateOrCreate(['product_id'=>$request->product_id, 
                        'variation_id'=> $request->variation_id, 'price'=>$request->price], ['quantity' =>$item_exist->quantity + $request->quantity]);

                    }else{
                        $cart->cart_item()->updateOrCreate(['product_id'=>$request->product_id, 
                        'variation_id'=> $request->variation_id], ['quantity' =>$item_exist->quantity + $request->quantity]);

                    }
                }else{
                    $cart->cart_item()->create($data);
                }
                return response()->json(['status'=>true, 'message' => 'Thêm sản phẩm vào giỏ hàng thành công']);
 
            }else{
                return response()->json(['status'=>true, 'message'=> 'Sản phẩm không khả dụng cho định danh khách hàng']);
            }
            return $store_product;
        }else{
            return response()->json(['status'=>false, 'url' => '']);
        }
    }

    public function index()
    { 
        $user = Auth::guard('user')->user();
        $user->level = $user->user_level()->first();
        Session::forget('store_ids');
        $user->carts()->update(['transpot_service_id'=> null, 'transpot_price_default' => 0, 'transpot_price_fast' => 0]);
        $carts = $user->carts()->with(['cart_item.product.product_type', 'cart_item.product.product_price', 'cart_item.product.product_detail',
        'cart_item.product.product_brand', 'cart_item.product.product_category',
        'cart_item.product.product_price.product_price_detail' => function($query) use ($user) {
            $query->where('user_price_id', '=', $user->level->user_price_id); 
        },
        'cart_item.variation.product_price_detail'=> function($query) use ($user) {
            $query->where('user_price_id', '=', $user->level->user_price_id);
        }
        , 'store'])->get();

        return view('cart.index', compact('carts'));
    }

    public function updateCart(Request $request){
        $user = Auth::guard('user')->user();
        $cart = $user->carts()->where('id', $request->cart_id)->first();
        $cart_item =  $cart->cart_item()->where('id', $request->cart_item_id)->update(['quantity' => $request->quantity]);
        $carts = $user->carts()->with('cart_item')->get();
        $count_total = $carts->pluck('cart_item')->flatten()->sum('quantity');
        return response()->json(['count_total' => $count_total]);
    }

    public function addCart(Request $request)
    {
        $user = Auth::user();
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $product = Product::whereId($product_id)->with('productPrice', 'productVariations', 'productType')->first();
        switch ($product->product_variation){
            case 1:
                switch($product->productType->type) {
                    case 1:
                        switch($product->productPrice->price_type){
                            case 1:
                                $data = ['user_id'=>$user->id, 'product_id'=>$product->id];
                                $exist_item = Cart::where($data)->first();
                                $quantity = ($exist_item) ? $exist_item->quantity + $quantity : $quantity;
                                $cart_item = Cart::updateOrCreate($data,[ 'quantity'=>$quantity]);
                                $carts = $user->carts()->get();
                                return $carts;
                                break;
                            case 2:
                                $data = ['user_id'=>$user->id, 'product_id'=>$product->id, 'price'=>$request->price];
                                $exist_item = Cart::where($data)->first();
                                $quantity = ($exist_item) ? $exist_item->quantity + $quantity : $quantity;
                                $cart_item = Cart::updateOrCreate($data,[ 'quantity'=>$quantity]);
                                $carts = $user->carts()->get();
                                return $carts;
                                break;
                        }
                        break;
                    
                }
                break;
        }
      
        return response()->json($product);
    }

    public function calculatorTranspot(Request $request){
        $product = Product::whereId($request->product_id)->with('productPrice', 'productVariations', 'productType')->first();
        $price = $this->calculator($request->weight, $request->height, $request->width, $request->length,1);
        return view('product.include.transpot_preview', compact('request','price'))->render();
    }
 
    public function toCheckout(Request $request)
    {
        $store_ids = $request->store_ids;
        Session::put('store_ids', $store_ids);
        return redirect()->route('checkout.index');
    }

    public function deleteCart(Request $request)
    {
        $id = $_POST['id'];
        $storeid = $_POST['storeid'];
        $user = Auth::guard('user')->user();
        $user->carts()->where('id', $request->id)->delete();
        $count = $user->carts()->where('store_id', $request->storeid)->count();
        $count_total = $user->carts()->sum('quantity');

        return response()->json(['count' => $count, 'count_total' => $count_total]);
       
    }

    public function updateCheckout(Request $request)
    {
        $user = Auth::guard('user')->user();
        $user->level = $user->user_level()->first();
        $carts = $user->carts()->whereIn('store_id', $request->store_ids)->with(['cart_item.product.product_type', 'cart_item.product.product_price', 'cart_item.product.product_detail',
        'cart_item.product.product_brand', 'cart_item.product.product_category',
        'cart_item.product.product_price.product_price_detail' => function($query) use ($user) {
            $query->where('user_price_id', '=', $user->level->user_price_id); 
        },
        'cart_item.variation.product_price_detail'=> function($query) use ($user) {
            $query->where('user_price_id', '=', $user->level->user_price_id);
        }
        , 'store'])->get();
        $cart_items = $carts->pluck('cart_item')->flatten();

        $cart_items->map(function ($value, $key){
            $value->total_p = $value->quantity * ($value->is_ecard == 1
            ? $value->price
            : ($value->product->is_variation == 1 ? $value->variation->product_price_detail->price: $value->product->product_price->product_price_detail->price));
            $value->total_c = $value->quantity * $value->product->product_price->cpoint;
            $value->total_m = $value->quantity * $value->product->product_price->mpoint;
            return $value;
           
        });
        $total_p = $cart_items->sum('total_p');
        $total_c = $cart_items->sum('total_c');
        $total_m = $cart_items->sum('total_m');
        
        $accept = 0;
        if($carts->count() > 0 ){
            $accept = 1;
        }
        return response()->json(['store_ids'=>$request->store_ids, 'total_p' => formatCurrency($total_p), 'total_m' => formatCurrency($total_m),'total_c' => formatCurrency($total_c), 'accept'=>$accept]);
    }
}
