<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //
    public function index()
    {
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
        Cart::instance($storeid)->update($rowId, ['qty' => $qty]);
        return response()->json([
            formatPrice(Cart::instance($storeid)->get($rowId)->price * $qty)
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
        Cart::instance('shopping')->remove($rowId);
        return response()->json([
            Cart::instance('shopping')->subtotal() . '₫',
            Cart::instance('shopping')->total() . '₫'
        ], 200);
    }

    public function updateCheckout(Request $request)
    {
        $store_ids = $request->store_ids;
        $subtotal = 0;
        $total = 0;
        $count_cart = 0;
        if ($store_ids == null) {
            return response()->json([
                formatPrice(0),
                formatPrice(0),
                0,
                ''
            ], 200);
        }
        foreach ($store_ids as $store_id) {
            $store = Store::whereId($store_id)->first();
            if (Cart::instance($store->id)->count() > 0) {
                $cart = Cart::instance($store->id);
                $subtotal += intval(str_replace(",", "", $cart->subtotal()));
                $total += intval(str_replace(",", "", $cart->total()));
                $count_cart += $cart->count();
            }
        }
        $list_ids = implode(',', $store_ids);
        return response()->json([
            formatPrice($subtotal),
            formatPrice($total),
            $count_cart,
            $list_ids
        ], 200);
    }
}
