<?php
include_once("init.php");
session_start();
var_dump($_SESSION["cart"]);
if(isset($_SESSION["cart"])){
    foreach($_SESSION["cart"] as $key => $value){
        echo $value["name"]."<br>";
    }
}
?>