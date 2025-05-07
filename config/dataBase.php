<?php
class DataBase{
    public static function connect($host='nozomi.proxy.rlwy.net', $user='root', $password='IDqcmYwaArNlnCfydHQRICaTcrchnPvs', $database='AirRestaurant', $port='15275'){
        $connection = new mysqli($host, $user, $password, $database,$port);

        if ($connection == false) {
            die("ERROR 500: No te puedes conectar a la base de datos.". $connection->connect_error);
        }
        
        return $connection;
    }
}
