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
        $title = 'WeDo Support';
        $this->setVars(compact('title'));
    }
}