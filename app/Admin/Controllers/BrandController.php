<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang quản lý thương hiệu';
        Log::info($message);
        return view('admin.brand.index', compact('brands'));
    }

    public function indexDatatable()
    {
        $brands = Brand::all();
        if($brands) {
            return response()->json([
                'message' => "Success!",
                'code' => 200,
                'data' => $brands
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
        $unit = Brand::where('id', $id)->first();
        $returnHTML = view('admin.brand.formUpdate', compact('unit', 'id'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }


    public function store(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:product_brand,code',
            'slug' => 'required|unique:product_brand,slug',
            'name' => 'required|unique:product_brand,name',
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first('code') .' '. $validator->errors()->first('slug') .' '. $validator->errors()->first('name'),
            ], 400);
        }

        $brand = Brand::create([
            'code' => $request->brandCode,
            'slug' => $slug,
            'name' => $request->brandName,
            'description' => $request->brandDescription,
        ]);

        if($brand){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới thương hiệu ' . $brand->name;
            Log::info($message);

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

    public function update(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        $validator = Validator::make($request->all(), [
            'couponCode' => 'required|unique:coupons,code,'.$request->id,
            'couponName' => 'required|unique:coupons,name,'.$request->id,
        ]);
        
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()->first('couponCode') .' '. $validator->errors()->first('couponName'),
            ], 400);
        }

        $brand = Brand::where('id', $request->id)->update([
            'code' => $request->brandCode,
            'slug' => $slug,
            'type' => $request->Type == "Company" ? "Công ty" : "Đối thủ",
            'name' => $request->brandName,
            'description' => $request->brandDescription
        ]);

        if($brand){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật thương hiệu ' . $request->brandName;
            Log::info($message);

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

    public function updateStatus(Request $request)
    {
        $brand = Brand::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        if($brand){
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

    public function destroy(Request $request)
    {
        $b = Brand::findOrFail($request->id);
        $brand = Brand::destroy($request->id);
        if($brand){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa thương hiệu ' . $b->name;
            Log::info($message);

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
                $b = Brand::findOrFail($item);
                Brand::destroy($item);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa thương hiệu ' . $b->name;
                Log::info($message);
            }
            return redirect(route('thuong-hieu.index'));
        } else {
            return redirect()->back();
        }
    }
}