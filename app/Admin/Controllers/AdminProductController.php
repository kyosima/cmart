<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\ajaxProductTrait;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CalculationUnit;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\PaymentMethod;
use DataTables;
use App\Admin\Controllers\AdminLogController; 

class AdminProductController extends Controller
{
    use ajaxProductTrait;
    public $logController;

    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function index()
    {
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập xem trang sản phẩm';
        Log::info($message);
        $products = Product::select(['id', 'slug', 'name', 'sku', 'feature_img', 'weight','height','width', 'length', 'status'])
                    ->orderBy('name', 'desc')->get();
        return view('admin.product.san-pham', compact('products'));
    }

    public function create()
    {
        $nganhHang = ProductCategory::where('category_parent', 0)
                                ->with('childrenCategories')
                                ->get();
        $products = Product::all();
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();
        $payments = PaymentMethod::all();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang tạo mới sản phẩm';
        Log::info($message);

        return view('admin.product.tao-san-pham', compact('nganhHang', 'calculationUnits', 'brands', 'payments', 'products'));
    }

    public function store(Request $request)
    {
        if($request->is_ecard == 1){
            $request->validate([
                'product_sku' => 'required|unique:products,sku',
                'product_name' => 'required|unique:products,name',
                'slug' => 'unique:products,slug',
                'feature_img' => 'required',
                'category_parent' => 'required',
                'product_brand' => 'required',
                'payments' => 'required',
                'product_status' => 'required',
                'cpoint' => 'nullable|numeric',
                'mpoint' => 'nullable|numeric',
                'phi_xuly' => 'nullable|numeric',
                'tax' => 'required',
            ], [
                'product_sku.required' => 'SKU không được để trống',
                'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
                'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
                'feature_img' => 'Ảnh đại diện không được để trống',
                'category_parent' => 'Danh mục sản phẩm không được để trống',
                'product_brand' => 'Thương hiệu không được để trống',
                'payments' => 'Hình thức thanh toán không được để trống',
                'product_status' => 'Trạng thái không được để trống',
                'cpoint' => 'CPoint phải là số',
                'mpoint' => 'MPoint phải là số',
                'phi_xuly.numeric' => 'Phí xử lý phải là số',
                'tax' => 'Thuế không được để trống',
            ]);
        }else{
            $request->validate([
                'product_sku' => 'required|unique:products,sku',
                'product_name' => 'required|unique:products,name',
                'slug' => 'unique:products,slug',
                'feature_img' => 'required',
                'category_parent' => 'required',
                'product_brand' => 'required',
                'payments' => 'required',
                'product_status' => 'required',
                'product_price' => 'required|numeric',
                'product_regular_price' => 'required|numeric',
                'product_wholesale_price' => 'required|numeric',
                'product_shock_price' => 'required|numeric',
                'cpoint' => 'nullable|numeric',
                'mpoint' => 'nullable|numeric',
                'phi_xuly' => 'nullable|numeric',
                'tax' => 'required',
            ], [
                'product_sku.required' => 'SKU không được để trống',
                'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
                'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
                'feature_img' => 'Ảnh đại diện không được để trống',
                'category_parent' => 'Danh mục sản phẩm không được để trống',
                'product_brand' => 'Thương hiệu không được để trống',
                'payments' => 'Hình thức thanh toán không được để trống',
                'product_status' => 'Trạng thái không được để trống',
                'cpoint' => 'CPoint phải là số',
                'mpoint' => 'MPoint phải là số',
                'product_price.required' => 'Giá nhập không được để trống',
                'product_regular_price.required' => 'Giá bán lẻ không được để trống',
                'product_wholesale_price.required' => 'Giá bán buôn không được để trống',
                'product_shock_price.required' => 'Giá shock không được để trống',
                'product_price.numeric' => 'Giá nhập phải là số',
                'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
                'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
                'product_shock_price.numeric' => 'Giá shock phải là số',
                'phi_xuly.numeric' => 'Phí xử lý phải là số',
                'tax' => 'Thuế không được để trống',
            ]);
        }
        

        return DB::transaction(function () use ($request) {
            try {
                $slug = Str::slug($request->product_name, '-');

                $product = Product::create([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->category_parent,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => strtoupper($request->product_brand),
                    'upsell' => isset($request->upsell) != false ? implode(',',$request->upsell) : null,
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
                    'long_desc' => $request->description,
                    'is_ecard' => $request->is_ecard,
                    'meta_desc' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                ]);

                $productPrice = new ProductPrice();
                $productPrice->price = $request->product_price;
                $productPrice->regular_price = $request->product_regular_price;
                $productPrice->wholesale_price = $request->product_wholesale_price;
                $productPrice->shock_price = $request->product_shock_price;
                $productPrice->cpoint = $request->cpoint;
                $productPrice->mpoint = $request->mpoint;
                $productPrice->phi_xuly = $request->phi_xuly;
                $productPrice->tax = $request->tax;

                $product->productPrice()->save($productPrice);

                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới sản phẩm ' . $product->name;
                Log::info($message);
                $admin = auth('admin')->user();

                $this->logController->createLog($admin, 'Sản phẩm', 'Tạo', 'sản phẩm '.$product->name, route('san-pham.edit',$product->id ));


                return redirect()->route('san-pham.edit', $product->id)->with('success', 'Cập nhật sản phẩm thành công');
            } catch (\Throwable $th) {
                throw new \Exception('Đã có lỗi xảy ra vui lòng thử lại');
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        });
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $products = Product::all();
        $nganhHang = ProductCategory::where('category_parent', 0)
                                ->with('childrenCategories')
                                ->get();
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();
        $payments = PaymentMethod::all();

        $upsells = [];
        if ($product->upsell != null) {
            $upsells = explode(',', $product->upsell);
            $upsells = Product::whereIn('id', $upsells)->get();
        }
        $message = 'User: '. auth()->guard('admin')->user()->name . ' truy cập trang cập nhật sản phẩm';
        Log::info($message);

        return view('admin.product.cap-nhat-san-pham', compact('product', 'products', 'nganhHang', 'calculationUnits', 'brands', 'payments', 'upsells'));
    }

    public function update(Request $request, $id)
    {
        if($request->is_ecard == 1){
            $request->validate([
                'product_sku' => 'required|unique:products,sku,'.$id,
                'product_name' => 'required|unique:products,name,'.$id,
                'slug' => 'unique:products,slug',
                'feature_img' => 'required',
                'category_parent' => 'required',
                'product_brand' => 'required',
                'payments' => 'required',
                'product_status' => 'required',
                'cpoint' => 'nullable|numeric',
                'mpoint' => 'nullable|numeric',
                'phi_xuly' => 'nullable|numeric',
                'tax' => 'required',
            ], [
                'product_sku.required' => 'SKU không được để trống',
                'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
                'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
                'feature_img' => 'Ảnh đại diện không được để trống',
                'category_parent' => 'Danh mục sản phẩm không được để trống',
                'product_brand' => 'Thương hiệu không được để trống',
                'payments' => 'Hình thức thanh toán không được để trống',
                'product_status' => 'Trạng thái không được để trống',
                'cpoint' => 'CPoint phải là số',
                'mpoint' => 'MPoint phải là số',
                'phi_xuly.numeric' => 'Phí xử lý phải là số',
                'tax' => 'Thuế không được để trống',
            ]);
        }else{
            $request->validate([
                'product_sku' => 'required|unique:products,sku,'.$id,
                'product_name' => 'required|unique:products,name,'.$id,
                'slug' => 'unique:products,slug',
                'feature_img' => 'required',
                'category_parent' => 'required',
                'product_brand' => 'required',
                'payments' => 'required',
                'product_status' => 'required',
                'product_price' => 'required|numeric',
                'product_regular_price' => 'required|numeric',
                'product_wholesale_price' => 'required|numeric',
                'product_shock_price' => 'required|numeric',
                'cpoint' => 'nullable|numeric',
                'mpoint' => 'nullable|numeric',
                'phi_xuly' => 'nullable|numeric',
                'tax' => 'required',
            ], [
                'product_sku.required' => 'SKU không được để trống',
                'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
                'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
                'feature_img' => 'Ảnh đại diện không được để trống',
                'category_parent' => 'Danh mục sản phẩm không được để trống',
                'product_brand' => 'Thương hiệu không được để trống',
                'payments' => 'Hình thức thanh toán không được để trống',
                'product_status' => 'Trạng thái không được để trống',
                'cpoint' => 'CPoint phải là số',
                'mpoint' => 'MPoint phải là số',
                'product_price.required' => 'Giá nhập không được để trống',
                'product_regular_price.required' => 'Giá bán lẻ không được để trống',
                'product_wholesale_price.required' => 'Giá bán buôn không được để trống',
                'product_shock_price.required' => 'Giá shock không được để trống',
                'product_price.numeric' => 'Giá nhập phải là số',
                'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
                'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
                'product_shock_price.numeric' => 'Giá shock phải là số',
                'phi_xuly.numeric' => 'Phí xử lý phải là số',
                'tax' => 'Thuế không được để trống',
            ]);
        }
        if($request->is_ecard == null){
            $request->is_ecard = 0;
        }
        

        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->product_name, '-');

                if(str_starts_with($request->gallery_img, ', ')){
                    $request->gallery_img = substr_replace($request->gallery_img,'',0,2);
                }
                $product = Product::where('id', $id)->first();
                $message = '';
                if($product->sku != $request->product_sku){
                    $message .= 'mã sản phẩm: '.$product->sku.' -> '.$request->product_sku.', ';
                }
                if($product->name != $request->product_name){
                    $message .= 'tên sản phẩm: '.$product->sku.' -> '.$request->product_name.', ';
                }
                if($product->feature_img != $request->feature_img){
                    $message .= 'ảnh sản phẩm, ';
                }
                if($product->gallery != rtrim($request->gallery_img, ", ")){
                    $message .= 'thư viện ảnh, ';
                }
                if($product->category_id != $request->category_parent){
                    $message .= 'danh mục sản phẩm, ';
                }
                if($product->weight != $request->product_weight){
                    $message .= 'khối lượng: '.$product->weight.' -> '.$request->product_weight.', ';
                }
                if($product->height != $request->product_height){
                    $message .= 'chiều cao: '.$product->height.' -> '.$request->product_height.', ';
                }
                if($product->length != $request->product_length){
                    $message .= 'chiều dài: '.$product->length.' -> '.$request->product_length.', ';
                }
                if($product->width != $request->product_width){
                    $message .= 'chiều rộng: '.$product->width.' -> '.$request->width.', ';
                }
                if(isset($request->upsell) ){
                    if($product->upsell !=  implode(',',$request->upsell) ){
                        $message .= 'sản phẩm liên quan, ';
                    }
                }
                if($product->payments != implode(',',$request->payments)){
                    $message .= 'hình thức thanh toán, ';
                }
                if($product->status != $request->product_status){
                    if($request->status == 1){
                        $message .= 'trạng thái: ngưng hoạt động -> hoạt động, ';

                    }else{
                        $message .= 'trạng thái: hoạt động -> ngưng hoạt động, ';

                    }
                }
                if($product->brand != $request->product_brand){
                    $message .= 'thương hiệu: '.$product->brand.' -> '.$request->product_brand.', ';
                }
                if($product->long_desc != $request->description){
                    $message .= 'Mô tả chi tiết, ';
                }
                if($product->is_ecard != $request->is_ecard){
                    if($request->is_ecard == 1){
                        $message .= 'sản phẩm: thường -> Ecard ';

                    }
                }
                Product::where('id', $id)->update([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->category_parent,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => strtoupper($request->product_brand),
                    'upsell' => isset($request->upsell) != false ? implode(',',$request->upsell) : null,
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
                    'long_desc' => $request->description,
                    'is_ecard' => $request->is_ecard,
                    'meta_desc' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                ]);
                $product_price = ProductPrice::where('id_ofproduct', $id)->first();
                if($product_price->price != $request->product_price){
                    $message .= 'giá nhập: '.$product_price->price.' -> '.$request->product_price.', ';
                }
                if($product_price->regular_price != $request->product_regular_price){
                    $message .= 'giá bán lẻ: '.$product_price->regular_price.' -> '.$request->product_regular_price.', ';
                }
                if($product_price->shock_price != $request->product_shock_price){
                    $message .= 'giá shock: '.$product_price->shock_price.' -> '.$request->product_shock_price.', ';
                }
                if($product_price->wholesale_price != $request->product_wholesale_price){
                    $message .= 'giá buôn: '.$product_price->wholesale_price.' -> '.$request->product_wholesale_price.', ';
                }
                if($product_price->cpoint != $request->cpoint){
                    $message .= 'tích lũy C: '.$product_price->cpoint.' -> '.$request->cpoint.', ';
                }
                if($product_price->mpoint != $request->mpoint){
                    $message .= 'tích lũy M: '.$product_price->mpoint.' -> '.$request->mpoint.', ';
                }
                if($product_price->phi_xuly != $request->phi_xuly){
                    $message .= 'phí xử lý: '.$product_price->phi_xuly.' -> '.$request->phi_xuly.', ';
                }
                if($product_price->tax != $request->tax){
                    $message .= 'thuế suất: '.$product_price->tax.' -> '.$request->tax.', ';
                }
                ProductPrice::where('id_ofproduct', $id)->update([
                    'price' => $request->product_price,
                    'regular_price' => $request->product_regular_price,
                    'wholesale_price' => $request->product_wholesale_price,
                    'shock_price' => $request->product_shock_price,
                    'cpoint' => $request->cpoint,
                    'mpoint' => $request->mpoint,
                    'phi_xuly' => $request->phi_xuly,
                    'tax' => $request->tax,
                ]);
                if($message != ''){
                    $admin = auth('admin')->user();
                    $this->logController->createLog($admin, 'Sản phẩm', 'Sửa', substr_replace($message ,"", -1), route('san-pham.edit',$product->id ));
    
    
                }
             

                return redirect()->route('san-pham.edit', $id)->with('success', 'Cập nhật sản phẩm thành công');
            } catch (\Throwable $th) {
                throw new \Exception('Đã có lỗi xảy ra vui lòng thử lại');
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        });
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Product::destroy($id);

        $admin = auth('admin')->user();
        $this->logController->createLog($admin, 'Sản phẩm', 'Xóa', 'sản phẩm '.$product->name);


        return redirect()->route('san-pham.index');
    }

    public function multiChange(Request $request) {
        if ($request->id == null) {
            return redirect()->back();
        } 
        else {
            if ($request->action == 'delete') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    Product::destroy($item);
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            else if($request->action == 'show') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    $product->status = 1;
                    $product->save();

                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            else if($request->action == 'hidden') {
                foreach($request->id as $item) {
                    $product = Product::findOrFail($item);
                    $product->status = 0;
                    $product->save();
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái sản phẩm ' . $product->name;
                    Log::info($message);
                }
                return redirect(route('san-pham.index'));
            }
            return redirect()->back();
        }
    }

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search, $request->id)
        ]);
    }

    public function getProCat(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProCat($request->search, 0)
        ]);
    }

    public function indexDatatable()
    {
        $products = Product::latest()->with('productPrice')->get();
        return datatables()->of($products)->toJson();
    }
}
