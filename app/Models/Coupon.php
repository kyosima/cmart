<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    public $timestamps = false;

    protected $guarded = [];

    public function promo()
    {
        return $this->hasOne(CouponPromo::class, 'id_ofcoupon', 'id');
    }
}
