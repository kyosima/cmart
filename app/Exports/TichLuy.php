<?php

namespace App\Exports;

use App\Models\User;
use App\Models\PointCHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TichLuy implements FromView
{
    use Exportable;

    public function view(): View
    {
        $listHistory = PointCHistory::where('type','=',2)->get();
        return view('admin.export.tichluy',[
            'users' => User::all(),
            'listHistory' => $listHistory,
        ]);
    }
}
