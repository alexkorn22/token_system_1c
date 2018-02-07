<?php
/**
 * Date: 09.11.2017
 * Time: 13:19
 */

namespace core;
class Router
{
    public static $route = [
        'controller' => 'Main',
        'action' => 'index',
        'prefix' => ''
    ];

    public static function dispatch($url){
        $url      = preg_replace('~[&?]~','/',$url);
        $parseUrl = explode('/', trim($url, '/'));

        // check and redirect:
       self::serRoute($parseUrl);
       self::setNameControllerAction();

        $nameController = "controllers\\". self::$route['prefix'].self::$route['controller']."Controller";
       if(class_exists($nameController)){
           $controller = new $nameController(self::$route);
           // new object (the class file called)
           // to the construct of the abstract controller
       }else{
           echo "Class does not exist..<br/>";
           die();
       }

       $method = self::$route['action']."Action";
       if(method_exists($nameController,$method)){
           $controller->$method();
           //debug(self::$route);
          // debug($controller,true);
           $controller->getView();
       }else{
           echo "method does not exist..";
           die();
       }
    }

    public static function setNameControllerAction(){
        $edited_controller = ucwords(self::$route['controller'],'-');
        self::$route['controller'] = str_replace('-','',$edited_controller);
        $edited_action = ucwords(self::$route['action'],'-');
        $edited_action[0]= strtolower($edited_action[0]);
        self::$route['action'] = str_replace('-','',$edited_action);
    }

    public static function serRoute($parseUrl){
        if(sizeof($parseUrl)>0){
            if($parseUrl[0]=='admin'){
                self::$route['prefix']= $parseUrl[0]."\\";
                if(!empty($parseUrl[1])){
                    self::$route['controller'] = $parseUrl[1];
                }
                if(sizeof($parseUrl)>2){
                    self::$route['action']     = $parseUrl[2];
                }
            }else {
                if (!empty($parseUrl[0])) {
                    self::$route['controller'] = $parseUrl[0];
                }
                if (sizeof($parseUrl) > 1) {
                    self::$route['action'] = $parseUrl[1];
                }
            }
        }
    }
}// end of class

?>