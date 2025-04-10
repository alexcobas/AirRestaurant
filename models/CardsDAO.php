<?php
include_once(__DIR__ . "/Card.php");
include_once(__DIR__ . "/../config/DataBase.php");
class CardsDAO {

    public static function getAll() {
        $db = DataBase::connect();
        $stmtCards = $db->prepare("SELECT * FROM cards");
        if (!$stmtCards) {
            die("Error en la preparación de la consulta: " . mysqli_error($db)); 
        }
        $stmtCards->execute();
        $resultCards = $stmtCards->get_result();
    
        $cards = [];
        while ($category = $resultCards->fetch_object('Card')) {
            $cards[] = $category;
        }
    
        $db->close();
        return $cards;
    }

    public static function getUserCards($user_id) {
        $db = DataBase::connect();
        $stmtCards = $db->prepare("SELECT * FROM cards WHERE user_id = ?");
        $stmtCards->bind_param("i", $user_id);
        $stmtCards->execute();
        $resultCards = $stmtCards->get_result();
        $cards = [];
        while ($category = $resultCards->fetch_object('Card')) {
            $cards[] = $category;
        }
    
        $db->close();
        return $cards;
    }
    public static function store($card) {
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO cards (user_id, cardNumber, codPostal, expirationDate, cvv, country, isPrimary) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt === false) {
            die("Error en la preparación de la consulta: " . $db->error); // Muestra el error detallado de la consulta
        }
        $stmt->bind_param("isssssi", $card->getUser_id(), $card->getCardNumber(), $card->getCodPostal(), $card->getExpirationDate(), $card->getCvv(), $card->getCountry(), $card->getIsPrimary());
        $stmt->execute();
        $insertedId = $db->insert_id;
        return $insertedId;
        $db->close();
    }
    public static function destroy($card_id) {
        $db = DataBase::connect();
        $stmt = $db->prepare("DELETE FROM cards WHERE id = ?");
        $stmt->bind_param("i", $card_id);
        $stmt->execute();
        $db->close();
    }
    public static function primaryEstablish($card_id){
        $db = DataBase::connect();
        $stmt = $db->prepare("UPDATE cards SET isPrimary = 0 WHERE isPrimary = 1");
        $stmt->execute();
        $stmt = $db->prepare("UPDATE cards SET isPrimary = 1 WHERE id = ?");
        $stmt->bind_param("i", $card_id);
        $stmt->execute();
        $db->close();
    }
    public static function find($id){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM cards WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $card = $result->fetch_object('Card');
        $db->close();
        return $card;
    }
    public static function findApi($id) {
        $connection = DataBase::connect();
        $stmt = $connection->prepare("SELECT * FROM cards WHERE id = ?");
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta: " . mysqli_error($connection));
        }
        $result = $stmt->get_result();
        $card = $result->fetch_assoc();
        $stmt->close();
        $connection->close();
        return $card;
    }
}