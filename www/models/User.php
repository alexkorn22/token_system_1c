<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 11:49
 */
namespace models;
use core\App;
use core\base\Model;

class User extends Model {
    public static $tableName  = 'users';

    protected $attributes = array(
        'login'=>'',
        'password'=>'',
        'guid'=>''
    );

    public static function getCurUser(){
        if(isset($_SESSION['USER_ID'])){
            $curUser = User::findOneById($_SESSION['USER_ID']);
            if($curUser){
                return $curUser;
            }
        }
        return new User;
    }

    public static function isGuest(){
        if(isset(App::$user->id)){
            return false; // not guest ( user )
        }
        return true; // guest
    }
}