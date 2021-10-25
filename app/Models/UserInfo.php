<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'users_info';
    protected $guarded =[];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
