<?php
include_once("config/DataBase.php");
class OrdersDAO {
    public static function store($order){
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO orders (user_id, card_id, order_price) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción del producto: " . mysqli_error($db));
        }
        $userId = $order->getUser_Id(); 
        $cardId = $order->getCard_Id();
        $orderPrice = $order->getOrder_Price();
        $stmt->bind_param("iid", $userId, $cardId, $orderPrice);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de inserción del producto: " . mysqli_error($db));
        }
        $orderId = $db->insert_id;
        $order->setId($orderId);
        $stmt->close();
        foreach ($order->getProducts() as $orderProduct) {
            $product = $orderProduct['product'];
            $quantity = $orderProduct['quantity'];
            $stmtProduct = $db->prepare(
                "INSERT INTO order_product (order_id, product_id, custom_price, quantity) VALUES (?, ?, ?, ?)"
            );
            if (!$stmtProduct) {
                die("Error en la preparación de la consulta para insertar productos: " . mysqli_error($db));
            }
            $productId = $product->getId();
            $customPrice = $product->getBase_Price();
            $stmtProduct->bind_param("iidi", $orderId, $productId, $customPrice, $quantity);
            if (!$stmtProduct->execute()) {
                die("Error al ejecutar la consulta de inserción de productos: " . mysqli_error($db));
            }
            $stmtProduct->close();
        }
        $db->close();
        return $order;
    }
}
