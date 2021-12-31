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
use App\Models\StoreAddress;
use App\Models\OrderVat;

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
            $store_address = $user->getstoreAddress()->get();
            $tax = 0;
            $c_ship = 0;
            $v_ship = 0;
            $m_point = 0;
            $c_point = 0;
            $process_fee = 0;
            foreach($carts as $row){
                $price = $row->model->productPrice()->first();
                $tax += ($row->price * $price->tax / 100) * $row->qty;
                $c_ship += $price->cship * $row->qty;
                $v_ship += $price->viettel_ship * $row->qty;
                $m_point += $price->mpoint * $row->qty;
                $c_point += $price->cpoint * $row->qty;
                $process_fee += $price->phi_xuly * $row->qty;
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
                'c_point' => $c_point,
                'process_fee' => $process_fee,
                'store_address' => $store_address
            ]);
        }else{
            return redirect()->route('cart.index');
        }
    }else{
        return redirect()->route('account');
    }
    }

    public function getAddress(Request $request){
        $address = StoreAddress::find($request->id)->first();
        $a_province = Province::where('matinhthanh', $address->id_province)->first();
        $a_district = District::where('maquanhuyen', $address->id_district)->first();
        $a_ward = Ward::where('maphuongxa', $address->id_ward)->first();
        $province = Province::select('matinhthanh', 'tentinhthanh')->get();
        $district = $a_province->district()->select('maquanhuyen', 'tenquanhuyen')->get();
        $ward = $a_district->ward()->select('maphuongxa', 'tenphuongxa')->get();
        $arr = [$address, $a_province, $a_district, $a_ward, $province, $district, $ward];
        return $arr;
    }

    public function postOrder(Request $request){
        $cart = Cart::instance('shopping')->content();
        $user_id = null;
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }
        $store_address = $request->input('store_address');
        $show_vat = $request->input('show_vat');

        $tax = 0;
        $c_ship = 0;
        $v_ship = 0;
        $m_point = 0;
        $c_point = 0;
        $process_fee = 0;
        foreach($cart as $row){
            $price = $row->model->productPrice()->first();
            $tax += ($row->price * $price->tax / 100) * $row->qty;
            $c_ship += $price->cship * $row->qty;
            $v_ship += $price->viettel_ship * $row->qty;
            $m_point += $price->mpoint * $row->qty;
            $c_point += $price->cpoint * $row->qty;
            $process_fee += $price->phi_xuly * $row->qty;
        }
        switch ($request->shipping_method) {
            case'v_ship':
                $name_method = 'Viettel Shipping';
                $shipping_total = $v_ship;
              break;
              case'c_ship':
                $name_method = 'Cmart Shipping';
                $shipping_total = $c_ship;
              break;
          }
  
        if(Cart::instance('shopping')->count() > 0){
            $validation = $request->validate([
                'fullname' => 'required',
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)|(84)\d{9}/'],
                // 'email' => 'required|email',
                'sel_province' => 'required',
                'sel_district' => 'required',
                'sel_ward' => 'required',
                'address' => 'required',
                // 'shipping_method' => 'required',
            ]);
            // return DB::transaction(function () use ($request, $cart) {
            //     try {
                if($store_address == 1){
                    $storeAddress = StoreAddress::create([
                        'id_user' => $user_id,
                        // 'name' => $request->name_address,
                        'fullname' => $request->fullname,
                        'phone'=>$request->phone,
                        // 'email' => $request->email,
                        'id_province' => $request->sel_province,
                        'id_district' => $request->sel_district,
                        'id_ward' => $request->sel_ward,
                        'address' => $request->address
                    ]);
                    $storeAddress->save();

                }
        
                    $order = Order::create([
                        'note' => $request->note,
                        'user_id'=>$user_id,
                        'shipping_method' => $name_method,
                        'shipping_total' => $shipping_total,
                        'c_point' => $c_point,
                        'm_point' => $m_point,
                        'tax' => $tax,
                        'process_fee' => $process_fee,
                        'sub_total' => intval(str_replace(",", "", Cart::instance('shopping')->subtotal())),
                        'total' => intval(str_replace(",", "", Cart::instance('shopping')->total()) )

                        // 'total' => intval(str_replace(",", "", Cart::instance('shopping')->total()) + $tax + $process_fee + $shipping_total)
                    ]);
                    if($show_vat == 1){
                        $vat = OrderVat::create([
                            'id_order' => $order->id,
                            'vat_name' => $request->vat_name,
                            'vat_mst'=>$request->vat_mst,
                            'vat_address' => $request->vat_address
                        ]);
                        $vat->save();
    
                    }
                  
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
