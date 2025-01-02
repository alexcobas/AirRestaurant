<?php
include_once("controllers/productController.php");
include_once("controllers/ingredientController.php");
include_once("controllers/homeController.php");
include_once("controllers/userController.php");
include_once("controllers/cartController.php");
include_once("config/parameters.php");
if(!isset($_GET['controller'])){
    header("Location:" . url . default_controller . "/");
} else{
    $controllerName = $_GET['controller']."Controller";
    if(class_exists($controllerName)) {
        $controller = new $controllerName();

        if(isset($_GET['action']) && method_exists($controller, $_GET['action'])){
            $action = $_GET['action'];
        }else{
            $action = default_action;
        }
    
        $controller->$action();

    } else{
        echo "El controller \"". $controllerName ."\" no existe";
    }
}