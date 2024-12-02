<?php
include_once("models/Product.php");
include_once("models/Images.php");
include_once("models/CategoriesDAO.php");
include_once("config/dataBase.php");

class ProductsDAO {
    
    public static function getAll() {
        $db = DataBase::connect();
        $stmtProductos = $db->prepare("SELECT * FROM products");
        if (!$stmtProductos) {
            die("Error en la preparación de la consulta: " . mysqli_error($db)); 
        }
        $stmtProductos->execute();
        $resultProductos = $stmtProductos->get_result();
    
        $products = [];
        while ($product = $resultProductos->fetch_object('Product')) {
            $product->setImages(ProductsDAO::findImagesProduct($product->getId()));
            $product->setCategory(CategoriesDAO::find($product->getCategory_id()));
            $products[] = $product;
        }
    
        $db->close();
        return $products;
    }
    

    public static function find($id) {
        $db = DataBase::connect();
        $stmtProduct = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmtProduct->bind_param("i", $id);
        $stmtProduct->execute();
        $resultProduct = $stmtProduct->get_result();
        $product = $resultProduct->fetch_object('Product');
        $db->close();
        return $product;
    }

    public static function store($producto, $ingredientes) {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("INSERT INTO products (name, description, base_price) VALUES (?, ?, ?)");
        
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción del producto: " . mysqli_error($connection));
        }
        $name = $producto->getName();
        $description = $producto->getDescription();
        $price = $producto->getBase_price();
        $stmt->bind_param("ssd", $name, $description, $price);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de inserción del producto: " . mysqli_error($connection));
        }
        $productId = $connection->insert_id;  
        $stmt->close();
        foreach ($ingredientes as $data) {
            $ingrediente = $data['ingredient'];
            $stmtIngredient = $connection->prepare("INSERT INTO product_ingredients_defaults (product_id, ingredient_id, quantity, is_optional, is_charged_extra) VALUES (?, ?, ?, ?, ?)");
            if (!$stmtIngredient) {
                die("Error en la preparación de la consulta de inserción de ingrediente: " . mysqli_error($connection));
            }
            $ingredientId = $ingrediente->getId();
            $quantity = $data['quantity']; 
            $isOptional = $data['isOptional']; 
            $isChargedExtra = $ingrediente->getExtra_price() > 0 ? 1 : 0;
            $stmtIngredient->bind_param("iiiii", $productId, $ingredientId, $quantity, $isOptional, $isChargedExtra);
            if (!$stmtIngredient->execute()) {
                die("Error al ejecutar la consulta de inserción de ingrediente: " . mysqli_error($connection));
            }
            $stmtIngredient->close();
        }
        $connection->close();
    }
    
    
    

    public static function destroy($id) {
        $db = DataBase::connect();
        $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public static function findImagesProduct($id){
        $db = DataBase::connect();
        $query = "SELECT * FROM products_images WHERE product_id = ?";
        $stmtImages = $db->prepare($query);
        $stmtImages->bind_param("i",$id);
        $stmtImages->execute();
        $resultImages = $stmtImages->get_result();
        $images = [];
        while ($image = $resultImages->fetch_object('Images')) {
            $images[] = $image;
        }
        $db->close();
        return $images;
    }
    public static function findCategoryProduct($idCategory){
        $db = DataBase::connect();
        $query = "SELECT * FROM categories WHERE id = ?";
        $stmtCategories = $db->prepare($query);
        $stmtCategories->bind_param("i",$id);
        $stmtCategories->execute();
        $resultCategories = $stmtCategories->get_result();
        $category = $resultCategories->fetch_object('Categories');
        $db->close();
        return $category;
    }
}
?>
