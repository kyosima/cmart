<?php

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 0, '.', ',') . ' ₫';
    }
}


if (!function_exists('formatPriceOfLevel')) {
    function formatPriceOfLevel($product)
    {
        return number_format(getPriceOfLevel($product), 0, '.', ',') . ' ₫';
    }
}

if (!function_exists('getTagSale')) {
    function getTagSale($product){
        if (Auth::check()) {
            $user = Auth::user();
            if (($product->productPrice->shock_price != null || $product->productPrice->shock_price != 0) && ($user->level == 1)){
                $percent = (1 - ($product->productPrice->shock_price/$product->productPrice->regular_price))*100;
                $html='<div class="block-sale">
                    <img alt="" src="'. asset('public/image/bg-sale.png') .'">
                    <span class="sale">-'.round($percent).'%</span>
                </div>';
                return $html;
            }else{
                return null;
            }
        }
    }
}
if (!function_exists('getPriceOfLevel')) {
    function getPriceOfLevel($product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if($user->level ==0){
                return $product->productPrice()->value('regular_price');
            }else{
                return $product->productPrice()->value('shock_price');
            }
        }else{
            return $product->productPrice()->value('regular_price');
        }
    }
}

if (!function_exists('permissionOfRole')) {
}
if (!function_exists('helper')) {
    
    function permissionOfRole($data){
        $str = '';
        foreach ($data as $value){
            if($value->name == 'All Permissions'){
                return '<span class="badge bg-primary">All Permissions</span>'; 
            }
            $str .= '<span class="badge bg-primary me-1">'.$value->name.'</span>';
        }
        return $str;
    }
    function checkRoleHasPermissions($role, $permissionName){
        if($role->hasPermissionTo($permissionName)){
            return 'selected';
        }
    }
    function checkAdminHasRole($admin, $RoleName){
        if($admin->hasRole($RoleName)){
            return 'selected';
        }
    }
    function showRolesOfAdmin($data){
        $str = '';
        foreach ($data as $value){
            $str .= '<span class="badge bg-primary me-1">'.$value.'</span>';
        }
        return $str;
    }

    function showAdminWithRoles($data){
        $str = '';
        foreach ($data as $value){
            $str .= '<span class="badge bg-primary me-1">'.$value->name.'</span>';
        }
        return $str;
    }

    function orderStatus($status){
        if($status == 0){
            return '<span class="text-primary status-order">Đã đặt hàng</span>';
        }elseif($status == 1){
            return '<span class="text-info status-order">Đã xác nhận thanh toán</span>';
        }elseif($status == 2){
            return '<span class="text-info status-order">Đang xử lý</span>';
        }elseif($status == 3){
            return '<span class="text-info status-order">Đang vận chuyển</span>';
        }elseif($status == 4){
            return '<span class="text-success status-order">Hoàn thành</span>';
        }else{
            return '<span class="text-danger status-order">Đã hủy</span>';
        }
    }

    function orderStatusOtion($status){
        $array = array('Đã đặt hàng', 'Đã xác nhận thanh toán', 'Đang xử lý', 'Đang vận chuyển', 'Hoàn thành', 'Đã hủy');
        $string = '';
        foreach($array as $key => $value){
            $selected = '';
            if($key == $status){
                $selected = 'selected';
            }
            $string .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
        }
        return $string;
    }
    function selected($value1, $value2){
        if($value1 == $value2){
            return 'selected';
        }
        return;
    }

    function checked($value1, $value2){
        if($value1 == $value2){
            return 'checked';
        }
        return;
    }

    function typeInfoCompany($value){
        $type = config('custom-config.page.type');
        return $type[$value];
    }

}
