<?php
include_once("models/Product.php");
include_once("models/Images.php");
include_once("models/CategoriesDAO.php");
include_once("config/DataBase.php");

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

    public static function getAllApi(){
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM products");
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . mysqli_error($connection));
        }
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = [
                'id' => $row['id'],
                'name' => $row['name'],
                'description' => $row['description'],
                'base_price' => $row['base_price'],
                'category' => ProductsDAO::findCategoryProductApi($row['category_id']),
                'images' => ProductsDAO::findImagesProductApi($row['id']),
                'created_at' => $row['created_at']
            ];
            $products[] = $product;
        }
        $stmt->close();
        $connection->close();
        return $products;
    }

    public static function getOrderProducts($orderId){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM order_product WHERE order_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $orderId);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = ProductsDAO::find($row['product_id']);
            $cuantity = $row['quantity'];
            $products[] = ProductsDAO::convertToProductCart($product, $cuantity);
        }
        $stmt->close();
        $db->close();
        return $products;
    }
    public static function convertToProductCart(Product $product, $cuantity) {
        $productCart = new ProductCart();
        $productCart->setId($product->getId());
        $productCart->setName($product->getName());
        $productCart->setDescription($product->getDescription());
        $productCart->setBase_price($product->getBase_price());
        $productCart->setCategory_id($product->getCategory_id());
        $productCart->setImages($product->getImages());
        $productCart->setCategory($product->getCategory());
        $productCart->setCuantity($cuantity);
        

        return $productCart;
    } 
    

    public static function find($id) {
        $db = DataBase::connect();
        $stmtProduct = $db->prepare("SELECT * FROM products WHERE id = ?");
        $stmtProduct->bind_param("i", $id);
        $stmtProduct->execute();
        $resultProduct = $stmtProduct->get_result();
        $product = $resultProduct->fetch_object('Product');
        $product->setImages(ProductsDAO::findImagesProduct($product->getId()));
        $product->setCategory(CategoriesDAO::find($product->getCategory_id()));
        $db->close();
        return $product;
    }
    public static function findApi($id) {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $stmt->close();
        $connection->close();
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
    public static function findImagesProductApi($id){
        $db = DataBase::connect();
        $query = "SELECT * FROM products_images WHERE product_id = ?";
        $stmtImages = $db->prepare($query);
        $stmtImages->bind_param("i", $id);
        $stmtImages->execute();
        $resultImages = $stmtImages->get_result();
        $images = [];
        while ($row = $resultImages->fetch_assoc()) {
            $image = [
                'id' => $row['id'],
                'product_id' => $row['product_id'],
                'photo_archive_name' => $row['photo_archive_name']
            ];
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
    public static function findCategoryProductApi($idCategory){
        $db = DataBase::connect();
        $query = "SELECT * FROM categories WHERE id = ?";
        $stmtCategories = $db->prepare($query);
        $stmtCategories->bind_param("i", $idCategory); 
        $stmtCategories->execute();
        $resultCategories = $stmtCategories->get_result();
        if ($row = $resultCategories->fetch_assoc()) {
            $category = [
                'id' => $row['id'],
                'title' => $row['title'],
                'name' => $row['name'],
                'icon' => $row['icon'],
                'img' => $row['img']
            ];
        } else {
            $category = [];
        }
        $db->close();
        return $category;
    }
    
}
?>
