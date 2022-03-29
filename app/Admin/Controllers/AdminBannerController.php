<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\BannerLocation;
use Illuminate\Support\Facades\Session;
use App\Admin\Controllers\AdminLogController;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class AdminBannerController extends Controller
{
	public $logController;

    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
	public function index(){
		$banners = Banner::latest()->get();
		return view('admin.banner.index', compact('banners'));
	}

	public function create(){
		$locations = BannerLocation::latest()->get();
		return view('admin.banner.create', compact('locations'));
	}
	public function store(Request $request){
		$request->validate([
            'id_location' => 'required',
            'unit_name' => 'required',
            'expire_date' => 'required',
            'file' => 'required',
        ], [
            'id_location.required' => 'Trang hiển thị không được để trống',
            'unit_name.required' => 'Tên đơn vị sử dụng không được để trống',
            'expire_date.required' => 'Hạn sử dụng không được để trống',
            'file.required' => 'File ảnh không được để trống',
        ]);
		$banner = Banner::create([
			'id_location'=> $request->id_location,
			'position' => $request->position,
			'unit_name' => $request->unit_name,
			'expire_date' => $request->expire_date,
			'file' => $request->file,
			'link' => $request->link,
			'code' => str_replace('-', '',(string)date('Y-m-d-H-i-s')),
		]);

		$admin = auth('admin')->user();

		$this->logController->createLog($admin, 'Banner', 'Tạo', 'banner cho đơn vị '. $request->unit_name, route('admin.banner.edit',$banner->id ));

		return redirect()->route('admin.banner.edit', $banner->id)->with('message','Thêm banner thành công');

	}
	public function edit(Request $request,$id){
		$locations = BannerLocation::latest()->get();

		$banner = Banner::whereId($id)->first();
		return view('admin.banner.edit', compact( 'banner', 'locations'));
	}
	public function update(Request $request){
		// dd($request);
		$request->validate([
            'id_location' => 'required',
            'unit_name' => 'required',
            'expire_date' => 'required',
            'file' => 'required',
        ], [
            'id_location.required' => 'Trang hiển thị không được để trống',
            'unit_name.required' => 'Tên đơn vị sử dụng không được để trống',
            'expire_date.required' => 'Hạn sử dụng không được để trống',
            'file.required' => 'File ảnh không được để trống',
        ]);
		$banner = Banner::whereId($request->id)->first();

		$banner->update([
			'id_location'=> $request->id_location,
			'position' => $request->position,
			'unit_name' => $request->unit_name,
			'expire_date' => $request->expire_date,
			'file' => $request->file,
			'link' => $request->link,
		]);

		$admin = auth('admin')->user();

		$this->logController->createLog($admin, 'Banner', 'Sửa', 'banner cho đơn vị '. $request->unit_name, route('admin.banner.edit',$banner->id ));

		return redirect()->back()->with('message','Cập nhật banner thành công');

	}

	public function changeStatus(Request $request){
		$banner = Banner::whereId($request->id)->first();
		if($banner->status == 1){
			$banner->status = 0;
		}else{
			$banner->status = 1;
		}
		$banner->save();
		return back();
	}
	
	public function delete(Request $request){
		$banner = Banner::whereId($request->id)->first();
		$banner->delete();
		return redirect()->route('admin.banner.index')->with('message','Xóa banner thành công');
	}

}
