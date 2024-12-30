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
include_once("config/dataBase.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}
?>
