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

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders() {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }
    public function user_info(){
        return $this->hasOne(UserInfo::class, 'user_id', 'id');
    }
    public function getstoreAddress(){
        return $this->hasMany(StoreAddress::class, 'id_user', 'id');
    }

    public function point_c() {
        return $this->hasOne(PointC::class, 'user_id', 'id');
    }
    public function historyCpoints() {
        return $this->hasMany(PointCHistory::class, 'point_c_idchuyen', 'id');
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
}
