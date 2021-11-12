<?php

namespace App\Admin\Controllers;

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

class AdminProductController extends Controller
{
    public function index()
    {
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập xem trang sản phẩm';
        Log::info($message);
        $products = Product::all();
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
        $payments = Payment::all();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang tạo mới sản phẩm';
        Log::info($message);

        return view('admin.product.tao-san-pham', compact('nganhHang', 'calculationUnits', 'brands', 'payments', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_sku' => 'required|unique:products,sku',
            'product_name' => 'required|unique:products,name',
            'slug' => 'unique:products,slug',
            'feature_img' => 'required',
            'category_parent' => 'required',
            'product_weight' => 'required',
            'product_height' => 'required',
            'product_width' => 'required',
            'product_length' => 'required',
            'product_brand' => 'required',
            'payments' => 'required',
            'product_status' => 'required',
            'product_regular_price' => 'required|numeric',
            'product_wholesale_price' => 'required|numeric',
            'product_shock_price' => 'required|numeric',
            'cpoint' => 'numeric',
            'mpoint' => 'numeric',
            'phi_xuly' => 'required|numeric',
            'cship' => 'required|numeric',
            'viettel_ship' => 'required|numeric',
            'tax' => 'required',
        ], [
            'product_sku.required' => 'SKU không được để trống',
            'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
            'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
            'feature_img' => 'Ảnh đại diện không được để trống',
            'category_parent' => 'Danh mục sản phẩm không được để trống',
            'product_weight' => 'Cân nặng không được để trống',
            'product_height' => 'Chiều cao không được để trống',
            'product_width' => 'Chiều rộng không được để trống',
            'product_length' => 'Chiều dài không được để trống',
            'product_brand' => 'Thương hiệu không được để trống',
            'payments' => 'Hình thức thanh toán không được để trống',
            'product_status' => 'Trạng thái không được để trống',
            'cpoint' => 'CPoint phải là số',
            'mpoint' => 'MPoint phải là số',
            'product_regular_price.required' => 'Giá bán lẻ không được để trống',
            'product_wholesale_price.required' => 'Giá bán buôn không được để trống',
            'product_shock_price.required' => 'Giá shock không được để trống',
            'phi_xuly.required' => 'Phí xử lý không được để trống',
            'cship.required' => 'CShip không được để trống',
            'viettel_ship.required' => 'Viettel Ship không được để trống',
            'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
            'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
            'product_shock_price.numeric' => 'Giá shock phải là số',
            'phi_xuly.numeric' => 'Phí xử lý phải là số',
            'cship.numeric' => 'CShip phải là số',
            'viettel_ship.numeric' => 'Viettel Ship phải là số',
            'tax' => 'Thuế không được để trống',
        ]);

        return DB::transaction(function () use ($request) {
            try {
                $slug = Str::slug($request->product_name, '-');

                // if(Product::whereSlug($slug)->exists()){
                //     $int = random_int(1, 99999999);
                //     $slug .= '-'.$int;
                // }

                $product = Product::create([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->category_parent,
                    // 'calculation_unit' => $request->product_calculation_unit,
                    // 'quantity' => $request->product_quantity,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => $request->product_brand,
                    'upsell' => implode(',',$request->upsell),
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
                    'short_desc' => $request->short_description,
                    'long_desc' => $request->description,
                    'meta_desc' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                ]);

                $productPrice = new ProductPrice();
                $productPrice->regular_price = $request->product_regular_price;
                $productPrice->wholesale_price = $request->product_wholesale_price;
                $productPrice->shock_price = $request->product_shock_price;
                $productPrice->cpoint = $request->cpoint;
                $productPrice->mpoint = $request->mpoint;
                $productPrice->phi_xuly = $request->phi_xuly;
                $productPrice->cship = $request->cship;
                $productPrice->viettel_ship = $request->viettel_ship;
                $productPrice->tax = $request->tax;

                $product->productPrice()->save($productPrice);

                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới sản phẩm ' . $product->name;
                Log::info($message);

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
        $payments = Payment::all();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' truy cập trang cập nhật sản phẩm';
        Log::info($message);

        return view('admin.product.cap-nhat-san-pham', compact('product', 'products', 'nganhHang', 'calculationUnits', 'brands', 'payments'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product_sku' => 'required|unique:products,sku,'.$id,
            'product_name' => 'required|unique:products,name,'.$id,
            'slug' => 'unique:products,slug',
            'feature_img' => 'required',
            'category_parent' => 'required',
            'product_weight' => 'required',
            'product_height' => 'required',
            'product_width' => 'required',
            'product_length' => 'required',
            'product_brand' => 'required',
            'payments' => 'required',
            'product_status' => 'required',
            'product_regular_price' => 'required|numeric',
            'product_wholesale_price' => 'required|numeric',
            'product_shock_price' => 'required|numeric',
            'cpoint' => 'numeric',
            'mpoint' => 'numeric',
            'phi_xuly' => 'required|numeric',
            'cship' => 'required|numeric',
            'viettel_ship' => 'required|numeric',
            'tax' => 'required',
        ], [
            'product_sku.required' => 'SKU không được để trống',
            'product_sku.unique' => 'SKU đang sử dụng đã bị trùng lặp',
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'product_name.unique' => 'Tên sản phẩm đã bị trùng lặp, vui lòng đặt tên khác',
            'slug.unique' => 'Slug đang sử dụng đã bị trùng lặp, vui lòng đặt tên khác',
            'feature_img' => 'Ảnh đại diện không được để trống',
            'category_parent' => 'Danh mục sản phẩm không được để trống',
            'product_weight' => 'Cân nặng không được để trống',
            'product_height' => 'Chiều cao không được để trống',
            'product_width' => 'Chiều rộng không được để trống',
            'product_length' => 'Chiều dài không được để trống',
            'product_brand' => 'Thương hiệu không được để trống',
            'payments' => 'Hình thức thanh toán không được để trống',
            'product_status' => 'Trạng thái không được để trống',
            'cpoint' => 'CPoint phải là số',
            'mpoint' => 'MPoint phải là số',
            'product_regular_price.required' => 'Giá bán lẻ không được để trống',
            'product_wholesale_price.required' => 'Giá bán buôn không được để trống',
            'product_shock_price.required' => 'Giá shock không được để trống',
            'phi_xuly.required' => 'Phí xử lý không được để trống',
            'cship.required' => 'CShip không được để trống',
            'viettel_ship.required' => 'Viettel Ship không được để trống',
            'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
            'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
            'product_shock_price.numeric' => 'Giá shock phải là số',
            'phi_xuly.numeric' => 'Phí xử lý phải là số',
            'cship.numeric' => 'CShip phải là số',
            'viettel_ship.numeric' => 'Viettel Ship phải là số',
            'tax' => 'Thuế không được để trống',
        ]);

        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->product_name, '-');
        
                // if(Product::whereSlug($slug)->exists()){
                //     $int = random_int(1, 99999999);
                //     $slug .= '-'.$int;
                // }

                Product::where('id', $id)->update([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->category_parent,
                    // 'calculation_unit' => $request->product_calculation_unit,
                    // 'quantity' => $request->product_quantity,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => $request->product_brand,
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
                    'short_desc' => $request->short_description,
                    'long_desc' => $request->description,
                    'meta_desc' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                ]);

                ProductPrice::where('id_ofproduct', $id)->update([
                    'regular_price' => $request->product_regular_price,
                    'wholesale_price' => $request->product_wholesale_price,
                    'shock_price' => $request->product_shock_price,
                    'cpoint' => $request->cpoint,
                    'mpoint' => $request->mpoint,
                    'phi_xuly' => $request->phi_xuly,
                    'cship' => $request->cship,
                    'viettel_ship' => $request->viettel_ship,
                    'tax' => $request->tax,
                ]);

                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật sản phẩm ' . $request->product_name;
                Log::info($message);

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

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa sản phẩm ' . $product->name;
        Log::info($message);

        return redirect()->route('san-pham.index');
    }

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                $product = Product::findOrFail($item);
                Product::destroy($item);

                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa sản phẩm ' . $product->name;
                Log::info($message);
            }
            return redirect(route('san-pham.index'));
        } else {
            return redirect()->back();
        }
    }

}