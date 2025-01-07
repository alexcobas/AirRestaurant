<?php
require($_SERVER['DOCUMENT_ROOT'] . "/AirRestaurant/config/init.php");
include_once("models/Order.php");
include_once("models/OrdersDAO.php");
include_once("models/Card.php");
include_once("models/CardsDAO.php");
include_once("models/Address.php");
include_once("models/AddressesDAO.php");
include_once("models/Offer.php");
include_once("models/OffersDAO.php");
include_once("models/ProductCart.php");
class cartController
{
    private $controller = "cart";
    public function index()
    {
        $controller = $this->controller;
        $header = "views/headers/header3.php";
        $view = "views/cart/index.php";
        $footer = "views/footers/footer1.php";
        $cart = $_SESSION["cart"] ?? [];
        $user = $_SESSION["user"] ?? null;
        $offer = $_SESSION["offerCart"] ?? null;
        $cards = $user ? $user->getCards() : [];
        $total = $this->calculateTotal($cart);
        $totalOffers = $offer != null ? $this->calculateTotalOffers($total, $offer) : null;
        include_once("views/main.php");
    }

    private function calculateTotal($cart)
    {
        return array_reduce($cart, fn($total, $product) => $total + $product->getBase_price() * $product->getCuantity(), 0);
    }

    private function calculateTotalOffers($total, $offer)
    {
        if ($offer) {
            $total =  number_format($total - ($total * $offer->getDiscount_percentage() / 100),2);
        }
        return $total;
    }

    public function addToCart()
    {
        $productId = $_GET['productId'];
        $product = ProductsDAO::find($productId);
        $productCart = $this->convertToProductCart($product);
        if ($product === null) {
            die("Error: Producto no encontrado con ID: $productId");
        }
        $productExists = false;
        foreach ($_SESSION['cart'] ?? [] as $existingProduct) {
            if ($existingProduct->getId() === $productCart->getId()) {
                $productExists = true;
                $cuantity = $existingProduct->getCuantity();
                $cuantity++;
                $existingProduct->setCuantity($cuantity);
                break;
            }
        }
        if (!$productExists) {
            $_SESSION['cart'][] = $productCart;
        }
        
        header("Location: " . url . "product/");
    }

    public function convertToProductCart(Product $product) {
        $productCart = new ProductCart();
        $productCart->setId($product->getId());
        $productCart->setName($product->getName());
        $productCart->setDescription($product->getDescription());
        $productCart->setBase_price($product->getBase_price());
        $productCart->setCategory_id($product->getCategory_id());
        $productCart->setImages($product->getImages());
        $productCart->setCategory($product->getCategory());
        $productCart->setCuantity(1);
        

        return $productCart;
    } 

    public function removeFromCart()
    {
        $productId = $_GET['productId'];
        if(isset($_GET['controller'])){
            $controller = $_GET['controller'];
        }
        $cart = $_SESSION['cart'] ?? [];
        $cart = array_filter($cart, fn($product) => $product->getId() != $productId);
        $_SESSION['cart'] = $cart;
        if(isset($_GET['controller'])){
            header("Location: " . url . "$controller/");
        } else{
            header("Location: " . url . "cart/");
        }
    }
    public function removeFromCartHeader()
    {
        $productId = $_POST['productId'];
        if(isset($_POST['controller'])){
            $controller = $_POST['controller'];
        }
        $cart = $_SESSION['cart'] ?? [];
        $cart = array_filter($cart, fn($product) => $product->getId() != $productId);
        $_SESSION['cart'] = $cart;
        if(isset($_POST['controller'])){
            header("Location: " . url . "$controller/");
        } else{
            header("Location: " . url . "cart/");
        }
    }

    public function createOrder()
    {
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
        $city = $_POST["city"];
        $deliveryAddress = $_POST["address"];
        $addressPostalCode = $_POST["addressPostalCode"];
        $userId = isset($_SESSION["user"]) ? $_SESSION["user"]->getId() : null;
        $address = new Address();
        $address->setUser_id($userId);
        $address->setAddress($deliveryAddress);
        $address->setCodPostal($addressPostalCode);
        $address->setCity($city);
        $idAddress = AddressesDAO::store($address);
        $total = $_POST["totalPrice"];
        $totalOffers = $_POST["totalOffers"] != null ? $_POST["totalOffers"] : $total;
        $userId = isset($_SESSION["user"]) ? $_SESSION["user"]->getId() : null;
        $offerId = isset($_SESSION["offerCart"]) ? $_SESSION["offerCart"]->getId() : null;
        $order = new Order();
        $order->setUser_id($userId);
        $order->setCard_id($idCard);
        $order->setAddress_Id($idAddress);
        $order->setOffer_Id($offerId);
        $order->setOrder_Price($total);
        $order->setOrder_Price_Total($totalOffers);
        $productsCart = $_SESSION["cart"] ?? [];
        foreach ($productsCart as $productCart) {
           
            $order->addProduct($productCart);
        }
        $orderId = OrdersDAO::store($order);
        $_SESSION["cart"] = [];
        unset($_SESSION["offerCart"]);
        if(!empty($_POST["controller"])){
            $controller = $_POST["controller"];
            header("Location: " . url . "$controller/");
        } else{
            header("Location: " . url . "cart/");
        }
    }
    public function addPromotion(){
        $promoCode = trim($_POST["promo_code"]);
        echo OffersDAO::existsOfferName($promoCode);
        if(OffersDAO::existsOfferName($promoCode) != 1){
            unset($_SESSION['offerCart']);
            $error = "Este código promocional no existe.";
            header("Location: " . url . "cart/?errorOffers=$error");
        } else{
            $_SESSION["offerCart"] = OffersDAO::getOfferByName($promoCode);
            header("Location: " . url . "cart/");
        }
    }
    public function removePromotion(){
        unset($_SESSION['offerCart']);
        header("Location: " . url . "cart/");
    }
}
