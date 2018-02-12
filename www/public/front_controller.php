<?php


use core\Router;

spl_autoload_register(function($classname){
// runs when you make a class
    $file_name = ROOT."/{$classname}.php";
    $file_name = str_replace('\\',"/",$file_name);
    if(file_exists($file_name)){
        require_once ($file_name);
    }
});

// sessions
session_start();


require_once ('../core/functions.php');

define('ROOT',$_SERVER["DOCUMENT_ROOT"]);
define('PUBLIC_PATH',$_SERVER["DOCUMENT_ROOT"]."/public");
define('DIR_VIEW',ROOT."/views");
define('LAYOUT_DEFAULT','layout');
define('LAYOUT_ADMIN_DEFAULT','layoutAdmin');
define('IMAGE_DATA_PATH',"/images/data");
define('DIR_IMAGES_DATA',ROOT."/public".IMAGE_DATA_PATH);
define('TICKETS_URL','http://artorg.ddns.net:8899/ArtorgWork20/odata/standard.odata/Document_ОбращенияКлиентов');


$url = $_SERVER['REQUEST_URI'];
Router::dispatch($url);

// todo : Дублирование и путь лучше хранить в параметрах (DONE)



?>