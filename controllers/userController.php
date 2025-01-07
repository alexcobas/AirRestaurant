<?php
include_once("models/User.php");
include_once("models/UsersDAO.php");
include_once("models/Card.php");
include_once("models/CardsDAO.php");
include_once("models/Order.php");
include_once("models/OrdersDAO.php");
include_once("models/Address.php");
include_once("models/AddressesDAO.php");
class userController
{
    private $controller = "user";
    public function index()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $header = "views/headers/header3.php";
        $view = "views/users/index.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }

    public function show()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $header = "views/headers/header3.php";
        $view = "views/users/show.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }

    public function destroy()
    {
        UsersDAO::destroy($_SESSION['user']->getId());
        header("Location: " . url . "/home/");
    }

    public function update()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $value = isset($_GET['newValue']) ? trim($_GET['newValue']) : null;
        $field = isset($_GET['field']) ? trim($_GET['field']) : null;
        $userId = $_SESSION["user"]->getId();

        if (empty($value) || empty($field)) {
            echo "Value: $value field: $field ";
            echo "Error: Faltan datos para actualizar el usuario.";
            return;
        }
        if ($field === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
            echo "Error: El correo electrónico no es válido.";
            return;
        }
        if ($field === 'username' && UsersDAO::usernameExists($value)) {
            echo "Error: El nombre de usuario ya está en uso.";
            return;
        }
        if ($field === 'email' && UsersDAO::emailExists($value)) {
            echo "Error: El correo electrónico ya está en uso.";
            return;
        }
        if ($field === 'fullname') {
            $name = explode(" ", $value)[0];
            $surnames = !empty(explode(" ", $value)[1]) ? explode(" ", $value)[1] : "";
            $surnames .= !empty(explode(" ", $value)[2]) ? " " . explode(" ", $value)[2] : "";
            UsersDAO::update($userId, 'name', $name);
            UsersDAO::update($userId, 'surnames', $surnames);
            $_SESSION["user"]->setName($name);
            $_SESSION["user"]->setSurnames($surnames);
        } else {
            UsersDAO::update($userId, $field, $value);
            $fieldCapitalized = ucfirst($field);
            $method = "set" . $fieldCapitalized;

            if (method_exists($_SESSION["user"], $method)) {
                call_user_func([$_SESSION["user"], $method], $value);
            } else {
                throw new Exception("El método {$method} no existe en el objeto.");
            }
        }

        header("Location: " . url . "user/personalInfo");
    }


    public function personalInfo()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $header = "views/headers/header3.php";
        $view = "views/users/personalInfo.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }

    public function loginAndSecurity()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $header = "views/headers/header3.php";
        $view = "views/users/loginAndSecurity.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }

    public function paymentMethods()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $cards = CardsDAO::getUserCards($_SESSION['user']->getId());
        $header = "views/headers/header3.php";
        $view = "views/users/paymentMethods.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }
    public function myOrders()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $orders = OrdersDAO::getUserOrders($_SESSION['user']->getId());
        $header = "views/headers/header3.php";
        $view = "views/users/myOrders.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }
    public function orderDetails()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $controller = $this->controller;
        $order = OrdersDAO::find($_GET['id']);
        $order->setProducts(ProductsDAO::getOrderProducts($_GET['id']));
        $card  = CardsDAO::find($order->getCard_id());
        $address = AddressesDAO::find($order->getAddress_Id());
        $header = "views/headers/header3.php";
        $view = "views/users/orderDetails.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }

    public function store()
    {
        if (isset($_POST["controller"])) {
            $controller = $_POST["controller"];
        } else {
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
        $user->setPassword_hash($password_hash);
        $user->setRole("user");
        UsersDAO::store($user);
        header("Location: " . url . "$controller/");
    }
    public function addCard()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protection.php");
        $card = new Card();
        $card->setCardNumber($_POST["cardNumber"]);
        $card->setExpirationDate($_POST["expirationDate"]);
        $card->setCvv($_POST["cvv"]);
        $card->setCodPostal($_POST["codPostal"]);
        $card->setCountry($_POST["country"]);
        $card->setUser_id($_SESSION['user']->getId());
        $card->setIsPrimary((count(CardsDAO::getUserCards($_SESSION["user"]->getId())) == 0 ? 1 : 0));
        $cardId = CardsDAO::store($card);
        $card->setId($cardId);
        $_SESSION["user"]->addCard($card);
        header("Location: " . url . "user/paymentMethods");
    }
    public function deleteCard()
    {
        CardsDAO::destroy($_GET["card_id"]);
        $_SESSION["user"]->deleteCard($_GET["card_id"]);
        header("Location: " . url . "user/paymentMethods");
    }
    public function primaryEstablish()
    {
        CardsDAO::primaryEstablish($_GET["card_id"]);
        foreach ($_SESSION["user"]->getCards() as $card) {
            if ($card->getId() == $_GET["card_id"]) {
                $card->setIsPrimary(1);
            } else {
                $card->setIsPrimary(0);
            }
        }
        header("Location: " . url . "user/paymentMethods");
    }
    public function login()
    {
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
        if (!empty($_POST["remember"])) {
            // Configura la cookie con una duración de 30 días
            setcookie("user_session", $user->getEmail(), time() + (30 * 24 * 60 * 60), "/", "", false, true);
        }
           
        if ($user->getRole() == "admin") {
            header("Location: " . url . "admin/");
        } else {
            header("Location: " . url . "$controller/");
        }
    }
    public function changePassword()
    {
        if (empty($_POST["current-password"]) || empty($_POST["new-password"]) || empty($_POST["confirm-password"])) {
            header("Location: " . url . "user/loginAndSecurity?errorChangePassword=Todos los campos son obligatorios.");
            exit();
        }
        $currentPassword = $_POST["current-password"];
        $newPassword = $_POST["new-password"];
        $confirmPassword = $_POST["confirm-password"];
        if (!password_verify($currentPassword, $_SESSION["user"]->getPassword_hash())) {
            header("Location: " . url . "user/loginAndSecurity?errorChangePassword=La contraseña actual es incorrecta.");
            exit();
        }
        if ($newPassword !== $confirmPassword) {
            header("Location: " . url . "user/loginAndSecurity?errorChangePassword=Las contraseñas no coinciden.");
            exit();
        }
        $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);
        UsersDAO::update($_SESSION["user"]->getId(), "password_hash", $password_hash);
        $_SESSION["user"]->setPassword_hash($password_hash);
        header("Location: " . url . "user/loginAndSecurity");
    }

    public function deleteAccount()
    {
        UsersDAO::destroy($_SESSION["user"]->getId());
        session_destroy();
        header("Location: " . url . "home/");
    }
    public function logout()
    {
        session_start();
        session_destroy();

        if (!empty($_COOKIE["user_session"])) {
            // Asegúrate de incluir los parámetros como "path" y "domain" si aplican
            setcookie("user_session", "", time() - 3600 * 24, "/", "", false, true);
        }

        header("Location: " . url . "home/");
        exit();
    }
}
