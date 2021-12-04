<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Session;

class AdminBannerController extends Controller
{
    
	public function index(){
		$banner = config('custom-config.banner');
		return view('admin.banner.index', compact('banner'));
	}
	public function store(){
		
	}
	public function edit(Request $request){
		$type = $request->type;
		$banner = Banner::where('type', $type)->orderBy('sort', 'ASC')->get();
		return view('admin.banner.edit', compact('type', 'banner'));
	}
	public function update(Request $request){
		// dd($request);
		$array = array();
		foreach ($request->id as $key => $value) {
			$banner = Banner::updateOrCreate(
	    		['id' => $value],
	    		['type' => $request->type, 'image' => $request->image[$key], 'sort' => $key]
			);
			array_push($array, $banner->id);
		}

		Banner::where('type', $request->type)->whereNotIn('id', $array)->delete();

		$banner = Banner::where('type', $request->type)->orderBy('sort', 'ASC')->get();

		$html = view('admin.template-render.render')->with('type', 'banner')
					->with('banner', $banner);
		return $html;
		
	}
	public function delete(){
		
	}

}
