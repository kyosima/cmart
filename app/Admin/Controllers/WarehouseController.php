<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $warehouseCodes = Warehouse::select('code')->distinct()->get();
        $products = Product::all();
        $index = 1;
        $cities = DB::table('province')->get();
        return view('admin.warehouse.ton-kho', compact('warehouses', 'warehouseCodes', 'index', 'products', 'cities'));
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                // $product = Product::find($request->product);

                // if($request->product == "" || $request->product == '-1' || $product == null) {
                //     throw new \Exception('Vui lòng chọn đúng sản phẩm');
                // }

                $warehouse = Warehouse::create([
                    'code' => $request->warehouseCode,
                    'name' => $request->warehouseName,
                    'id_province' => $request->id_province,
                    'id_district' => $request->id_district,
                    'id_ward' => $request->id_ward,
                    'address' => $request->warehouseAddress,
                ]);

                // DB::table('warehouse_product')->insert([
                //     'warehouse_id' => $warehouse->id,
                //     'product_id' => $request->product,
                //     'quantity' => $request->productQuantity,
                // ]);
                return redirect()->route('warehouse.index')->with('success', 'Tạo kho hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function addProductToWarehouse(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $product = Product::find($request->product);

                if($request->product == "" || $request->product == '-1' || $product == null) {
                    throw new \Exception('Vui lòng chọn đúng sản phẩm');
                }
                
                $warehouse = Warehouse::where('code', $request->warehouseCode)
                                        ->where('name', $request->warehouseName)->first();
                if($warehouse == null) {
                    throw new \Exception('Vui lòng chọn đúng kho hàng');
                }
                DB::table('warehouse_product')->insert([
                    'warehouse_id' => $warehouse->id,
                    'product_id' => $request->product,
                    'quantity' => $request->productQuantity,
                ]);
                
                return redirect()->route('warehouse.index')->with('success', 'Tạo kho hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function getWarehouse(Request $request)
    {
        $code = $request->code;
        $names = DB::table('warehouse')->where('code', $code)->get();
        return response(['data' => $names]);
    }

    public function update(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $product = Product::find($request->product);
                if($request->product == "" || $request->product == '-1' || $product == null) {
                    return redirect()->back()->withErrors(['error' => 'Vui lòng chọn đúng sản phẩm']);
                }
                $warehouse = Warehouse::where('id', $request->id)->update([
                    'code' => $request->warehouseCode,
                    'name' => $request->warehouseName,
                    'id_province' => $request->id_province,
                    'id_district' => $request->id_district,
                    'id_ward' => $request->id_ward,
                    'address' => $request->warehouseAddress,
                ]);

                
                if($warehouse == null) {
                    return redirect()->back()->withErrors(['error' => 'Vui lòng chọn đúng kho hàng']);
                }
                
                DB::table('warehouse_product')->where('warehouse_id', $request->id)
                                                ->where('product_id', $request->product_id_old)
                                                ->update([
                                                    'warehouse_id' => $request->id,
                                                    'product_id' => $product->id,
                                                    'quantity' => $request->productQuantity,
                                                ]);

                return redirect()->route('warehouse.index')->with('success', 'Cập nhật kho hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function delete(Request $request)
    {

    }

    public function getLocation(Request $request)
    {
        $parentId = $request->parent;
        $type = $request->type;
        if($parentId && $type == 'city'){
            $location = DB::table('district')->where('matinhthanh', $parentId)->get();
            return response(['data' => $location]);
        } else {
            $location = DB::table('ward')->where('maquanhuyen', $parentId)->get();
            return response(['data' => $location]);
        }
    }

    public function modalEdit(Request $request)
    {
        $products = Product::all();
        $unit = Warehouse::where('id', $request->warehouse_id)->first();
        $warehouseCodes = Warehouse::select('code')->distinct()->get();
        $productEdit = DB::table('warehouse_product')->where('warehouse_id', $unit->id)
                                                    ->where('product_id', $request->product_id)->first();
        $warehouseNames = DB::table('warehouse')->where('code', $unit->code)->get();
        $cities = DB::table('province')->get();
        $districts = DB::table('district')->where('matinhthanh', $unit->id_province)->get();
        $wards = DB::table('ward')->where('maquanhuyen', $unit->id_district)->get();
        $returnHTML = view('admin.warehouse.formUpdate', compact('unit', 'warehouseCodes', 'warehouseNames', 'productEdit', 'cities', 'products', 'districts', 'wards'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

}