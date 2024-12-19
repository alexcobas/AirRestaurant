<?php
class Cards{
    private $id;
    private $cardNumber;
    private $cvv;
    private $codPostal;
    private $country;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getCardNumber()
    {
        return $this->cardNumber;
    }
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }
    public function getCvv()
    {
        return $this->cvv;
    }
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;
    }
    public function getCodPostal()
    {
        return $this->codPostal;
    }
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;
    }
    public function getCountry()
    {
        return $this->country;
    }
    public function setCountry($country)
    {
        $this->country = $country;
    }
}