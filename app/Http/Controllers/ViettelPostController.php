<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderStore;
use App\Http\Controllers\AddressController;

class ViettelPostController extends Controller
{
    //
    public function getToken()
    {
        $endPoint = 'https://partner.viettelpost.vn/v2/user/Login';
        $url = $endPoint;
        $data = [
            'USERNAME' => '0899302323',
            'PASSWORD' => 'Aldc1996',
        ];
        $ch = curl_init($url);
        $headers = array(
            "Content-Type: application/json",
        );
        //  $headers[] = "Content-Type: application/json";
        //  $headers[] = "api-key: ".$apiKey;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
        return $result['data']['token'];
    }
    public function createOrder($order_store)
    {
        $endPoint = 'https://partner.viettelpost.vn/v2/order/createOrder';
        $token = $this->getToken();
        $url = $endPoint;
        $order = $order_store->order()->first();
        $store =  $order_store->store()->first();
        $order_address = $order->order_address()->first();
        $order_info = $order->order_info()->first();
        $addressController = new AddressController();
        $address1_province = $addressController->getProvinceDetail($store->id_province);
        $address1_district = $addressController->getDistrictDetail($store->id_province, $store->id_district);
        $address1_ward = $addressController->getWardDetail($store->id_district, $store->id_ward);
        $address_store = $store->address . ' ' . $address1_province->PROVINCE_NAME . ' ' . $address1_district->DISTRICT_NAME . ' ' . $address1_ward->WARDS_NAME;

        $address2_province = $addressController->getProvinceDetail($order_address->id_province);
        $address2_district = $addressController->getDistrictDetail($order_address->id_province, $order_address->id_district);
        $address2_ward = $addressController->getWardDetail($order_address->id_district, $order_address->id_ward);
        $address2 = $order_address->address . ' ' . $address2_province->PROVINCE_NAME . ' ' . $address2_district->DISTRICT_NAME . ' ' . $address2_ward->WARDS_NAME;
        $height = 0;
        $width = 0;
        $length = 0;
        $list_items = [];
        $store = $order_store->store()->first();
        foreach ($order_store->order_products()->get() as $order_product) {
            $product = $order_product->product()->first();
            if($product == null){
                $item = [
                    "PRODUCT_NAME" =>  $order_product->name,
                    "PRODUCT_PRICE" => $order_product->price,
                    "PRODUCT_WEIGHT" => 0,
                    "PRODUCT_QUANTITY" => $order_product->quantity,
                ];
                array_push($list_items,$item);

            }else{
                $height += $product->height;
                $width += $product->width;
                $length += $product->length;
                $item = [
                    "PRODUCT_NAME" =>  $order_product->name,
                    "PRODUCT_PRICE" => $order_product->price,
                    "PRODUCT_WEIGHT" => $order_product->weight,
                    "PRODUCT_QUANTITY" => $order_product->quantity,
                ];
                array_push($list_items,$item);

            }
        }
        $data = [
            "ORDER_NUMBER" => $order_store->id,
            "GROUPADDRESS_ID" => "5818802",
            "CUS_ID" => $order->user()->value('code_customer'),
            "DELIVERY_DATE" => date("d/m/Y H:i:s"),
            "SENDER_FULLNAME" => $store->name,
            "SENDER_ADDRESS" => $address_store,
            "SENDER_PHONE" => "0967.363.789",
            "SENDER_EMAIL" => "",
            "SENDER_WARD" => $store->id_ward,
            "SENDER_DISTRICT" =>  $store->id_district,
            "SENDER_PROVINCE" =>  $store->id_province,
            "SENDER_LATITUDE" => 0,
            "SENDER_LONGITUDE" => 0,
            "RECEIVER_FULLNAME" =>  $order_info->fullname . "- Test",
            "RECEIVER_ADDRESS" => $address2,
            "RECEIVER_PHONE" => $order_info->phone,
            "RECEIVER_EMAIL" => "",
            "RECEIVER_WARD" => $order_address->id_ward,
            "RECEIVER_DISTRICT" => $order_address->id_district,
            "RECEIVER_PROVINCE" => $order_address->id_province,
            "RECEIVER_LATITUDE" => 0,
            "RECEIVER_LONGITUDE" => 0,
            "PRODUCT_NAME" => $order_store->order_products()->first()->name,
            "PRODUCT_DESCRIPTION" => $order_store->order_products()->first()->name,
            "PRODUCT_QUANTITY" => 1,
            "PRODUCT_PRICE" => $order_store->sub_total,
            "PRODUCT_WEIGHT" => $order_store->shipping_weight,
            "PRODUCT_LENGTH" => $length,
            "PRODUCT_WIDTH" => $width,
            "PRODUCT_HEIGHT" => $height,
            "PRODUCT_TYPE" => "HH",
            "ORDER_PAYMENT" => 1,
            "ORDER_SERVICE" => "VCN",
            "ORDER_SERVICE_ADD" => "",
            "ORDER_VOUCHER" => "",
            "ORDER_NOTE" => "",
            "MONEY_COLLECTION" => 0,
            "MONEY_TOTALFEE" => 0,
            "MONEY_FEECOD" => 0,
            "MONEY_FEEVAS" => 0,
            "MONEY_FEEINSURRANCE" => 0,
            "MONEY_FEE" => 0,
            "MONEY_FEEOTHER" => 0,
            "MONEY_TOTALVAT" => 0,
            "MONEY_TOTAL" => $order_store->total,
            "LIST_ITEM" => $list_items,
        ];
        $ch = curl_init($url);
        $headers = array(
            "token: " . $token,
            "Content-Type: application/json",
        );
        //  $headers[] = "Content-Type: application/json";
        //  $headers[] = "api-key: ".$apiKey;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        $result = json_decode($result, TRUE);
        curl_close($ch);
        return  $result;
    }
}
