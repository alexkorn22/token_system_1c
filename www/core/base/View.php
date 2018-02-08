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
        if($this->layout !== false){
            if(file_exists($layoutFile)){ // check if layout not false
                ob_start();
                $view_name = DIR_VIEW."/".$this->route['prefix'].$this->route['controller']."/".$this->view.".php" ;
                $view_name = str_replace("\\","/",$view_name);
                require_once ($view_name);
                $content = ob_get_clean();
                require_once($layoutFile);
            }else{
                echo "Failed to require the layout..";
            }
        } else {
            $view_name = DIR_VIEW."/".$this->route['prefix'].$this->route['controller']."/".$this->view.".php" ;
            $view_name = str_replace("\\","/",$view_name);
            require_once ($view_name);
        }
    }

    public function getView($view,$vars){
        $this->view = $view;
        extract($vars);
        $view_name = DIR_VIEW."/".$this->route['prefix'].$this->route['controller']."/".$this->view.".php" ;
        $view_name = str_replace("\\","/",$view_name);
        require_once ($view_name);
    }
}