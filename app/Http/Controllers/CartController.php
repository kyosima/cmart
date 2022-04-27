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
use App\Http\Controllers\AddressController;
class CartController extends Controller
{
    //

    public function index()
    {
        // dd(Cart::instance(1)->content());
        if(Auth::check()){
            $user = Auth::user();
            if($user->is_company == 1){
                if($user->check_company ==0){
                    return redirect('tai-khoan')->with('thongbao', 'Hồ sơ khách hàng doanh nghiệp chưa xác minh');
                }
            }
            if($user->status == 0){
                Auth::logout();
               return redirect('tai-khoan')->with('thongbao', 'Hồ sơ khách hàng đã ngưng hoạt động');
            }
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
        }
     
        $stores = Store::get();
        Session::forget('store_ids');
        $count_cart = 0;
        foreach ($stores as $store) {
            $count_cart += Cart::instance($store->id)->count();
            if(Cart::instance($store->id)->count()> 0){
                $cart = Cart::instance($store->id);
                if(Auth::check()){
                    foreach($cart->content() as $row){
                        if($row->model->is_ecard == 0 || $row->model->is_shipping == 0){
                            $cart->update($row->rowId, ['price' => getPriceOfLevel($row->model)]);
                        }
                    }
                }
            }
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
        if($product->is_ecard == 1){
            Cart::instance($store_id)->add(['id' => $product->id, 'name' => $product->name, 'price' =>  $request->price, 'qty' => $qty, 'is_shipping' => 0, 'options' => [ 'method_ship' => 0, 'type_ship' => 0, 'price_normal' => 0, 'price_fast'=>0]])->associate('App\Models\Product');
        }if($product->is_shipping == 1){
            $addressController = new AddressController();
            $weight = ceil(max($request->weight / 1000, (($request->height * $request->width * $request->length) / 3000)) * 1000);
            $province_from = $addressController->getProvinceDetail($request->sel_province);
            $district_from = $addressController->getDistrictDetail($request->sel_province, $request->sel_district);
            $ward_from = $addressController->getWardDetail($request->sel_district, $request->sel_ward);
            $address_from = $request->address;
            $province_to = $addressController->getProvinceDetail($request->sel_province_to);
            $district_to = $addressController->getDistrictDetail($request->sel_province_to, $request->sel_district_to);
            $ward_to = $addressController->getWardDetail($request->sel_district_to, $request->sel_ward_to);
            $address_to = $request->address_to;
            $product_name = $province_from->PROVINCE_NAME .', '.$district_from->DISTRICT_NAME . ', '.$ward_from->WARDS_NAME.', '.$address_from .' - '. $province_to->PROVINCE_NAME .', '.$district_to->DISTRICT_NAME .', '.$ward_to->WARDS_NAME.', '.$address_to;
            Cart::instance($store_id)->add(['id' => $product->id,  'name'=> $product_name.'-'.$weight.'(g)', 'price' =>  0, 'qty' => 1,  'options' => [
                'id_province_from' => $request->sel_province,
                'id_district_from' => $request->sel_district,
                'id_ward_from' => $request->sel_ward,
                'address_from' => $request->address,
                'id_province_to' => $request->sel_province_to,
                'id_district_to' => $request->sel_district_to,
                'id_ward_to' => $request->sel_ward_to,
                'address_to' => $request->address_to,
                'weight' => $request->weight,
                'is_shipping' => 1,
                'method_ship' => 0,
                'type_ship' => 0,
                'price_normal' => 0,
                'price_fast'=>0
                ]])->associate('App\Models\Product');
            // Cart::instance('product_shipping')->add(['id' => $product->id,  'name'=> $product_name.'-'.$weight.'(g)', 'price' =>  0, 'qty' => 1,  'options' => [
            //     'id_province_from' => $request->sel_province,
            //     'id_district_from' => $request->sel_district,
            //     'id_ward_from' => $request->sel_ward,
            //     'address_from' => $request->address,
            //     'id_province_to' => $request->sel_province_to,
            //     'id_district_to' => $request->sel_district_to,
            //     'id_ward_to' => $request->sel_ward_to,
            //     'address_to' => $request->address_to,
            //     'weight' => $request->weight,
            //     'is_shipping' => 1,
            //     'method_ship' => 0,
            //     'type_ship' => 0,
            //     'price_normal' => 0,
            //     'price_fast'=>0
            //     ]])->associate('App\Models\Product');
        }else{
            Cart::instance($store_id)->add(['id' => $product->id, 'name' => $product->name, 'price' =>  getPriceOfLevel($product), 'qty' => $qty, 'is_shipping' => 0, 'options' => [ 'method_ship' => 0, 'type_ship' => 0, 'price_normal' => 0, 'price_fast'=>0]])->associate('App\Models\Product');

        }
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
