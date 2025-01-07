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
}



    // Función para crear un usuario
    /*public function createUser() {
        // Obtener los datos enviados en el cuerpo de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si los datos necesarios están presentes
        if (!isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan parámetros necesarios para crear el usuario.'
            ]);
            return;
        }

        // Crear el usuario en la base de datos
        $usersDAO = new UsersDAO();
        $result = $usersDAO->insertUser($data['name'], $data['email'], $data['password']);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuario creado con éxito.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hubo un error al crear el usuario.'
            ]);
        }
    }

    // Función para actualizar un usuario
    public function updateUser() {
        // Obtener los datos enviados en el cuerpo de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si los datos necesarios están presentes
        if (!isset($data['id']) || !isset($data['name']) || !isset($data['email']) || !isset($data['password'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Faltan parámetros necesarios para actualizar el usuario.'
            ]);
            return;
        }

        // Actualizar el usuario en la base de datos
        $usersDAO = new UsersDAO();
        $result = $usersDAO->updateUser($data['id'], $data['name'], $data['email'], $data['password']);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuario actualizado con éxito.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hubo un error al actualizar el usuario.'
            ]);
        }
    }

    // Función para eliminar un usuario
    public function deleteUser() {
        // Obtener los datos enviados en el cuerpo de la solicitud
        $data = json_decode(file_get_contents('php://input'), true);

        // Verificar si el ID del usuario está presente
        if (!isset($data['id'])) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Falta el ID del usuario para eliminar.'
            ]);
            return;
        }

        // Eliminar el usuario de la base de datos
        $usersDAO = new UsersDAO();
        $result = $usersDAO->deleteUser($data['id']);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Usuario eliminado con éxito.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Hubo un error al eliminar el usuario.'
            ]);
        }
    }*/
