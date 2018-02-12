<?php

namespace controllers;


use core\base\Controller;
use models\User;


abstract class AppController extends Controller
{
    public $curUser;

    public function __construct($route){
        parent::__construct($route);
        $this->layout = LAYOUT_DEFAULT;
        $user = User::getCurUser();
        if(!$user){ // if not logged in redirect him
            if($route['controller']=='User' && $route['action']=='login'){
                return; // if this is the Main login so no need to redirect him !
            }
            $this->redirect("/user/login");
            die();
        }
        $this->curUser = $user;
        $login = $this->curUser->login ;
        $this->setVars(compact('login'));
    }

}