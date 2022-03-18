<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table = 'notice';
    protected $guarded =[];
    protected $fillable = [
        'slug',
        'title',
        'short_content',
        'content',
        'target',
        'type',
        'author',
        'status',
    ];
    public function users(){
        return $this->belongsToMany(User::class, 'user_notice', 'notice_id')->withPivot(['is_read']);
    }
    
    public function getUserNotices(){
        return $this->hasMany(UserNotice::class, 'notice_id', 'id');
    }
}
