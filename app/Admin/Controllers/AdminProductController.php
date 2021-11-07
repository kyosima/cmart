<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\CalculationUnit;
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
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang tạo mới sản phẩm';
        Log::info($message);

        return view('admin.product.tao-san-pham', compact('nganhHang', 'calculationUnits', 'brands'));
    }

    public function store(Request $request)
    {
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
                    'calculation_unit' => $request->product_calculation_unit,
                    // 'quantity' => $request->product_quantity,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => $request->product_brand,
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
        $nganhHang = ProductCategory::where('category_parent', 0)
                                ->with('childrenCategories')
                                ->get();
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' truy cập trang cập nhật sản phẩm';
        Log::info($message);

        return view('admin.product.cap-nhat-san-pham', compact('product', 'nganhHang', 'calculationUnits', 'brands'));
    }

    public function update(Request $request, $id)
    {
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
                    'calculation_unit' => $request->product_calculation_unit,
                    // 'quantity' => $request->product_quantity,
                    'weight' => $request->product_weight,
                    'height' => $request->product_height,
                    'width' => $request->product_width,
                    'length' => $request->product_length,
                    'brand' => $request->product_brand,
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