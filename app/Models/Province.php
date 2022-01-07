<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';

    protected $guarded = [];

    public function district() {
        return $this->hasMany(District::class, 'matinhthanh', 'matinhthanh');
    }
}
