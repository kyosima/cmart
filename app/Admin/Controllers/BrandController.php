<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
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
        $index = 0;
        return view('admin.brand.index', compact('brands', 'index'));
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
        $brand = Brand::create([
            'code' => $request->brandCode,
            'slug' => $slug,
            'type' => $request->Type == "Company" ? "Công ty" : "Đối thủ",
            'name' => $request->brandName,
            'description' => $request->brandDescription,
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

    public function update(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        $brand = Brand::where('id', $request->id)->update([
            'code' => $request->brandCode,
            'slug' => $slug,
            'type' => $request->Type == "Company" ? "Công ty" : "Đối thủ",
            'name' => $request->brandName,
            'description' => $request->brandDescription
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
        $brand = Brand::destroy($request->id);
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

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                Brand::destroy($item);
            }
            return redirect(route('thuong-hieu.index'));
        } else {
            return redirect()->back();
        }
    }
}