<?php

namespace App\Admin\Controllers;

use App\Admin\Traits\ajaxProductTrait;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Admin\Controllers\AdminLogController; 

class AdminProductCategoryController extends Controller
{
    use ajaxProductTrait;
    public $logController;

    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    public function showChild($parentId, $level)
    {
        $categories = ProductCategory::where('category_parent', $parentId)
            ->with('childrenCategoriesOnly')
            ->orderBy('priority')
            ->select(['id', 'name', 'slug', 'status', 'priority', 'category_parent', 'level'])
            ->get();
        
        $parentOfCurrentParent = ProductCategory::where('id', $parentId)->first();
        return view('admin.productCategory.page_child', compact('categories', 'level', 'parentOfCurrentParent'));
    }

    public function index()
    {
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategoriesOnly')
            ->orderBy('priority')
            ->select(['id', 'name', 'slug', 'status', 'priority', 'category_parent', 'level'])
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
                'link_to_category' => $request->linkProCat,
                'priority' => $request->proCatPriority,
            ]);
            $admin = auth('admin')->user();

            $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'Tạo', 'ngành/nhóm hàng '.$proCat->name, route('nganh-nhom-hang.edit',$proCat->id));

        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                $proCat = ProductCategory::create([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'description' => $request->proCatDescription,
                    'link_to_category' => $request->linkProCat,
                    'priority' => $request->proCatPriority,
                ]);

              
            }
            $admin = auth('admin')->user();

            $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'Tạo', 'ngành/nhóm hàng '.$proCat->name, route('nganh-nhom-hang.edit',$proCat->id));

        }
        
        return back()->with('success','Tạo mới thành công danh mục sản phẩm');;
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

        if ($request->proCatParent == 0) {
            $category = ProductCategory::where('id', $id)->first();
            $message = '';
            if($category->name != $request->proCatName){
                $message .='tên: '.$category->name.' -> '.$request->proCatName.', ' ;
            }
            if($category->feature_img != $request->feature_img){
                $message .='ảnh ngành hàng, ' ;
            }
            if($category->gallery != rtrim($request->gallery_img, ", ")){
                $message .='thư viện ảnh, ' ;
            }
            if($category->description != $request->proCatDescription){
                $message .='mô tả, ' ;
            }
            if($category->link_to_category != $request->linkProCat){
                $message .='liên kết đến ngành hàng khác, ' ;
            }
            if($category->priority != $request->proCatPriority){
                $message .='thứ tự ưu tiên: '.$category->priority.' -> '.$request->proCatPriority.', ' ;
            }
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
                'link_to_category' => $request->linkProCat,
                'priority' => $request->proCatPriority,
            ]);
            $admin = auth('admin')->user();

            $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'Sửa', $message, route('nganh-nhom-hang.edit',$id));

            $this->recursive($id, 0, 1);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                $category = ProductCategory::where('id', $id)->first();

                $message = '';
                if($category->category_parent != $request->proCatParent){
                    $message .='Danh mục cha, ' ;
                }
                if($category->name != $request->proCatName){
                    $message .='tên: '.$category->name.' -> '.$request->proCatName.', ' ;
                }
                if($category->feature_img != $request->feature_img){
                    $message .='ảnh ngành hàng, ' ;
                }
                if($category->gallery != rtrim($request->gallery_img, ", ")){
                    $message .='thư viện ảnh, ' ;
                }
                if($category->description != $request->proCatDescription){
                    $message .='mô tả, ' ;
                }
                if($category->link_to_category != $request->linkProCat){
                    $message .='liên kết đến ngành hàng khác, ' ;
                }
                if($category->priority != $request->proCatPriority){
                    $message .='thứ tự ưu tiên: '.$category->priority.' -> '.$request->proCatPriority.', ' ;
            }
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
                    'link_to_category' => $request->linkProCat,
                    'priority' => $request->proCatPriority,
                ]);
                $admin = auth('admin')->user();

                $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'Tạo', 'ngành/nhóm hàng '.$request->proCatName, route('nganh-nhom-hang.edit',$id));
    
                $this->recursive($id, 1, 0);
            }
        }
        return redirect()->route('nganh-nhom-hang.edit', $id)->with('success', 'Cập nhật danh mục thành công');
    }

    public function modelUpdate(Request $request, $id)
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

        $proCat = '';

        if ($request->proCatParent == 0) {
            $proCat = ProductCategory::where('id', $id)->update([
                'category_parent' => 0,
                'level' => 0,
                'slug' => $slug,
                'name' => $request->proCatName,
                'link_to_category' => $request->linkProCat == 0 ? null : $request->linkProCat,
                'priority' => $request->proCatPriority,
            ]);
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục sản phẩm '. $request->proCatName;
            Log::info($message);
            $this->recursive($id, 0, 1);
        } else {
            $catPar = ProductCategory::where('id', $request->proCatParent)->first();
            if ($catPar) {
                $proCat = ProductCategory::where('id', $id)->update([
                    'category_parent' => $request->proCatParent,
                    'level' => $catPar->level + 1,
                    'slug' => $slug,
                    'name' => $request->proCatName,
                    'link_to_category' => $request->linkProCat == 0 ? null : $request->linkProCat,
                    'priority' => $request->proCatPriority,
                ]);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục sản phẩm '. $request->proCatName;
                Log::info($message);
                $this->recursive($id, 1, 0);
            }
        }
        if ($proCat == 1) {
            return response([
                'priority' => $request->proCatPriority,
                'id' => $id
            ], 200);
        }
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

    public function destroy($id, Request $request)
    {
        
        if($id == 1) {
            // Không được xóa Uncategorized
            return redirect()->route('nganh-nhom-hang.index');
        } else {
            $this->recursive($id, 2, 0);
            Product::where('category_id', $id)->update(['category_id' => 1]);

            $proCat = ProductCategory::findOrFail($id);
            ProductCategory::destroy($id);

            $admin = auth('admin')->user();

            $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'xóa', 'ngành/nhóm hàng '.$proCat->name);

        }
        if($request->ajax()){
        }else{
            return redirect()->route('nganh-nhom-hang.index');
        }
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $proCat = ProductCategory::where('id', $id)->first();
        $categories = ProductCategory::where('category_parent', 0)
            ->with('childrenCategories')
            ->select(['id', 'name', 'category_parent', 'slug', 'link_to_category', 'priority'])
            ->get();
        $returnHTML = view('admin.productCategory.update', compact('proCat', 'id', 'categories'))->render();

        return response()->json([
            'html' => $returnHTML,
            'curent_id' => $id
        ], 200);
    }

    public function multiChange(Request $request) {
        if ($request->id == null) {
            return redirect()->back();
        } 
        else {
            if ($request->action == 'delete') {
                foreach($request->id as $item) {
                    $this->recursive($item, 2, 0);
                    Product::where('category_id', $item)->update(['category_id' => 1]);

                    $proCat = ProductCategory::findOrFail($item);
                    ProductCategory::destroy($item);
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa danh mục sản phẩm ' . $proCat->name;
                    Log::info($message);
                }
                return redirect(route('nganh-nhom-hang.index'));
            }
            else if($request->action == 'show') {
                foreach($request->id as $item) {
                    $proCat = ProductCategory::findOrFail($item);
                    $proCat->status = 1;
                    $proCat->save();

                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái danh mục sản phẩm ' . $proCat->name;
                    Log::info($message);
                }
                return redirect(route('nganh-nhom-hang.index'));
            }
            else if($request->action == 'hidden') {
                foreach($request->id as $item) {
                    $proCat = ProductCategory::findOrFail($item);
                    $proCat->status = 0;
                    $proCat->save();
    
                    $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện thay đổi trạng thái danh mục sản phẩm ' . $proCat->name;
                    Log::info($message);
                }
                return redirect(route('nganh-nhom-hang.index'));
            }
            return redirect()->back();
        }
    }

    public function updateStatus(Request $request, $id)
    {
         ProductCategory::where('id', $id)->update([
            'status' => $request->unitStatus
        ]);
        $admin = auth('admin')->user();
        if($request->unitStatus ==0){
            $status_text = 'Ngừng';
        }else{
            $status_text = 'Hoạt động';
        }
        $proCat = ProductCategory::where('id', $id)->first();

        $this->logController->createLog($admin, 'Ngành/nhóm hàng', 'Thay đổi', 'trạng thái ngành/nhóm hàng '.$proCat->name .' thành '.$status_text, route('nganh-nhom-hang.edit',$proCat->id));
        
    }   

    public function getProCat(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetProCat($request->search, $request->id)
        ]);
    }

}
