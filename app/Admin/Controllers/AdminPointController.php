<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HistoryPoint;
use App\Models\User;
use App\Http\Controllers\HistoryPointController;
use App\Models\RememberC;
use Aws\History;
use Symfony\Polyfill\Intl\Idn\Resources\unidata\Regex;

class AdminPointController extends Controller
{
    //

    public function postDeposit(Request $request){
        $cmart =  User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        $cmart_wallet->point_c += $request->amount;
        $cmart_wallet->save();
        return back()->with('message', 'Nạp C thành công');
    }
    public function getStatisticalAccount(Request $request)
    {
        $cmart =  User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        if ($request->has('time_start') && $request->has('time_end')) {
            $time_start = $request->time_start;
            $time_end = $request->time_end;
            if ($time_start == null) {
                $time_start = date('2000-01-01 00:00:00');
            }
            if ($time_end == null) {
                $time_end = date('Y-m-d H:i:s');
            }
            $cmart_wallet_histories = RememberC::whereUserId($cmart->id)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->latest()->get();
            $total_increa = HistoryPoint::whereType(1)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea = HistoryPoint::whereIn('type', [2, 3, 4, 5])->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea_transfer = HistoryPoint::whereType(2)->whereIn('method', [1, 2])->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea_saving = HistoryPoint::whereType(4)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea_accummulation_c = HistoryPoint::whereType(3)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea_accummulation_m = HistoryPoint::whereType(5)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->sum('amount');
            $total_decrea_cancel_order = HistoryPoint::whereType(2)->where('created_at', '>', date('Y-m-d H:i:s', strtotime($time_start)))->where('created_at', '<', date('Y-m-d H:i:s', strtotime($time_end)))->whereMethod(3)->sum('amount');
        } else {
            $cmart_wallet_histories = RememberC::whereUserId($cmart->id)->latest()->get();
            $total_increa = HistoryPoint::whereType(1)->sum('amount');
            $total_decrea = HistoryPoint::whereIn('type', [2, 3, 4, 5])->sum('amount');
            $total_decrea_transfer = HistoryPoint::whereType(2)->whereIn('method', [1, 2])->sum('amount');
            $total_decrea_saving = HistoryPoint::whereType(4)->sum('amount');
            $total_decrea_accummulation_c = HistoryPoint::whereType(3)->sum('amount');
            $total_decrea_accummulation_m = HistoryPoint::whereType(5)->sum('amount');
            $total_decrea_cancel_order = HistoryPoint::whereType(2)->whereMethod(3)->sum('amount');
        }

        if ($request->has('time_start') && $request->has('time_end')) {
            return view(
                'admin.point.statistical_account',
                compact('time_start', 'time_end','cmart_wallet', 'cmart_wallet_histories', 'total_increa', 'total_decrea', 'total_decrea_transfer', 'total_decrea_saving', 'total_decrea_accummulation_c', 'total_decrea_accummulation_m', 'total_decrea_cancel_order')
            );
        } else {
            return view(
                'admin.point.statistical_account',
                compact('cmart_wallet', 'cmart_wallet_histories', 'total_increa', 'total_decrea', 'total_decrea_transfer', 'total_decrea_saving', 'total_decrea_accummulation_c', 'total_decrea_accummulation_m', 'total_decrea_cancel_order')
            );
        }
    }
    public function getStatistical(Request $request)
    {
        $users = User::orderBy('id', 'asc')->get();
        return view('admin.point.statistical', compact('users'));
    }

    public function getHistorySaving(Request $request)
    {
        $histories = HistoryPoint::whereType(4)->latest()->get();
        return view('admin.history.saving', compact('histories'));
    }

    public function getTransfer(Request $request)
    {
        $cmart = User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        return view('admin.point.transfer', compact('cmart_wallet'));
    }

    public function getHistoryAccumulationM(Request $request)
    {
        $histories = HistoryPoint::whereType(5)->latest()->get();
        return view('admin.history.accumulation_m', compact('histories'));
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
        $histories = HistoryPoint::whereType(2)->whereIn('method', [1, 2])->latest()->get();
        return view('admin.history.transfer', compact('histories'));
    }
    public function getHistoryRefund(Request $request)
    {
        $histories = HistoryPoint::whereType(2)->whereMethod(3)->latest()->get();
        return view('admin.history.refund', compact('histories'));
    }
}
