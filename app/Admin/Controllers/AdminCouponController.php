<?php

namespace App\Admin\Controllers;
use App\Admin\Traits\ajaxCustomerTrait;
use App\Admin\Traits\ajaxCouponTrait;

use App\Admin\Traits\ajaxProductTrait;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\CouponPromo;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Framework\Constraint\Count;

class AdminCouponController extends Controller
{
    use ajaxProductTrait;
    use ajaxCustomerTrait;
    use ajaxCouponTrait;
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
    public function create(){
        return view('admin.coupon.create');
    }

    public function edit(Request $request)
    {
        $id = $request->id;
        $coupon = Coupon::where('id', $id)->with('promo')->first();
        $arr = [];
        $arr_coupons = [];
        if ($coupon->connect == 2) {
            $arr_coupons = explode(',', $coupon->id_coupons);
            $arr_coupons = Coupon::whereIn('id', $arr_coupons)->get();
        }
        if ( $coupon->type == 0) {
            if($coupon->promo->target == 0){
                return view('admin.coupon.edit', compact('coupon', 'arr_coupons'));
            }else{
                $arr = explode(',', $coupon->promo->id_customers);
                $arr = User::whereIn('id', $arr)->get();
                return view('admin.coupon.edit', compact('coupon', 'arr', 'arr_coupons'));
            }
        }
        elseif ($coupon->type == 1) {
            $arr = explode(',', $coupon->promo->id_products);
            $arr = Product::whereIn('id', $arr)->get();
            return view('admin.coupon.edit', compact('coupon', 'arr','arr_coupons'));
        }
        else if ($coupon->type ==2) {
            $arr = explode(',', $coupon->promo->id_procats);
            $arr = ProductCategory::whereIn('id', $arr)->get();
            return view('admin.coupon.edit', compact('coupon', 'arr', 'arr_coupons'));
        }
     
    }

    public function store(Request $request)
    {
        $timeStart = strtotime(str_replace("/", "-", $request->start_date));
        $timeEnd = strtotime(str_replace("/", "-", $request->end_date));
        if ($timeEnd < $timeStart) {
            return back()->with('message', 'Ngày kết thúc ưu đãi phải lớn hơn hoặc bằng ngày bắt đầu');
        }
        $request->validate([
            'name' => 'required',
            'supplier' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'name.required' => 'Tên ưu đãi không được để trống',
            'supllier.required' => 'Đơn vị cung cấp không được để trống',
            'code.required|unique' => 'Mã ưu đãi không được để trống',
            'start_date.required' => 'Thời gian bắt đầu ưu đãi không được để trống',
            'end_date.required' => 'Thời gian kết thúc ưu đãi không đước để trống',
        ]);
        $coupon = new Coupon;
        $coupon_promo = new CouponPromo();
        if($request->type == 0){
            if($request->target == 0){
                $request->validate([
                    'id_levels' => 'required',

                ],[
                    'level_1.id_levels' => 'Danh sách định danh khách hàng không được để trống',
                 
                ]);
                $coupon = Coupon::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'type' => $request->type,
                    'start_date' => date('Y-m-d', $timeStart),
                    'end_date' => date('Y-m-d', $timeEnd),
                    'description' => $request->description,
                ]);
                $coupon_promo = CouponPromo::create([
                    'id_ofcoupon' => $coupon->id,
                    'is_percent' => $request->is_percent,
                ]);
                $coupon_promo->target = $request->target;
                $coupon_promo->id_levels =  implode(",", $request->id_levels);
             
            }else{
                $request->validate([
                    'id_customers' => 'required',
                ],[
                    'id_customers.required' => 'Danh sách khách hàng không được để trống',
                ]);
                $coupon = Coupon::create([
                    'name' => $request->name,
                    'code' => $request->code,
                    'type' => $request->type,
                    'start_date' => date('Y-m-d', $timeStart),
                    'end_date' => date('Y-m-d', $timeEnd),
                    'description' => $request->description,
                ]);
                $coupon_promo = CouponPromo::create([
                    'id_ofcoupon' => $coupon->id,
                    'is_percent' => $request->is_percent,
                ]);
                $coupon_promo->target = $request->target;
                $coupon_promo->id_customers = implode(",", $request->id_customers);
                $coupon_promo->value_discount = $request->value_discount;

            }
        }elseif($request->type == 1){
            $request->validate([
                'id_products' => 'required',
            ],[
                'id_products.required' => 'Danh sách sản phẩm không được để trống',
            ]);
            $coupon = Coupon::create([
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'start_date' => date('Y-m-d', $timeStart),
                'end_date' => date('Y-m-d', $timeEnd),
                'description' => $request->description,
            ]);
            $coupon_promo = CouponPromo::create([
                'id_ofcoupon' => $coupon->id,
                'is_percent' => $request->is_percent,
            ]);
            $coupon_promo->id_products = implode(",", $request->id_products);
            $coupon_promo->value_discount = $request->value_discount;

        }else{
            $request->validate([
                'id_procats' => 'required',
            ],[
                'id_procats.required' => 'Danh sách danh mục sản phẩm không được để trống',
            ]);
            $coupon = Coupon::create([
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'start_date' => date('Y-m-d', $timeStart),
                'end_date' => date('Y-m-d', $timeEnd),
                'description' => $request->description,
            ]);
            $coupon_promo = CouponPromo::create([
                'id_ofcoupon' => $coupon->id,
                'is_percent' => $request->is_percent,
            ]);
            $coupon_promo->id_procats = implode(",", $request->id_procats);
            $coupon_promo->value_discount = $request->value_discount;
        }
        $coupon->supplier = $request->supplier;
        $coupon->connect = $request->connect;
        if($request->connect == 2){
            $coupon->id_coupons = implode(",", $request->id_coupons);
        }
        $coupon->min = $request->min;
        $coupon->max = $request->max;
        $coupon_promo->value_discount = $request->value_discount;

        $coupon->save();
        $coupon_promo->save();
        return redirect()->route('coupon.edit', $coupon->id)->with('message', 'Tạo mã ưu đãi thành công');
        
    }
    public function update(Request $request)
    {
        $timeStart = strtotime(str_replace("/", "-", $request->start_date));
        $timeEnd = strtotime(str_replace("/", "-", $request->end_date));
        if ($timeEnd < $timeStart) {
            return back()->with('message', 'Ngày kết thúc ưu đãi phải lớn hơn hoặc bằng ngày bắt đầu');
        }
        $request->validate([
            'name' => 'required',
            'supplier' => 'required',
            'code' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ],[
            'name.required' => 'Tên ưu đãi không được để trống',
            'supllier.required' => 'Đơn vị cung cấp không được để trống',
            'code.required|unique' => 'Mã ưu đãi không được để trống',
            'start_date.required' => 'Thời gian bắt đầu ưu đãi không được để trống',
            'end_date.required' => 'Thời gian kết thúc ưu đãi không đước để trống',
        ]);
        $coupon = Coupon::whereId($request->id)->first();
        $coupon ->update([
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'start_date' => date('Y-m-d', $timeStart),
            'end_date' => date('Y-m-d', $timeEnd),
            'description' => $request->description,
        ]);
        $coupon_promo = $coupon->promo()->first();
        $coupon_promo->is_percent = $request->is_percent;
        if($request->type == 0){
            $coupon_promo->target = $request->target;
            if($request->target == 0){
                $request->validate([
                    'id_levels' => 'required',

                ],[
                    'level_1.id_levels' => 'Danh sách định danh khách hàng không được để trống',
                 
                ]);
                $coupon_promo->target = $request->target;
                $coupon_promo->id_levels =  implode(",", $request->id_levels);
            }else{
                $request->validate([
                    'id_customers' => 'required',
                ],[
                    'id_customers.required' => 'Danh sách khách hàng không được để trống',
                ]);
                $coupon_promo->id_customers = implode(",", $request->id_customers);
                $coupon_promo->value_discount = $request->value_discount;

            }
        }elseif($request->type == 1){
            $request->validate([
                'id_products' => 'required',
            ],[
                'id_products.required' => 'Danh sách sản phẩm không được để trống',
            ]);
            $coupon_promo->id_products = implode(",", $request->id_products);
            $coupon_promo->value_discount = $request->value_discount;

        }else{
            $request->validate([
                'id_procats' => 'required',
            ],[
                'id_procats.required' => 'Danh sách danh mục sản phẩm không được để trống',
            ]);
            $coupon_promo->id_procats = implode(",", $request->id_procats);
            $coupon_promo->value_discount = $request->value_discount;
        }
        $coupon->supplier = $request->supplier;
        $coupon->connect = $request->connect;
        if($request->connect == 2){
            $coupon->id_coupons = implode(",", $request->id_coupons);
        }
        $coupon->min = $request->min;
        $coupon->max = $request->max;
        $coupon_promo->value_discount = $request->value_discount;

        $coupon->save();
        $coupon_promo->save();
        return redirect()->back()->with('message', 'Chỉnh sửa mã ưu đãi thành công');
        
    }
    // public function update(Request $request)
    // {
    //     $timeStart = strtotime(str_replace("/", "-", $request->startTime));
    //     $timeEnd = strtotime(str_replace("/", "-", $request->endTime));

    //     if ($timeEnd < $timeStart) {
    //         return response()->json([
    //             'error' => 'Ngày kết thúc ưu đãi phải lớn hơn hoặc bằng ngày bắt đầu',
    //         ], 400);
    //     }
    //     $validator = Validator::make($request->all(), [
    //         'couponCode' => 'required|unique:coupons,code,'.$request->id,
    //         'couponName' => 'required|unique:coupons,name,'.$request->id,
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'error' => $validator->errors()->first('couponCode') . ' ' . $validator->errors()->first('couponName'),
    //         ], 400);
    //     }

    //     // END VALIDATION

    //     return DB::transaction(function () use ($request) {
    //         try {
    //             $coupon = Coupon::where('id', $request->id)->update([
    //                 'code' => $request->couponCode,
    //                 'name' => $request->couponName,
    //                 'description' => $request->couponDescription,
    //                 'type' => $request->couponType,
    //                 'start_date' => date('Y-m-d', strtotime($request->startTime)),
    //                 'end_date' => date('Y-m-d', strtotime($request->endTime)),
    //             ]);

    //             $couponPromo = CouponPromo::where('id_ofcoupon', $request->id)->update([
    //                 'value_discount' => $request->discount,
    //                 'is_percent' => $request->discountType == 'percent' ? 1 : 0,
    //                 'id_products' => $request->product_promo != null ? implode(",",$request->product_promo) : null,
    //                 'id_procats' => $request->procat_promo != null ? implode(",",$request->procat_promo) : null,
    //             ]);

    //             return redirect()->route('coupon.edit', $request->id)->with('success', 'Cập nhật voucher/coupon thành công');
                
    //         } catch (\Exception $e) {
    //             dd($e);
    //         }
    //     });
    // }
    public function delete(Request $request)
    {
        
        CouponPromo::where('id_ofcoupon', $request->id)->delete();

        $coupon = Coupon::destroy($request->id);
        if($request->ajax()){

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
        return redirect()->route('coupon.index')->with('success', 'Xóa voucher/coupon thành công');

    }

    public function multiChange(Request $request) {
        if ($request->id == null) {
            return redirect()->back();
        } 
        else {
            if ($request->action == 'delete') {
                foreach($request->id as $item) {
                    $coupon = Coupon::findOrFail($item);
                    Coupon::destroy($item);
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa coupon/voucher ' . $coupon->name;
                    Log::info($message);
                }
                return redirect(route('coupon.index'));
            }
            return redirect()->back();
        }
    }
    public function getCustomer(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetCustomer($request->search)
        ]);
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

    public function getCoupon(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetCoupon($request->search)
        ]);
    }
    public function selectCoupon()
    {
        $returnHTML = view('admin.coupon.selectCoupon')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
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

    public function selectCustomer()
    {
        $returnHTML = view('admin.coupon.selectCustomer')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }
    public function selectTarget()
    {
        $returnHTML = view('admin.coupon.selectTarget')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }
    public function inputLevel()
    {
        $returnHTML = view('admin.coupon.inputValueLevel')->render();
        return response()->json([
            'html' => $returnHTML
        ], 200);
    }
}
