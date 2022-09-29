<?php

namespace App\Admin\Traits;
use App\Models\Province;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

trait getListProvinceTrait {
    function getListProvincebyId($province_id, $province){
        $provinces = Province::select('matinhthanh', 'tentinhthanh')->where('matinhthanh', '<>', $province->matinhthanh)->whereNotIn('matinhthanh',$province->transpot_variations->pluck('transpot_to')->toArray())->orderBy('matinhthanh', 'asc')->get();
        return $provinces;
    }
}