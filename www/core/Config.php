<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 13.02.2018
 * Time: 14:33
 */

namespace core;


class Config
{
    public $data = [] ;

    public function __construct(){
        $config = include_once ROOT.'/config/config.php';
        if (!empty($config)) {
            foreach ($config as $key => $item) {
                $this->data[$key] = $item;
            }
        }
    }

    public function __get($name)
    {
        if(isset($this->data[$name])){
            return $this->data[$name];
        }
        return false;
    }

}