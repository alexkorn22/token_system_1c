<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 11:49
 */
namespace models;
use core\base\Model;

class User extends Model {
    public static $tableName  = 'users';
    public static $user;

    protected $attributes = array(
        'login'=>'',
        'password'=>'',
        'guid'=>''
    );

    // TODO findOne() (DONE)

    public static function getCurUser(){
        if(isset($_SESSION['USER_ID'])){
            $curUser = User::findOneById($_SESSION['USER_ID']);
            // TODO check user (DONE)
            if($curUser){
                return $curUser;
            }
            return false;
        }
        return false;
    }

}