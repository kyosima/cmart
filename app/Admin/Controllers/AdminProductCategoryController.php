<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategories')
            ->get();
        return view('admin.productCategory.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->proCatName, '-');

        if ($request->proCatParent == 0) {
            ProductCategory::create([
                'category_parent' => 0,
                'level' => 0,
                'slug' => $slug,
                'name' => $request->proCatName,
                'description' => $request->proCatDescription
            ]);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                ProductCategory::create([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'description' => $request->proCatDescription
                ]);
            }
        }
        return redirect()->route('nganh-nhom-hang.index');
    }

    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->proCatName, '-');

        if ($request->proCatParent == 0) {
            ProductCategory::where('id', $id)->update([
                'category_parent' => 0,
                'level' => 0,
                'slug' => $slug,
                'name' => $request->proCatName,
                'description' => $request->proCatDescription
            ]);
            $this->recursive($id, 0, 1);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                ProductCategory::where('id', $id)->update([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'description' => $request->proCatDescription
                ]);
                $this->recursive($id, 1, 0);
            }
        }
        return redirect()->route('nganh-nhom-hang.index');
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
                $this->recursive($child->id, $status, $levelChange + 1);
            }
        } else {
            // Trường hợp chuyển Category thành con của 1 Category bất kì (level > 0)
            foreach ($current->childrenCategories as $child) {
                ProductCategory::where('id', $child->id)->update([
                    'level' => $current->level + 1,
                ]);
                $this->recursive($child->id, $status, 0);
            }
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

    public function updateStatus(Request $request, $id)
    {
        ProductCategory::where('id', $id)->update([
            'status' => $request->unitStatus
        ]);

        return redirect()->route('nganh-nhom-hang.index');
    }

    public function destroy($id)
    {
        ProductCategory::destroy($id);
        return redirect()->route('nganh-nhom-hang.index');
    }
}
