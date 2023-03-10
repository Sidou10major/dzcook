<?php

//require controller
require_once(__DIR__.'/Controllers/adminController.php');

//create controller
$adminController = new adminController();


//get action

if(isset($_GET['action'])){
    $action=$_GET['action'];
}else{
    $action='';
}

//call actio
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
if(isset($_SESSION['admin'])){
    if($action==''){
        $adminController->dashboard();
    }else if (method_exists($adminController, $action)) {
        //check if params exists
        $adminController->$action();
    } else{
        require_once('Views/404.php');
        $view = new _404();
        $view->index();
    }
}else {
   if($action=='loginHandler'){
    $adminController->$action();
   } else{
    $adminController->authDisplay();
   }
}


?>
