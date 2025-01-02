<?php
class Order
{
    private $id;
    private $user_id;
    private $card_id;
    private $created_at;
    private $order_price;
    private $products = []; // Lista de productos asociados

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

    public function addProduct($product, $quantity)
    {
        $this->products[] = [
            'product' => $product,
            'quantity' => $quantity,
        ];
    }

    public function getProducts()
    {
        return $this->products;
    }
}
