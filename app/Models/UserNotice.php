<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotice extends Model
{
    protected $table = 'user_notice';
    protected $guarded =[];
    protected $fillable = [
        'user_id',
        'notice_id',
        'is_read',
    ];
    
}
