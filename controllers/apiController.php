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
            empty($data['img']) ||
            empty($data[['category_id']])
        ) {
            return false;
        }

        $product = new Product();
        $product->setName($data['name']);
        $product->setDescription($data['description']);
        $product->setBase_price($data['base_price']);
        $product->setCategory_Id($data['category_id']);
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
        $orders = OrdersDAO::getAll();
        $ordersArray = [];

        foreach ($orders as $order) {
            $ordersArray[] = $order->toArray();
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

    public static function createOrder($data)
    {
        // Verificar que los datos requeridos estén presentes
        if (
            empty($data['user_id']) ||
            empty($data['order_price']) ||
            empty($data['products']) // Verificar que se envíen productos
        ) {
            return false; // Datos incompletos
        }

        // Crear una instancia de Order y rellenar los datos
        $order = new Order();
        $order->setUser_Id($data['user_id']);
        $order->setCard_Id($data['card_id'] ?? null); // Opcional
        $order->setAddress_Id($data['address_id'] ?? null); // Opcional
        $order->setOffer_Id($data['offer_id'] ?? null); // Opcional
        $order->setOrder_Price($data['order_price']);
        $order->setOrder_Price_Total($data['order_price_total'] ?? $data['order_price']); // Total opcional

        // Procesar los productos
        $products = [];
        foreach ($data['products'] as $productData) {
            if (isset($productData['id'], $productData['quantity'], $productData['custom_price'])) {
                $productCart = new ProductCart();
                $productCart->setId($productData['id']);
                $productCart->setCuantity($productData['quantity']);
                $productCart->setBase_Price($productData['custom_price']);
                $products[] = $productCart; // Agregar el producto al array
            }
        }
        $order->setProducts($products);

        // Guardar el pedido en la base de datos
        $result = OrdersDAO::store($order);

        // Retornar el pedido creado como array si se guardó correctamente
        if ($result) {
            return $order->toArray();
        }

        return false; // Error al guardar el pedido
    }

    public static function updateOrder($id, $data)
    {
        if ($id && $data) {
            $order = OrdersDAO::find($id);
            $order->setUser_Id($data['user_id'] ?? $order->getUser_Id());
            $order->setCard_Id($data['card_id'] ?? $order->getCard_Id());
            $order->setAddress_Id($data['address_id'] ?? $order->getAddress_Id());
            $order->setOffer_Id($data['offer_id'] ?? $order->getOffer_Id());
            $order->setOrder_Price($data['order_price'] ?? $order->getOrder_Price());
            $order->setOrder_Price_Total($data['order_price_total'] ?? $order->getOrder_Price_Total());

            // Procesar los productos
            $products = [];
            foreach ($data['products'] as $productData) {
                if (isset($productData['id'], $productData['quantity'], $productData['custom_price'])) {
                    $productCart = new ProductCart();
                    $productCart->setId($productData['id']);
                    $productCart->setCuantity($productData['quantity']);
                    $productCart->setBase_Price($productData['custom_price']);
                    $products[] = $productCart;
                }
            }
            $order->setProducts($products);

            return OrdersDAO::update($order);
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

    public static function getCategories()
    {
        $categories = CategoriesDAO::getAllApi();
        return $categories;
    }
}
