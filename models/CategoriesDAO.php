<?php
include_once("models/Categories.php");
include_once("config/dataBase.php");
class CategoriesDAO {

    public static function getAll() {
        $db = DataBase::connect();
        $stmtCategories = $db->prepare("SELECT * FROM categories");
        if (!$stmtCategories) {
            die("Error en la preparación de la consulta: " . mysqli_error($db)); 
        }
        $stmtCategories->execute();
        $resultCategories = $stmtCategories->get_result();
    
        $categories = [];
        while ($category = $resultCategories->fetch_object('Categories')) {
            $categories[] = $category;
        }
    
        $db->close();
        return $categories;
    }

    public static function find($id) {
        $db = DataBase::connect();
        $stmtCategory = $db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmtCategory->bind_param("i", $id);
        $stmtCategory->execute();
        $resultCategory = $stmtCategory->get_result();
        $category = $resultCategory->fetch_object('Categories');
        $db->close();
        return $category;
    }
}