<?php
include_once(__DIR__ . "/User.php");
include_once(__DIR__ . "/AddressesDAO.php");
include_once(__DIR__ . "/../config/DataBase.php");
include_once(__DIR__ . "/CardsDao.php");
include_once(__DIR__ . "/OrdersDao.php");
class UsersDAO
{
    public static function getAllApi()
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM users");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($connection));
        }
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $user = [
                'id' => $row['id'],
                'username' => $row['username'],
                'name' => $row['name'],
                'surnames' => $row['surnames'],
                'email' => $row['email'],
                'password_hash' => $row['password_hash'],
                'role' => $row['role'],
                'img_profile' => $row['img_profile'],
                'created_at' => $row['created_at']
            ];
            $users[] = $user;
        }
        $stmt->close();
        $connection->close();
        return $users; // Devuelve los datos
    }
    public static function getAll()
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM users");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($connection));
        }
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $users = array();
        while ($row = $result->fetch_assoc()) {
            $user = new User();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setName($row['name']);
            $user->setSurnames($row['surnames']);
            $user->setEmail($row['email']);
            $user->setPassword_hash($row['password_hash']);
            $user->setRole($row['role']);
            $user->setImg_profile($row['img_profile']);
            $user->setCreated_at($row['created_at']);
            $user->setCards(CardsDAO::getUserCards($user->getId()));
            $user->setAddresses(AddressesDAO::getAllFromUser($user->getId()));
            $user->setOrders(OrdersDAO::getOrdersByUserId($user->getId()));

            $users[] = $user;
        }
        $stmt->close();
        $connection->close();
        return $users;
    }
    public static function find($id)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($connection));
        }
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $user = null;

        if ($row = $result->fetch_assoc()) {
            $user = new User();
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setName($row['name']);
            $user->setSurnames($row['surnames']);
            $user->setEmail($row['email']);
            $user->setPassword_hash($row['password_hash']);
            $user->setRole($row['role']);
            $user->setImg_profile($row['img_profile']);
            $user->setCreated_at($row['created_at']);

            // Obtener y asignar tarjetas, direcciones y pedidos
            $user->setCards(CardsDAO::getAll($user->getId()));
            $user->setAddresses(AddressesDAO::getAllFromUser($user->getId()));
            $user->setOrders(OrdersDAO::getOrdersByUserId($user->getId()));
        }
        $stmt->close();
        $connection->close();
        return $user;
    }
    public static function findApi($id)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($connection));
        }
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $user = null;

        if ($row = $result->fetch_assoc()) {
            $user = [
                'id' => $row['id'],
                'username' => $row['username'],
                'name' => $row['name'],
                'surnames' => $row['surnames'],
                'email' => $row['email'],
                'password_hash' => $row['password_hash'],
                'role' => $row['role'],
                'img_profile' => $row['img_profile'],
                'created_at' => $row['created_at']
            ];
        }
        $stmt->close();
        $connection->close();
        return $user;
    }
    public static function store($user)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("INSERT INTO users (username, name, surnames, email, password_hash, role) VALUES (?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción del usuario: " . mysqli_error($connection));
        }
        $username = $user->getUsername();
        $name = $user->getName();
        $surnames = $user->getSurnames();
        $email = $user->getEmail();
        $password_hash = $user->getPassword_hash();
        $role = $user->getRole();
        $stmt->bind_param("ssssss", $username, $name, $surnames, $email, $password_hash, $role);
        if (!$stmt->execute()) {
            die("Error al comprobar si el email esta en uso: " . mysqli_error($connection));
        }
        $stmt->close();
        $connection->close();
        return true;
    }

    public static function emailExists($email)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE email = ?");

        if (!$stmt) {
            die("Error en la preparación de la consulta al comprobar si el email esta en uso: " . mysqli_error($connection));
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta al comprobar si el email esta en uso: " . mysqli_error($connection));
        }
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        $connection->close();
        return $count > 0;
    }

    public static function usernameExists($username)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT COUNT(*) FROM users WHERE username = ?");

        if (!$stmt) {
            die("Error en la preparación de la consulta al comprobar si el username esta en uso: " . mysqli_error($connection));
        }
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta al comprobar si el username esta en uso: " . mysqli_error($connection));
        }
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
        $connection->close();
        return $count > 0;
    }
    public static function getUserByEmail($email)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta al recibir el usuario por el email: " . mysqli_error($connection));
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta al comprobar si el username esta en uso: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $user = $result->fetch_object("User");
        $user->setCards(CardsDAO::getUserCards($user->getId()));
        $stmt->close();
        $connection->close();
        return $user;
    }
    public static function destroy($id)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("DELETE FROM users WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta al borrar el usuario: " . mysqli_error($connection));
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta al borrar el usuario: " . mysqli_error($connection));
        }
        $stmt->close();
        $connection->close();
        return $id;
    }
    public static function update($id, $field, $value)
    {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("UPDATE users SET $field = ? WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta al actualizar el usuario: " . mysqli_error($connection));
        }
        $stmt->bind_param("si", $value, $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta al actualizar el usuario: " . mysqli_error($connection));
        }
        $stmt->close();
        $connection->close();
    }

    public static function updateAll($id, $data)
    {
        $connection = DataBase::connect();

        if (!$connection) {
            die("Error de conexión: " . mysqli_connect_error());
        }

        $fields = [];
        $values = [];

        // Iteramos sobre el array de datos para crear la consulta
        foreach ($data as $field => $value) {
            $fields[] = "$field = ?";
            $values[] = $value;
        }

        // Añadimos el ID para la condición WHERE
        $values[] = $id;

        // Generamos la consulta SQL de actualización
        $sql = "UPDATE users SET " . implode(", ", $fields) . " WHERE id = ?";

        $stmt = $connection->prepare($sql);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $connection->error);
        }

        // Construimos dinámicamente el tipo para bind_param (todos los valores excepto el ID son strings)
        $types = str_repeat("s", count($data)) . "i"; // 's' para strings, 'i' para el ID (integer)
        $stmt->bind_param($types, ...$values);

        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . $stmt->error);
        }

        $stmt->close();
        $connection->close();

        return true;
    }
}
