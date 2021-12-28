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

class AdminProductController extends Controller
{
    use ajaxProductTrait;

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
            'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
            'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
            'product_shock_price.numeric' => 'Giá shock phải là số',
            'phi_xuly.numeric' => 'Phí xử lý phải là số',
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
                    'upsell' => isset($request->upsell) != false ? implode(',',$request->upsell) : null,
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
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
            'product_regular_price.numeric' => 'Giá bán lẻ phải là số',
            'product_wholesale_price.numeric' => 'Giá bán buôn phải là số',
            'product_shock_price.numeric' => 'Giá shock phải là số',
            'phi_xuly.numeric' => 'Phí xử lý phải là số',
            'tax' => 'Thuế không được để trống',
        ]);


        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->product_name, '-');

                if(str_starts_with($request->gallery_img, ', ')){
                    $request->gallery_img = substr_replace($request->gallery_img,'',0,2);
                }

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
                    'upsell' => isset($request->upsell) != false ? implode(',',$request->upsell) : null,
                    'payments' => implode(',',$request->payments),
                    'status' => $request->product_status,
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

    public function multipleDestroy(Request $request)
    {
        if($request->id != null) {
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

    public function getProduct(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProduct($request->search, $request->id)
        ]);
    }
}