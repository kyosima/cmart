<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RememberC extends Model
{
    protected $table = 'remember_c';
    protected $guarded =[];
    protected $fillable = [
        'balance',
        'user_id'
    ];
}
