<?php

namespace App\Admin\Traits;
use Illuminate\Support\Facades\DB;
use App\Admin\Traits\calculatorWeight;

trait calculatorTranspotCmart {
    use calculatorWeight;
    public function calculator($weight, $height, $width, $length, $quantity) {
        $total_weight = $this->calculatorWeight($weight, $height, $width, $length, $quantity);
        
        return $total_weight;
    }
}