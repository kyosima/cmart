<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointCHistory extends Model
{
    protected $table = 'point_history';
    protected $guarded =[];
    
    public function getViPointChuyenKhoan(){
        return $this->belongsTo(PointC::class, 'point_c_idnhan', 'id');
    }

    public function getName() {
        return $this->hasOne(User::class, 'point_c_idchuyen', 'id');
    }
}
