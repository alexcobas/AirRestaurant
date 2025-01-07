<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(empty($_SESSION["user"])){
    $error = "La sesión ha expirado. Vuelve a iniciar sesión porfavor.";
    header("Location: " . url . "home/?errorLogin=$error");
}