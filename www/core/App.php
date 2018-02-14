<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 13.02.2018
 * Time: 13:39
 */

namespace core;
use core\base\Model;
use models\User;

class App
{
    public static $user;
    public static $config;
    public static $db;

    public static function init(){
        App::$config = new Config();
        Model::setDB();
        App::$user  = User::getCurUser();
    }

}