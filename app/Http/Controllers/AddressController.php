<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    //
    public function getAllProvince(){
        $url = 'https://partner.viettelpost.vn/v2/categories/listProvinceById?provinceId=';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);
        return $output['data'];
    }

    public function getDistrictByProvince(Request $request){
        $url = 'https://partner.viettelpost.vn/v2/categories/listDistrict?provinceId='.$request->province_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);
        return $output['data'];
    }

    public function getWardByDistrict(Request $request){
        $url = 'https://partner.viettelpost.vn/v2/categories/listWards?districtId='.$request->district_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $result = curl_exec($ch);
        curl_close($ch);
        $output = json_decode($result, true);
        return $output['data'];
    }

    public function getProvinceDetail($province_id){
        $arr = $this->getAllProvince();
        $results = array_filter($arr, function($detail) use($province_id) {
            return $detail['PROVINCE_ID'] == $province_id;
        });
        return  (object)array_values($results)[0];
    }

    public function getDistrictDetail($province_id, $district_id){
        $request = new Request();
        $request->province_id = $province_id;
        $request->district_id = $district_id;
        $arr = $this->getDistrictByProvince($request);
        $results = array_filter($arr, function($detail) use($request) {
            return $detail['DISTRICT_ID'] == $request->district_id;
        });
        return  (object)array_values($results)[0];
    }

    public function getWardDetail($district_id, $ward_id){
        $request = new Request();
        $request->district_id = $district_id;
        $request->ward_id = $ward_id;
        $arr = $this->getWardByDistrict($request);
        $results = array_filter($arr, function($detail) use($request) {
            return $detail['WARDS_ID'] == $request->ward_id;
        });
        return  (object)array_values($results)[0];
    }
}
