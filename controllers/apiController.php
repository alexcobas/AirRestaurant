<?php

include_once __DIR__ . '/../models/User.php';
include_once __DIR__ . '/../models/UsersDAO.php';
include_once __DIR__ . '/../models/Product.php';
include_once __DIR__ . '/../models/ProductsDAO.php';
include_once __DIR__ . '/../models/Order.php';
include_once __DIR__ . '/../models/OrdersDAO.php';

class apiController
{
    // Métodos para los usuarios
    public static function getUsers()
    {
        $users = UsersDAO::getAllApi();
        return $users;
    }

    public static function getUser($id)
    {
        $user = UsersDAO::find($id);
        if ($user) {
            return $user->toArray();
        }
        return $user;
    }

    public static function createUser($data)
    {
        if (
            empty($data['username']) ||
            empty($data['name']) ||
            empty($data['surnames']) ||
            empty($data['email']) ||
            empty($data['password']) ||
            empty($data['role'])
        ) {
            return false;
        }

        $user = new User();
        $user->setUsername($data['username']);
        $user->setName($data['name']);
        $user->setSurnames($data['surnames']);
        $user->setEmail($data['email']);
        $user->setPassword_hash(password_hash($data['password'], PASSWORD_BCRYPT));
        $user->setRole($data['role']);
        $user->setImg_profile($data['img_profile'] ?? null);

        $result = UsersDAO::store($user);

        if ($result) {
            return $user->toArray();
        }

        return false;
    }

    public static function updateUser($id, $data)
    {
        if ($id && $data) {
            return UsersDAO::updateAll($id, $data);
        }
        return false;
    }

    public static function deleteUser($id)
    {
        $user = null;
        if ($id) {
            $user = UsersDAO::destroy($id);
        }

        return $user;
    }

    // Métodos para los productos
    public static function getProducts()
    {
        $products = ProductsDAO::getAllApi();
        return $products;
    }

    public static function getProduct($id)
    {
        $product = ProductsDAO::find($id);
        if ($product) {
            return $product->toArray();
        }
        return $product;
    }

    public static function createProduct($data)
    {
        if (
            empty($data['name']) ||
            empty($data['description']) ||
            empty($data['base_price']) ||
            empty($data['img'])
        ) {
            return false;
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setBase_price($data['base_price']);
        $product->addImage($data['img'] ?? null);

        $result = ProductsDAO::store($product);

        if ($result) {
            return $product->toArray();
        }

        return $product;
    }

    public static function updateProduct($id, $data)
    {
        if ($id && $data) {
            return ProductsDAO::updateAll($id, $data);
        }
        return false;
    }

    public static function deleteProduct($id)
    {
        $product = null;
        if ($id) {
            $product = ProductsDAO::destroy($id);
        }

        return $product;
    }

    // Métodos para los pedidos
    public static function getOrders()
{
    $orders = OrdersDAO::getAll(); // Esto devuelve un array de objetos Order
    $ordersArray = [];

    // Convertir cada objeto Order a un array
    foreach ($orders as $order) {
        $ordersArray[] = $order->toArray(); // Llamamos a toArray() para convertir el objeto a un array
    }

    return $ordersArray;
}


    public static function getOrder($id)
    {
        $order = OrdersDAO::find($id);
        if ($order) {
            return $order->toArray();
        }
        return $order;
    }

    // public static function createOrder($data)
    // {
    //     if (
    //         empty($data['user_id']) ||
    //         empty($data['product_ids']) ||
    //         empty($data['total'])
    //     ) {
    //         return false;
    //     }

    //     $order = new Order();
    //     $order->setUserId($data['user_id']);
    //     $order->setProductIds($data['product_ids']);
    //     $order->setTotal($data['total']);
    //     $order->setStatus($data['status'] ?? 'pending');

    //     $result = OrdersDAO::store($order);

    //     if ($result) {
    //         return $order->toArray();
    //     }

    //     return false;
    // }

    public static function updateOrder($id, $data)
    {
        if ($id && $data) {
            return OrdersDAO::updateAll($id, $data);
        }
        return false;
    }

    public static function deleteOrder($id)
    {
        $order = null;
        if ($id) {
            $order = OrdersDAO::destroy($id);
        }

        return $order;
    }
}
?>
