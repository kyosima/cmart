<?php 

if (!function_exists('permissionOfRole')) {
    
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

