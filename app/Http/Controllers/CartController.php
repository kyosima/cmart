<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Ward;
use App\Models\Order;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $orders_not_payment = $user->orders()->where('is_payment',0)->get();
        if (count($orders_not_payment) > 0) {
            foreach($orders_not_payment as $order){
                foreach($order->order_stores()->get() as $order_store){
                    foreach($order_store->order_products()->get() as $order_product){
                        $order_product->delete();
                    }
                    $order_store->delete();
    
                }
                $order->delete();
            }            
        }
        $stores = Store::get();
        Session::forget('store_ids');
        $count_cart = 0;
        foreach ($stores as $store) {
            $count_cart += Cart::instance($store->id)->count();
        }
        return view('cart.giohang', compact('stores', 'count_cart'));
    }

    public function addCart(Request $request)
    {
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $store_id = $_POST['store_id'];
        $product = Product::whereId($product_id)->firstOrFail();

        $store = Store::whereId($store_id)->first();
        $store_product = $store->product_stores()->where('id_ofproduct', $product->id)->first();
        $cart = Cart::instance($store->id)->content();
        $row = $cart->where('id', $product_id)->first();
         if($row != null){
            if(($qty +$row->qty) > $store_product->soluong){
                return response()->json([
                    0
                ], 200);
            }
         }elseif($qty  > $store_product->soluong){
            return response()->json([
                0
            ], 200);
        }
      
        Cart::instance($store_id)->add(['id' => $product->id, 'name' => $product->name, 'price' => getPriceOfLevel($product), 'qty' => $qty, 'options' => [ 'method_ship' => 0, 'type_ship' => 0, 'price_normal' => 0, 'price_fast'=>0]])->associate('App\Models\Product');
        $stores = Store::get();
        $count_cart = 0;
        foreach ($stores as $store) {
            $count_cart += Cart::instance($store->id)->count();
        }
        return response()->json([
            $count_cart
        ], 200);
    }

    public function updateCart(Request $request)
    {
        $rowId = $_POST['rowid'];
        $qty = $_POST['qty'];
        $storeid = $_POST['storeid'];
        $row = Cart::instance($storeid)->get($rowId);

        $product = Product::whereId($row->id)->firstOrFail();

        $store = Store::whereId($storeid)->first();
        $store_product = $store->product_stores()->where('id_ofproduct', $product->id)->first();

        $error = 0;
        if($qty > $store_product->soluong){
            Cart::instance($storeid)->update($rowId, ['qty' => $store_product->soluong]);
            $error = 1;
        }else{
            Cart::instance($storeid)->update($rowId, ['qty' => $qty]);
        }
     
        $stores = Store::get();
        $count_cart = 0;
        foreach ($stores as $store) {
            $count_cart += Cart::instance($store->id)->count();
        }
        return response()->json([
            formatPrice(Cart::instance($storeid)->get($rowId)->price * $qty),
            // formatNumber(Cart::instance($storeid)->get($rowId)->model->product_price()->value('cpoint')),
            // formatNumber(Cart::instance($storeid)->get($rowId)->model->product_price()->value('mpoint')),
            $count_cart,
            $store_product->soluong,
            $error,
        ], 200);
    }
    public function toCheckout(Request $request)
    {
        $store_ids = $request->store_ids;
        Session::put('store_ids', $store_ids);
        return redirect()->route('checkout.index');
    }

    public function deleteCart(Request $request)
    {
        $rowId = $_POST['rowid'];
        $storeid = $_POST['storeid'];
        Cart::instance($storeid)->remove($rowId);
        $stores = Store::get();
        $count_cart = 0;
        foreach ($stores as $store) {
            $count_cart += Cart::instance($store->id)->count();
        }
        if(Cart::instance($storeid)->count() == 0 ){
            return response()->json([
                0,
                $count_cart
            ], 200);
        }else{
            return response()->json([
                1,
                $count_cart

            ], 200);
        }
       
    }

    public function updateCheckout(Request $request)
    {
        $store_ids = $request->store_ids;
        $subtotal = 0;
        $count_cart = 0;
        $c_point = 0;
        $m_point = 0;
        if ($store_ids == null) {
            return response()->json([
                formatPrice(0),
                0,
                '',
                0,
                0
            ], 200);
        }
        foreach ($store_ids as $store_id) {
            $store = Store::whereId($store_id)->first();
            if (Cart::instance($store->id)->count() > 0) {
                $cart = Cart::instance($store->id);
                $subtotal += intval(str_replace(",", "", $cart->subtotal()));
                $count_cart += $cart->count();
                foreach ($cart->content() as $row){
                    $c_point += $row->model->productPrice()->value('cpoint') * $row->qty;
                    $m_point += $row->model->productPrice()->value('mpoint') * $row->qty;
                }
            }
        }
        $list_ids = implode(',', $store_ids);
        return response()->json([
            formatPrice($subtotal),
            $count_cart,
            $list_ids,
            $c_point,
            $m_point
        ], 200);
    }
}
