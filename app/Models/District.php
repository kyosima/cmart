<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'district';

    protected $guarded = [];

    public function ward() {
        return $this->hasMany(Ward::class, 'maquanhuyen', 'maquanhuyen');
    }
    public function getProvinceFromDistrict() {
        return $this->hasOne(Province::class, 'matinhthanh', 'matinhthanh');
    }
}
