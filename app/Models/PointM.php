<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointM extends Model
{
    protected $table = 'point_m';
    protected $guarded =[];

    public function point_m(){
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function getViM(){
        return $this->hasMany(PointMHistory::class, 'id_vi', 'user_id');
    }
}
