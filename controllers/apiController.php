<?php
include_once("models/User.php");
include_once("models/UsersDAO.php");
include_once("models/Card.php");
include_once("models/Order.php");
include_once("models/OrdersDAO.php");
include_once("models/Address.php");

class apiController
{
    public function createUser()
    {
        try {
            // Validación de parámetros
            if (!isset($_POST["username"]) || !isset($_POST["name"]) || !isset($_POST["surnames"]) || !isset($_POST["email"]) || !isset($_POST["password_hash"]) || !isset($_POST["role"])) {
                throw new Exception('Faltan parámetros necesarios para crear el usuario.');
            }

            // Verificamos si el correo electrónico ya existe
            if (UsersDAO::emailExists($_POST["email"]) != null) {
                throw new Exception('El correo electrónico ya está registrado.');
            }

            // Verificamos si el nombre de usuario ya existe
            if (UsersDAO::usernameExists($_POST["username"]) != null) {
                throw new Exception('El nombre de usuario ya está registrado.');
            }

            // Creamos un nuevo objeto User
            $user = new User();
            $user->setUsername($_POST["username"]);
            $user->setName($_POST["name"]);
            $user->setSurnames($_POST["surnames"]);
            $user->setEmail($_POST["email"]);
            $user->setPassword_hash($_POST["password_hash"]);
            $user->setRole($_POST["role"]);

            // Almacenamos el usuario en la base de datos
            if (!UsersDAO::store($user)) {
                throw new Exception('Error al guardar el usuario en la base de datos.');
            }

            // Si todo ha salido bien
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuario creado correctamente.'
            ]);
        } catch (Exception $e) {
            // Capturamos y mostramos el error
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()  // Mensaje detallado del error
            ]);
        }
    }


    public function getUsers()
    {
        $users = usersDAO::getAllApi();
        if ($users) {
            // Respuesta JSON con los datos preparados
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No se encontraron usuarios.'
            ]);
        }
    }
    public function deleteUser()
    {
        $id = $_GET['id'];
        $users = usersDAO::destroy($id);
        if ($users) {
            // Respuesta JSON con los datos preparados
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No se encontraron usuarios.'
            ]);
        }
    }

    public function getProducts()
    {
        $users = productsDAO::getAllApi();
        if ($users) {
            // Respuesta JSON con los datos preparados
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No se encontraron usuarios.'
            ]);
        }
    }
    public function getOrders()
    {
        $users = ordersDAO::getAllApi();
        if ($users) {
            // Respuesta JSON con los datos preparados
            echo json_encode([
                'status' => 'success',
                'data' => $users
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No se encontraron pedidos.'
            ]);
        }
    }
}
