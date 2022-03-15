<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryPoint;
use App\Models\User;
use App\Http\Controllers\HistoryPointController;

class AdminPointController extends Controller
{
    //

    public function getStatistical(Request $request){
        $users = User::orderBy('id', 'asc')->get();
        return view('admin.point.statistical', compact('users'));
    }

    public function getHistorySaving(Request $request){
        $histories = HistoryPoint::whereType(4)->latest()->get();
        return view('admin.history.saving', compact('histories'));
    }

    public function getTransfer(Request $request)
    {
        $cmart = User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        return view('admin.point.transfer', compact('cmart_wallet'));
    }

    public function postTransfer(Request $request)
    {
        $cmart = User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        $user = User::whereCodeCustomer($request->code_customer)->first();
        if (!$user) {
            return back()->with('message', 'Hồ sơ khách hàng không tồn tại');
        }
        $user_wallet = $user->point_c()->first();
        $historyPointController = new HistoryPointController();
        $historyPointController->createHistory($user, $request->amount, 2, null, $request->content, $request->method, $request->time);
        return back()->with('message', 'Chuyển khoản thành công');
    }
    public function getHistoryReceiverC(Request $request)
    {
        $histories = HistoryPoint::whereType(1)->latest()->get();
        return view('admin.history.receiver', compact('histories'));
    }

    public function getAccumulationC(Request $request)
    {
        $histories = HistoryPoint::whereType(3)->latest()->get();
        return view('admin.history.accumulation', compact('histories'));
    }
    public function getHistoryTransfer(Request $request)
    {
        $histories = HistoryPoint::whereType(2)->whereIn('method', [1,2])->latest()->get();
        return view('admin.history.transfer', compact('histories'));
    }
    public function getHistoryRefund(Request $request)
    {
        $histories = HistoryPoint::whereType(2)->whereMethod(3)->latest()->get();
        return view('admin.history.refund', compact('histories'));
    }
}
