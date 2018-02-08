<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 11:49
 */
namespace models;
use core\base\Model;

class User extends Model
{
    public static $tableName  = 'users';
    public static $curUser;
    protected $attributes = array(
        'login'=>'',
        'password'=>'',
        'guid'=>''
    );


    public function getCurUser(){
        if (!empty($_SESSION['USER'])) {
            return  true;
        }else{
            $users = User::findAll();
            foreach ($users as $user){
                if ($_POST['userName'] == $user->login && password_verify($_POST['password'], $user->password)){
                    $_SESSION['USER'] = $_POST['userName'];
                    self::$curUser = $user;
                    return true;
                }
            }
            return false;
        }
    }
}