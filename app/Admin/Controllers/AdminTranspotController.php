<?php

namespace App\Admin\Controllers;

use App\Models\Province;
use App\Models\UserLevel;
use Illuminate\Http\Request;
use App\Models\TranspotService;
use App\Models\TranspotVariation;
use App\Models\TranspotPriceDetail;
use App\Http\Controllers\Controller;
use App\Admin\Traits\getListProvinceTrait;

class AdminTranspotController extends Controller
{
    //
    use getListProvinceTrait;
    public function indexCmartTranspot(){
        $transpot_service = TranspotService::whereType(1)->with('transpot_prices_details.user_level')->first();
        $transpot_normal_price_details = $transpot_service->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 1;
        });
        $transpot_fast_price_details = $transpot_service->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 2;
        });
        return view('admin.transpot.cmart.index', compact('transpot_service', 'transpot_normal_price_details','transpot_fast_price_details'));
    }

    public function editCmartTranspot($id){
        $transpot_price_detail = TranspotPriceDetail::with('user_level')->find($id);
        return view('admin.transpot.cmart.edit' ,compact('transpot_price_detail'));
    }

    public function updateCmartTranspot($id, Request $request){
        TranspotPriceDetail::whereId($id)->update($request->except('id','_token', '_method'));
        return back()->with('success', 'Cập nhật thành công');
    }

    public function indexProvinceTranspot(){
        $transpot_service = TranspotService::whereType(2)->with('transpot_prices_details.user_level')->first();
        $transpot_normal_price_details = $transpot_service->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 1;
        });
        $transpot_fast_price_details = $transpot_service->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 2;
        });
        return view('admin.transpot.province.index', compact('transpot_service','transpot_normal_price_details','transpot_fast_price_details'));
    }

    public function editProvinceTranspot($id){
        $transpot_price_detail = TranspotPriceDetail::with('user_level')->find($id);
        return view('admin.transpot.province.edit' ,compact('transpot_price_detail'));
    }

    public function updateProvinceTranspot($id, Request $request){
        TranspotPriceDetail::whereId($id)->update($request->except('id','_token', '_method'));
        return back()->with('success', 'Cập nhật thành công');
    }

    public function indexCrossProvinceTranspot(){
        $transpot_service = TranspotService::whereType(3)->first();
        $provinces = Province::select('matinhthanh', 'tentinhthanh')->with('transpot_variations.province_to')->orderBy('matinhthanh', 'asc')->get();
        return view('admin.transpot.cross_province.index' ,compact('transpot_service', 'provinces'));
    }

    public function getListProvince(Request $request){
        $province_id = $request->province_id;
        $province = Province::select('matinhthanh', 'tentinhthanh')->where('matinhthanh',$province_id)->with('transpot_variations')->first();
        $provinces =  $this->getListProvincebyId($province_id, $province);
        return response()->json(['province' => $province, 'provinces' => $provinces]);
    }

    public function getListVariations($province_id){
        $province = Province::select('matinhthanh', 'tentinhthanh')->where('matinhthanh',$province_id)->with('transpot_variations.province_to', 'transpot_variations.province_from')->first();
        return view('admin.transpot.cross_province.variation.list_variations', compact('province'))->render();
    }
    
    public function storeTranspotTo(Request $request){
        $transpot_service = TranspotService::whereType(3)->first();
        if(TranspotVariation::where('province_id', $request->province_id)->where('transpot_to', $request->transpot_to)->first()){
            return  response()->json(['status'=>'error', 'message'=> 'Điểm đến đã tồn tại']);
        }
        $transpot_variation = $transpot_service->transpot_variations()->create($request->only('province_id', 'transpot_to'));
        $province_to = $transpot_variation->province_to()->first();
        $user_levels = UserLevel::orderBy('id', 'asc')->get();
        for($i = 1; $i < 3; $i++){
            foreach($user_levels as $level){
                $transpot_variation->transpot_prices_details()->create([
                    'transpot_service_id' => $transpot_service->id,
                    'user_level_id' => $level->id,
                    'type' => $i,
                    'limit_weight_min' => 0,
                    'limit_weight_max' => 0,
                    'fee_min' => 0,
                    'fee_default' => 0,
                    'fee_package' => 0,
                    'fee_distance' => 0,
                    'fee_weight' => 0,
                ]);
            }
        }
        $html = $this->getListVariations($transpot_variation->province_id);
        return response()->json(['transpot_variation' =>$transpot_variation, 'province_to'=>$province_to, 'html'=>$html]);
    }

    public function showCrossProvinceVariation(Request $request){
        $transpot_variation = TranspotVariation::whereId($request->id)->with('transpot_prices_details.user_level', 'province_from', 'province_to')->first();
        $transpot_normal_price_details = $transpot_variation->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 1;
        });
        $transpot_fast_price_details = $transpot_variation->transpot_prices_details->filter(function($price_detail, $key){
            return $price_detail->type == 2;
        });
        return view('admin.transpot.cross_province.variation.index' ,compact('transpot_variation', 'transpot_normal_price_details', 'transpot_fast_price_details'));
    }

    public function editCrossProvinceVariationPrice($id,Request $request){
        $transpot_price_detail = TranspotPriceDetail::with('user_level','transpot_variation.province_from', 'transpot_variation.province_to')->find($id);
        return view('admin.transpot.cross_province.variation.edit' ,compact('transpot_price_detail'));
    }

    public function updateCrossProvinceVariationPrice($id,Request $request){
        TranspotPriceDetail::whereId($id)->update($request->except('id','_token', '_method'));
        return back()->with('success', 'Cập nhật thành công');
    }

    public function storeVariationCrossProvinceTranspot(Request $request){
        $transpot_service = TranspotService::whereType(3)->with('transpot_prices_details.user_level')->first();
        return $request->all();
    }
}
