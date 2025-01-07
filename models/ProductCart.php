<?php
include_once("models/Product.php");
class ProductCart extends Product{
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
}