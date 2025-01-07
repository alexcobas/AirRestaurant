<?php
include_once("models/User.php");
include_once("models/UsersDAO.php");
include_once("models/Card.php");
include_once("models/CardsDAO.php");
include_once("models/Product.php");
include_once("models/ProductsDAO.php");
include_once("models/IngredientsDAO.php");
include_once("models/Categories.php");
include_once("models/CategoriesDAO.php");
include_once("models/Offer.php");
include_once("models/OffersDAO.php");
include_once("models/ProductCart.php");
include_once("config/parameters.php");
include_once("config/dataBase.php");
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}
// Comprueba si la cookie está establecida
if (!empty($_COOKIE["user_session"]) && !isset($_SESSION["user"])) {
    $email = $_COOKIE["user_session"];

    if (UsersDAO::emailExists($email)) {
        $user = UsersDAO::getUserByEmail($email);
        $_SESSION["user"] = $user;
    } else {
        setcookie("user_session", "", time() - 3600 * 24, "/", "", false, true);
    }
}
