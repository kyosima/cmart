<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Admin\Traits\ajaxGetLocation;
use App\Admin\Traits\ajaxProductTrait;
use App\Models\Admin;
use App\Models\District;
use App\Models\Product;
use App\Models\Province;
use App\Models\Store;
use App\Models\Ward;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class AdminStoreController extends Controller
{
    use ajaxGetLocation, ajaxProductTrait;

    public function index()
    {
        $cities = Province::all();
        $stores = Store::all();
        $admin = auth('admin')->user();
        return view('admin.store.index', compact('cities', 'stores', 'admin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_name' => 'required|unique:stores,name',
            'store_address' => 'required',
            'id_owner' => 'required',
            'id_province' => 'required',
            'id_district' => 'required',
            'id_ward' => 'required',
        ], [
            'store_name.required' => 'Tên cửa hàng không được để trống',
            'store_name.unique' => 'Tên cửa hàng đã bị trùng lặp, vui lòng đặt tên khác',
            'store_address.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_owner.required' => 'Chủ cửa hàng không được để trống',
            'id_province.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_district.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_ward.required' => 'Địa chỉ cửa hàng không được để trống',
        ]);


        return DB::transaction(function () use ($request) {
            try {
                $slug = Str::slug($request->store_name, '-');

                $store = Store::create([
                    'name' => $request->store_name,
                    'slug' => $slug,
                    'address' => $request->store_address,
                    'id_owner' => $request->id_owner,
                    'id_province' => $request->id_province,
                    'id_district' => $request->id_district,
                    'id_ward' => $request->id_ward,
                ]);

                $message = 'User: '. auth('admin')->user()->name . ' thực hiện tạo mới cửa hàng ' . $request->name;
                Log::info($message);

                return redirect()->route('store.index')->with('success', 'Tạo cửa hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'store_name' => 'required|unique:stores,name,'.$id,
            'store_address' => 'required',
            'id_owner' => 'required',
            'id_province' => 'required',
            'id_district' => 'required',
            'id_ward' => 'required',
        ], [
            'store_name.required' => 'Tên cửa hàng không được để trống',
            'store_name.unique' => 'Tên cửa hàng đã bị trùng lặp, vui lòng đặt tên khác',
            'store_address.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_owner.required' => 'Chủ cửa hàng không được để trống',
            'id_province.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_district.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_ward.required' => 'Địa chỉ cửa hàng không được để trống',
        ]);


        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->store_name, '-');

                Store::where('id', $id)->update([
                    'name' => $request->store_name,
                    'slug' => $slug,
                    'address' => $request->store_address,
                    'id_owner' => $request->id_owner,
                    'id_province' => $request->id_province,
                    'id_district' => $request->id_district,
                    'id_ward' => $request->id_ward,
                ]);

                $message = 'User: '. auth('admin')->user()->name . ' thực hiện chỉnh sửa cửa hàng ' . $request->name;
                Log::info($message);

                return redirect()->route('store.edit', $id)->with('success', 'Cập nhật cửa hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $cities = Province::all();
        $districts = District::where('matinhthanh', $store->id_province)->get();
        $wards = Ward::where('maquanhuyen', $store->id_district)->get();
        $products = $store->products; // lấy theo relationship

        $admin = auth('admin')->user();

        $message = 'User: '. $admin->name . ' truy cập trang chỉnh sửa cửa hàng ' . $store->name;
        Log::info($message);
        return view('admin.store.edit', compact('cities', 'store', 'districts', 'wards', 'products', 'admin'));
    }

    public function storeProduct(Request $request)
    {
        $for_user = implode(',', $request->for_user);
        $for_user .= ',';
        $product_store = DB::table('product_store')->updateOrInsert(
            ['id_ofproduct' => $request->id_ofproduct, 'id_ofstore' => $request->id_ofstore],
            ['for_user' => $for_user, 'soluong' => $request->soluong]
        );
        if ($product_store) {
            $store = Store::findOrFail($request->id_ofstore);
            $product = Product::findOrFail($request->id_ofproduct);
            $message = 'User: '. auth('admin')->user()->name . ' thực hiện thêm sản phẩm ' . $product->name . ' vào cửa hàng ' . $store->name;
            Log::info($message);
            return response('Success', 200);
        }
        return response('Errors', 404);
    }


    public function delete($id)
    {
        $store = Store::findOrFail($id);
        Store::destroy($id);
        DB::table('product_store')->where('id_ofstore', $id)->delete();

        $message = 'User: '. auth('admin')->user()->name . ' thực hiện xóa cửa hàng ' . $store->name;
        Log::info($message);
        return redirect()->route('store.index');
    }

    public function multiChange(Request $request) {
        if ($request->id == null) {
            return redirect()->back();
        } 
        else {
            if ($request->action == 'delete') {
                foreach($request->id as $item) {
                    $store = Store::findOrFail($item);
                    Store::destroy($item);
                    DB::table('product_store')->where('id_ofstore', $item)->delete();
    
                    $message = 'User: '. auth('admin')->user()->name . ' thực hiện xóa cửa hàng ' . $store->name;
                    Log::info($message);
                }
                return redirect(route('store.index'));
            }
            return redirect()->back();
        }
    }

    public function deleteProductStore($id_store, $id_product)
    {
        $store = Store::findOrFail($id_store);
        $product = Product::findOrFail($id_product);
        DB::table('product_store')->where('id_ofproduct', $id_product)
            ->where('id_ofstore', $id_store)->delete();   

        $message = 'User: '. auth('admin')->user()->name . ' thực hiện xóa sản phẩm ' . $product->name . ' khỏi cửa hàng ' . $store->name;
        Log::info($message);
        return response('', 200);
    }

    public function getLocation(Request $request) {
        return response(['data' => $this->ajaxGetLocation($request)]);
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search, $request->id)
        ]);
    }

    public function getListOwner(Request $request)
    {
        $owners = Admin::where('name', 'LIKE', '%'.$request->search.'%')->limit(25)->get();
        return response()->json([
            'code' => 200,
            'data' => $owners
        ]);
    }

    public function getListProduct(Request $request)
    {

        $store = Store::findOrFail($request->store_id);
        $product = Product::findOrFail($request->product_id);
        $returnHTML = view('admin.store.product_store', compact('store', 'product'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }
}
