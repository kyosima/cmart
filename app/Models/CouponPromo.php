<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponPromo extends Model
{
    use HasFactory;

    protected $table = 'coupon_promo';


    protected $guarded = [];
}
