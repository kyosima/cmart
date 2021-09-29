<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('admin.blog.create', compact('categories'));
    }

    public function edit(Request $request, $id)
    {
        $categories = BlogCategory::all();
        $blog = Blog::find($id);
        return view('admin.blog.edit', compact('categories', 'blog'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->blog_title, '-');

        if(Blog::whereSlug($slug)->exists()){
            $int = random_int(1, 99999999);
            $slug .= '-'.$int;
        }

        $blog = Blog::create([
            'id_ofcategory' => $request->blog_category,
            'feature_img' => $request->feature_img,
            'name' => $request->blog_title,
            'slug' => $slug,
            'content' => $request->description,
            'status' => $request->blog_status,
        ]);

        if($blog) {
            return redirect()->route('baiviet.edit', $blog->id)->with('success', 'Tạo bài viết thành công');
        } else {
            return redirect()->back()->withErrors(['error' => "Đã có lỗi xảy ra, vui lòng nhập đúng dữ liệu"]);
        }
    }


    public function update(Request $request, $id)
    {
        $slug = Str::slug($request->blog_title, '-');

        if(Blog::whereSlug($slug)->exists()){
            $int = random_int(1, 99999999);
            $slug .= '-'.$int;
        }

        $blog = Blog::where('id', $id)->update([
            'id_ofcategory' => $request->blog_category,
            'feature_img' => $request->feature_img,
            'name' => $request->blog_title,
            'slug' => $slug,
            'content' => $request->description,
            'status' => $request->blog_status,
        ]);

        if($blog) {
            return redirect()->route('baiviet.edit', $id)->with('success', 'Cập nhật bài viết thành công');
        } else {
            return redirect()->back()->withErrors(['error' => "Đã có lỗi xảy ra, vui lòng nhập đúng dữ liệu"]);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        Blog::where('id', $id)->update([
            'status' => $request->unitStatus
        ]);

        return redirect()->route('baiviet.index');
    }

    public function destroy($id)
    {
        Blog::destroy($id);
        return redirect()->route('baiviet.index');
    }
}