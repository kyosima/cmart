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
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.product.san-pham', compact('products'));
    }

    public function create()
    {
        $nganhHang = ProductCategory::where('typeof_category', 0)->get();
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();
        return view('admin.product.tao-san-pham', compact('nganhHang', 'calculationUnits', 'brands'));
    }

    public function getCategory(Request $request)
    {
        $cate = ProductCategory::where('category_parent', $request->id)
                                ->get();
        return response()->json([
            'data' => $cate,
        ], 200);
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            try {
                $slug = Str::slug($request->product_name, '-');

                $product = Product::create([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->child_category != "-1" ? $request->category_parent : $request->child_category,
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
                ]);

                $productPrice = new ProductPrice();
                $productPrice->regular_price = $request->product_regular_price;
                $productPrice->wholesale_price = $request->product_wholesale_price;
                $productPrice->shock_price = $request->product_shock_price;

                $product->productPrice()->save($productPrice);

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
        $nganhHang = ProductCategory::where('typeof_category', 0)->get();
        $calculationUnits = CalculationUnit::all();
        $brands = Brand::all();
        return view('admin.product.cap-nhat-san-pham', compact('product', 'nganhHang', 'calculationUnits', 'brands'));
    }

    public function update(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            try {
                $slug = Str::slug($request->product_name, '-');

                Product::where('id', $id)->update([
                    'sku' => $request->product_sku,
                    'name' => $request->product_name,
                    'slug' => $slug,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'category_id' => $request->child_category == "-1" ? $request->category_parent : $request->child_category,
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
                ]);

                ProductPrice::where('id_ofproduct', $id)->update([
                    'regular_price' => $request->product_regular_price,
                    'wholesale_price' => $request->product_wholesale_price,
                    'shock_price' => $request->product_shock_price,
                ]);

                return redirect()->route('san-pham.edit', $id)->with('success', 'Cập nhật sản phẩm thành công');
            } catch (\Throwable $th) {
                throw new \Exception('Đã có lỗi xảy ra vui lòng thử lại');
                return redirect()->back()->withErrors(['error' => $th->getMessage()]);
            }
        });
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('san-pham.index');
    }
}