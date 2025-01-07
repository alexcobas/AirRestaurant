<?php
include_once("controllers/productController.php");
include_once("controllers/ingredientController.php");
include_once("controllers/homeController.php");
include_once("controllers/userController.php");
include_once("controllers/cartController.php");
include_once("controllers/adminController.php");
include_once("controllers/apiController.php"); // Este controlador maneja solo la API
include_once("config/parameters.php");

// Detecta si es una solicitud de API o de vista
$isApiRequest = isset($_GET['controller']) && $_GET['controller'] === 'api';

if ($isApiRequest) {
    // Configuración de cabeceras para la API
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
}

// Lógica de enrutamiento
if (!isset($_GET['controller'])) {
    // Si no hay controlador, redirige al predeterminado
    header("Location: " . url . default_controller . "/");
    exit;
}

$controllerName = $_GET['controller'] . "Controller";

if (class_exists($controllerName)) {
    $controller = new $controllerName();

    // Valida y ejecuta la acción solicitada
    $action = isset($_GET['action']) && method_exists($controller, $_GET['action']) ? $_GET['action'] : default_action;

    // Ejecuta la acción
    $controller->$action();
} else {
    if ($isApiRequest) {
        // Error para solicitudes de API
        http_response_code(404);
        echo json_encode(["error" => "El controlador \"$controllerName\" no existe."]);
    } else {
        // Error para vistas
        echo "<h1>Error 404: Página no encontrada</h1>";
    }
}
