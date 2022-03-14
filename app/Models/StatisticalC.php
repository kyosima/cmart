<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatisticalC extends Model
{
    use HasFactory;
    protected $table = 'statistical_c';
    
    protected $guarded = [];

    protected $fillable = [
        'total'
    ];
}
