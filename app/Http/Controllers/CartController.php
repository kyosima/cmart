<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    //
    public function index(){
        $carts = Cart::instance('shopping')->content();
        $cart_subtotal = Cart::instance('shopping')->subtotal();
        $cart_total = Cart::instance('shopping')->total();

        return view('cart.giohang', ['carts' => $carts, 'cart_subtotal' => $cart_subtotal, 'cart_total'=>$cart_total]);
    }

    public function addCart(Request $request){
        $product_id = $_POST['product_id'];
        $qty = $_POST['qty'];
        $product = Product::whereId($product_id)->firstOrFail();
        Cart::instance('shopping')->add(['id'=> $product->id,'name'=> $product->name, 'price'=> $product->productPrice()->value('market_price'), 'qty'=>$qty])->associate('App\Models\Product');
        return response()->json([
            Cart::instance('shopping')->subtotal(),
            Cart::instance('shopping')->count()
        ],200);
    }

    public function updateCart(Request $request){
        $rowId = $_POST['rowid'];
        $qty = $_POST['qty'];
        Cart::instance('shopping')->update($rowId, ['qty' => $qty]);
        return response()->json([
            formatPrice(Cart::instance('shopping')->get($rowId)->price *$qty),
            Cart::instance('shopping')->subtotal().'₫',
            Cart::instance('shopping')->total().'₫'
        ],200);
    }

    public function deleteCart(Request $request){
        $rowId = $_POST['rowid'];
        Cart::instance('shopping')->remove($rowId);
        return response()->json([
            Cart::instance('shopping')->subtotal().'₫',
            Cart::instance('shopping')->total().'₫'
        ],200);
    }
    
    
}
