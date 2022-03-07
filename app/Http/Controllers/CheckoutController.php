<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\PaymentMethod;
use App\Models\PointCHistory;
use App\Models\OrderAddress;
use App\Models\OrderProduct;
use App\Models\StoreAddress;
use App\Models\InfoCompany;
use App\Models\Store;
use App\Models\OrderVat;
use App\Models\User;

use App\Models\OrderPayme;
use App\Models\OrderStore;
use App\Http\Controllers\ViettelPostController;
use App\Http\Controllers\EkycController;

use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PaymentPaymeController;
use App\Models\PaymentMethodOption;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->api_key = 'VuBqJVkHv1wiBSdJArMeq5rhSCC6q12e3cVeVxmc';
    }
    public function index()
    {
        if (Session::has('edit_order')) {
            return redirect()->route('checkout.getPaymentMethod', ['order_code' => Session::get('edit_order')]);
        }
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->is_ekyc == 0) {
                return redirect()->route('ekyc.getVerify');
            }

            if (Session::has('store_ids') == false) {
                return redirect()->route('cart.index');
            }
            $store_ids = Session::get('store_ids');
            $province = Province::select('matinhthanh', 'tentinhthanh')->get();
            $store_address = $user->getstoreAddress()->get();
            $tax = 0;
            $m_point = 0;
            $c_point = 0;
            $sub_total = 0;
            $total = 0;
            $count_cart = 0;
            foreach (explode(",", $store_ids) as $store_id) {
                $cart = Cart::instance($store_id);
                foreach ($cart->content() as $row) {
                    $price = $row->model->productPrice()->first();
                    $tax += ($row->price * getTaxValue($price->tax)) * $row->qty;
                    $m_point += $price->mpoint * $row->qty;
                    $c_point += $price->cpoint * $row->qty;
                }
                $count_cart += $cart->count();

                $sub_total += intval(str_replace(",", "", $cart->subtotal()));

                $total += intval(str_replace(",", "", $cart->total()));
            }


            return view('checkout.thanhtoan', [
                'cart_subtotal' => $sub_total,
                'cart_total' => $total + $tax,
                'province' => $province,
                'user' => $user,
                'tax' => $tax,
                'm_point' => $m_point,
                'c_point' => $c_point,
                'store_address' => $store_address,
                'count_cart' => $count_cart,
                'store_ids' => $store_ids
            ]);
        } else {
            return redirect()->route('account');
        }
    }



    public function getAddress(Request $request)
    {
        $user = Auth::user();
        $addressController = new AddressController();
        $user_province = $addressController->getProvinceDetail($user->id_tinhthanh);
        $user_district = $addressController->getDistrictDetail($user->id_tinhthanh, $user->id_quanhuyen);
        $user_ward = $addressController->getWardDetail($user->id_quanhuyen, $user->id_phuongxa);
        $arr = [$user, $user_province, $user_district, $user_ward];
        return $arr;
    }

    public function postOrder(Request $request)
    {
        if (Session::has('edit_order')) {
            return redirect()->route('checkout.edit', ['order_code' => Session::get('edit_order')]);
        }
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }
        if ($request->in_store == 1) {
            $order_info = new OrderInfo();

            $order_info->fullname = $user->hoten;
            $order_info->phone = $user->phone;
            $order_info->note = $request->note;
            $order_address = new OrderAddress();
            $order_address->id_province = $user->id_tinhthanh;
            $order_address->id_district = $user->id_quanhuyen;
            $order_address->id_ward = $user->id_phuongxa;
            $order_address->address = $user->address;
        } else {
            $validation = $request->validate([
                'fullname' => 'required',
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)|(84)\d{9}/'],
                'sel_province' => 'required',
                'sel_district' => 'required',
                'sel_ward' => 'required',
                'address' => 'required',
            ], [
                'fullname.required' => 'Họ tên không được để trống',
                'phone.required' => 'Số điện thoại đang sử dụng đã bị trùng lặp',
                'sel_province.required' => ' Vui lòng chọn tỉnh/thành phố',
                'sel_district.required' => 'Vui lòng chọn quận/huyện',
                'sel_ward.required' => 'Vui lòng chọn phường/xã',
                'address.required' => 'Địa chỉ không được để trống'
            ]);
            $order_info = new OrderInfo();
            $order_info->fullname = $request->fullname;
            $order_info->phone = $request->phone;
            $order_info->note = $request->note;
            $order_address = new OrderAddress();
            $order_address->id_province = $request->sel_province;
            $order_address->id_district = $request->sel_district;
            $order_address->id_ward = $request->sel_ward;
            $order_address->address = $request->address;
        }




        $viettelPostController = new ViettelPostController();
        $store_address = $request->input('store_address');
        $show_vat = $request->input('show_vat');
        // $payment_method = $request->input('payment_method');
        $store_ids = Session::get('store_ids');
        $order = Order::create([
            'user_id' => $user_id
        ]);
        $total_tax = 0;
        $total_shipping = 0;
        $total_c = 0;
        $total_m = 0;
        $total_vat_products = 0;
        $total_discount_products = 0;
        $total_remaining_m_point = 0;
        $sub_total = 0;
        $total = 0;
        $time = (string)date('Y-m-d-H-i-s');
        $order_code = str_replace('-', '', $time) ;

        $order->order_code =$order_code;
        $count_store = 0;

        foreach (explode(",", $store_ids) as $store_id) {
            // Cart::instance($store_id)->destroy();

            $cart = Cart::instance($store_id);
            $order_store = OrderStore::create([
                'id_order' => $order->id,
                'id_store' => $store_id,

            ]);
            $count_store++;
            $store_tax = 0;
            $store_shipping_total = 0;
            $store_shipping_method = 0;
            $store_shipping_type = 0;
            $store_shipping_weight = 0;
            $store_c = 0;
            $store_m = 0;
            $vat_products = 0;
            $vat_services = 0;
            $discount_products = 0;
            foreach ($cart->content() as $row) {
                $price = $row->model->productPrice()->first();
                $store_tax += ($row->price * getTaxValue($price->tax)) * $row->qty;
                $store_c += $price->cpoint * $row->qty;
                $store_m += $price->mpoint * $row->qty;
                $store_shipping_method = $row->options->method_ship;
                $store_shipping_type = $row->options->type_ship;
                $store_shipping_weight += $this->getWeight($row->model, $row->qty);
                switch ($store_shipping_type) {
                    case 2:
                        $store_shipping_total += $row->options->price_fast;
                        break;
                    default:
                        $store_shipping_total += $row->options->price_normal;
                        break;
                }
                $vat_products += $row->price * getTaxValue($price->tax) * $row->qty;

                if (in_array(Auth::user()->level, [3, 4])) {
                    $price->cpoint = 0;
                    $price->mpoint = 0;
                }
                $store = Store::whereId($store_id)->first();
                $store_product = $store->product_stores()->where('id_ofproduct', $row->model->id)->first();
                $store_product->soluong -= $row->qty;
                $store_product->save();
                OrderProduct::create([
                    'id_order' => $order->id,
                    'id_order_store' => $order_store->id,
                    'id_product' => $row->model->id,
                    'sku' => $row->model->sku,
                    'name' => $row->name,
                    'slug' => $row->model->slug,
                    'feature_img' => $row->model->feature_img,
                    'quantity' => $row->qty,
                    'weight' => $this->getWeight($row->model, 1),
                    'price' => $row->price,
                    'discount' => 0,
                    'c_point' => $price->cpoint,
                    'm_point' => $price->mpoint
                ]);
            }
            OrderProduct::create([
                'id_order' => $order->id,
                'id_order_store' => $order_store->id,
                'id_product' => null,
                'sku' => null,
                'name' => "Hóa đơn GTGT",
                'slug' => null,
                'feature_img' => null,
                'quantity' => 1,
                'weight' => 0,
                'price' => 300,
                'discount' => 0,
                'c_point' => 0,
                'm_point' => 0,
            ]);
            $order_store->tax = $store_tax;
            $order_store->shipping_method = $store_shipping_method;
            $order_store->shipping_weight = $store_shipping_weight;
            $order_store->shipping_type = $store_shipping_type;
            $order_store->shipping_total = $store_shipping_total;
            $order_store->remaining_m_point = max($store_m - $store_shipping_total, 0);
            if (in_array(Auth::user()->level, [3, 4])) {
                $store_c = 0;
                $store_m = 0;
            }

            $order_store->c_point = $store_c;
            $order_store->m_point = $store_m;
            $order_store->vat_products = $vat_products;
            $order_store->sub_total = intval(str_replace(",", "", $cart->subtotal())) + 300;
            $order_store->total = $order_store->sub_total + $vat_products + $vat_services+ $store_shipping_total;
            $order_store_code = str_replace('-', '', $time) . '-' . '00'. $count_store;
            $order_store->order_store_code = $order_store_code;
            $order_store->save();
            $total_tax += $store_tax;
            $total_shipping += $store_shipping_total;
            $total_c += $store_c;
            $total_m += $store_m;
            $total_vat_products += $vat_products;
            $total_remaining_m_point += $order_store->remaining_m_point;
            $total_discount_products += $discount_products;
            $sub_total += $order_store->sub_total;
            $total += $order_store->total;
            // Cart::instance($store_id)->destroy();
        }

        if ($show_vat == 1) {
            $vat = OrderVat::create([
                'id_order' => $order->id,
                'vat_company' => $request->vat_company,
                'vat_email' => $request->vat_email,
                'vat_mst' => $request->vat_mst,
                'vat_address' => $request->vat_address
            ]);
            $vat->save();
        }
        $order->payment_method = null;
        $order->tax = $total_tax;
        $order->shipping_total = $total_shipping;
        $order->c_point = $total_c;
        $order->m_point = $total_m;
        $order->sub_total = $sub_total;
        $order->total = $total;
        $order->vat_products = $total_vat_products;
        $order->discount_products = $total_discount_products;
        $order->save();


        $order->order_address()->save($order_address);

       
        $order->order_info()->save($order_info);
        Session::put('edit_order', $order->order_code);

        // Session::forget('store_ids');
        // Session::put('order_code', $order->order_code);
        // if($payment_method == 2){
        //     $paymentPaymeController = new PaymentPaymeController();
        //     $result = $paymentPaymeController->PaymentPayme($order);
        //     $result = json_decode($result);
        //     if( $result->code == '105000'){
        //         $this->createOrderPayme($order->id, $order->order_code, $result->data->url, $result->data->transaction);
        //         return redirect($result->data->url);
        //     }else{
        //         return redirect()->route('paymentFail');

        //     }

        // }else{

        return redirect()->route('checkout.getPaymentMethod', ['order_code' => $order->order_code]);
        // }

        // } else {
        //     return redirect()->route('cart.index');
        // }
    }

    public function getEditOrder(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        return view('checkout.edit_order', compact('order'));
    }

    public function postEditOrder(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user_id = $user->id;
        }
        $order = Order::whereOrderCode($request->order_code)->first();

        if ($request->in_store == 1) {
            $order_info = $order->order_info()->first();
            $order_info->fullname = $user->hoten;
            $order_info->phone = $user->phone;
            $order_info->note = $request->note;
            $order_address = $order->order_address()->first();
            $order_address->id_province = $user->id_tinhthanh;
            $order_address->id_district = $user->id_quanhuyen;
            $order_address->id_ward = $user->id_phuongxa;
            $order_address->address = $user->address;
        } else {
            $validation = $request->validate([
                'fullname' => 'required',
                'phone' => ['required', 'regex:/((09|03|07|08|05)+([0-9]{8})\b)|(84)\d{9}/'],
                'sel_province' => 'required',
                'sel_district' => 'required',
                'sel_ward' => 'required',
                'address' => 'required',
            ], [
                'fullname.required' => 'Họ tên không được để trống',
                'phone.required' => 'Số điện thoại đang sử dụng đã bị trùng lặp',
                'sel_province.required' => ' Vui lòng chọn tỉnh/thành phố',
                'sel_district.required' => 'Vui lòng chọn quận/huyện',
                'sel_ward.required' => 'Vui lòng chọn phường/xã',
                'address.required' => 'Địa chỉ không được để trống'
            ]);
            $order_info = $order->order_info()->first();
            $order_info->fullname = $request->fullname;
            $order_info->phone = $request->phone;
            $order_info->note = $request->note;
            $order_address = $order->order_address()->first();
            $order_address->id_province = $request->sel_province;
            $order_address->id_district = $request->sel_district;
            $order_address->id_ward = $request->sel_ward;
            $order_address->address = $request->address;
        }




        $viettelPostController = new ViettelPostController();
        $store_address = $request->input('store_address');
        $show_vat = $request->input('show_vat');
        // $payment_method = $request->input('payment_method');
        $store_ids = Session::get('store_ids');
        // $order = Order::create([
        //     'user_id' => $user_id
        // ]);
        $total_tax = 0;
        $total_shipping = 0;
        $total_c = 0;
        $total_m = 0;
        $total_vat_products = 0;
        $total_discount_products = 0;
        $total_remaining_m_point = 0;
        $sub_total = 0;
        $total = 0;
        // $order->order_code = 'CMART-' . $order->id . time();
        $count_store = 0;

        foreach (explode(",", $store_ids) as $store_id) {
            $cart = Cart::instance($store_id);
            // $order_store = OrderStore::create([
            //     'id_order' => $order->id,
            //     'id_store' => $store_id,

            // ]);
            $order_store = $order->order_stores()->where('id_store', $store_id)->first();

            $count_store++;
            $store_tax = 0;
            $store_shipping_total = 0;
            $store_shipping_method = 0;
            $store_shipping_type = 0;
            $store_shipping_weight = 0;
            $store_c = 0;
            $store_m = 0;
            $vat_products = 0;
            $vat_services = 0;
            $discount_products = 0;
            foreach ($cart->content() as $row) {
                $order_product = $order_store->order_products()->where('id_product', $row->model->id)->first();
                $price = $row->model->productPrice()->first();
                $store_tax += ($row->price * getTaxValue($price->tax)) * $row->qty;
                $store_c += $price->cpoint * $row->qty;
                $store_m += $price->mpoint * $row->qty;
                $store_shipping_method = $row->options->method_ship;
                $store_shipping_type = $row->options->type_ship;
                $store_shipping_weight += $this->getWeight($row->model, $row->qty);
                switch ($store_shipping_type) {
                    case 2:
                        $store_shipping_total += $row->options->price_fast;
                        break;
                    default:
                        $store_shipping_total += $row->options->price_normal;
                        break;
                }
            
                $vat_products += $row->price * getTaxValue($price->tax) * $row->qty;
                if (in_array(Auth::user()->level, [3, 4])) {
                    $price->cpoint = 0;
                    $price->mpoint = 0;
                }
                $order_product->update([
                    'id_order' => $order->id,
                    'id_order_store' => $order_store->id,
                    'id_product' => $row->model->id,
                    'sku' => $row->model->sku,
                    'name' => $row->name,
                    'slug' => $row->model->slug,
                    'feature_img' => $row->model->feature_img,
                    'quantity' => $row->qty,
                    'weight' => $this->getWeight($row->model, 1),
                    'price' => $row->price,
                    'discount' => 0,
                    'c_point' => $price->cpoint,
                    'm_point' => $price->mpoint
                ]);
                $order_product->save();
            }
            // OrderProduct::create([
            //     'id_order' => $order->id,
            //     'id_order_store' => $order_store->id,
            //     'id_product' => null,
            //     'sku' => null,
            //     'name' => "Hóa đơn GTGT",
            //     'slug' => null,
            //     'feature_img' => null,
            //     'quantity' => 1,
            //     'weight' => 0,
            //     'price' => 300,
            //     'discount' => 0,
            //     'c_point' => 0,
            //     'm_point' => 0,
            // ]);
            $order_store->tax = $store_tax;
            $order_store->shipping_method = $store_shipping_method;
            $order_store->shipping_weight = $store_shipping_weight;
            $order_store->shipping_type = $store_shipping_type;
            $order_store->shipping_total = $store_shipping_total;
            $order_store->remaining_m_point = max($store_m - $store_shipping_total, 0);
            if (in_array(Auth::user()->level, [3, 4])) {
                $store_c = 0;
                $store_m = 0;
            }

            $order_store->c_point = $store_c;
            $order_store->m_point = $store_m;
            $order_store->vat_products = $vat_products;
            $order_store->sub_total = intval(str_replace(",", "", $cart->subtotal())) + 300;
            $order_store->total = $order_store->sub_total + $vat_products + $vat_services;
            $time = (string)date('Y-m-d-H-i-s');
            $order_store_code = str_replace('-', '', $time) . '-' . (100 * $count_store);
            $order_store->order_store_code = $order_store_code;
            $order_store->save();
            $total_tax += $store_tax;
            $total_shipping += $store_shipping_total;
            $total_c += $store_c;
            $total_m += $store_m;
            $total_vat_products += $vat_products;
            $total_remaining_m_point += $order_store->remaining_m_point;
            $total_discount_products += $discount_products;
            $sub_total += $order_store->sub_total;
            $total += $order_store->total;
            // Cart::instance($store_id)->destroy();
        }
        $order_vat = $order->order_vat()->first();
        if ($show_vat == 1) {
            $order_vat->update([
                'id_order' => $order->id,
                'vat_company' => $request->vat_company,
                'vat_email' => $request->vat_email,
                'vat_mst' => $request->vat_mst,
                'vat_address' => $request->vat_address
            ]);
            $order_vat->save();
        }
        $order->payment_method = null;
        $order->tax = $total_tax;
        $order->shipping_total = $total_shipping;
        $order->c_point = $total_c;
        $order->m_point = $total_m;
        $order->sub_total = $sub_total;
        $order->total = $total;
        $order->vat_products = $total_vat_products;
        $order->discount_products = $total_discount_products;
        $order->save();


        // $order->order_address()->save($order_address);
        $order_address->save();
        
        $order_info->save();

        // Session::forget('store_ids');
        // Session::put('order_code', $order->order_code);
        // if($payment_method == 2){
        //     $paymentPaymeController = new PaymentPaymeController();
        //     $result = $paymentPaymeController->PaymentPayme($order);
        //     $result = json_decode($result);
        //     if( $result->code == '105000'){
        //         $this->createOrderPayme($order->id, $order->order_code, $result->data->url, $result->data->transaction);
        //         return redirect($result->data->url);
        //     }else{
        //         return redirect()->route('paymentFail');

        //     }

        // }else{

        return redirect()->route('checkout.getPaymentMethod', ['order_code' => $order->order_code]);
        // }

        // } else {
        //     return redirect()->route('cart.index');
        // }
    }

    public function getPayment(Request $request)
    {
        $user = Auth::user();
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        foreach ($order->order_stores()->get() as $order_store) {
            $vat_services = 0;
            $vat_services = $payment_method->fee * ($order_store->sub_total + $order_store->vat_products - $order_store->discount_products + max($order_store->shipping_total - $order_store->m_point, 0) * 1.08);
            $order_store->vat_services = $vat_services;
            $order_store->total = $order_store->sub_total + $vat_services + $order_store->vat_products;
            $order_store->save();
        }
        $order->total = $order->order_stores()->sum('total');
        $order->vat_services = $order->order_stores()->sum('vat_services');
        $order->payment_method = $payment_method->id;
        $order->save();
        $order_vat = $order->order_vat()->first();
        return view('checkout.payment_info', compact('order', 'user', 'order_vat'));
    }

    public function getPaymentMethod(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $user = Auth::user();
        $point_c = $user->point_c()->first();
        $payment_methods = PaymentMethod::orderBy('id', 'asc')->get();
        // $viettelPostController = new ViettelPostController();
        // foreach($order->order_stores()->get() as $order_store){
        //     if($order_store->shipping_method == 2){
        //         return $viettelPostController->createOrder($order_store);
        //     }   
        // }
        $check_shipping_method = true;
        foreach ($order->order_stores()->get() as $order_store) {
            if ($order_store->shipping_method == 2) {
                $check_shipping_method = false;
            }
        }
        return view('checkout.payment_method', compact('order', 'user', 'point_c', 'check_shipping_method', 'payment_methods'));
    }
    public function postPayment(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $user = Auth::user();
        $payment_method = PaymentMethod::whereId($order->payment_method)->first();
        switch ($payment_method->type) {
            case 1:
                switch ($payment_method->id) {
                    case 1:
                        return redirect()->route('payment.C', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    case 2:
                        return redirect()->route('payment.Deposit', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    case 3:
                        return redirect()->route('payment.Send', ['order_code' => $order->order_code, 'payment_method' => $payment_method->id]);
                        break;
                    default:
                        return redirect()->route('checkout.getPaymentMethod', ['order_code' => $order->order_code])->with(['message' => 'Hình thức thanh toán không khả dụng']);
                        break;
                }
            default:
                $this->processOrder($order);
                return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
                break;
        }
    }

    public function processOrder($order)
    {
        $viettelPostController = new ViettelPostController();
        foreach ($order->order_stores()->get() as $order_store) {
            if (($order_store->shipping_method == 0) || ($order_store->shipping_method == 1)) {
                $order_store->shipping_code = $order_store->order_store_code;
            } else {
                $result_vt = $viettelPostController->createOrder($order_store);
                $order_store->shipping_code = $result_vt['data']['ORDER_NUMBER'];
            }

            $order_store->save();
        }
        $store_ids = Session::get('store_ids');

        foreach (explode(",", $store_ids) as $store_id) {
            Cart::instance($store_id)->destroy();
        }
        Session::forget('store_ids');
        Session::forget('edit_order');

        $order->status = 1;
        $order->save();
    }

    public function getPaymentDeposit(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        return view('checkout.payment.payment_nap', compact('payment_method', 'order'));
    }
    public function postPaymentDeposit(Request $request)
    {

        $validation = $request->validate([
            'payment_option' => 'required',

        ], [
            'payment_option.required' => "Mời chọn đơn vị thanh toán",
        ]);
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $order->payment_method_option = $request->payment_option;
        $order->save();
        $this->processOrder($order);
        return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
    }
    public function getPaymentSend(Request $request)
    {

        $order = Order::whereOrderCode($request->order_code)->first();

        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $payment_method = PaymentMethod::whereId($request->payment_method)->first();
        return view('checkout.payment.payment_send', compact('payment_method', 'order'));
    }

    public function postPaymentSend(Request $request)
    {
        $validation = $request->validate([
            'payment_option' => 'required',

        ], [
            'payment_option.required' => "Mời chọn đơn vị thanh toán",
        ]);
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $order->payment_method_option = $request->payment_option;
        $order->save();
        $this->processOrder($order);
        return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
    }

    public function getInfoPaymentOption(Request $request)
    {

        $payment_method = PaymentMethod::whereId($request->method_id)->first();
        $payment_option = PaymentMethodOption::whereId($request->option_id)->first();
        if ($payment_option->qr_image != null) {
            $payment_option->qr_image = asset($payment_option->qr_image);
        }
        return $payment_option;
    }
    public function getPaymentC(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();

        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        return view('checkout.payment.payment_c', compact('order'));
    }

    public function postPaymentC(Request $request)
    {

        $user = Auth::user();
        $order = Order::whereOrderCode($request->order_code)->first();
        if ($order->status > 0) {
            return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
        }
        $image_portrait = $request->image_portrait;
        $ekycController = new EkycController();
        $result_verify =  json_decode($ekycController->postVerification($user->cmnd_image, $image_portrait));
        switch ($result_verify->verify_result) {
            case 0:
                return back()->with(['message' => 'Hệ thống không xác minh được danh tính. Vui lòng liên hệ Hotline 0899.663.883 để được hỗ trợ']);
                break;
            case 1:
                return back()->with(['message' => 'Hệ thống không xác minh được danh tính. Vui lòng liên hệ Hotline 0899.663.883 để được hỗ trợ']);
                break;
            case 2:
                $time = (string)date('Y-m-d-H-i-s');
                $transaction_code = str_replace('-', '', $time) ;
                $this->processOrder($order);
                $user_receiver = User::whereCodeCustomer('202201170001')->first();
                $lichsu_chuyen = new PointCHistory;
                $point_c = $user->point_c()->first();
                $point_c_receiver = $user_receiver->point_c()->first();
                $lichsu_chuyen->point_c_idnhan = $user_receiver->id;
                $lichsu_chuyen->point_past_nhan = $point_c_receiver->point_c;
                $lichsu_chuyen->point_present_nhan = $point_c_receiver->point_c + $order->total;
                $lichsu_chuyen->makhachhang = $user_receiver->code_customer;
                $transaction_code = $transaction_code;
                $lichsu_chuyen->note = 'Da thanh toan GD ' . $transaction_code;
                $lichsu_chuyen->magiaodich =  $transaction_code;
                $lichsu_chuyen->amount = $order->total;
                $lichsu_chuyen->type = 4;
                $lichsu_chuyen->point_c_idchuyen = $user->id;
                $lichsu_chuyen->point_past_chuyen = $point_c->point_c;
                $lichsu_chuyen->point_present_chuyen = $point_c->point_c - $order->total;
                $lichsu_chuyen->makhachhang_chuyen = $user->code_customer;
                $lichsu_chuyen->save();
                $point_c->point_c -= $order->total;
                $point_c->save();
                $point_c_receiver->point_c += $order->total;
                $point_c_receiver->save();
                return redirect()->route('checkout.orderSuccess', ['order_code' => $order->order_code]);
                break;
        }
    }


    public function showPolicy(Request $request)
    {
        $policy = InfoCompany::whereSlug($request->slug)->first();
        return $policy;
    }

    public function orderSuccess(Request $request)
    {
        $order = Order::whereOrderCode($request->order_code)->first();
        if (!$request->order_code || $order == null) {
            return redirect('/');
        }
        // $order_info = $order->order_info()->first();
        // $order_address = $order->order_address()->first();
        // $order_stores = $order->order_stores()->get();
        return view('checkout.thanhcong', compact('order'));
    }

    public function updateTypeShip(Request $request)
    {

        $cart = Cart::instance($request->storeid);

        foreach ($cart->content() as $row) {

            $options = $row->options;
            $options = $options->merge(['type_ship' => $request->type]);
            $cart->update($row->rowId, ['options' => $options]);
        }
        return $cart->content();
    }



    public function calShip(Request $request)
    {
        $data = $request->all();
        $store_ids = Session::get('store_ids');
        $store_ships = array();
        $store_ids = explode(",", $store_ids);
        if (isset($data['shipcmart'])) {
            $arr2 = $data['shipcmart'];
            $store_ids = array_diff($store_ids, $arr2);
        }
        $addressController = new AddressController();


        foreach ($store_ids as $store_id) {
            $store = Store::whereId($store_id)->first();
            $cart = Cart::instance($store_id);
            $store_ships['store' . $store_id]['products'] = $cart->content();
            $address1_province = $addressController->getProvinceDetail($store->id_province);
            $address1_district = $addressController->getDistrictDetail($store->id_province, $store->id_district);
            $address1_ward = $addressController->getWardDetail($store->id_district, $store->id_ward);

            $address2_province = $addressController->getProvinceDetail($data['province']);
            $address2_district = $addressController->getDistrictDetail($data['province'], $data['district']);
            $address2_ward = $addressController->getWardDetail($data['district'], $data['ward']);

            $address1 = $store->address . ' ' . $address1_province->PROVINCE_NAME . ' ' . $address1_district->DISTRICT_NAME . ' ' . $address1_ward->WARDS_NAME;
            $address2 = $data['address'] . ' ' . $address2_province->PROVINCE_NAME . ' ' . $address2_district->DISTRICT_NAME . ' ' . $address2_ward->WARDS_NAME;
            if ($data['province'] == $store->id_province) {
                $distance =  $this->getDistance($address1, $address2);
                $ship_arr = array(0, 0);
                $weight = 0;

                foreach ($cart->content() as $row) {
                    $price = $row->model->productPrice()->first();
                    $process_fee = $row->qty * $price->phi_xuly;
                    $ship_temp = $this->getCShip($process_fee, $this->getWeight($row->model, $row->qty), $distance);
                    $ship_arr[0] += $ship_temp[0];
                    $ship_arr[1] += $ship_temp[1];
                    $weight += $this->getWeight($row->model, $row->qty);
                    $cart->update($row->rowId, ['options' => ['method_ship' => 1, 'type_ship' => 1, 'price_normal' => $ship_temp[0], 'price_fast' => $ship_temp[1]]]);
                }
                $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
                $store_ships['store' . $store_id]['id'] = $store_id;
                $store_ships['store' . $store_id]['distance'] = $distance;
                $store_ships['store' . $store_id]['weight'] = $weight;
                $store_ships['store' . $store_id]['ship_total']['ship'] = array('value' => $ship_arr[0], 'text' => formatPrice($ship_arr[0]));
                $store_ships['store' . $store_id]['ship_total']['ship_fast'] = array('value' => $ship_arr[1], 'text' => formatPrice($ship_arr[1]));
                $store_ships['store' . $store_id]['method'] = 1;
                $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total())) + $ship_arr[0]);
                $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
            } else {
                $ship_arr = array(0, 0);
                $weight = 0;
                foreach ($cart->content() as $row) {
                    $price = $row->model->productPrice()->first();
                    $process_fee = $row->qty * $price->phi_xuly;
                    $ship_temp = $this->getVShip($process_fee, $this->getWeight($row->model, $row->qty), $data['province'], $store->province()->value('matinhthanh'));
                    $ship_arr[0] += $ship_temp[0];
                    $ship_arr[1] += $ship_temp[1];
                    $weight += $this->getWeight($row->model, $row->qty);
                    $cart->update($row->rowId, ['options' => ['method_ship' => 2, 'type_ship' => 1, 'price_normal' => $ship_temp[0], 'price_fast' => $ship_temp[1]]]);
                }
                $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
                $store_ships['store' . $store_id]['id'] = $store_id;
                $store_ships['store' . $store_id]['weight'] = $weight;
                $store_ships['store' . $store_id]['ship_total']['ship'] = array('value' => $ship_arr[0], 'text' => formatPrice($ship_arr[0]));
                $store_ships['store' . $store_id]['ship_total']['ship_fast'] = array('value' => $ship_arr[1], 'text' => formatPrice($ship_arr[1]));
                $store_ships['store' . $store_id]['method'] = 2;
                $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total())) + $ship_arr[0]);
                $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
            }
        }
        return json_encode($store_ships);
    }

    public function calCmartShip(Request $request)
    {
        $store_id = $request->storeid;
        $cart = Cart::instance($store_id);
        $ship_cost = 0;
        foreach ($cart->content() as $row) {
            $price = $row->model->productPrice()->first();
            $process_fee = $row->qty * $price->phi_xuly;
            $ship_price = $this->getCmartShip($process_fee, $this->getWeight($row->model, $row->qty));
            $ship_cost += $ship_price;
            $cart->update($row->rowId, ['options' => ['method_ship' => 0, 'type_ship' => 0, 'price_normal' => $ship_price, 'price_fast' => 0]]);
        }
        $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
        $store_ships['store' . $store_id]['ship_total'] = array('value' => $ship_cost, 'text' => formatPrice($ship_cost));
        $store_ships['store' . $store_id]['method'] = 0;
        $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total())) + $ship_cost);
        $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
        return json_encode($store_ships);
    }

    public function getCmartShip($process_fee, $weight)
    {
        $ship = 0;
        if ($weight <= 0) {
            $ship = $process_fee;
        } else {
            $ship = $process_fee + (max(0, (3500 + (1000 * ceil($weight / 500)))));
        }
        return $ship;
    }

    public function getCShip($process_fee, $weight, $distance)
    {
        $ship = 0;
        switch (true) {
            case in_array($weight, range(0, 2599)):
                $ship += 6500 + (4.01 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(2600, 3000)):
                $ship += 6500 + (3.01 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(3001, 29000)):
                $ship += 6500 + (3.64 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(29001, 49999)):
                $ship += 6500 + (3.7 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(50000, 99999)):
                $ship += 6500 + (3.45 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(100000, 199999)):
                $ship += 6500 + (2.55 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(200000, 499999)):
                $ship += 6500 + (1.62 * $weight + (1000 * round($weight / 500)));
                break;
            case in_array($weight, range(500000, 1000000)):
                $ship += 6500 + (1.11 * $weight + (1000 * round($weight / 500)));
                break;
            default:
                $ship += 6500 + (1 * $weight + (1000 * round($weight / 500)));
                break;
        }
        $ship = $process_fee +  round(max(10000, $ship));
        $distance = max(round($distance, 1), 3);
        $ship_fast = $process_fee + 6500 + (5000 * $distance) + (1 * $weight) + (1000 * round($weight / 500));
        // $ship = $process_fee + 3000 + (4 * $weight) + max(3000, (1500 * round($weight / 500)));
        // $ship_fast = $process_fee + max(20000, 3000 + (3600 * $distance) + $weight) + max(3000, (1500 * round($weight / 500)));
        return array(round($ship), round($ship_fast));
    }
    public function getProvinceArea($province_code)
    {
        $north = [18, 19, 21, 22, 23, 20, 24, 64, 31, 29, 30, 26, 25, 27, 10, 11, 12, 3, 28, 14, 1, 13, 15, 17, 16, 32, 33, 34];
        $middle = [35, 36, 37, 4, 38, 39, 40, 41, 42, 43, 44];
        switch (true) {
            case in_array($province_code, $north):
                return 0;
                break;
            case in_array($province_code, $middle):
                return 1;
                break;
            default:
                return 2;
                break;
        }
    }
    public function getVShip($process_fee, $weight, $province_customer, $province_store)
    {
        $ship = $process_fee;
        $ship_fast = $process_fee;
        //MB 10-48
        //MT 49-66

        switch (true) {
            case in_array($weight, range(0, 249)):
                if ($province_customer == $province_store) {
                    $ship +=  15278;
                    $ship_fast += 20371;
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 25926;
                        $ship_fast += 25926;
                    } else {
                        $ship +=  28704;
                        $ship_fast += 35649;
                    }
                }
                break;
            case in_array($weight, range(250, 500)):
                if ($province_customer == $province_store) {
                    $ship +=  15278;
                    $ship_fast += 20371;
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 27778;
                        $ship_fast += 27778;
                    } else {
                        $ship += 29630;
                        $ship_fast += 45371;
                    }
                }
                break;
            case in_array($weight, range(501, 29500)):
                if ($province_customer == $province_store) {
                    $ship += 15278 + (2315 * floor($weight / 500));
                    $ship_fast += 20371 + (2315 * floor($weight / 500));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 27778 + (2963 * floor($weight / 500));
                        $ship_fast += 27778 + (2963 * floor($weight / 500));
                    } else {
                        $ship +=  29630 + (4167 * floor($weight / 500));
                        $ship_fast += 45371 + (11575 * floor($weight / 500));
                    }
                }
                break;
            case in_array($weight, range(29501, 29999)):
                if ($province_customer == $province_store) {
                    $ship += 128704;
                    $ship_fast += 128704;
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 138889;
                        $ship_fast += 193519;
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 216667;
                        $ship_fast += 693519;
                    } else {
                        $ship += 164815;
                        $ship_fast += 693519;
                    }
                }
                break;
            case in_array($weight, range(30000, 99999)):
                if ($province_customer == $province_store) {
                    $ship += 128704  + (3704 * floor($weight / 30000));
                    $ship_fast += 128704   + (3704 * floor($weight / 30000));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 138889 + (3704 * floor($weight / 30000));
                        $ship_fast += 193519  + (4630 * floor($weight / 30000));
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 216667 + (6482 * floor($weight / 30000));
                        $ship_fast += 693519 + (23149 * floor($weight / 30000));
                    } else {
                        $ship += 164815 + (4630 * floor($weight / 30000));
                        $ship_fast += 693519 + (16667 * floor($weight / 30000));
                    }
                }
                break;

            case in_array($weight, range(100000, 199999)):
                if ($province_customer == $province_store) {
                    $ship += 387984  + (2593 * floor($weight / 100000));
                    $ship_fast += 387984 + (2593 * floor($weight / 30000));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 398169 + (3519 * floor($weight / 100000));
                        $ship_fast += 517619 + (3704 * floor($weight / 30000));
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 670407 + (5186 * floor($weight / 100000));
                        $ship_fast += 2313949 + (22686 * floor($weight / 30000));
                    } else {
                        $ship += 488915 + (4538 * floor($weight / 100000));
                        $ship_fast += 1860209 + (16204 * floor($weight / 30000));
                    }
                }
                break;
            case in_array($weight, range(200000, 499999)):
                if ($province_customer == $province_store) {
                    $ship += 647284  + (2130 * floor($weight / 200000));
                    $ship_fast += 647284 + (2130 * floor($weight / 30000));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 750069 + (3056 * floor($weight / 200000));
                        $ship_fast += 888019 + (3519 * floor($weight / 30000));
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 1189007 + (4630 * floor($weight / 200000));
                        $ship_fast += 4582549 + (22038 * floor($weight / 30000));
                    } else {
                        $ship += 942715  + (4167 * floor($weight / 200000));
                        $ship_fast += 3480609 + (15741 * floor($weight / 30000));
                    }
                }
                break;
            case in_array($weight, range(500000, 999999)):
                if ($province_customer == $province_store) {
                    $ship += 1286284  + (1852 * floor($weight / 500000));
                    $ship_fast += 1286284 + (1852 * floor($weight / 30000));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 1666869 + (2778 * floor($weight / 200000));
                        $ship_fast += 1943719 + (3334 * floor($weight / 30000));
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 2578007 + (4352 * floor($weight / 200000));
                        $ship_fast += 11193949 + (21297 * floor($weight / 30000));
                    } else {
                        $ship +=  2192815  + (3704 * floor($weight / 200000));
                        $ship_fast += 8202909 + (15278 * floor($weight / 30000));
                    }
                }
                break;
            default:
                if ($province_customer == $province_store) {
                    $ship += 2212284  + (1667 * floor($weight / 1000000));
                    $ship_fast += 2212284 + (1667 * floor($weight / 30000));
                } else {
                    if ($this->getProvinceArea($province_customer) == $this->getProvinceArea($province_store)) {
                        $ship += 3055869 + (2593 * floor($weight / 1000000));
                        $ship_fast += 3610719 + (3149 * floor($weight / 30000));
                    } elseif (
                        in_array($this->getProvinceArea($province_customer), [0, 2])
                        && in_array($this->getProvinceArea($province_store), [0, 2])
                    ) {
                        $ship += 4430007 + (3519 * floor($weight / 1000000));
                        $ship_fast += 21842449 + (20834 * floor($weight / 30000));
                    } else {
                        $ship +=  4368815  + (3704 * floor($weight / 1000000));
                        $ship_fast += 15841909 + (15000 * floor($weight / 30000));
                    }
                }
                break;
        }
        // switch (true) {
        //     case in_array($weight, range(0, 99)):
        //         $ship += 26637;
        //         $ship_fast += 28454;
        //         break;
        //     case in_array($weight, range(100, 249)):
        //         $ship += 28454;
        //         $ship_fast += 38000;
        //         break;
        //     case in_array($weight, range(250, 499)):
        //         $ship += 30272;
        //         $ship_fast += 47545;
        //         break;
        //     case in_array($weight, range(500, 999)):
        //         $ship += 33000;
        //         $ship_fast += 53636;
        //         break;
        //     case in_array($weight, range(1000, 1999)):
        //         $ship += 41363;
        //         $ship_fast += 67727;
        //         break;
        //     case in_array($weight, range(2000, 4999)):
        //         $ship += 27636 + (4409 * round($weight / 500));
        //         $ship_fast += 35457 + (10590 * round($weight / 500));
        //         break;
        //     case in_array($weight, range(5000, 9999)):
        //         $ship += 33370 + (3772 * round($weight / 500));
        //         $ship_fast += 35457 + (10590 * round($weight / 500));
        //         break;
        //     default:
        //         $ship += 123854 + (3318 * round($weight / 500));
        //         $ship_fast += 35457 + (10590 * round($weight / 500));
        //         break;
        // }
        return array(round($ship), round($ship_fast));
    }
    public function getWeight($product, $quantity)
    {
        $weight = round(max($product->weight / 1000, (($product->height * $product->width * $product->length) / 3000) )* 1000);
        return $weight * $quantity;
    }
    public function getDistance($address1, $address2)
    {
        // $address1 ="730/32/5 Lac Long Quan So 9 Tan Binh Ho Chi Minh";
        // $address2 ="28 Phạm Văn Chiều số 8 Gò Vấp Hồ Chí Minh";
        $checkoutControles = new CheckoutController;
        $coordinates1 = $checkoutControles->getCoordinates($address1);
        $coordinates2 = $checkoutControles->getCoordinates($address2);
        if ($coordinates1 == null || $coordinates2 == null) {
            return 0;
        }
        $url = 'https://rsapi.goong.io/Direction?origin=' . $coordinates1['lat'] . ',' . $coordinates1['lng'] . '&destination=' . $coordinates2['lat'] . ',' . $coordinates2['lng'] . '&vehicle=car&api_key=' . $checkoutControles->api_key . '';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);

        return round(($output['routes'][0]['legs'][0]['distance']['value'] / 1000), 1);
    }

    public function getCoordinates($address)
    {
        // $address = '28 Pham Van Chieu So 8 Go Vap Ho Chi Minh';
        $checkoutControles = new CheckoutController;

        $address = $checkoutControles->vn_to_str($address);

        $url = 'https://rsapi.goong.io/geocode?address=' . $address . '&api_key=' . $checkoutControles->api_key . '';
        $url = str_replace(" ", '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);
        if ($output == null) {
            return null;
        }
        return $output['results'][0]['geometry']['location'];
    }
    function vn_to_str($str)
    {

        $unicode = array(
            'a' => 'ấ|á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd' => 'đ', 'D' => 'Đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i' => 'ì|í|í|ì|ỉ|ĩ|ị',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'o' => 'ố|ồ|ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ò',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ', 'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
        );

        foreach ($unicode as $khongdau => $codau) {
            $arr = explode("|", $codau);
            $str = str_replace($arr, $khongdau, $str);
        }

        return $str;
    }

    public function createOrderPayme($order_id, $transaction_partner_id, $link_payment, $transaction_payme_id)
    {
        $order_payme = new OrderPayme;
        $order_payme->order_id = $order_id;
        $order_payme->transaction_partner_id = $transaction_partner_id;
        $order_payme->link_payment = $link_payment;
        $order_payme->transaction_payme_id = $transaction_payme_id;
        $order_payme->save();
        return $order_payme;
    }
}
