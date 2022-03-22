<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryPoint extends Model
{
    protected $table = 'history_point';
    protected $guarded =[];
    protected $fillable = [
        'user_id',
        'old_balance',
        'amount',
        'content',
        'method',
        'time',
        'type',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
