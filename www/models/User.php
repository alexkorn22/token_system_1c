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
    public static $user;

    protected $attributes = array(
        'login'=>'',
        'password'=>'',
        'guid'=>''
    );


    public static function findByLogin($login){
        self::setDB();
        $sql = "SELECT * FROM " . static::$tableName;
        $sql .= " WHERE login= '" . $login . "' LIMIT 1";
        $result = self::$db->pdo->query($sql);
        $object = new static();
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(\PDO::FETCH_ASSOC)) {
                if (isset($row['id'])) {
                    $object->id = (int)$row['id'];
                }
                $object->load($row);
            }
        }

        return $object;
    }


    public static function getCurUser(){
        if(isset($_SESSION['USER_ID'])){
            $curUser = User::findOneById($_SESSION['USER_ID']);
            return $curUser;
        }
        return false;
    }

}