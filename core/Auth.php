<?php

namespace Core;

use Models\User;

class Auth
{

    public static function user(){
        if(isset($_SESSION['user'])) return User::with('role')->where('id',json_decode($_SESSION['user'])->id)->first();
        if(!isset($_SESSION['user'])) return (object)[];
    }

    public static function check(){
        if(isset($_SESSION['user'])) return true;
        if(!isset($_SESSION['user'])) return false;
    }
}