<?php
/**
 * Created by PhpStorm.
 * User: amarz
 * Date: 16.11.2017
 * Time: 12:56
 */

namespace controllers\admin;

use core\base\Controller;

abstract class AppController extends Controller
{
    protected $isAdmin = false;

    public function __construct($route)
    {
        $adminData = require_once ROOT . "/config/config.php";
        parent::__construct($route);
        $this->layout = LAYOUT_ADMIN_DEFAULT;
        if(!$this->checkLogin($adminData['admins'])){ // if not logged in redirect him
            if($route['controller']=='Main' && $route['action']=='login'){
                return; // if this is the Main login so no need to redirect him !
            }
            $this->redirect("/admin/Main/login");
        }
        if($route['controller']=='Main' && $route['action']=='login'){
            $this->redirect("/admin/Main/index");
        }
    }

    public function checkLogin($adminData)
    {
        if (!empty($_SESSION['ADMIN'])) {
            return true;
        } else {
            if ($_POST['userName'] == $adminData['user'] && $_POST['password'] == $adminData['pass']) {
                $_SESSION['ADMIN'] = $_POST['userName'];
                $this->isAdmin = true;
                return true;
            } else {
                return false;
            }
        }

    }


}