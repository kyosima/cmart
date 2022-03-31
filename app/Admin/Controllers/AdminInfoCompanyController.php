<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoCompany;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Admin\Requests\StoreInfoCompanyRequest;
use App\Admin\Controllers\AdminLogController; 

class AdminInfoCompanyController extends Controller
{
    //  
    public $logController;
    public function __construct()
    {
        $this->logController = new AdminLogController();
    }

    public function index(){
        $page = InfoCompany::all();
        return view('admin.info_company.index', compact('page'));
    }
    public function create(){

        $type = config('custom-config.page.type');
        return view('admin.info_company.create', compact('type'));
        
    }

    public function store(StoreInfoCompanyRequest $request){
        $info_company = InfoCompany::create([
            'name' => $request->in_name,
            'slug' => $this->createSlug($request->in_name),
            'content' => $request->description,
            'type' => $request->in_type,
            'status' => $request->in_status,
            'sort' => $request->in_sort ? $request->in_sort : 0
        ]);
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Tạo trang đơn #'.$info_company->id);
        Session::flash('success', 'Bạn đã thêm thành công !');
        $ad = auth('admin')->user();
        $this->logController->createLog($ad, 'Dịch vụ và chính sách', 'Tạo', ' trang: '.$info_company->name, route('info-company.edit',$info_company));

        return redirect()->route('info-company.edit', ['info_company' => $info_company->id]);
        
    }

    public function edit(InfoCompany $info_company){
        $type = config('custom-config.page.type');
        return view('admin.info_company.edit', compact('info_company', 'type'));
    }

    public function update(StoreInfoCompanyRequest $request, InfoCompany $info_company){
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Cập nhật trang đơn #'.$info_company->id);
        $message = '';
        if($info_company->name != $request->in_name){
            $message .= 'tên: '.$info_company->name.' -> '.$request->in_name.', ';
        }
      
        if($info_company->content != $request->description){
            $message .= 'nội dung, ';
        }
        if($info_company->type != $request->in_type){
            $message .= 'loại: '.getTypePage($info_company->type).' -> '.getTypePage($request->in_type).' , ';
        }
        if($info_company->status != $request->in_status){
            if($request->in_status == 0){
                $message .= 'trạng thái: hoạt động -> ngưng, ';

            }else{
                $message .= 'trạng thái: ngưng -> hoạt động, ';

            }
        }
        if($info_company->sort != $request->in_sort){
            $message .= 'thứ tự: '.$info_company->sort.' -> '.$request->in_sort.', ';
        }
        $info_company->update([
            'name' => $request->in_name,
            'slug' => $this->createSlug($request->in_name, $info_company->id),
            'content' => $request->description,
            'type' => $request->in_type,
            'status' => $request->in_status,
            'sort' => $request->in_sort ? $request->in_sort : 0,
            'updated_at' => Carbon::now()
        ]);
        if($message != ''){
            $ad = auth('admin')->user();
            $this->logController->createLog($ad, 'Dịch vụ và chính sách', 'Sửa', substr_replace($message ,"", -1), route('info-company.edit',$info_company));
    
        }
      
        Session::flash('success', 'Bạn đã sửa thành công !');
        return back();
    }

    public function createSlug($title, $id = 0)
    {
        $slug = Str::slug($title);
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;
            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }
    protected function getRelatedSlugs($slug, $id = 0)
    {
        return InfoCompany::select('slug')->where('slug', 'like', $slug.'%')
        ->where('id', '<>', $id)
        ->get();
    }
    public function delete(Request $request, InfoCompany $info_company){
        $ad = auth('admin')->user();
        $this->logController->createLog($ad, 'Dịch vụ và chính sách', 'Xóa', ' trang: '.$info_company->name);

        $info_company->delete();
        Log::info('Admin '.auth()->guard('admin')->user()->name.' Xóa nhật trang đơn #'.$info_company->id);
        if ($request->isMethod('get')) {
            Session::flash('success', 'Thực hiện thành công');
            return redirect()->route('info-company.index');
        }
        return response('Thành công', 200);
    }

    public function multiple(Request $request){
        $this->validate($request, [
            'action' => 'required',
            'id' => 'required'
        ]);
        if($request->action == 'delete'){
            foreach($request->id as $value){
                InfoCompany::find($value)->delete();
            }
            Session::flash('success', 'Thực hiện thành công');
        }
        elseif($request->action == 'show'){
            InfoCompany::whereIn('id', $request->id)->update(['status' => 1]);
            Session::flash('success', 'Thực hiện thành công');
        }
        elseif($request->action == 'hidden'){
            InfoCompany::whereIn('id', $request->id)->update(['status' => 0]);
            Session::flash('success', 'Thực hiện thành công');
        }
        else{
            Session::flash('warning', 'Thực hiện không thành công');
        }
        return back();
    }
}

