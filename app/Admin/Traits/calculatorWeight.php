<?php

namespace App\Admin\Traits;
use Illuminate\Support\Facades\DB;

trait calculatorWeight {
    public function calculatorWeight($weight, $height, $width, $length, $quantity) {
        $weight = ceil(max($weight / 1000, (($height * $width * $length) / 3000)) * 1000);
        return $weight * $quantity;
    }
}