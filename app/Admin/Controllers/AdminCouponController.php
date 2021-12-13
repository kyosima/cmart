<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\ajaxProductTrait;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponPromo;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminCouponController extends Controller
{
    use ajaxProductTrait;
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

    public function edit(Request $request)
    {
        $id = $request->id;
        $unit = Coupon::where('id', $id)->with('promo')->first();
        $arr = [];
        if ($unit->promo->id_products != null) {
            $arr = explode(',', $unit->promo->id_products);
            $arr = Product::whereIn('id', $arr)->get();
        }
        else if ($unit->promo->id_procats != null) {
            $arr = explode(',', $unit->promo->id_procats);
            $arr = ProductCategory::whereIn('id', $arr)->get();
        }
        return view('admin.coupon.edit', compact('id', 'unit', 'arr'));
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
                    'type' => $request->couponType,
                    'start_date' => date('Y-m-d', strtotime($request->startTime)),
                    'end_date' => date('Y-m-d', strtotime($request->endTime)),
                ]);

                $couponPromo = new CouponPromo();
                $couponPromo->id_ofcoupon = $coupon->id;
                if ($request->discountType == 'percent') {
                    $couponPromo->is_percent = 1;
                } else {
                    $couponPromo->is_percent = 0;
                }
                $couponPromo->value_discount = $request->discount;

                if($request->product_promo) {
                    $couponPromo->id_products = implode(",",$request->product_promo);
                }
                if($request->procat_promo) {
                    $couponPromo->id_procats = implode(",",$request->procat_promo);
                }

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
                    'type' => $request->couponType,
                    'start_date' => date('Y-m-d', strtotime($request->startTime)),
                    'end_date' => date('Y-m-d', strtotime($request->endTime)),
                ]);

                $couponPromo = CouponPromo::where('id_ofcoupon', $request->id)->update([
                    'value_discount' => $request->discount,
                    'is_percent' => $request->discountType == 'percent' ? 1 : 0,
                    'id_products' => $request->product_promo != null ? implode(",",$request->product_promo) : null,
                    'id_procats' => $request->procat_promo != null ? implode(",",$request->procat_promo) : null,
                ]);

                return redirect()->route('coupon.edit', $request->id)->with('success', 'Cập nhật voucher/coupon thành công');
                
            } catch (\Exception $e) {
                dd($e);
            }
        });
    }
    public function delete(Request $request, $id = null, $form = null)
    {
        if ($id != null && $form != null) {
            CouponPromo::where('id_ofcoupon', $id)->delete();
            Coupon::destroy($id);
            return redirect()->route('coupon.index')->with('success', 'Xóa voucher/coupon thành công');
        }
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

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search)
        ]);
    }

    public function getProCat(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProCat($request->search)
        ]);
    }

    public function selectProduct()
    {
        $returnHTML = view('admin.coupon.selectProduct')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function selectProCat()
    {
        $returnHTML = view('admin.coupon.selectProCat')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }
}
