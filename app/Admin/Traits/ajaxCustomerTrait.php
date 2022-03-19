<?php

namespace App\Admin\Traits;
use App\Models\User;
use Illuminate\Support\Facades\DB;

trait ajaxCustomerTrait {
    public function ajaxGetCustomer($search) {
        $users = User::where('hoten', 'LIKE', '%'.$search.'%')
            ->orWhere('code_customer', 'LIKE', '%'.$search.'%')
            ->orWhere('phone', 'LIKE', '%'.$search.'%')
            ->limit(25)
            ->get();
        return $users;
    }
}