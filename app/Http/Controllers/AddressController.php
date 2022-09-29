<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    //
    public function allProvinces(Request $request){
        return Province::select('matinhthanh', 'tentinhthanh')->get();
    }
    public function districtOfProvince(Request $request){
        return optional(Province::where('matinhthanh', $request->province_id)->first(), function ($response) {
            return $response->district()->select('maquanhuyen', 'tenquanhuyen')->get();
        });
    }
    // lấy phường xã theo quận huyện
    public function wardOfDistrict(Request $request){
        return optional(District::where('maquanhuyen', $request->district_id)->first(), function ($response) {
            
            return $response->ward()->select('maphuongxa', 'tenphuongxa')->get();
        });
    }


}
