<?php

namespace App\Exports;

use App\Models\User;
use App\Models\PointCHistory;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\Support\Responsable;

class UsersExport implements FromView
{
    use Exportable;

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $listHistory = PointCHistory::where('type','=',3)->get();
        return view('admin.export.tietkiem',[
            'users' => User::all(),
            'listHistory' => $listHistory,
        ]);
    }
}
