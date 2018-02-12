<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 09.11.2017
 * Time: 15:36
 */

namespace core\base;
use core\base\View;
use models\User;

abstract class Controller
{
    public $layout;
    public $objView;
    public $view; // set by class
    public $vars = [];
    public $route = [];

    public function __construct($route)
    {
        $this->layout = LAYOUT_DEFAULT;
        $this->route  = $route;
        $this->view   = $this->route['action'];
    }

    public function setVars($vars){
        //TODO не перезаписывать (DONE)
        if (!is_array($vars)) {
            return;
        }
        foreach ($vars as $key => $value) {
            $this->vars[$key] = $value;
        }
    }


    public function getView()
    {
        $this->objView = new View($this->route, $this->view, $this->layout);
        $this->objView->render($this->vars);
    }

    public function redirect($location){
        header("location: ".$location);
    }


}