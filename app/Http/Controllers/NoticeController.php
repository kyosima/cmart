<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use App\Models\UserNotice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $notices = $user->notices()->whereStatus(1)->latest()->get();
        return view('notice.index', compact('notices'));
    }

    public function getNotice($slug){
        $user = Auth::user();
        $notice = Notice::whereSlug($slug)->first();
        $user->notices()->whereNoticeId($notice->id)->update(['is_read'=>1]);
        return view('notice.detail', compact('notice'));
    }

    public function createNotice($type, $user, $history= null, $order = null ){
        switch($type){
            case 1:
                $notice = Notice::create([
                    'title' => 'Hệ thống',
                    'slug' => 'thay-doi-dinh-danh-khach-hang'.date('d-m-Y-H-i-s'),
                    'short_content' => view('notice.template.changeLevel', ['user'=>$user])->render(),
                    'content' => view('notice.template.changeLevel', ['user'=>$user])->render(),
                    'target' => 1,
                    'type' => $type,
                    'method' => 0,
                    'author' => 0,
                    'status' => 1,
                ]);
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
                break;
            case 2:
                $notice = Notice::create([
                    'title' => 'Hệ thống',
                    'slug' => 'thay-doi-thong-tin'.date('d-m-Y-H-i-s'),
                    'short_content' => view('notice.template.changeInfo')->render(),
                    'content' => view('notice.template.changeInfo')->render(),
                    'target' => 1,
                    'type' => $type,
                    'method' => 0,
                    'author' => 0,
                    'status' => 1,
                ]);
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
                break;
            case 3:
                $notice = Notice::create([
                    'title' => 'Hệ thống',
                    'slug' => 'thay-doi-so-du-tien-tich-luy'.date('d-m-Y-H-i-s'),
                    'short_content' => view('notice.template.changePoint', ['history'=>$history])->render(),
                    'content' => view('notice.template.changePoint', ['history'=>$history])->render(),
                    'target' => 1,
                    'type' => $type,
                    'method' => 0,
                    'author' => 0,
                    'status' => 1,
                ]);
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
                break;
            case 4:
                $notice = Notice::create([
                    'title' => 'Hệ thống',
                    'slug' => 'thay-doi-trang-thai-don-hang'.date('d-m-Y-H-i-s'),
                    'short_content' => view('notice.template.changeOrder', ['order'=>$order])->render(),
                    'content' => view('notice.template.changeOrder', ['order'=>$order])->render(),
                    'target' => 1,
                    'type' => $type,
                    'method' => 0,
                    'author' => 0,
                    'status' => 1,
                ]);
                UserNotice::create([
                    'user_id'=>$user->id,
                    'notice_id'=>$notice->id,
                ]);
                break;
        }

    }
}
