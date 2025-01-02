<?php
require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/init.php");
include_once("models/Order.php");
include_once("models/OrdersDAO.php");
include_once("models/Card.php");
include_once("models/CardsDAO.php");
class cartController
{
    public function index()
    {
        $header = "views/headers/header3.php";
        $view = "views/cart/index.php";
        $footer = "views/footers/footer1.php";
        $cart = $_SESSION["cart"] ?? [];
        $user = $_SESSION["user"] ?? null;
        $cards = $user ? $user->getCards() : [];
        $total = $this->calculateTotal($cart);
        include_once("views/main.php");
    }

    private function calculateTotal($cart)
    {
        return array_reduce($cart, fn($total, $product) => $total + $product->getBase_price(), 0);
    }

    public function addToCart()
    {
        $productId = $_GET['productId'];
        $product = ProductsDAO::find($productId);

        if ($product === null) {
            die("Error: Producto no encontrado con ID: $productId");
        }
        $_SESSION['cart'][] = $product;
        header("Location: " . url . "product/");
    }

    public function createOrder()
    {
        var_dump($_POST);
        if (isset($_POST["newTarget"]) && $_POST["newTarget"] == "on") {
            $error = "Rellene todos los campos porfavor";
            if (empty($_POST["cardNumber"]) || empty($_POST["expiry"]) || empty($_POST["cvv"]) || empty($_POST["postalCode"]) || empty($_POST["country"])) {
                $error = "Rellene todos los campos porfavor";
                header("Location: " . url . "cart/?error=$error");
            }
            $cardNumber = $_POST["cardNumber"];
            $expirationDate = $_POST["expiry"];
            $cvv = $_POST["cvv"];
            $codPostal = $_POST["postalCode"];
            $country = $_POST["country"];
            $userId = isset($_SESSION["user"]) ? $_SESSION["user"]->getId() : null;
            $card = new Card();
            $card->setCardNumber($cardNumber);
            $card->setExpirationDate($expirationDate);
            $card->setCvv($cvv);
            $card->setCodPostal($codPostal);
            $card->setCountry($country);
            $card->setUser_id($userId);
            $card->getIsPrimary(0);
            $idCard = CardsDAO::store($card);
            isset($_SESSION["user"]) ? $_SESSION["user"]->addCard($card) : "";
        } else {
            $idCard = $_POST["idCardSelect"];
        }
        $total = $_POST["totalPrice"];
        $userId = isset($_SESSION["user"]) ? $_SESSION["user"]->getId() : null;
        $order = new Order();
        $order->setUser_id($userId);
        $order->setCard_id($idCard);
        $order->setOrder_Price($total);
        $products = $_SESSION["cart"] ?? [];
        $productsCuantities = [];
        foreach ($products as $product) {
            $productId = $product->getId();

            if (isset($productsCuantities[$productId])) {
                $productsCuantities[$productId]["quantity"] += 1;
            } else {
                $productsCuantities[$productId] = [
                    "quantity" => 1,
                    "product" => $product
                ];
            }
        }
        foreach ($productsCuantities as $productId => $productData) {
            $product = $productData["product"];
            $quantity = $productData["quantity"];
            $order->addProduct($product, $quantity);
        }
        $orderId = OrdersDAO::store($order);
    }
}
