<?php

namespace App\Exports;

use App\Models\User;
use App\Models\PointCHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;

class TietKiem implements FromView
{
    use Exportable;

    public function view(): View
    {
        $listHistory = PointCHistory::where('type','=',3)->get();
        return view('admin.export.tietkiem',[
            'users' => User::all(),
            'listHistory' => $listHistory,
        ]);
    }
}
