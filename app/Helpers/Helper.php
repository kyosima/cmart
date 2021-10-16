<?php

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return number_format($price, 0, '.', ',') . ' ₫';
    }
}
?>
<?php 

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
}
