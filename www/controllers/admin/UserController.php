<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 17.11.2017
 * Time: 11:38
 */

namespace controllers\admin;


use models\User;

class UserController extends AppController
{

    public function indexAction(){
        // now we want to show out all the tests:
        $title = "list of users";
        $users = User::findAll();
        $this->setVars(compact('title', 'users'));
    }


    public function deleteAction(){
        if (isset($_GET['test_id'])) {
            Test::deleteById($_GET['test_id']);
            $this->redirect("\admin");
        }
    }

    public function editAction(){

        $this->view ='form';
        $test_id = $_GET['test_id'];
        $test    = Test::findOneById($test_id);
        $action = "/admin/test/edit?test_id= ". $test->id ;
        $this->setVars(compact('test','action'));

        if(!empty($_POST)){
            $test = Test::findOneById($test_id);
            $test->load($_POST);
            $test->save();
            $this->redirect('\admin\test');
        }
    }


    public function addAction()
    {

        if(!empty($_POST)){
            $user = new User();
            $user->load($_POST);
            $user->save();
            $this->redirect('\admin\user');
        }
    }


}