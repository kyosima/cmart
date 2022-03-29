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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\AddressController;
use App\Admin\Controllers\AdminLogController; 


class AdminStoreController extends Controller
{
    use ajaxGetLocation, ajaxProductTrait;
    public $logController;

    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
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
            'sel_province' => 'required',
            'sel_district' => 'required',
            'sel_ward' => 'required',
        ], [
            'store_name.required' => 'Tên cửa hàng không được để trống',
            'store_name.unique' => 'Tên cửa hàng đã bị trùng lặp, vui lòng đặt tên khác',
            'store_address.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_owner.required' => 'Chủ cửa hàng không được để trống',
            'sel_province.required' => 'Địa chỉ cửa hàng không được để trống',
            'sel_district.required' => 'Địa chỉ cửa hàng không được để trống',
            'sel_ward.required' => 'Địa chỉ cửa hàng không được để trống',
        ]);

        return DB::transaction(function () use ($request) {
            try {
                $slug = Str::slug($request->store_name, '-');

                $store = Store::create([
                    'name' => $request->store_name,
                    'slug' => $slug,
                    'address' => $request->store_address,
                    'id_owner' => implode(',',$request->id_owner),
                    'id_province' => $request->sel_province,
                    'id_district' => $request->sel_district,
                    'id_ward' => $request->sel_ward,
                ]);

                $admin = auth('admin')->user();

                $this->logController->createLog($admin, 'Cửa hàng', 'Tạo', 'cửa hàng '.$store->name, route('store.edit',['slug'=>$store->slug,'id'=>$store->id] ));

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
            'sel_province' => 'required',
            'sel_district' => 'required',
            'sel_ward' => 'required',
        ], [
            'store_name.required' => 'Tên cửa hàng không được để trống',
            'store_name.unique' => 'Tên cửa hàng đã bị trùng lặp, vui lòng đặt tên khác',
            'store_address.required' => 'Địa chỉ cửa hàng không được để trống',
            'id_owner.required' => 'Chủ cửa hàng không được để trống',
            'sel_province.required' => 'Địa chỉ cửa hàng không được để trống',
            'sel_district.required' => 'Địa chỉ cửa hàng không được để trống',
            'sel_ward.required' => 'Địa chỉ cửa hàng không được để trống',
        ]);


        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->store_name, '-');

                Store::where('id', $id)->update([
                    'name' => $request->store_name,
                    'slug' => $slug,
                    'address' => $request->store_address,
                    'id_owner' => implode(',',$request->id_owner),
                    'id_province' => $request->sel_province,
                    'id_district' => $request->sel_district,
                    'id_ward' => $request->sel_ward,
                ]);

                $store = Store::where('id', $id)->first();
                $admin = auth('admin')->user();

                $this->logController->createLog($admin, 'Cửa hàng', 'Sửa', 'cửa hàng '.$store->name, route('store.edit',['slug'=>$store->slug,'id'=>$store->id] ));


                return redirect()->route('store.edit', ['slug' => $slug, 'id' => $id])->with('success', 'Cập nhật cửa hàng thành công');
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors(['error' => 'Đã có lỗi xảy ra vui lòng thử lại']);
            }
        });
    }

    public function edit(Request $request,$slug, $id)
    {
        $store = Store::where('slug', $slug)->where('id', $id)->firstorfail();
        $products = $store->products; // lấy theo relationship
        $addressController = new AddressController();

        $admin = auth('admin')->user();
        $store_province = $addressController->getProvinceDetail($store->id_province);
        $store_district = $addressController->getDistrictDetail($store->id_province,$store->id_district);
        $store_ward = $addressController->getWardDetail($store->id_district,$store->id_ward);
        $message = 'User: '. $admin->name . ' truy cập trang chỉnh sửa cửa hàng ' . $store->name;
        if ($request->has('time_start') && $request->has('time_end') ) {
            $time_start = $request->time_start;
            $time_end = $request->time_end;
            $order_stores_confirm = $store->order_stores()->whereStatus(0)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();
            $order_stores_payment = $store->order_stores()->whereStatus(1)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();
            $order_stores_process = $store->order_stores()->whereStatus(2)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();
            $order_stores_ship = $store->order_stores()->whereStatus(3)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();
            $order_stores_success = $store->order_stores()->whereStatus(4)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();
            $order_stores_cancel = $store->order_stores()->whereStatus(5)->where('created_at', '>=', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<=', date('Y-m-d H:i:s', strtotime($time_end)))->get();

        }else{
            $time_start = null;
            $time_end = null;
            $order_stores_confirm = $store->order_stores()->whereStatus(0)->get();
            $order_stores_payment = $store->order_stores()->whereStatus(1)->get();
            $order_stores_process = $store->order_stores()->whereStatus(2)->get();
            $order_stores_ship = $store->order_stores()->whereStatus(3)->get();
            $order_stores_success = $store->order_stores()->whereStatus(4)->get();
            $order_stores_cancel = $store->order_stores()->whereStatus(5)->get();

        }
         
        Log::info($message);
        return view('admin.store.edit', compact('time_start', 'time_end','order_stores_cancel','order_stores_success','order_stores_ship','order_stores_process','order_stores_payment','order_stores_confirm', 'store',  'products', 'admin', 'store_province', 'store_district', 'store_ward'));
    }

    public function storeProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'min:0|required',
            'for_user' => 'required',
        ],
        [
            'quantity.min:0'=>'Số lượng tồn kho lớn hơn 0'
        ]);
    
        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors(),
            ], 400);
        }

        $for_user = implode(',', $request->for_user);
        $for_user .= ',';
        DB::table('product_store')->updateOrInsert(
            ['id_ofproduct' => $request->id_ofproduct, 'id_ofstore' => $request->id_ofstore],
            ['for_user' => $for_user, 'soluong' => $request->quantity]
        );

        $store = Store::findOrFail($request->id_ofstore);
        $product = Product::findOrFail($request->id_ofproduct);
        $admin = auth('admin')->user();

        $this->logController->createLog($admin, 'Cửa hàng', 'Thêm/Sửa', 'sản phẩm '. $product->name .' vào cửa hàng '.$store->name, route('store.edit',['slug'=>$store->slug,'id'=>$store->id] ));

        return response()->json([$product->name] ,200);
    }


    public function delete($id)
    {
        $store = Store::findOrFail($id);
        Store::destroy($id);
        DB::table('product_store')->where('id_ofstore', $id)->delete();

        $admin = auth('admin')->user();

        $this->logController->createLog($admin, 'Cửa hàng', 'Xóa', 'cửa hàng '.$store->name );

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

        $admin = auth('admin')->user();

        $this->logController->createLog($admin, 'Cửa hàng', 'Xóa', 'sản phẩm '. $product->name .' khỏi cửa hàng '.$store->name, route('store.edit',['slug'=>$store->slug,'id'=>$store->id] ));

        return response()->json([$product->name] ,200);
    }

    public function getLocation(Request $request) {
        return response(['data' => $this->ajaxGetLocation($request)]);
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search)
        ]);
    }

    public function getListOwner(Request $request)
    {
        $owners = Admin::where('name', 'LIKE', '%'.$request->search.'%')->orWhere('email', 'LIKE', '%'.$request->search.'%' )->limit(25)->get();
        return response()->json([
            'code' => 200,
            'data' => $owners
        ]);
    }

    public function getListProduct(Request $request)
    {
        $store = Store::findOrFail($request->store_id);
        $product = Product::findOrFail($request->product_id);
        $admin = auth('admin')->user();

        $returnHTML = view('admin.store.product_store', compact('store', 'product','admin'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function getStatistical(Request $request, $id){
      

    }
}
