<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 14.11.2017
 * Time: 13:16
 */

namespace controllers;

use Couchbase\UserSettings;
use models\User;

class UserController extends AppController
{
    public function loginAction(){
        $title = "Log in page..";
        if(isset($_POST['login'])){
            $user = User::findByLogin($_POST['login']);
            if($user){
                if(password_verify($_POST['password'], $user->password)){
                    $_SESSION['USER_ID'] = $user->id;
                    $this->curUser = $user ;
                    $this->redirect('/main');
                }
            }
        }

        $this->setVars(compact('title'));
    }

    public function logoutAction()
    {
        unset( $_SESSION['USER_ID']);
        $this->redirect('\main');
    }

}