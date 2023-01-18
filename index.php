<?php
//routing

if(isset($_GET['action'])){
    $action=$_GET['action'];
}else{
    $action='';
}
require_once(__DIR__.'/Controllers/userController.php');
$controller = new userController();
//check if action exists

if($action==''){
    $controller->indexDisplay();
}else if (method_exists($controller, $action)) {
    //check if params exists
    $controller->$action();
} else{
    require_once('Views/404.php');
    $view = new _404();
    $view->index();
}

?>