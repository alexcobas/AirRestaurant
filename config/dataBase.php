<?php
class DataBase{
    public static function connect($host='localhost', $user='root', $password='Informatica_1', $database='AirRestaurant2', $port='3307'){
        $connection = new mysqli($host, $user, $password, $database,$port);

        if ($connection == false) {
            die("ERROR 500: No te puedes conectar a la base de datos.". $connection->connect_error);
        }
        
        return $connection;
    }
}