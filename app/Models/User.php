<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $table = 'users';
    protected $guarded =[];

    public function user_level() {
        return $this->hasOne(UserLevel::class, 'id', 'level');
    }
    public function carts() {
        return $this->hasMany(Cart::class, 'user_id', 'id');
    }
    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function user_info(){
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }
    public function getstoreAddress(){
        return $this->hasMany(StoreAddress::class, 'id_user', 'id');
    }
    public function wallet() {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }
    public function company() {
        return $this->hasOne(UserCompany::class, 'id_user', 'id');
    }
    public function historyCpoints() {
        return $this->hasMany(PointCHistory::class, 'point_c_idchuyen', 'id');
    }
    public function request_ekyc(){
        return $this->hasMany(RequestEkyc::class, 'user_id', 'id');
    }
    public function getHistory(){
        return $this->hasMany(HistoryPoint::class, 'user_id', 'id');
    }
    public function getRememberC(){
        return $this->hasMany(RememberC::class, 'user_id', 'id');
    }

	// public function orders()
	// {
	// 	return $this->belongsToMany(Order::class, 'order_products', 'id_order', 'id_product')
	// 				->withPivot('id', 'quantity', 'price')
	// 				->withTimestamps();
	// }

    // public function cpoint_history()
	// {
	// 	return $this->hasMany(CPointHistory::class, 'user_id', 'id');
	// }
    public function notices(){
        return $this->belongsToMany(Notice::class, 'user_notice', 'user_id', 'notice_id')->withPivot(['is_read']);
    }
    // public function carts(){
    //     return $this->hasMany(Cart::class, 'user_id', 'id');
    // }



}
