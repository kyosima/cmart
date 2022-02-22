<?php

namespace App\Exports;

use App\Models\User;
use App\Models\PointC;
use App\Models\PointM;
use App\Models\PointCHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TongDiem implements FromView, ShouldAutoSize
{
    use Exportable;

    public function view(): View
    {
        $id = User::get('id')->toArray();
        $user = User::with('point_c.user')->find($id);
        $today = Carbon::today()->startOfDay();
        $tongpointnhan = PointC::with('getHistoryChuyenKhoan.getViPointChuyenKhoan')->find($id);
        $tienGiam = PointC::with('getTienGiam')->find($id);
        $tienViM = PointM::with('getViM')->find($id);

        return view('admin.export.tongdiem',[
            'user' => $user,
            'tongpointnhan'=>$tongpointnhan,
            'tienGiam'=>$tienGiam,
            'tienViM'=>$tienViM,
            'today'=>$today,
        ]);
    }
}
