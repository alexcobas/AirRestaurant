<?php
include_once("config/parameters.php");

class adminController
{
    private $controller = "user";
    public function index()
    {
        require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/protectionAdmin.php");
        $controller = $this->controller;
        $header = "views/headers/header4.php";
        $view = "views/admin/index.php";
        include_once("views/main.php");
    }
}