<?php
include_once("models/Product.php");
include_once("models/ProductsDAO.php");
include_once("models/IngredientsDAO.php");
include_once("models/CategoriesDAO.php");
include_once("config/dataBase.php");
require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/init.php");
class productController
{
    public function index()
    {
        $products = ProductsDAO::getAll();
        $categories = CategoriesDAO::getAll();
        $header = "views/headers/header2.php";
        $view = "views/products/index.php";
        $footer = "views/footers/footer1.php";
        include_once("views/main.php");
    }
    public function show()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = ProductsDAO::find($id);
            $view = "views/products/show.php";
            $footer = "views/footers/footer1.php";
            include_once("views/main.php");
        } else {
            echo "No hay una id.";
        }
    }
    public function create()
    {
        $ingredients = IngredientsDAO::getAll();
        $view = "views/products/create.php";
        include_once("views/main.php");
    }
    public function store()
    {
        $name = $_POST["name"];
        $description = $_POST["description"];
        $base_price = $_POST["base_price"];
        $producto = new Product();
        $producto->setName($name);
        $producto->setDescription($description);
        $producto->setBase_price($base_price);
        $ingredientesSeleccionados = [];
        if (isset($_POST['ingredientes'])) {
            foreach ($_POST['ingredientes'] as $ingredientId => $data) {
                if (isset($data['selected'])) {
                    $ingrediente = IngredientsDAO::find($ingredientId);
                    if ($ingrediente) {
                        $quantity = isset($data['quantity']) ? intval($data['quantity']) : 1;
                        $isOptional = isset($data['optional']) ? 1 : 0;
                        $ingredientesSeleccionados[] = [
                            'ingredient' => $ingrediente,
                            'quantity' => $quantity,
                            'isOptional' => $isOptional,
                        ];
                    }
                }
            }
        }
        ProductsDAO::store($producto, $ingredientesSeleccionados);
        header("Location: " . url . "product/");
    }

    public function destroy()
    {
        ProductsDAO::destroy($_GET['id']);
        header("Location: " . url . "product/");
    }
}
