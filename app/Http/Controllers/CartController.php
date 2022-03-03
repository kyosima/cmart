<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Ward;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    //

    public function index()
    {
        if(Session::has('edit_order')){
            return redirect()->route('checkout.getPaymentMethod', ['order_code'=>Session::get('edit_order')]);
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
        $stores = $product->stores()->get();

        $store = Store::whereId($store_id)->first();
        $store_product = $store->product_stores()->where('id_ofproduct', $product->id)->first();
        if($qty > $store_product->soluong){
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
        Cart::instance($storeid)->update($rowId, ['qty' => $qty]);
        return response()->json([
            formatPrice(Cart::instance($storeid)->get($rowId)->price * $qty),
            // formatNumber(Cart::instance($storeid)->get($rowId)->model->product_price()->value('cpoint')),
            // formatNumber(Cart::instance($storeid)->get($rowId)->model->product_price()->value('mpoint')),


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
        return response()->json([
            true
        ], 200);
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
