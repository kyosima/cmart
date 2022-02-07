<?php

namespace App\Exports;

use App\Models\User;
use App\Models\PointCHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class ChuyenKhoan implements FromView
{
    use Exportable;

    public function view(): View
    {
        $listHistory = PointCHistory::where('type','=',1)->get();
        return view('admin.export.chuyenkhoan',[
            'users' => User::all(),
            'listHistory' => $listHistory,
        ]);
    }
}
