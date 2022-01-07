<?php

namespace App\Admin\Traits;

use App\Models\District;
use App\Models\Ward;
use Illuminate\Support\Facades\DB;

trait ajaxGetLocation {
    public function ajaxGetLocation($request)
    {
        $parentId = $request->parent;
        $type = $request->type;
        if($parentId && $type == 'city'){
            $location = District::where('matinhthanh', $parentId)->get();
        } else {
            $location = Ward::where('maquanhuyen', $parentId)->get();
        }
        return $location;
    }
}