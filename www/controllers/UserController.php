<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 13:16
 */

namespace controllers;

class UserController extends AppController
{
    public function loginAction(){
        $this->view = 'login';
        $title = "Log in page..";
        $this->setVars(compact('title'));
    }

    public function logoutAction()
    {
        unset($_SESSION['USER']);
        $this->redirect('\Main');
    }

}