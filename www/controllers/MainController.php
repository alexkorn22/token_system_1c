<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 09.11.2017
 * Time: 15:36
 */

namespace controllers;
use models\User;

class MainController extends AppController
{

    public function indexAction(){
        $user = new UserController($this->route);
        $user->getView();
    }

    public function hashPassAction(){
        $password = '123456';
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        debug($hashed_password,true);
    }


}