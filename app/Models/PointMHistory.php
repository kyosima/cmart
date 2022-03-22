<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointMHistory extends Model
{
    protected $table = 'point_m_history';
    protected $guarded =[];

    public function point_m(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }
}
