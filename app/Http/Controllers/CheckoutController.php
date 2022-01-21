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
use App\Models\Store;
use App\Models\OrderVat;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    //
    public function __construct()
    {
        $this->api_key = 'VuBqJVkHv1wiBSdJArMeq5rhSCC6q12e3cVeVxmc';
    }
    public function index()
    {        
        if (Auth::check()) {
            if (1 > 0) {
                if (Auth::check()) {
                    $user = Auth::user();
                } else {
                    $user = null;
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
                        $tax += ($row->price * $price->tax) * $row->qty;
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
                return redirect()->route('cart.index');
            }
        } else {
            return redirect()->route('account');
        }
    }

    public function getAddress(Request $request)
    {
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

    public function postOrder(Request $request)
    {
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
        foreach ($cart as $row) {
            $price = $row->model->productPrice()->first();
            $tax += ($row->price * $price->tax) * $row->qty;
            $c_ship += $price->cship * $row->qty;
            $v_ship += $price->viettel_ship * $row->qty;
            $m_point += $price->mpoint * $row->qty;
            $c_point += $price->cpoint * $row->qty;
            $process_fee += $price->phi_xuly * $row->qty;
        }
        switch ($request->shipping_method) {
            case 'v_ship':
                $name_method = 'Viettel Shipping';
                $shipping_total = $v_ship;
                break;
            case 'c_ship':
                $name_method = 'Cmart Shipping';
                $shipping_total = $c_ship;
                break;
        }

        if (Cart::instance('shopping')->count() > 0) {
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
            if ($store_address == 1) {
                $storeAddress = StoreAddress::create([
                    'id_user' => $user_id,
                    // 'name' => $request->name_address,
                    'fullname' => $request->fullname,
                    'phone' => $request->phone,
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
                'user_id' => $user_id,
                'shipping_method' => $name_method,
                'shipping_total' => $shipping_total,
                'c_point' => $c_point,
                'm_point' => $m_point,
                'tax' => $tax,
                'process_fee' => $process_fee,
                'sub_total' => intval(str_replace(",", "", Cart::instance('shopping')->subtotal())),
                'total' => intval(str_replace(",", "", Cart::instance('shopping')->total()) + $tax)

                // 'total' => intval(str_replace(",", "", Cart::instance('shopping')->total()) + $tax + $process_fee + $shipping_total)
            ]);
            if ($show_vat == 1) {
                $vat = OrderVat::create([
                    'id_order' => $order->id,
                    'vat_company' => $request->vat_company,
                    'vat_name' => $request->vat_name,
                    'vat_mst' => $request->vat_mst,
                    'vat_address' => $request->vat_address
                ]);
                $vat->save();
            }

            $order->order_code = 'CMART-' . $order->id . time();
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
        } else {
            return redirect()->route('cart.index');
        }
    }


    public function orderSuccess(Request $request)
    {
        if (!$request->order_code || !$order = Order::whereOrderCode($request->order_code)->first()) {
            return redirect('/');
        }

        $order_info = $order->order_info()->first();
        $order_address = $order->order_address()->first();
        $products = $order->order_products()->get();

        return view('checkout.thanhcong', ['order' => $order, 'address' => $order_address, 'order_info' => $order_info, 'products' => $products]);
        return view('checkout.thanhcong');
    }

    public function calShip(Request $request)
    {
        $data = $request->all();
        $store_ids = Session::get('store_ids');
        $store_ships = array();
        $total_ship = 0;
        $total_shipfast = 0;
        foreach (explode(",", $store_ids) as $store_id) {
            $store = Store::whereId($store_id)->first();
            $cart = Cart::instance($store_id);
            $store_ships['store' . $store_id]['products'] = $cart->content();
            $address1 = $store->address . ' ' . $store->ward()->value('tenphuongxa') . ' ' . $store->district()->value('tenquanhuyen') . ' ' . $store->province()->value('tentinhthanh');
            $address2 =  $data['address'] . ' ' . Ward::where('maphuongxa', $data['ward'])->value('tenphuongxa') . ' ' . District::where('maquanhuyen', $data['district'])->value('tenquanhuyen') . ' ' . Province::where('matinhthanh', $data['province'])->value('tentinhthanh');
            if ($data['province'] == $store->id_province) {
                $distance =  $this->getDistance($address1, $address2);
                $ship_arr = array(0, 0);
                foreach ($cart->content() as $row) {
                    $price = $row->model->productPrice()->first();
                    $process_fee = $row->qty * $price->phi_xuly;
                    $ship_temp = $this->getCShip($process_fee, $this->getWeight($row->model, $row->qty), $distance);
                    $ship_arr[0] += $ship_temp[0];
                    $ship_arr[1] += $ship_temp[1];
                }
                $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
                $store_ships['store' . $store_id]['ship_total']['ship'] = array('value' => $ship_arr[0], 'text' => formatPrice($ship_arr[0]));
                $store_ships['store' . $store_id]['ship_total']['ship_fast'] = array('value' => $ship_arr[1], 'text' => formatPrice($ship_arr[1]));
                $store_ships['store' . $store_id]['method'] = 1;
                $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total()))+$ship_arr[0]);
                $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
            }else{
                $ship_arr = array(0, 0);
                foreach ($cart->content() as $row) {
                    $price = $row->model->productPrice()->first();
                    $process_fee = $row->qty * $price->phi_xuly;
                    $ship_temp = $this->getVShip($process_fee, $this->getWeight($row->model, $row->qty));
                    $ship_arr[0] += $ship_temp[0];
                    $ship_arr[1] += $ship_temp[1];
                }
                $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
                $store_ships['store' . $store_id]['ship_total']['ship'] = array('value' => $ship_arr[0], 'text' => formatPrice($ship_arr[0]));
                $store_ships['store' . $store_id]['ship_total']['ship_fast'] = array('value' => $ship_arr[1], 'text' => formatPrice($ship_arr[1]));
                $store_ships['store' . $store_id]['method'] = 2;
                $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total()))+$ship_arr[0]);
                $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
            }
        }
        return json_encode($store_ships);
    }

    public function calCmartShip(Request $request){
        $store_id = $request->storeid;
        $cart = Cart::instance($store_id);
        $ship_cost = 0;
        foreach ($cart->content() as $row) {
            $price = $row->model->productPrice()->first();
            $process_fee = $row->qty * $price->phi_xuly;
            $ship_cost += $this->getCmartShip($process_fee, $this->getWeight($row->model, $row->qty));
         
        }
        $store_ships['store' . $store_id]['name'] = 'store' . $store_id;
        $store_ships['store' . $store_id]['ship_total']= array('value' => $ship_cost, 'text' => formatPrice($ship_cost));
        $store_ships['store' . $store_id]['method'] = 0;
        $store_ships['store' . $store_id]['total_cost']['text'] = formatPrice(intval(str_replace(",", "", $cart->total()))+$ship_cost);
        $store_ships['store' . $store_id]['total_cost']['value'] = intval(str_replace(",", "", $cart->total()));
        return json_encode($store_ships);

    }

    public function getCmartShip($process_fee, $weight)
    {
        $ship = 0;
        if ($weight <= 0) {
            $ship = $process_fee;
        } else {
            $ship = $process_fee + (max(3000, (1500 * round($weight / 500))));
        }
        return $ship;
    }

    public function getCShip($process_fee, $weight, $distance)
    {
        $ship = $process_fee + 3000 + (4 * $weight) + max(3000, (1500 * round($weight / 500)));
        $ship_fast = $process_fee + max(20000, 3000 + (3600 * $distance) + $weight) + max(3000, (1500 * round($weight / 500)));
        return array(round($ship), round($ship_fast));
    }

    public function getVShip($process_fee, $weight)
    {
        $ship = $process_fee;
        $ship_fast = $process_fee;
        switch (true) {
            case in_array($weight, range(0, 99)):
                $ship += 26637;
                $ship_fast += 28454;
                break;
            case in_array($weight, range(100, 249)):
                $ship += 28454;
                $ship_fast += 38000;
                break;
            case in_array($weight, range(250, 499)):
                $ship += 30272;
                $ship_fast += 47545;
                break;
            case in_array($weight, range(500, 999)):
                $ship += 33000;
                $ship_fast += 53636;
                break;
            case in_array($weight, range(1000, 1999)):
                $ship += 41363;
                $ship_fast += 67727;
                break;
            case in_array($weight, range(2000, 4999)):
                $ship += 27636 + (4409 * round($weight / 500));
                $ship_fast += 35457 + (10590 * round($weight / 500));
                break;
            case in_array($weight, range(5000, 9999)):
                $ship += 33370 + (3772 * round($weight / 500));
                $ship_fast += 35457 + (10590 * round($weight / 500));
                break;
            default:
                $ship += 123854 + (3318 * round($weight / 500));
                $ship_fast += 35457 + (10590 * round($weight / 500));
                break;
        }
        return array(round($ship), round($ship_fast));
    }
    public function getWeight($product, $quantity)
    {
        $weight1 = $product->weight * $quantity;
        $weight2 = ($product->height * $product->length * $product->width) / 600 * $quantity;
        return max(round($weight1), round($weight2));
    }
    public function getDistance($address1, $address2)
    {
        // $address1 ="730/32/5 Lac Long Quan So 9 Tan Binh Ho Chi Minh";
        // $address2 ="28 Phạm Văn Chiều số 8 Gò Vấp Hồ Chí Minh";
        $coordinates1 = $this->getCoordinates($address1);
        $coordinates2 = $this->getCoordinates($address2);
        $url = 'https://rsapi.goong.io/Direction?origin=' . $coordinates1['lat'] . ',' . $coordinates1['lng'] . '&destination=' . $coordinates2['lat'] . ',' . $coordinates2['lng'] . '&vehicle=car&api_key=' . $this->api_key . '';
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
        $address = $this->vn_to_str($address);

        $url = 'https://rsapi.goong.io/geocode?address=' . $address . '&api_key=' . $this->api_key . '';
        $url = str_replace(" ", '%20', $url);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);
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
}
