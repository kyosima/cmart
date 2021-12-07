<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang Quản lý bài viết';
        Log::info($message);
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang tạo mới bài viết';
        Log::info($message);
        return view('admin.blog.create', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        $categories = BlogCategory::all();
        $blog = Blog::find($id);
        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện truy cập trang chỉnh sửa bài viết';
        Log::info($message);
        return view('admin.blog.edit', compact('categories', 'blog'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->blog_title, '-');

        $request->validate([
            'blog_title' => 'required|unique:blogs,name',
            'blog_category' => 'required',
        ], [
            'blog_title.required' => 'Tên bài viết không được để trống',
            'blog_title.unique' => 'Tên bài viết đã bị trùng lặp, vui lòng đặt tên khác',
            'blog_category' => 'Danh mục bài viết không được để trống',
        ]);

        // if(Blog::whereSlug($slug)->exists()){
        //     $int = random_int(1, 99999999);
        //     $slug .= '-'.$int;
        // }

        $blog = Blog::create([
            'id_ofcategory' => $request->blog_category,
            'feature_img' => $request->feature_img,
            'name' => $request->blog_title,
            'slug' => $slug,
            'content' => $request->description,
            'status' => $request->blog_status,
            'meta_desc' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
        ]);

        if($blog) {
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện tạo mới bài viết ' . $blog->name;
            Log::info($message);

            return redirect()->route('baiviet.edit', $blog->id)->with('success', 'Tạo bài viết thành công');
        } else {
            return redirect()->back()->withErrors(['error' => "Đã có lỗi xảy ra, vui lòng nhập đúng dữ liệu"]);
        }
    }

    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->blog_title, '-');

        // if(Blog::whereSlug($slug)->exists()){
        //     $int = random_int(1, 99999999);
        //     $slug .= '-'.$int;
        // }

        $request->validate([
            'blog_title' => 'required|unique:blogs,name',
            'blog_category' => 'required',
        ], [
            'blog_title.required' => 'Tên bài viết không được để trống',
            'blog_title.unique' => 'Tên bài viết đã bị trùng lặp, vui lòng đặt tên khác',
            'blog_category' => 'Danh mục bài viết không được để trống',
        ]);

        $blog = Blog::where('id', $id)->update([
            'id_ofcategory' => $request->blog_category,
            'feature_img' => $request->feature_img,
            'name' => $request->blog_title,
            'slug' => $slug,
            'content' => $request->description,
            'status' => $request->blog_status,
            'meta_desc' => $request->meta_description,
            'meta_keyword' => $request->meta_keyword,
        ]);

        if($blog) {
            $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện cập nhật bài viết ' . $request->blog_title;
            Log::info($message);

            return redirect()->route('baiviet.edit', $id)->with('success', 'Cập nhật bài viết thành công');
        } else {
            return redirect()->back()->withErrors(['error' => "Đã có lỗi xảy ra, vui lòng nhập đúng dữ liệu"]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $blog = Blog::where('id', $id)->update([
            'status' => $request->unitStatus
        ]);
        // return redirect()->route('baiviet.index');
        if($blog){
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

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        Blog::destroy($id);

        $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa bài viết ' . $blog->name;
        Log::info($message);
        return redirect()->route('baiviet.index');
    }

    public function multipleDestory(Request $request)
    {
        if($request->action == 'delete' && $request->id != null) {
            foreach($request->id as $item) {
                $blog = Blog::findOrFail($item);
                Blog::destroy($item);
                $message = 'User: '. auth()->guard('admin')->user()->name . ' thực hiện xóa bài viết ' . $blog->name;
                Log::info($message);
            }
            return redirect(route('baiviet.index'));
        } else {
            return redirect()->back();
        }
    }
}