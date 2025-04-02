<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once("../controllers/apiController.php");

$metodo = $_SERVER["REQUEST_METHOD"];
$modal = $_GET['modal'];

switch ($metodo) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Obtener por ID dependiendo del modal
            switch ($modal) {
                case 'user':
                    $user = apiController::getUser($_GET['id']);
                    if ($user) {
                        echo json_encode(['status' => 'Success', 'data_count' => 1, 'data' => $user]);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'data' => []]);
                    }
                    break;
                case 'product':
                    $product = apiController::getProduct($_GET['id']);
                    if ($product) {
                        echo json_encode(['status' => 'Success', 'data_count' => 1, 'data' => $product]);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'data' => []]);
                    }
                    break;
                case 'order':
                    $order = apiController::getOrder($_GET['id']);
                    if ($order) {
                        echo json_encode(['status' => 'Success', 'data_count' => 1, 'data' => $order]);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'data' => []]);
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['status' => 'Error', 'mensaje' => 'Modal no válido']);
                    break;
            }
        } else {
            // Obtener todos los elementos según el modal
            switch ($modal) {
                case 'user':
                    $users = apiController::getUsers();
                    if (is_array($users)) {
                        echo json_encode(['status' => 'Success', 'data_count' => count($users), 'data' => $users]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudieron obtener los usuarios.']);
                    }
                    break;
                case 'product':
                    $products = apiController::getProducts();
                    if (is_array($products)) {
                        echo json_encode(['status' => 'Success', 'data_count' => count($products), 'data' => $products]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudieron obtener los productos.']);
                    }
                    break;
                case 'order':
                    $orders = apiController::getOrders();
                    if (is_array($orders)) {
                        echo json_encode(['status' => 'Success', 'data_count' => count($orders), 'data' => $orders]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudieron obtener los pedidos.']);
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['status' => 'Error', 'mensaje' => 'Modal no válido']);
                    break;
            }
        }
        exit;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data)) {
            // Crear según el modal
            switch ($modal) {
                case 'user':
                    $result = apiController::createUser($data);
                    if ($result) {
                        http_response_code(201);
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Usuario creado correctamente.', 'data' => $result]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo crear el usuario.']);
                    }
                    break;
                case 'product':
                    // $result = apiController::createProduct($data);
                    if ($result) {
                        http_response_code(201);
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Producto creado correctamente.', 'data' => $result]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo crear el producto.']);
                    }
                    break;
                case 'order':
                    // $result = apiController::createOrder($data);
                    if ($result) {
                        http_response_code(201);
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Pedido creado correctamente.', 'data' => $result]);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo crear el pedido.']);
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['status' => 'Error', 'mensaje' => 'Modal no válido']);
                    break;
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'Error', 'mensaje' => 'Datos incompletos o inválidos.']);
        }
        exit;

    case 'PUT':
        $data = json_decode(file_get_contents("php://input"), true);

        if (!empty($data) && isset($_GET['id'])) {
            $id = $_GET['id'];
            // Actualizar según el modal
            switch ($modal) {
                case 'user':
                    $result = apiController::updateUser($id, $data);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Usuario actualizado correctamente.']);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo actualizar el usuario.']);
                    }
                    break;
                case 'product':
                    $result = apiController::updateProduct($id, $data);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Producto actualizado correctamente.']);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo actualizar el producto.']);
                    }
                    break;
                case 'order':
                    $result = apiController::updateOrder($id, $data);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Pedido actualizado correctamente.']);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'Error', 'mensaje' => 'No se pudo actualizar el pedido.']);
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['status' => 'Error', 'mensaje' => 'Modal no válido']);
                    break;
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'Error', 'mensaje' => 'Datos incompletos o ID no proporcionado.']);
        }
        exit;

    case 'DELETE':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Eliminar según el modal
            switch ($modal) {
                case 'user':
                    $result = apiController::deleteUser($id);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Usuario eliminado correctamente.']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'mensaje' => 'No se pudo eliminar el usuario.']);
                    }
                    break;
                case 'product':
                    $result = apiController::deleteProduct($id);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Producto eliminado correctamente.']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'mensaje' => 'No se pudo eliminar el producto.']);
                    }
                    break;
                case 'order':
                    $result = apiController::deleteOrder($id);
                    if ($result) {
                        echo json_encode(['status' => 'Success', 'mensaje' => 'Pedido eliminado correctamente.']);
                    } else {
                        http_response_code(404);
                        echo json_encode(['status' => 'Fallido', 'mensaje' => 'No se pudo eliminar el pedido.']);
                    }
                    break;
                default:
                    http_response_code(400);
                    echo json_encode(['status' => 'Error', 'mensaje' => 'Modal no válido']);
                    break;
            }
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'Error', 'mensaje' => 'ID no proporcionado.']);
        }
        exit;

    default:
        http_response_code(405);
        echo json_encode(['status' => 'Error', 'mensaje' => 'Método no permitido']);
        break;
}
?>
