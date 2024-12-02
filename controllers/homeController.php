<?php
class homeController{
    public function index(){
        $view = "views/home/index.php";
        include_once("views/main.php");
    }
    public function show(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $ingredient = IngredientsDAO::find($id);
            include_once("views/ingredients/show.php");
        } else {
            echo "No hay una id.";
        }
    }

    public function create(){
        include_once("views/ingredients/create.php");
    }

    public function store(){
        $name = $_POST["name"];
        $extra_price = $_POST["extra_price"];
        $ingredient = new Ingredient();
        $ingredient->setName($name);
        $ingredient->setExtra_price($extra_price);
        IngredientsDAO::store($ingredient);
        header("Location: " . url . "/product/create");
    }
}