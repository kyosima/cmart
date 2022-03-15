<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistoryPoint;
use App\Models\User;
use Aws\History;

class HistoryPointController extends Controller
{
    /* 1: nhận c 
     * 2: chuyển khoản c
     * 3: thanh toán tích lũy c 1: nhanh 2 giam 3 hoandonhuy
     * 4: thanh toán tiết kiệm c
     * 5: thanh toán tích lũy m
     */

    public function createHistory($user, $amount, $type, $status, $code, $method, $time)
    {
        $cmart = User::whereId(1)->first();
        $cmart_wallet = $cmart->point_c()->first();
        $user_wallet = $user->point_c()->first();
        $history = new HistoryPoint();

        $history->user_id = $user->id;
        $history->old_balance = $cmart_wallet->point_c;
        $history->amount = $amount;
        $history->type = $type;
        $history->status = $status;
        switch ($type) {
            case 1:
                $cmart_wallet->point_c += $amount;
                $user_wallet->point_c -= $amount;
                $history->content = 'Da thanh toan GD ' . $code;
                break;
            case 2:
                switch ($method) {
                    case 1:
                        $cmart_wallet->point_c -= $amount;
                        $user_wallet->point_c += $amount;
                        $history->content = $code;
                        $history->method = $method;
                        $history->status = 1;
                        break;
                    case 2:
                        $cmart_wallet->point_c -= $amount;
                        $history->content = $code;
                        $history->method = $method;
                        $history->time = $time;
                        $history->status = 0;
                        break;
                    case 3:
                        $cmart_wallet->point_c -= $amount;
                        $user_wallet->point_c += $amount;
                        $history->content = $code;
                        $history->method = $method;
                        $history->status = 1;
                        break;
                }
                break;
            case 3:
                $cmart_wallet->point_c -= $amount;
                $user_wallet->point_c += $amount;
                $history->content = 'Tich luy C ' . $code;
                break;
            case 4:
                $cmart_wallet->point_c -= $amount;
                $user_wallet->point_c += $amount;
                $history->content = 'Tiet kiem ngay '. Date('d/m/Y') .' tu TK '. $user->code_customer;
                break;
            case 6:
                $cmart_wallet->point_c -= $amount;
                $user_wallet->point_c += $amount;
                $history->content = 'Hoan GD ' . $code;
                break;
        }
        $history->save();
        $user_wallet->save();
        $cmart_wallet->save();
    }
}
