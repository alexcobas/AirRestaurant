<?php
include_once("config/DataBase.php");
class OffersDAO{
    public static function find($id) {
        $db = DataBase::connect();
        $stmtOffer = $db->prepare("SELECT * FROM offers WHERE id = ?");
        if (!$stmtOffer) {
            die("Error en la preparación de la consulta de inserción del pedido: " . mysqli_error($db));
        }
        $stmtOffer->bind_param("i", $id);
        $stmtOffer->execute();
        $resultOffer = $stmtOffer->get_result();
        $offer = $resultOffer->fetch_object('Offer');
        $stmtOffer->close();
        $db->close();
        return $offer;
    }
    public static function getOfferByName($name){
        $db = DataBase::connect();
        $stmtOffer = $db->prepare("SELECT * FROM offers WHERE name = ?");
        if (!$stmtOffer) {
            die("Error en la preparación de la consulta de inserción del pedido: " . mysqli_error($db));
        }
        $stmtOffer->bind_param("s", $name);
        $stmtOffer->execute();
        $resultOffer = $stmtOffer->get_result();
        $offer = $resultOffer->fetch_object('Offer');
        $stmtOffer->close();
        $db->close();
        return $offer;
    }
    public static function existsOfferName($name){
        $db = DataBase::connect();
        $stmtOffer = $db->prepare("SELECT COUNT(*) FROM offers WHERE name = ?");
        if (!$stmtOffer) {
            die("Error en la preparación de la consulta de inserción del pedido: " . mysqli_error($db));
        }
        $stmtOffer->bind_param("s", $name);
        $stmtOffer->execute();
        $resultOffer = $stmtOffer->get_result();
        $count = $resultOffer->fetch_row()[0];
        $stmtOffer->close();
        $db->close();
        return $count > 0;
    }
}