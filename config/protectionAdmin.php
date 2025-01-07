<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_SESSION["user"])){
    header("Location: " . url . "home/");
}
if($_SESSION["user"]->getRole() != "admin"){
    header("Location: " . url . "home/");
}