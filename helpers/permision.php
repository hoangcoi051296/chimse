<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
if(!function_exists("is_permission")){
    function is_permission($permission){
        if(Auth::guard('manager')->check()){
            $manager =Auth::guard('manager')->user();
            $role =Role::find($manager->role_id);
            $allpermission=$role->permissions->pluck('slug')->all();
            if(in_array($permission,$allpermission)){
                return true;
            }
        }
        return false;
    }
}
