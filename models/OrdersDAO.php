<?php
include_once("config/DataBase.php");
include_once("models/Offer.php");
include_once("models/Order.php");
class OrdersDAO {
    public static function getAll() {
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->setId($row['id']);
            $order->setUser_Id($row['user_id']);
            if($row['user_id']){
                $order->setUser(UsersDAO::find($row['user_id']));
            }
            $order->setCard_Id($row['card_id']);
            $order->setCard(CardsDAO::find($row['card_id']));
            $order->setAddress_Id($row['address_id']);
            $order->setAddress(AddressesDAO::find($row['address_id']));
            $order->setOrder_Price($row['order_price']);
            $order->setOrder_Price_Total($row['order_price_total']);
            $order->setOffer_Id($row['offer_id']);
            $order->setProducts(self::getProductsByOrderId($row['id']));
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }
    public static function store($order){
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO orders (user_id, card_id, address_id, offer_id, order_price, order_price_total) VALUES (?, ?, ?, ?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción del pedido: " . mysqli_error($db));
        }
        $userId = $order->getUser_Id(); 
        $cardId = $order->getCard_Id();
        $addressId = $order->getAddress_Id();
        $offerId = $order->getOffer_Id();
        $orderPrice = $order->getOrder_Price();
        $orderPriceTotal = $order->getOrder_Price_Total();
        $stmt->bind_param("iiiidd", $userId, $cardId, $addressId, $offerId, $orderPrice, $orderPriceTotal);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de inserción del pedido: " . mysqli_error($db));
        }
        $orderId = $db->insert_id;
        $order->setId($orderId);
        $stmt->close();
        foreach ($order->getProducts() as $orderProduct) {
            $stmtProduct = $db->prepare(
                "INSERT INTO order_product (order_id, product_id, custom_price, quantity) VALUES (?, ?, ?, ?)"
            );
            if (!$stmtProduct) {
                die("Error en la preparación de la consulta para insertar pedidos: " . mysqli_error($db));
            }
            $productId = $orderProduct->getId();
            $customPrice = $orderProduct->getBase_Price();
            $quantity = $orderProduct->getCuantity();
            $stmtProduct->bind_param("iidi", $orderId, $productId, $customPrice, $quantity);
            if (!$stmtProduct->execute()) {
                die("Error al ejecutar la consulta de inserción de pedidos: " . mysqli_error($db));
            }
            $stmtProduct->close();
        }
        $db->close();
        return $order;
    }

    public static function getOrdersByUserId($userId) {
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $userId);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->setId($row['id']);
            $order->setUser_Id($row['user_id']);
            $order->setCard_Id($row['card_id']);
            $order->setOrder_Price($row['order_price']);
            $order->setProducts(self::getProductsByOrderId($row['id']));
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }
    public static function getProductsByOrderId($orderId) {
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM order_product WHERE order_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de productos: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $orderId);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de selección de productos: " . mysqli_error($db));
        }
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $product = new Product();
            $product->setId($row['product_id']);
            $product->setBase_Price($row['custom_price']);
            $products[] = $product;
        }
        $stmt->close();
        $db->close();
        return $products;
    }
    public static function find($id){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $id);

        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $result = $stmt->get_result();
        $order = $result->fetch_object("Order");

        $stmt->close();
        $db->close();
        return $order;
    }
    public static function getUserOrders($id){
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE user_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $id);
    
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $result = $stmt->get_result();
        $orders = [];
        while ($order = $result->fetch_object("Order")){
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }
}
