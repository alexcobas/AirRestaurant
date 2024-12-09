<?php
include_once("models/User.php");
include_once("models/UsersDAO.php");
class userController{
    public function show(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            include_once("views/ingredients/show.php");
        } else {
            echo "No hay una id.";
        }
    }

    public function store(){
        if(isset($_POST["controller"])){
            $controller = $_POST["controller"];
        } else{
            $controller = "home";
        }
        if (empty($_POST["username"]) || empty($_POST["name"]) || empty($_POST["surnames"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmPassword"])) {
            header("Location: " . url . "$controller/index?errorRegister=Todos los campos son obligatorios.");
            exit();
        }
        if ($_POST["password"] !== $_POST["confirmPassword"]) {
            header("Location: " . url . "$controller/index?errorRegister=Las contraseñas no coinciden.");
            exit();
        }
        if (UsersDAO::emailExists($_POST["email"])) {
            header("Location: " . url . "$controller/index?errorRegister=El email ya está vinculado a una cuenta.");
            exit();
        }
        if (UsersDAO::usernameExists($_POST["username"])) {
            header("Location: " . url . "$controller/index?errorRegister=El username ya está en uso.");
            exit();
        }
        $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $user = new User();
        $user->setUsername($_POST["username"]);
        $user->setName($_POST["name"]);
        $user->setSurnames($_POST["surnames"]);
        $user->setEmail($_POST["email"]);
        $user->setPasword_hash($password_hash);
        $user->setRole("user");
        UsersDAO::store($user);
        header("Location: " . url . "$controller/");
    }

    public function login(){
        $controller = $_POST["controller"] ?? "home";
        if (empty($_POST["email"]) || empty($_POST["password"])) {
            header("Location: " . url . "$controller/index?errorLogin=Todos los campos son obligatorios.");
            exit();
        }
        $email = $_POST["email"];
        $password = $_POST["password"];
        if (!UsersDAO::emailExists($email)) {
            header("Location: " . url . "$controller/index?errorLogin=No hay ninguna cuenta vinculada a este email.");
            exit();
        }
        $user = UsersDAO::getUserByEmail($email);
        if (!password_verify($password, $user->getPassword_hash())) {
            header("Location: " . url . "$controller/index?errorLogin=La contraseña es incorrecta.");
            exit();
        }
        session_start();
        $_SESSION["user"] = $user;
        header("Location: " . url . "$controller/dashboard");
    }
    
}