<?php

namespace App\Http\Controllers;

use App\Models\Notice;
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
}
