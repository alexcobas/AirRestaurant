<?php
include_once(__DIR__ . "/../config/DataBase.php");
include_once(__DIR__ . "/Offer.php");
include_once(__DIR__ . "/Order.php");
include_once(__DIR__ . "/ProductCart.php");
class OrdersDAO
{
    public static function getAll()
    {
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
            if ($row['user_id']) {
                $order->setUser(UsersDAO::find($row['user_id']));
            }
            $order->setCard_Id($row['card_id']);
            $order->setCard(CardsDAO::find($row['card_id']));
            $order->setAddress_Id($row['address_id']);
            $order->setAddress(AddressesDAO::find($row['address_id']));
            $order->setOrder_Price($row['order_price']);
            $order->setOrder_Price_Total($row['order_price_total']);
            $order->setOffer_Id($row['offer_id']);
            $order->setProducts(OrdersDAO::getProductsByOrderId($row['id']));
            $order->setCreatedAt($row['created_at']);
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }
    public static function getAllApi()
    {
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedidos: " . mysqli_error($db));
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $orders = [];
        while ($row = $result->fetch_assoc()) {
            $order = [
                'id' => $row['id'],
                'user' => UsersDAO::findApi($row['user_id']),
                'card' => CardsDAO::findApi($row['card_id']),
                'address' => AddressesDAO::findApi($row['address_id']),
                'order_price' => $row['order_price'],
                'offer' => $row['offer_id'],
                'order_price_total' => $row['order_price_total'],
                'products' => OrdersDAO::getProductsByOrderIdApi($row['id']),
                'created_at' => $row['created_at']
            ];
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }
    public static function store($order)
    {
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

    public static function getOrdersByUserId($userId)
    {
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
            $order->setProducts(self::getProductsOfOrder($row['id']));
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }

    public static function getProductsOfOrder($orderId)
    {
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
            $product = new ProductCart();
            $product->setId($row['product_id']);
            $product->setBase_Price($row['custom_price']);
            $product->setCuantity($row['quantity']);
            $products[] = $product;
        }
        $stmt->close();
        $db->close();

        // Depuración
        error_log(print_r($products, true));

        return $products;
    }

    public static function getProductsByOrderId($orderId)
    {
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
            $product = ProductsDAO::find($row['product_id']);
            $productCart = new ProductCart();
            $productCart->setId($row['product_id']);
            $productCart->setName($product->getName());
            $productCart->setCategory_Id($product->getCategory_Id());
            $productCart->setDescription($product->getDescription());
            $productCart->setBase_Price($row['custom_price']);
            $productCart->setCuantity($row['quantity']);
            $products[] = $productCart;
        }
        $stmt->close();
        $db->close();
        return $products;
    }
    public static function getProductsByOrderIdApi($orderId)
    {
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
            error_log("Procesando producto con ID: " . $row['product_id']);
            $product = ProductsDAO::find($row['product_id']);
            if ($product) {
                $products[] = [
                    'product' => $product,
                    'name' => $product->getName(),
                    'description' => $product->getDescription(),
                    'custom_price' => $row['custom_price'],
                    'quantity' => $row['quantity']
                ];
            } else {
                error_log("Producto no encontrado para ID: " . $row['product_id']);
            }
        }
        $stmt->close();
        $db->close();
        return $products;
    }

    public static function find($id)
    {
        $db = DataBase::connect();
        $stmt = $db->prepare("SELECT * FROM orders WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de selección de pedido: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $order = new Order();
            $order->setId($row['id']);
            $order->setUser_Id($row['user_id']);
            if ($row['user_id']) {
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
        } else {
            $order = null;
        }

        $stmt->close();
        $db->close();
        return $order;
    }

    public static function getUserOrders($id)
    {
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
        while ($order = $result->fetch_object("Order")) {
            $orders[] = $order;
        }
        $stmt->close();
        $db->close();
        return $orders;
    }

    public static function update($order)
    {
        $db = DataBase::connect();

        // Actualizar el pedido principal en la tabla `orders`
        $stmt = $db->prepare("UPDATE orders SET user_id = ?, card_id = ?, address_id = ?, offer_id = ?, order_price = ?, order_price_total = ? WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de actualización de pedido: " . mysqli_error($db));
        }

        $userId = $order->getUser_Id();
        $cardId = $order->getCard_Id();
        $addressId = $order->getAddress_Id();
        $offerId = $order->getOffer_Id();
        $orderPrice = $order->getOrder_Price();
        $orderPriceTotal = $order->getOrder_Price_Total();
        $id = $order->getId();

        $stmt->bind_param("iiiiddi", $userId, $cardId, $addressId, $offerId, $orderPrice, $orderPriceTotal, $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de actualización de pedido: " . mysqli_error($db));
        }
        $stmt->close();

        // Obtener los productos actuales del pedido
        $currentProducts = self::getProductsOfOrder($id);
        $currentProductIds = array_map(function ($product) {
            return $product->getId();
        }, $currentProducts);

        // Procesar los productos enviados en la actualización
        foreach ($order->getProducts() as $orderProduct) {
            if (!in_array($orderProduct->getId(), $currentProductIds)) {
                self::addProductToOrder($orderProduct, $id);
            }
        }

        // Eliminar productos que ya no están en la lista actualizada
        foreach ($currentProducts as $currentProduct) {
            if (!in_array($currentProduct->getId(), array_map(function ($product) {
                return $product->getId();
            }, $order->getProducts()))) {
                self::removeProductFromOrder($currentProduct->getId(), $id);
            }
        }

        $db->close();
        return true;
    }

    public static function addProductToOrder($orderProduct, $orderId)
    {
        $db = DataBase::connect();
        $stmt = $db->prepare("INSERT INTO order_product (order_id, product_id, custom_price, quantity) VALUES (?, ?, ?, ?)");
        if (!$stmt) {
            die("Error en la preparación de la consulta de inserción de producto: " . mysqli_error($db));
        }

        $productId = $orderProduct->getId();
        $customPrice = $orderProduct->getBase_Price();
        $quantity = $orderProduct->getCuantity();

        $stmt->bind_param("iidi", $orderId, $productId, $customPrice, $quantity);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de inserción de producto: " . mysqli_error($db));
        }

        $stmt->close();
        $db->close();
        return true;
    }

    public static function removeProductFromOrder($productId, $orderId)
    {
        $db = DataBase::connect();
        $stmt = $db->prepare("DELETE FROM order_product WHERE order_id = ? AND product_id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de eliminación de producto: " . mysqli_error($db));
        }

        $stmt->bind_param("ii", $orderId, $productId);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de eliminación de producto: " . mysqli_error($db));
        }

        $stmt->close();
        $db->close();
        return true;
    }

    public static function destroy($id)
    {
        $db = DataBase::connect();
        $stmt = $db->prepare("DELETE FROM orders WHERE id = ?");
        if (!$stmt) {
            die("Error en la preparación de la consulta de eliminación de pedido: " . mysqli_error($db));
        }
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            die("Error al ejecutar la consulta de eliminación de pedido: " . mysqli_error($db));
        }
        $stmt->close();
        $db->close();
        return true;
    }
}
