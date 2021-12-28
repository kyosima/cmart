<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class AdminProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategories')
            ->get();

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang Quản lý danh mục sản phẩm';
        Log::info($message);
        return view('admin.productCategory.index', compact('categories'));
    }

    public function edit(Request $request) {
        $proCat = ProductCategory::findOrFail($request->id);
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategories')
            ->get();
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang Chỉnh sửa danh mục sản phẩm';
        Log::info($message);
        return view('admin.productCategory.edit', compact('proCat', 'categories'));
    }

    public function store(Request $request)
    {
        if($request->proCatSlug == '') {
            $slug = Str::slug($request->proCatName, '-');
        } else {
            $slug = Str::slug($request->proCatSlug, '-');
        }

        $request->validate([
            'proCatName' => 'required|unique:product_categories,name',
            'proCatSlug' => 'unique:product_categories,slug',
        ], [
            'proCatName.required' => 'Tên danh mục không được để trống',
            'proCatName.unique' => 'Tên danh mục đã bị trùng lặp, vui lòng đặt tên khác',
            'proCatSlug.unique' => 'Tên đường dẫn đã bị trùng lặp, vui lòng đặt tên khác',
        ]);

        // if(ProductCategory::whereSlug($slug)->exists()){
        //     $int = random_int(1, 99999999);
        //     $slug .= '-'.$int;
        // }

        if ($request->proCatParent == 0) {
            $proCat = ProductCategory::create([
                'category_parent' => 0,
                'level' => 0,
                'slug' => $slug,
                'name' => $request->proCatName,
                'description' => $request->proCatDescription,
                'link_to_category' => $request->linkProCat
            ]);
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới danh mục sản phẩm '. $proCat->name;
            Log::info($message);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                $proCat = ProductCategory::create([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'description' => $request->proCatDescription,
                    'link_to_category' => $request->linkProCat
                ]);

                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới danh mục sản phẩm '. $proCat->name;
                Log::info($message);
            }
        }
        return redirect()->route('nganh-nhom-hang.index');
    }

    public function update(Request $request, $id)
    {
        if($request->proCatSlug == '') {
            $slug = Str::slug($request->proCatName, '-');
        } else {
            $slug = Str::slug($request->proCatSlug, '-');
        }

        $request->validate([
            'proCatName' => 'required|unique:product_categories,name,'.$id,
            'proCatSlug' => 'unique:product_categories,slug,'.$id,
        ], [
            'proCatName.required' => 'Tên danh mục không được để trống',
            'proCatName.unique' => 'Tên danh mục đã bị trùng lặp, vui lòng đặt tên khác',
            'proCatSlug.unique' => 'Tên đường dẫn đã bị trùng lặp, vui lòng đặt tên khác',
        ]);


        // if(ProductCategory::whereSlug($slug)->exists()){
        //     $int = random_int(1, 99999999);
        //     $slug .= '-'.$int;
        // }

        if ($request->proCatParent == 0) {
            ProductCategory::where('id', $id)->update([
                'category_parent' => 0,
                'level' => 0,
                'slug' => $slug,
                'name' => $request->proCatName,
                'feature_img' => $request->feature_img,
                'gallery' => rtrim($request->gallery_img, ", "),
                'meta_desc' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'description' => $request->proCatDescription,
                'link_to_category' => $request->linkProCat
            ]);
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục sản phẩm '. $request->proCatName;
            Log::info($message);
            $this->recursive($id, 0, 1);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                ProductCategory::where('id', $id)->update([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'feature_img' => $request->feature_img,
                    'gallery' => rtrim($request->gallery_img, ", "),
                    'meta_desc' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                    'description' => $request->proCatDescription,
                    'link_to_category' => $request->linkProCat
                ]);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục sản phẩm '. $request->proCatName;
                Log::info($message);
                $this->recursive($id, 1, 0);
            }
        }
        return redirect()->route('nganh-nhom-hang.edit', $id)->with('success', 'Cập nhật danh mục thành công');
    }

    public function recursive($id, $status, $levelChange)
    {
        $current = ProductCategory::where('id', $id)->with('childrenCategories')->first();
        if ($status == 0) {
            // Trường hợp chuyển Category lên Danh mục cha lớn (level = 0)
            foreach ($current->childrenCategories as $child) {
                ProductCategory::where('id', $child->id)->update([
                    'level' => $levelChange,
                ]);
                $this->recursive($child->id, 0, $levelChange + 1);
            }
        }
        elseif ($status == 1) {
            // Trường hợp chuyển Category thành con của 1 Category bất kì (level > 0)
            foreach ($current->childrenCategories as $child) {
                ProductCategory::where('id', $child->id)->update([
                    'level' => $current->level + 1,
                ]);
                $this->recursive($child->id, 1, 0);
            }
        } 
        else {
            // Trường hợp xóa Category rồi dồn level lên
            foreach ($current->childrenCategories as $child) {
                if($child->level - $current->level == 1) {
                    ProductCategory::where('id', $child->id)->update([
                        'category_parent' => $current->category_parent, 
                        'level' => $child->level - 1,
                    ]);
                } else {
                    ProductCategory::where('id', $child->id)->update([
                        'level' => $child->level - 1,
                    ]);
                }
                $this->recursive($child->id, $status, 0);
            }
        }
    }

    public function destroy($id)
    {
        if($id == 1) {
            // Không được xóa Uncategorized
            return redirect()->route('nganh-nhom-hang.index');
        } else {
            $this->recursive($id, 2, 0);
            Product::where('category_id', $id)->update(['category_id' => 1]);

            $proCat = ProductCategory::findOrFail($id);
            ProductCategory::destroy($id);

            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục sản phẩm '. $proCat->name;
            Log::info($message);
        }
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $proCat = ProductCategory::where('id', $id)->first();
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategories')
            ->get();
        $returnHTML = view('admin.productCategory.update', compact('proCat', 'id', 'categories'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function multipleDestroy(Request $request)
    {
        if($request->id != null) {
            foreach($request->id as $item) {
                if ($item != 1) {
                    $this->recursive($item, 2, 0);
                    Product::where('category_id', $item)->update(['category_id' => 1]);

                    $proCat = ProductCategory::findOrFail($item);
                    ProductCategory::destroy($item);
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa danh mục sản phẩm ' . $proCat->name;
                    Log::info($message);
                }
            }
            return redirect(route('nganh-nhom-hang.index'));
        } else {
            return redirect()->back();
        }
    }

    public function updateStatus(Request $request, $id)
    {
        ProductCategory::where('id', $id)->update([
            'status' => $request->unitStatus
        ]);
    }
}
