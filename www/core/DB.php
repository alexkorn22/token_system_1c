<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 10.11.2017
 * Time: 16:22
 */
namespace core;
class DB
{
    protected static $instance; // where it saves object
    public $pdo; // our database handle !
    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
        // from config array. open connection PDO
        $db_params = require_once ROOT . "/config/db.php";

        try {
            $this->pdo = new \PDO("mysql:host=" . $db_params['DB_SERVER'] . ";dbname="
                . $db_params['DB_NAME'], $db_params['DB_USER'], $db_params['DB_PASS']);

            //echo "DB Connection Succeed..";
        } catch (PDOException $e) {
            echo "Connection failed " . $e->getMessage();
        }


    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    public static function getInstance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }


}

// model abstract /
// every model is a table
// in every model we save tablename


