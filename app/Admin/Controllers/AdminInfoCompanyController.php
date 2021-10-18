<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InfoCompany;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class AdminInfoCompanyController extends Controller
{
    //

    public function index(){
        $page = InfoCompany::all();
        return view('admin.info_company.index', compact('page'));
    }
    public function create(){

        $type = config('custom-config.page.type');
        return view('admin.info_company.create', compact('type'));
        
    }

    public function store(Request $request){
        $this->validate($request, [
            'in_name' => 'required|max:255',
            'in_type' => 'required',
            'in_status' => 'required',
        ]);
        $info_company = InfoCompany::create([
            'name' => $request->in_name,
            'slug' => $this->createSlug($request->in_name),
            'content' => $request->description,
            'type' => $request->in_type,
            'status' => $request->in_status
        ]);
        Session::flash('success', 'Bạn đã thêm thành công !');
        return redirect()->route('info-company.edit', ['info_company' => $info_company->id]);
    }

    public function edit(InfoCompany $info_company){
        $type = config('custom-config.page.type');
        return view('admin.info_company.edit', compact('info_company', 'type'));
    }

    public function update(Request $request, InfoCompany $info_company){
        $this->validate($request, [
            'in_name' => 'required|max:255',
            'in_type' => 'required',
            'in_status' => 'required',
        ]);
        $info_company->update([
            'name' => $request->in_name,
            'slug' => $this->createSlug($request->in_name),
            'content' => $request->description,
            'type' => $request->in_type,
            'status' => $request->in_status,
            'updated_at' => Carbon::now()
        ]);
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
    public function delete(InfoCompany $info_company){
        $info_company->delete();
        return response('Thành công', 200);
    }
}

