<?php
if (!function_exists("permission")) {
    function permissionManager($user, $post)
    {
        if ($post->status==1||$post->status==2){
            return true;
        }
        return false;
    }
}
