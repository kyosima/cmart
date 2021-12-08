<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponPromo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminCouponController extends Controller
{
    public function index()
    {
        // $coupons = Coupon::with('promo')->get();
        return view('admin.coupon.index');
    }

    public function indexDatatable()
    {
        $coupons = Coupon::with('promo')->get();
        if ($coupons) {
            return response()->json([
                'message' => "Success!",
                'code' => 200,
                'data' => $coupons
            ]);
        } else {
            return response()->json([
                'message' => "Error!",
                'code' => 500,
            ]);
        }
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $unit = Coupon::where('id', $id)->with('promo')->first();
        // $startDate = date('d-m-Y', strtotime($unit->start_date));
        $returnHTML = view('admin.coupon.formUpdate', compact('unit', 'id'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function store(Request $request)
    {
        $timeStart = strtotime(str_replace("/", "-", $request->startTime));
        $timeEnd = strtotime(str_replace("/", "-", $request->endTime));

        if ($timeEnd < $timeStart) {
            return response()->json([
                'error' => 'Ngày kết thúc ưu đãi phải lớn hơn hoặc bằng ngày bắt đầu',
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'couponCode' => 'required|unique:coupons,code',
            'couponName' => 'required|unique:coupons,name',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('couponCode') . ' ' . $validator->errors()->first('couponName'),
            ], 400);
        }

        // END VALIDATION

        return DB::transaction(function () use ($request) {
            try {
                $coupon = Coupon::create([
                    'code' => $request->couponCode,
                    'name' => $request->couponName,
                    'description' => $request->couponDescription,
                    'start_date' => date('Y-m-d', strtotime($request->startTime)),
                    'end_date' => date('Y-m-d', strtotime($request->endTime)),
                ]);

                $couponPromo = new CouponPromo();
                $couponPromo->id_ofcoupon = $coupon->id;
                $couponPromo->id_type = $request->couponType;
                if ($request->discountType == 'percent') {
                    $couponPromo->is_percent = 1;
                } else {
                    $couponPromo->is_percent = 0;
                }
                $couponPromo->value_discount = $request->discount;

                $coupon->promo()->save($couponPromo);
                
                return response()->json([
                    'message' => "Success",
                    'code' => 200,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => "$e",
                    'code' => 500,
                ]);
            }
        });
    }

    public function update(Request $request)
    {
        $timeStart = strtotime(str_replace("/", "-", $request->startTime));
        $timeEnd = strtotime(str_replace("/", "-", $request->endTime));

        if ($timeEnd < $timeStart) {
            return response()->json([
                'error' => 'Ngày kết thúc ưu đãi phải lớn hơn hoặc bằng ngày bắt đầu',
            ], 400);
        }
        $validator = Validator::make($request->all(), [
            'couponCode' => 'required|unique:coupons,code,'.$request->id,
            'couponName' => 'required|unique:coupons,name,'.$request->id,
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first('couponCode') . ' ' . $validator->errors()->first('couponName'),
            ], 400);
        }

        // END VALIDATION

        return DB::transaction(function () use ($request) {
            try {
                $coupon = Coupon::where('id', $request->id)->update([
                    'code' => $request->couponCode,
                    'name' => $request->couponName,
                    'description' => $request->couponDescription,
                    'start_date' => date('Y-m-d', strtotime($request->startTime)),
                    'end_date' => date('Y-m-d', strtotime($request->endTime)),
                ]);

                $couponPromo = CouponPromo::where('id_ofcoupon', $request->id)->update([
                    'id_type' => $request->couponType,
                    'value_discount' => $request->discount,
                    'is_percent' => $request->discountType == 'percent' ? 1 : 0,
                ]);

                return response()->json([
                    'message' => "Success",
                    'code' => 200,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => "$e",
                    'code' => 500,
                ]);
            }
        });
    }
    public function delete(Request $request)
    {
        CouponPromo::where('id_ofcoupon', $request->id)->delete();
        $coupon = Coupon::destroy($request->id);
        if($coupon){
            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                CouponPromo::where('id_ofcoupon', $item)->delete();
                Coupon::destroy($item);
            }
            return redirect(route('coupon.index'));
        } else {
            return redirect()->back();
        }
    }
}
