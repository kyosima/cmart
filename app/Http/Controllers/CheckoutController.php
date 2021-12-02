<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index(){
        if (Auth::check()) {
        if(Cart::instance('shopping')->count() > 0){
            if (Auth::check()) {
                $user = Auth::user();
            }else{
                $user = null;
            }
            $carts = Cart::instance('shopping')->content();
            $cart_subtotal = Cart::instance('shopping')->subtotal();
            $cart_total = Cart::instance('shopping')->total();
            $province = Province::select('matinhthanh', 'tentinhthanh')->get();
            $user_ward = Ward::where('maphuongxa', $user->id_phuongxa)->first();
            $tax = 0;
            $c_ship = 0;
            $v_ship = 0;
            $m_point = 0;
            $process_fee = 0;
            foreach($carts as $row){
                $price = $row->model->productPrice()->first();
                $tax += $row->price * $price->tax / 100;
                $c_ship += $price->cship;
                $v_ship += $price->viettel_ship;
                $m_point += $price->mpoint;
                $process_fee += $price->phi_xuly;

            }
            return view('checkout.thanhtoan', [
                'carts' => $carts, 
                'cart_subtotal' => $cart_subtotal, 
                'cart_total'=>$cart_total,
                'province' => $province,
                'user' => $user,
                'user_ward' => $user_ward,
                'tax' => $tax,
                'c_ship' => $c_ship,
                'v_ship' => $v_ship,
                'm_point' => $m_point,
                'process_fee' => $process_fee
            ]);
        }else{
            return redirect()->route('cart.index');
        }
    }else{
        return redirect()->route('account');
    }
    }

    public function postOrder(Request $request){
        $cart = Cart::instance('shopping')->content();
        $user_id = null;
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }
        if(Cart::instance('shopping')->count() > 0){

            $validation = $request->validate([
                'fullname' => 'required',
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)|(84)\d{9}/'],
                'email' => 'required|email',
                'sel_province' => 'required',
                'sel_district' => 'required',
                'sel_ward' => 'required',
                'address' => 'required',
                // 'shipping_method' => 'required',
            ]);
            // return DB::transaction(function () use ($request, $cart) {
            //     try {
                    $order = Order::create([
                        'note' => $request->note,
                        'user_id'=>$user_id,
                        // 'shipping_method' => $request->shipping_method,
                        'shipping_total' => 0,
                        'sub_total' => intval(str_replace(",", "", Cart::instance('shopping')->subtotal())),
                        'total' => intval(str_replace(",", "", Cart::instance('shopping')->total()))
                    ]);
                    $order->order_code = 'CMART-'.$order->id.time();
                    $order->save();
                    $order_address = new OrderAddress();
                    $order_address->id_province = $request->sel_province;
                    $order_address->id_district = $request->sel_district;
                    $order_address->id_ward = $request->sel_ward;
                    $order_address->address = $request->address;
                    $order->order_address()->save($order_address);

                    $order_info = new OrderInfo();
                    $order_info->fullname = $request->fullname;
                    $order_info->phone = $request->phone;
                    $order_info->email = $request->email;
                    $order_info->note = $request->note;
                    $order->order_info()->save($order_info);

                    foreach ($cart as $item) {
                        OrderProduct::create([
                            'id_order' => $order->id,
                            'id_product' => $item->model->id,
                            'quantity' => $item->qty,
                            'price' => $item->price
                        ]);
                    }
                    Cart::instance('shopping')->destroy();
                    return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
            //     } catch (\Throwable $th) {
            //         throw new \Exception('Đã có lỗi xảy ra vui lòng thử lại');
            //         return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            //     }
            // });
        }else{
            return redirect()->route('cart.index');
        }
    }


    public function orderSuccess(Request $request){
        if(!$request->order_code || !$order = Order::whereOrderCode($request->order_code)->first()){
            return redirect('/');
        }

        $order_info = $order->order_info()->first();
        $order_address = $order->order_address()->first();
        $products = $order->order_products()->get();

        return view('checkout.thanhcong', ['order' => $order, 'address' => $order_address, 'order_info' => $order_info, 'products'=>$products]);
        return view('checkout.thanhcong');
    }

}
