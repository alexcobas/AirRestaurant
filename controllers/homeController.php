<?php
require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/init.php");
class homeController{
    private $controller = "home";
    public function index(){
        $controller = $this->controller;
        $categories = CategoriesDAO::getAll();
        $header = "views/headers/header1.php";
        $view = "views/home/index.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }
}