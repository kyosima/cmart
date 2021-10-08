<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Province;
use App\Models\District;
use App\Models\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Order;
use App\Models\shippingConfig;
use App\Admin\Controllers\ConfigShippingController;

class ShippingController extends Controller
{
    public function test(){
        // try {
        //     return District::where('maquanhuyen', 7110)->first()->ward()
        // ->select('maphuongxa', 'tenphuongxa')->get();
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
        return optional(District::where('maquanhuyen', 7110)->first(), function ($user) {
            return $user->ward()->select('maphuongxa', 'tenphuongxa')->get();
        });
        
    }
    // lấy quận huyện theo tỉnh thành
    public function districtOfProvince(Request $request){
        return optional(Province::where('matinhthanh', $request->id)->first(), function ($response) {
            return $response->district()->select('maquanhuyen', 'tenquanhuyen')->get();
        });
    }
    // lấy phường xã theo quận huyện
    public function wardOfDistrict(Request $request){
        return optional(District::where('maquanhuyen', $request->id)->first(), function ($response) {
            return $response->ward()->select('maphuongxa', 'tenphuongxa')->get();
        });
    }

    public function postShippingFee(Request $request){

        //id_order: 0 tính phí từ khách hàng, ngược lại là của admin trong đơn hàng
        if($request->id_order == 0){
            //tổng tiền đơn hàng
            $order_total = (int)str_replace(",", "", Cart::instance('shopping')->subtotal());
            $products = Cart::instance('shopping')->content();
            //tính toán cân nặng, chiều dài, chiều rộng, chiều cao của tất cả sp trong giỏ hàng.
            $calc = $this->calculateProductShipping($products);
        }else{
            $order = Order::find($request->id_order);
            $order_total = $order->sub_total; 
            $products = $order->products()->select('height', 'weight', 'length', 'width')->get();
            $calc = $this->calculateProductShippingAdmin($products);
        }

        $shipping_fee = json_decode($this->calculateCartShipping($request->district, $request->province, $order_total, $calc)->getContent(), true);

        return view('public.template-render.calc-shipping')
            ->with('EMS', $shipping_fee['EMS'])
            ->with('BK', $shipping_fee['BK'])
            ->render(); 
    }

    // Tính phí ship tất cả sp trong giỏ hàng
    public function calculateCartShipping($district, $province, $order_total, $calc){

        $shipping_config = ShippingConfig::select('production', 'username', 'password')->first();

        $configShippingController = new ConfigShippingController;

        //lấy link môi trường.
        $get_link = $configShippingController->checkEnvironmentConfig($shipping_config->production);

        //Tính phí vận chuyển bên vnpost
        $response_shippinh_fee = $this->callApiShippingFee($district, $province, $calc, $order_total, $get_link);

        //token hết thời gian.
        if($response_shippinh_fee->status() == 401){

            //cập nhật lại token
            $configShippingController->updateTokenVnPost($shipping_config->production, $shipping_config->username, $shipping_config->password);

            //gọi lại hàm tạo đơn hàng vận chuyển
            $response_shippinh_fee = $this->callApiShippingFee($district, $province, $calc, $order_total, $get_link);
        }

        //kết quả trả về: object -> array.
        $response_shippinh_fee = json_decode($response_shippinh_fee, true);

        //lấy 2 phương thức vận chuyển: chuyển phát nhanh, chuyển phát thường.
        // unset($response_shippinh_fee[2], $response_shippinh_fee[3], $response_shippinh_fee[4], $response_shippinh_fee[5]);

        //EMS: chuyển phát nhanh, BK: chuyển phát thường
        return response(array('EMS' => $response_shippinh_fee[0]["TongCuocBaoGomDVCT"], 'BK' => $response_shippinh_fee[1]["TongCuocBaoGomDVCT"]));
    }

    //gọi api sang vnpost để tính phí
    public function callApiShippingFee($district, $province, $calc, $order_total, $get_link){

        //lấy cấu hình vận chuyển
        $shipping_config = ShippingConfig::first();

        $response_shippinh_fee = Http::withHeaders([
            'Content-Type' => 'application/json',
            'h-token' => $shipping_config->token
        ])->post($get_link.'/api/api/CustomerConnect/TinhCuocTatCaDichVu', [
            "SenderDistrictId" => "7270",
            "SenderProvinceId" => "70",
            "ReceiverDistrictId" => $district,
            "ReceiverProvinceId" => $province,
            "Weight" => $calc['weight'],
            "Width" => $calc['width'],
            "Length" => $calc['length'],
            "Height" => $calc['height'],
            "CodAmount" => $order_total,
            "IsReceiverPayFreight" => true,
            "OrderAmount" => $shipping_config->order_amount_evaluation == true ? $order->sub_total : 0,
            "UseBaoPhat" => $shipping_config->use_bao_phat,
            "UseHoaDon" => $shipping_config->use_hoa_don,
            "UseNhanTinSmsNguoiNhanTruocPhat" => $shipping_config->use_nhan_tin_sms_nguoi_nhan_truoc_phat,
            "UseNhanTinSmsNguoiNhanSauPhat" => $shipping_config->use_nhan_tin_sms_nguoi_nhan_sau_phat
        ]);
        return $response_shippinh_fee;
    }

    //Tính toán cân nặng, chiều dài, chiều rộng, chiều cao của tất cả sp trong giỏ hàng.
    public function calculateProductShipping($products){
        $weight = 0;
        $height = 0;
        $width = 0;
        $length = 0;
        foreach($products as $value){
            $product_info = $value->model;
            $weight += $product_info->weight*$value->qty;
            $height = $height < $product_info->height ? $product_info->height : $height;
            $width += $product_info->width*$value->qty;
            $length = $length < $product_info->length ? $product_info->length : $length;
        }
        return array("weight" => $weight, "height" => $height, "width" => $width, "length" => $length);
    }

    public function calculateProductShippingAdmin($products){
        $weight = 0;
        $height = 0;
        $width = 0;
        $length = 0;
        foreach($products as $value){
            $weight += $value->weight*$value->pivot->quantity;
            $height = $height < $value->height ? $value->height : $height;
            $width += $value->width*$value->pivot->quantity;
            $length = $length < $value->length ? $value->length : $length;
        }
        return array("weight" => $weight, "height" => $height, "width" => $width, "length" => $length);
    }
}
