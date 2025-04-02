<?php
class Order
{
    private $id;
    private $user_id;
    private $user;
    private $card_id;
    private $card;
    private $address_id;
    private $address;
    private $offer_id;
    private $created_at;
    private $order_price;
    private $order_price_total;
    private $products = [];

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUser_Id($user_id)
    {
        $this->user_id = $user_id;
    }

    public function getUser_Id()
    {
        return $this->user_id;
    }

    public function setCard_Id($card_id)
    {
        $this->card_id = $card_id;
    }

    public function getAddress_Id()
    {
        return $this->address_id;
    }

    public function setAddress_Id($address_id)
    {
        $this->address_id = $address_id;
    }

    public function getOffer_Id()
    {
        return $this->offer_id;
    }

    public function setOffer_Id($offer_id)
    {
        $this->offer_id = $offer_id;
    }


    public function getCard_Id()
    {
        return $this->card_id;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setOrder_Price($order_price)
    {
        $this->order_price = $order_price;
    }

    public function getOrder_Price()
    {
        return $this->order_price;
    }

    public function setOrder_Price_Total($order_price_total)
    {
        $this->order_price_total = $order_price_total;
    }

    public function getOrder_Price_Total()
    {
        return $this->order_price_total;
    }

    public function setProducts($products)
    {
        $this->products = $products;
    }

    public function addProduct($product)
    {
        $this->products[] = $product;
    }

    public function getProducts()
    {
        return $this->products;
    }
    public function getDate()
    {
        $date = new DateTime($this->created_at);
        return $date->format('d/m/Y');
    }
    public function setAddress($address)
    {
        $this->address = $address;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function setCard($card)
    {
        $this->card = $card;
    }
    public function getCard()
    {
        return $this->card;
    }
    public function setUser($user)
    {
        $this->user = $user;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function toArray() {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'user' => $this->user ? $this->user->toArray() : null, // Si 'user' es un objeto, también lo convierto a array
            'card_id' => $this->card_id,
            'card' => $this->card ? $this->card->toArray() : null, // Si 'card' es un objeto, lo convierto
            'address_id' => $this->address_id,
            'address' => $this->address ? $this->address->toArray() : null, // Si 'address' es un objeto, lo convierto
            'order_price' => $this->order_price,
            'order_price_total' => $this->order_price_total,
            'offer_id' => $this->offer_id,
            'products' => $this->products, // Suponiendo que es un array de productos, lo mantengo
        ];
    }
}
