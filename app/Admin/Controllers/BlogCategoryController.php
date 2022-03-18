<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang Quản lý danh mục bài viết';
        Log::info($message);
        return view('admin.blogCategory.index');
    }

    public function indexDatatable()
    {
        $units = BlogCategory::all();
        if($units) {
            return response()->json([
                'message' => "Success!",
                'code' => 200,
                'data' => $units
            ]);
        } else {
            return response()->json([
                'message' => "Error!",
                'code' => 500,
            ]);
        }
    }

    public function modalEdit(Request $request)
    {
        $id = $request->id;
        $unit = BlogCategory::where('id', $id)->first();
        $returnHTML = view('admin.blogCategory.formUpdate', compact('unit', 'id'))->render();

        return response()->json([
            'html' => $returnHTML
        ], 200);
    }

    public function store(Request $request)
    {
        if($request->unitSlug == '') {
            $slug = Str::slug($request->unitName, '-');
        } else {
            $slug = Str::slug($request->unitSlug, '-');
        }

        // if(BlogCategory::whereSlug($slug)->exists()){
        //     $int = random_int(1, 99999999);
        //     $slug .= '-'.$int;
        // }

        $validator = Validator::make($request->all(), [
            'unitName' => 'required',
            'unitSlug' => 'unique:blog_category,slug',
        ]);
        if($validator->fails()){
            return response()->json([
                'errorSlug' => $validator->errors()->first('unitSlug'),
                'errorName' => $validator->errors()->first('unitName'),
            ], 400);
        }
        
        $blogCategory = BlogCategory::create([
            'name' => $request->unitName,
            'slug' => $slug,
        ]);

        if($blogCategory){

            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới danh mục bài viết ' . $blogCategory->name;
            Log::info($message);

            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }

    }


    public function update(Request $request)
    {
        if($request->unitSlug == '') {
            $slug = Str::slug($request->unitName, '-');
        } else {
            $slug = Str::slug($request->unitSlug, '-');
        }

        $validator = Validator::make($request->all(), [
            'unitName' => 'required',
            'unitSlug' => 'unique:blog_category,slug,'.$request->id,
        ]);
        if($validator->fails()){
            return response()->json([
                'errorSlug' => $validator->errors()->first('unitSlug'),
                'errorName' => $validator->errors()->first('unitName'),
            ], 400);
        }

        $blogCategory = BlogCategory::where('id', $request->id)->update([
            'name' => $request->unitName,
            'slug' => $slug
        ]);

        if($blogCategory){
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật danh mục bài viết ' . $request->unitName;
            Log::info($message);

            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $blogCate = BlogCategory::findOrFail($request->id);
        $blogCategory = BlogCategory::destroy($request->id);
        if($blogCategory){

            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa danh mục bài viết ' . $blogCate->name;
            Log::info($message);
            return response()->json([
                'message' => "Success",
                'code' => 200,
            ]);
        } else {
            return response()->json([
                'message' => "Error",
                'code' => 500,
            ]);
        }
    }

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                $blogCate = BlogCategory::findOrFail($item);
                BlogCategory::destroy($item);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa danh mục bài viết ' . $blogCate->name;
                Log::info($message);
            }
            return redirect(route('chuyenmuc-baiviet.index'));
        } else {
            return redirect()->back();
        }
    }
}