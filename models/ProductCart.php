<?php
include_once(__DIR__ . "/Product.php");
class ProductCart extends Product
{
    private $cuantity;

    /**
     * Get the value of cuantity
     */
    public function getCuantity()
    {
        return $this->cuantity;
    }

    /**
     * Set the value of cuantity
     *
     * @return  self
     */
    public function setCuantity($cuantity)
    {
        $this->cuantity = $cuantity;

        return $this;
    }
    public function toArray()
    {
        return array_merge(parent::toArray(), [ // Llama al método toArray de la clase padre (Product)
            'cuantity' => $this->getCuantity()
        ]);
    }
}
