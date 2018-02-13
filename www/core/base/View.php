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

        if($this->layout !== false){
            if(file_exists($layoutFile)){ // check if layout not false
                $content = $this->renderView($this->view,$vars);
                require_once($layoutFile);
            }else{
                echo "Failed to require the layout..";
            }
        }else{
            echo $this->renderView($this->view,$vars);
        }
    }

    public function renderView($view,$vars){
        extract($vars);
        $this->view = $view;
        $view_name  = $this->getPathView();
        ob_start();
        require_once ($view_name);
        return ob_get_clean() ;
    }


    protected function getPathView(){
        $view_name = DIR_VIEW."/".$this->route['prefix'].$this->route['controller']."/".$this->view.".php" ;
        $view_name = str_replace("\\","/",$view_name);
        return $view_name;
    }

}