<?php
include_once("config/DataBase.php");
class AddressesDAO{
    public static function getAllFromUser($user_id){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM addresses WHERE user_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de direcciones: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = array();
        while ($row = $result->fetch_object('Address')) {
            $addresses[] = $row;
        }
        $stmt->close();
        $db->close();
        return $addresses;
    }
    public static function getAll(){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM addresses");
        if (!$stmt) {
            die("Error en la preparación de la consulta de direcciones: " . mysqli_error($db));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $addresses = array();
        while ($row = $result->fetch_object('Address')) {
            $addresses[] = $row;
        }
        $stmt->close();
        $db->close();
        return $addresses;
    }
    public static function store($address){
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO addresses (user_id, address, city, codPostal) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción de la direccion: " . mysqli_error($db));
        }
        $stmt->bind_param("isss", $address->getUser_id(), $address->getAddress(), $address->getCity(), $address->getCodPostal());
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de inserción de la direccion: " . mysqli_error($db));
        }
        $addressId = $db->insert_id;
        $address->setId($addressId);
        $stmt->execute();
        $stmt->close();
        $db->close();
        return $addressId;
    }
    public static function find($id){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM addresses WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de búsqueda de la direccion: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $address = $result->fetch_object('Address');
        $stmt->close();
        $db->close();
        return $address;
    }
}