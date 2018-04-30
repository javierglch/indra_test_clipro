<?php

if(!function_exists('get_user')){
    function get_user(){
        return get_instance()->usersession;
    }
}
