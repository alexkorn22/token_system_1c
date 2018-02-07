<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 16.11.2017
 * Time: 13:04
 */

namespace controllers\admin;

use core\Router;
use models\Test;

class MainController extends AppController
{
    public function indexAction()
    {
        $this->route['controller']='Test';
        $test = new UserController($this->route);
        $test->indexAction();
        $test->getView();
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
        unset($_SESSION['USER']);
        $this->redirect('\admin');
    }


}
