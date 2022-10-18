<?php

if(!function_exists('showImageWithError')){
    function showImageWithError($img){
        if (file_exists(asset($img))){
            return asset($img);
        }
        else{
            return asset(config('custom-config.default-image'));
        }
    }
}



if (!function_exists('getFeeProductShipping')) {
    function getFeeProductShipping($user, $price)
    {
        $fee = [];
        switch ($user->level){
            case 0:
                $fee = [
                    $price->c_ship_price_df0,
                    $price->c_ship_price_weight0, 
                    $price->c_ship_fast_price_df0, 
                    $price->c_ship_fast_price_weight0, 
                    $price->c_ship_fast_price_distance0,
                ];
                break;
            case 1:
                $fee = [
                    $price->c_ship_price_df1,
                    $price->c_ship_price_weight1, 
                    $price->c_ship_fast_price_df1, 
                    $price->c_ship_fast_price_weight1, 
                    $price->c_ship_fast_price_distance1,
                ];
                break;
            case 2:
                $fee = [
                    $price->c_ship_price_df2,
                    $price->c_ship_price_weight2, 
                    $price->c_ship_fast_price_df2, 
                    $price->c_ship_fast_price_weight2, 
                    $price->c_ship_fast_price_distance2,
                ];
                break;
            case 3:
                $fee = [
                    $price->c_ship_price_df2,
                    $price->c_ship_price_weight2, 
                    $price->c_ship_fast_price_df2, 
                    $price->c_ship_fast_price_weight2, 
                    $price->c_ship_fast_price_distance2,
                ];
                break;
            case 4:
                $fee = [
                    $price->c_ship_price_df3,
                    $price->c_ship_price_weight3, 
                    $price->c_ship_fast_price_df3, 
                    $price->c_ship_fast_price_weight3, 
                    $price->c_ship_fast_price_distance3,
                ];
                break;
        }
        return $fee;
    }
}

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 0, ',', '.') . ' ₫';
    }
}
if (!function_exists('formatNumber')) {
    function formatNumber($number)
    {
        return number_format($number, 0, ',', '.');
    }
}
if (!function_exists('formatPriceAdmin')) {
    function formatPriceAdmin($price)
    {
        return number_format($price, 0, ',', '.');
    }
}
if (!function_exists('formatMethod')) {
    function formatMethod($method)
    {
        switch ($method) {
            case 0:
                return 'C-Mart';
            case 1:
                return 'C-Ship';
            case 2:
                return 'Viettel Post';
        }
    }
}
if (!function_exists('formatType')) {
    function formatType($type)
    {
        switch ($type) {
            case 0:
                return 'Nhận tại cửa hàng';
            case 1:
                return 'Tiêu chuẩn';
            case 2:
                return 'Hỏa tốc';
        }
    }
}
if (!function_exists('formatTypeCoupon')) {
    function formatTypeCoupon($coupon)
    {
        switch ($coupon->type) {
            case 0:
                if($coupon->target == 0){
                    return 'Giảm giá theo định danh KH';
                }else{
                    return 'Giảm giá theo mã KH';
                }
            case 1:
                return 'Giảm giá theo sản phẩm';
            case 2:
                return 'Giảm giá theo danh mục sản phẩm';
        }
    }
}
if (!function_exists('formatLevel')) {
    function formatLevel($level)
    {
        switch ($level) {
            case 1:
                return 'Khách hàng thân thiết';
            case 2:
                return 'Khách hàng V.I.P';
            case 3:
                return 'Cộng tác viên';
            case 4:
                return 'Purchasing';
            case 5:
                return 'Khách hàng thương mại';
        }
    }
}

if(!function_exists('formatNumber')){
    function formatNumber($number){
        return number_format($number, 0, ',', '.') ;
    }
}
if (!function_exists('formatPriceWithType')) {

        function formatPriceWithType($price, $product_type)
        {
            if($product_type == 0){
                return number_format($price, 0, ',', '.') . ' ₫';
            }else{
                return number_format($price, 0, ',', '.') . ' %';
            }
        }
}
if (!function_exists('formatCurrency')) {

    function formatCurrency($price)
    {
            return number_format($price, 0, ',', '.') . ' ₫';
      
    }
}

if (!function_exists('formatPriceWithVariation')) {

    function formatPriceWithVariation($product)
    {
     

        if($product->is_variation == 0){
            return '<span class="price-number">'.formatPriceWithType($product->product_price->product_price_details[0]->price, $product->is_ecard).'</span>';
        }else{
            $min = $product->product_variations[0]->product_price_details[0]->price;
            foreach($product->product_variations as $variation){
            
                if($min > $variation->product_price_details[0]->price){
                    $min = $variation->product_price_details[0]->price;
                }
            }
            return 'Từ <span class="price-number">'.formatPriceWithType($min, $product->is_ecard).'</span>';

        }
    }
}

if (!function_exists('formatPriceOfLevelVariation')) {
    function formatPriceOfLevelVariation($variation,$product)
    {
        if($product->productPrice->price_type == 1){
            return number_format(getPriceOfLevelVariation($variation), 0, ',', '.') . ' ₫';
        }else{
            return number_format(getPriceOfLevelVariation($variation), 0, ',', '.') . ' %';
        }
    }
}

if (!function_exists('getCountCart')) {
    function getCountCart()
    {
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
            $carts =  $user->carts()->with('cart_item')->get();
            return ($carts->pluck('cart_item')->flatten()->sum('quantity'));
        }else{
            return 0;
        }
        return 0;
    }
}
if (!function_exists('getTagSale')) {
    function getTagSale($product)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if (($product->productPrice->shock_price != null || $product->productPrice->shock_price != 0) && ($user->level == 1)) {
                $percent = (1 - ($product->productPrice->shock_price / $product->productPrice->regular_price)) * 100;
                $html = '<div class="block-sale">
                    <img alt="" src="' . asset('public/image/bg-sale.png') . '">
                    <span class="sale">-' . round($percent) . '%</span>
                </div>';
                return $html;
            } else {
                return null;
            }
        }
    }
}
if (!function_exists('getTaxValue')) {
    function getTaxValue($tax)
    {
        if ($tax == 'KKK' || $tax == 'KTT') {
            return 0;
        } else {
            return $tax;
        }
    }
}

if (!function_exists('formatTax')) {
    function formatTax($tax)
    {
        if ($tax == 'KKK' || $tax == 'KTT') {
            return $tax;
        } else {
            return ($tax * 100) . '%';
        }
    }
}

if (!function_exists('formatStatusEkyc')) {
    function formatStatusEkyc($is_ekyc)
    {
        if ($is_ekyc == 0) {
            return '<span class="text-secondary">Chưa xác minh</span>';
        } else {
            return '<span class="text-success">Đã xác minh</span>';
        }
    }
}
if (!function_exists('formatStatusEcontract')) {
    function formatStatusEcontract($is_econtract)
    {
        if ($is_econtract == 0) {
            return '<span class="text-secondary">Chưa ký</span>';
        } else {
            return '<span class="text-success">Đã ký</span>';
        }
    }
}

if (!function_exists('getPriceOfLevelVariation')) {
    function getPriceOfLevelVariation($variation)
    {
        if (Auth::gcheck()) {
            $user = Auth::user();
            switch ($user->level) {
                case 0:
                    return $variation->price_retail;
                case 1:
                    return $variation->price_shock;

                case 2:
                    return $variation->price_shock;

                case 3:
                    return $variation->price_purchase;

                case 4:
                    return $variation->price_wholesale;

                default:
                    return $variation->price_retail;

            }
        } else {
            return $variation->price_retail;

        }
    }
}

if (!function_exists('formatPriceOfLevelCate')) {
    function formatPriceOfLevelCate($item)
    {
        return number_format(getPriceOfLevelCate($item), 0, ',', '.') . ' ₫';
    }
}

if (!function_exists('getPriceOfLevelCate')) {
    function getPriceOfLevelCate($item)
    {
        if (Auth::check()) {
            $user = Auth::user();
            switch ($user->level) {
                case 0:
                    return $item->regular_price;
                case 1:
                    return $item->shock_price;
                case 2:
                    return $item->shock_price;
                case 3:
                    return $item->price;
                case 4:
                    return $item->wholesale_price;
                default:
                    return $item->regular_price;
            }
        } else {

            return $item->regular_price;
        }
    }
}

if (!function_exists('permissionOfRole')) {
}
if (!function_exists('helper')) {

    function permissionOfRole($data)
    {
        $str = '';
        foreach ($data as $value) {
            if ($value->name == 'All Permissions') {
                return '<span class="badge bg-primary">All Permissions</span>';
            }
            $str .= '<span class="badge bg-primary me-1">' . $value->name . '</span>';
        }
        return $str;
    }
    function checkRoleHasPermissions($role, $permissionName)
    {
        if ($role->hasPermissionTo($permissionName)) {
            return 'selected';
        }
    }
    function checkAdminHasRole($admin, $RoleName)
    {
        if ($admin->hasRole($RoleName)) {
            return 'selected';
        }
    }
    function checkAdminHasPermissionTo($admin, $PermissionName)
    {
        if ($admin->hasPermissionTo($PermissionName)) {
            return 'selected';
        }
    }
    function showRolesOfAdmin($data)
    {
        $str = '';
        foreach ($data as $value) {
            $str .= '<span class="badge bg-primary me-1">' . $value . '</span>';
        }
        return $str;
    }

    function showAdminWithRoles($data)
    {
        $str = '';
        foreach ($data as $value) {
            $str .= '<span class="badge bg-primary me-1">' . $value->name . '</span>';
    
        }
        return $str;
    }
    function showAdminWithPermission($data)
    {
        $str = '';
        foreach ($data as $value) {
            $str .= '<span class="badge bg-primary me-1">' . $value->name . '</span>';
        }
        return $str;
    }

    function orderStatus($status)
    {
        if ($status == 0) {
            return '<span class="text-primary status-order">Đã đặt hàng</span>';
        } elseif ($status == 1) {
            return '<span class="text-info status-order">Đã xác nhận thanh toán</span>';
        } elseif ($status == 2) {
            return '<span class="text-info status-order">Đang xử lý</span>';
        } elseif ($status == 3) {
            return '<span class="text-info status-order">Đang vận chuyển</span>';
        } elseif ($status == 4) {
            return '<span class="text-success status-order">Hoàn thành</span>';
        } else {
            return '<span class="text-danger status-order">Đã hủy</span>';
        }
    }
    function getTypePage($type){
        if ($type == 'introduce') {
            return 'giới thiệu';
        } elseif ($type == 'policy') {
            return 'chính sách';
        
        } elseif ($type == 'service') {
            return 'dịch vụ';
        } 
    }
    function getPositionBanner($position){
        if ($position == 0) {
            return 'slider';
        } elseif ($position == 1) {
            return 'bên trái trang';
        
        } elseif ($position == 2) {
            return 'bên phải trang';
        } 
    }
    function orderStatusSimple($status)
    {
        if ($status == 0) {
            return 'Đã đặt hàng';
        } elseif ($status == 1) {
            return 'Đã xác nhận thanh toán';
        } elseif ($status == 2) {
            return 'Đang xử lý';
        } elseif ($status == 3) {
            return 'Đang vận chuyển';
        } elseif ($status == 4) {
            return 'Hoàn thành';
        } else {
            return 'Đã hủy';
        }
    }

    function orderStatusOtion($status)
    {
        if ($status == 6) {
            $status = 5;
        }
        $array = array('Đã đặt hàng', 'Đã xác nhận thanh toán', 'Đang xử lý', 'Đang vận chuyển', 'Hoàn thành', 'Đã hủy');
        $string = '';
        foreach ($array as $key => $value) {
            $selected = '';
            if ($key == $status) {
                $selected = 'selected';
            }
            $string .= '<option value="' . $key . '" ' . $selected . '>' . $value . '</option>';
        }
        return $string;
    }
    function selected($value1, $value2)
    {
        if ($value1 == $value2) {
            return 'selected';
        }
        return;
    }

    function checked($value1, $value2)
    {
        if ($value1 == $value2) {
            return 'checked';
        }
        return;
    }

    function typeInfoCompany($value)
    {
        $type = config('custom-config.page.type');
        return $type[$value];
    }

    function typeBanner($value)
    {
        $type = config('custom-config.banner');
        return $type[$value];
    }
    function shippingMethodName($method)
    {
        return config('custom-config.shipping_method_name')[$method];
    }

    function shippingTypeName($type)
    {
        return config('custom-config.shipping_type_name')[$type];
    }
    function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
