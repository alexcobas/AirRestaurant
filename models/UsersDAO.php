<?php
include_once("models/User.php");
include_once("config/DataBase.php");
class UsersDAO{
    public static function store($user) {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("INSERT INTO users (username, name, surnames, email, password_hash, role) VALUES (?, ?, ?, ?, ?, ?)");
        
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción del usuario: " . mysqli_error($connection));
        }
        $username = $user->getUsername();
        $name = $user->getName();
        $surnames = $user->getSurnames();
        $email = $user->getEmail();
        $password_hash = $user->getPasword_hash();
        $role = $user->getRole();
        $stmt->bind_param("ssssss", $username, $name, $surnames, $email, $password_hash, $role);
        if (!$stmt->execute()) {
            die("Error al comprobar si el email esta en uso: " . mysqli_error($connection));
        }
        $stmt->close();
        $connection->close();
    }
    public static function emailExists($email){
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

    public static function usernameExists($username){
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
    public static function getUserByEmail($email){
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
        $stmt->close();
        $connection->close();
        return $user;
    }
}