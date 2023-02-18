<?php


if(isset($_GET['action'])){
    $action=$_GET['action'];
}else{
    $action='';
}
require_once(__DIR__.'/Controllers/userController.php');
$controller = new userController();
$params=$controller->getParams();
foreach($params as $param){
    $GLOBALS[$param['cle']]=$param['valeur'];
}


if($action==''){
    $controller->indexDisplay();
}else if (method_exists($controller, $action)) {
    
    $controller->$action();
} else{
    require_once('Views/404.php');
    $view = new _404();
    $view->index();
}

?>
