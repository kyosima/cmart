<?php

namespace App\Admin\Controllers;

use App\Models\Cart;
use App\Models\Ward;
use App\Models\Admin;
use App\Models\Store;
use App\Models\Country;
use App\Models\Product;
use App\Models\District;
use App\Models\Province;
use App\Models\UserLevel;
use App\Models\Warehouse;
use App\Models\StoreAdmin;
use Illuminate\Support\Str;
use App\Models\ProductStore;
use App\Models\StoreProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Admin\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Admin\Traits\ajaxGetLocation;
use App\Admin\Traits\ajaxProductTrait;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\AddressController;
use App\Admin\Controllers\AdminLogController;

class AdminStoreController extends Controller
{
    use ajaxGetLocation, ajaxProductTrait;


    public function index()
    {
        $stores = Store::with('store_address.province','store_address.district','store_address.ward','admins')->latest()->get();
        return view('admin.store.index', compact('stores'));
    }

    public function create(){
        $admins = Admin::get();
        $countries = Country::get();
        return view('admin.store.create', compact('admins','countries'));
    }

    public function store(StoreRequest $request)
    {
        $data_store = $request->only('title', 'introduce');
        $store = Store::create($data_store);
        foreach($request->admin_ids as $admin_id) {
            $store->store_admins()->create(['admin_id' => $admin_id]);
        }
        $data_address = $request->only('country_id','province_id', 'district_id', 'ward_id', 'address');
        $store_address = $store->store_address()->create($data_address);
        return redirect()->route('store.edit', $store->id)->with('success','Thêm cửa hàng thành công');
    }

    public function edit($id)
    {
        $store = Store::whereId($id)->with('store_address.province','store_address.district','store_address.ward','store_address.country','admins')->first();
        $admins = Admin::get();
        return view('admin.store.edit', compact('store', 'admins'));
    }

    public function update(StoreRequest $request)
    {
        $store = Store::whereId($request->id)->first();
        $data_store = $request->only('title', 'introduce');
        $store->update($data_store);
        foreach($request->admin_ids as $admin_id) {
            $store->store_admins()->updateOrCreate(['admin_id' => $admin_id]);
        }
        $data_address = $request->only('province_id', 'district_id', 'ward_id', 'address');
        $store_address = $store->store_address()->update($data_address);
        return back()->with('success','Sửa cửa hàng thành công');

    }

    public function show($id){
        $store = Store::whereId($id)->with('store_address.province','store_address.district','store_address.ward','store_address.country', 'store_admins.admin','store_products.product.product_type', 'store_products.storeproduct_userlevels.userlevel')->first();
        return view('admin.store.show', compact('store'));
    }

    public function addProduct($id){
        $store = Store::whereId($id)->first();
        $user_levels = UserLevel::orderBy('id', 'desc')->get();
        return view('admin.store.modal.add_product', compact('store', 'user_levels'));
    }

    public function storeProduct(Request $request)
    {
        $store = Store::whereId($request->store_id)->first();
        $check = $store->store_products()->whereProductId($request->product_id)->first();
        if($check){
            return response()->json(['status'=>'error','message'=>'Sản phẩm đã tồn tại trong cửa hàng']);
        }
        $data_store_product = $request->only('product_id', 'quantity');
        $store_product = $store->store_products()->updateOrCreate($data_store_product);
        foreach($request->userlevel_id as $val){
            $store_product->storeproduct_userlevels()->updateOrCreate(['userlevel_id'=>$val]);
        }
        $store_product = StoreProduct::whereId($store_product->id)->with('product.product_type','storeproduct_userlevels')->first();
        $html = view('admin.store.include.row_store_product', compact('store_product'))->render();
        return response()->json(['html'=>$html,'status'=>'success','message'=>'Thêm sản phẩm vào cửa hàng thành công']);
    }
    public function updateProduct($id,Request $request)
    {
        $store_product = StoreProduct::whereId($id)->first();
   
        $data_store_product = $request->only('quantity');
        $store_product->update($data_store_product);
        $store_product->storeproduct_userlevels()->whereNotIn('userlevel_id', $request->userlevel_id)->delete();
        foreach($request->userlevel_id as $val){
            $store_product->storeproduct_userlevels()->updateOrCreate(['userlevel_id'=>$val]);
        }
        $store_product = StoreProduct::whereId($store_product->id)->with('product.product_type','storeproduct_userlevels')->first();
        $html = view('admin.store.include.row_store_product', compact('store_product'))->render();
        return response()->json(['html'=>$html,'status'=>'success','message'=>'Thêm sản phẩm vào cửa hàng thành công']);
    }

    public function editProduct($id){
        $user_levels = UserLevel::orderBy('id', 'desc')->get();
        $store_product = StoreProduct::whereId($id)->with('store','product','storeproduct_userlevels')->first();
        return view('admin.store.modal.edit_product', compact('store_product','user_levels'));
    }

    public function deleteProduct($id){
        $store_product = StoreProduct::whereId($id)->first();
        $store_product->storeproduct_userlevels()->delete();
        $store_product->delete();
        return response()->json(['id'=>$store_product->id]);
    }

    public function deleteStore(Request $request)
    {
        $store = Store::findOrFail($request->store_id);
        $store->store_products()->with('storeproduct_userlevels')->delete();
        $store->store_products()->delete();
        $store->store_admins()->delete();
        $store->store_address()->delete();
        $store->delete();
        $cart = Cart::where('store_id', $store->id)->first();
        $cart->cart_item()->delete();
        $cart->delete();
        return redirect()->route('store.index');
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search)
        ]);
    }
}
