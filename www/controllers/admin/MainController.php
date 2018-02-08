<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 16.11.2017
 * Time: 13:04
 */

namespace controllers\admin;

use core\Router;

class MainController extends AppController
{
    public function indexAction()
    {
         $this->route['controller']='Main';
         $this->route['action']='index';
         $user = new UserController($this->route);
         $user->getView();
         $this->layout = false;
    }


    public function loginAction()
    {
        $this->view = 'login';
        $title = "Log in page..";
        $this->setVars(compact('title'));
    }

    public function logoutAction()
    {
        unset($_SESSION['ADMIN']);
        $this->redirect('\admin');
    }


}
