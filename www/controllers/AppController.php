<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 16.11.2017
 * Time: 12:56
 */

namespace controllers;


use core\base\Controller;
use models\User;


abstract class AppController extends Controller
{
    public $curUser;

    public function __construct($route)
    {
        parent::__construct($route);
        $this->layout = LAYOUT_DEFAULT;

        if(empty($_SESSION['USER'])){ // if not logged in redirect him
            if($route['controller']=='User' && $route['action']=='login'){
                return; // if this is the Main login so no need to redirect him !
            }
            $this->redirect("/user/login");
            die();
        }
    }

}