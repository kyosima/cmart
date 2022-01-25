<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointC extends Model
{
    protected $table = 'point_c';
    protected $guarded =[];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getHistoryChuyenKhoan(){
        return $this->hasMany(PointCHistory::class, 'point_c_idnhan', 'id');
    }

    public function getTienGiam(){
        return $this->hasMany(PointCHistory::class, 'point_c_idchuyen', 'id');
    }
}
