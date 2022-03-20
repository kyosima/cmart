<?php

namespace App\Admin\Traits;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;

trait ajaxCouponTrait {
    public function ajaxGetCoupon($search) {
        $coupons = Coupon::where('name', 'LIKE', '%'.$search.'%')
            ->orWhere('code', 'LIKE', '%'.$search.'%')
            ->limit(25)
            ->get();
        return $coupons;
    }
}