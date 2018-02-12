<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 10.11.2017
 * Time: 9:47
 */
namespace core\base;
class View
{
    private $route =[];
    public  $layout;
    public  $view ;
    public $login;

    public function __construct($route,$view,$layout){
        $this->route = $route ;
        $this->layout = $layout;
        $this->view = $view;
    }

    public function render($vars){
        $layoutFile = DIR_VIEW."/".$this->layout.".php" ;
        $layoutFile = str_replace("\\","/",$layoutFile);
       // $this->vars = $vars;
        extract($vars);
        //extract gives you vars in the back ground so you can use them
        $view_name = $this->getPathView();
        if($this->layout !== false){
            if(file_exists($layoutFile)){ // check if layout not false
                ob_start();
                require_once ($view_name);
                $content = ob_get_clean();
                require_once($layoutFile);
            }else{
                echo "Failed to require the layout..";
            }
        }else{
            require_once ($view_name);
        }
    }

    public function renderView($view,$vars){
        // TODO привести к  одному вызову без дублирования (DONE)
        $this->view = $view;
        extract($vars);
        $view_name = $this->getPathView();
        require_once ($view_name);
    }


    public function getPathView(){
        $view_name = DIR_VIEW."/".$this->route['prefix'].$this->route['controller']."/".$this->view.".php" ;
        $view_name = str_replace("\\","/",$view_name);
        return $view_name;
    }

}