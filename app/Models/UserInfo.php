<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_info';
    protected $guarded =[];
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function province() {
        return $this->belongsto(Province::class, 'province_id', 'matinhthanh');
    } 
	public function district() {
        return $this->belongsto(District::class, 'district_id', 'maquanhuyen');
    } 
	public function ward() {
        return $this->belongsto(Ward::class, 'ward_id', 'maphuongxa');
    } 
}
