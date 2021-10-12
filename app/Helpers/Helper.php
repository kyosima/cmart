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
}