<?php
include_once("models/Ingredient.php");
include_once("config/dataBase.php");
class IngredientsDAO{
    public static function getAll(){
        $db = DataBase::connect();
        $stmtIngredients = $db->prepare("SELECT * FROM ingredients");
        $stmtIngredients->execute();
        $resultIngredients = $stmtIngredients->get_result();

        $ingredients = [];
        while ($ingredient = $resultIngredients->fetch_object('Ingredient')) {
            $ingredients[] = $ingredient;
        }

        $db->close();
        return $ingredients;
    }
    public static function store($ingredient){
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO ingredients (name, extra_price) VALUES (?,?)");
        $name = $ingredient->getName();
        $price = $ingredient->getExtra_price();
        $stmt->bind_param("sd",$name,$price);
        $stmt->execute();
        $stmt->close();
    }
    public static function find($id){
        $db = DataBase::connect();
        $query = "SELECT * FROM ingredients WHERE id = ?";
        $stmtIngredient = $db->prepare($query);
        $stmtIngredient->bind_param("i",$id);
        $stmtIngredient->execute();
        $resultIngredient = $stmtIngredient->get_result();
        $ingredient = $resultIngredient->fetch_object('Ingredient');
        $db->close();
        return $ingredient;
    }
    public static function isIngredientInProduct($ingredientId, $productId) {
        $db = DataBase::connect();
        $query = "SELECT COUNT(*) AS count FROM product_ingredients_defaults WHERE ingredient_id = ? AND product_id = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ii", $ingredientId, $productId);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $count = $row['count'];
        
        $stmt->close();
        $db->close();
        
        return $count > 0;
    }
}