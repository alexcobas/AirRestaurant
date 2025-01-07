<?php
class Address{
    private $id;
    private $user_id;
    private $address;
    private $city;
    private $codPostal;

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    public function getUser_id(){
        return $this->user_id;
    }
    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }
    public function getAddress(){
        return $this->address;
    }
    public function setAddress($address){
        $this->address = $address;
    }
    public function getCity(){
        return $this->city;
    }
    public function setCity($city){
        $this->city = $city;
    }
    public function getCodPostal(){
        return $this->codPostal;
    }
    public function setCodPostal($codPostal){
        $this->codPostal = $codPostal;
    }
}