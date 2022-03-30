<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Traits\ajaxCustomerTrait;
use App\Models\Notice;
use App\Models\User;
use App\Models\UserNotice;
use Illuminate\Support\Str;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;
use App\Admin\Controllers\AdminLogController; 

class AdminNoticeController extends Controller
{
    //
    public $logController;

    public function __construct()
    {
        $this->logController = new AdminLogController();
    }
    use ajaxCustomerTrait;

    public function index(){
        $notices = Notice::latest()->get();
        return view('admin.notice.index', compact('notices'));
    }

    public function create(){
        return view('admin.notice.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'target' => 'required',
            'short_content' => 'required',
            'content' => 'required',
        ],[
            'title.required' => 'Tên thông báo không được để trống',
            'target.required' => 'Đối tượng nhận thông báo không được để trống',
            'short_content.required' => 'Nội dung ngắn không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ]);
        if($request->target == 1){
            $request->validate([
                'customers' => 'required',
            ],[
                'customers.required' => 'Danh sách khách hàng không được để trống',
            ]);
        }
        $notice = Notice::create([
            'title' => $request->title,
            'target' => $request->target,
            'slug' => Str::slug($request->title).date('d-m-Y-H-i-s'),
            'short_content' => $request->short_content,
            'content'=>$request->content,
            'method' => 1,
            'status' => $request->status,
        ]);
        if($request->target == 0 ){
            foreach(User::get() as $user){
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
            }
        }else{
            foreach($request->customers as $user_id){
                UserNotice::create([
                    'user_id'=>$user_id,
                    'notice_id'=>$notice->id,
                ]);
            }
        }
        $admin = auth()->guard('admin')->user();

        $this->logController->createLog($admin, 'Thông báo', 'Tạo', 'thông báo '.$notice->title, route('notice.edit', $notice->id));
        return redirect()->route('notice.edit', $notice->id)->with('message', 'Tạo thông báo thành công');
    }

    public function edit(Request $request){
        $notice = Notice::whereId($request->id)->first();
        $customers = $notice->users()->get();
        
        return view('admin.notice.edit',compact('notice', 'customers') );
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required',
            'target' => 'required',
            'short_content' => 'required',
            'content' => 'required',
        ],[
            'title.required' => 'Tên thông báo không được để trống',
            'target.required' => 'Đối tượng nhận thông báo không được để trống',
            'short_content.required' => 'Nội dung ngắn không được để trống',
            'content.required' => 'Nội dung không được để trống',
        ]);
        if($request->target == 1){
            $request->validate([
                'customers' => 'required',
            ],[
                'customers.required' => 'Danh sách khách hàng không được để trống',
            ]);
        }
        $notice = Notice::whereId( $id)->first();
        $message = '';
        if($notice->title != $request->title){
            $message .='tiêu đề: '.$notice->title.' -> '.$request->title.', ';
        }
        if($notice->short_content != $request->short_content){
            $message .='thay đổi nội dung ngắn, ';
        }
        if($notice->content != $request->content){
            $message .='thay đổi nội dung, ';
        }
        if($notice->status != $request->status){
            if($request->status == 1){
                $message .='trạng thái: ngừng -> hoạt động, ';

            }else{
                $message .='trạng thái: hoạt động -> ngừng, ';

            }
        }
        $notice->title = $request->title;
        $notice->target = $request->target;
        $notice->slug = Str::slug($request->title).date('d-m-Y-H-i-s').time();
        $notice->short_content = $request->short_content;
        $notice->content =$request->content;
        $notice->status = $request->status;
        $notice->save();
        $notice->getUserNotices()->delete();
        if($request->target == 0 ){
            foreach(User::get() as $user){
                
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
            }
            $message .='đối tượng: danh sách chỉ định -> tất cả';

        }else{
            foreach($request->customers as $user_id){
                UserNotice::create([
                    'user_id'=>$user_id,
                    'notice_id'=>$notice->id,
                ]);
            }
            $message .='đối tượng: tất cả -> danh sách chỉ định';

        }

        $admin = auth()->guard('admin')->user();
        $this->logController->createLog($admin, 'Thông báo', 'Sửa', $message, route('notice.edit', $notice->id));

        return redirect()->route('notice.edit', $notice->id)->with('message', 'Cập nhật thông báo thành công');
    }


    public function getUsers(Request $request)
    {
        return response()->json([
            'code' => 200,
            'data' => $this->ajaxGetCustomer($request->search)
        ]);
    }

    public function changeStatus(Request $request){
        $notice = Notice::whereId($request->id)->first();
        $admin = auth()->guard('admin')->user();

        if($notice->status == 1){
            $notice->status = 0; 
            $this->logController->createLog($admin, 'Thông báo', 'Ẩn', 'thông báo '.$notice->title, route('notice.edit', $notice->id));
    
        }else{
            $notice->status = 1;
            $this->logController->createLog($admin, 'Thông báo', 'Hiện', 'thông báo '.$notice->title, route('notice.edit', $notice->id));

        }

        $notice->save();
        $admin = auth()->guard('admin')->user();

        $this->logController->createLog($admin, 'Thông báo', 'Sửa', 'thông báo '.$notice->title, route('notice.edit', $notice->id));

        return back();
    }

    public function destroy(Request $request){
        $notice = Notice::whereId($request->id)->first();
        $notice->getUserNotices()->delete();
        $notice->delete();
        $admin = auth()->guard('admin')->user();

        $this->logController->createLog($admin, 'Thông báo', 'Xóa', 'thông báo '.$notice->title);

        return redirect()->route('notice.index');
    }

}
