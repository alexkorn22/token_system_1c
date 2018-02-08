<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 13:16
 */

namespace controllers;

use models\User;

class UserController extends AppController
{
    public function loginAction(){
        $this->view = 'login';
        $title = "Log in page..";
        $isAuth = $this->checkLoginData();
        if($isAuth){
            $this->redirect('/main');
        }
        $this->setVars(compact('title'));
    }

    public function logoutAction()
    {
        unset($_SESSION['USER']);
        $this->redirect('\main');
    }

    public function checkLoginData(){
        if (!empty($_SESSION['USER'])) {
            return true ;
        }else{
            $users = User::findAll();
            foreach ($users as $user){
                if ($_POST['userName'] == $user->login && password_verify($_POST['password'], $user->password)){
                    $_SESSION['USER'] = $_POST['userName'];
                    return true;
                }
            }
            return false;
        }
    }

}