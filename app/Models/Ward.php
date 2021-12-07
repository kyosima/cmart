<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'ward';

    protected $guarded = [];

    public function getDistrictFromWard() {
        return $this->hasOne(District::class, 'maquanhuyen', 'maquanhuyen');
    }
}
