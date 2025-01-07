<?php
class User{
    private $id;
    private $username;
    private $name;
    private $surnames;
    private $email;
    private $password_hash;
    private $role;
    private $img_profile;
    private $cards;
    private $addresses;
    private $orders;
    private $created_at;
    private $accountAge;
    private $accountAgeUnitLabel;

    public function __construct() {
        $this->calcularTiempoCuenta();
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of surnames
     */ 
    public function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * Set the value of surnames
     *
     * @return  self
     */ 
    public function setSurnames($surnames)
    {
        $this->surnames = $surnames;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pasword_hash
     */ 
    public function getPassword_hash()
    {
        return $this->password_hash;
    }

    /**
     * Set the value of pasword_hash
     *
     * @return  self
     */ 
    public function setPassword_hash($password_hash)
    {
        $this->password_hash = $password_hash;

        return $this;
    }
    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get the value of img_profile
     */ 
    public function getImg_profile()
    {
        return $this->img_profile;
    }

    /**
     * Set the value of img_profile
     *
     * @return  self
     */ 
    public function setImg_profile($img_profile)
    {
        $this->img_profile = $img_profile;

        return $this;
    }
    public function setCards($cards){
        $this->cards = $cards;

        return $this;
    }
    public function getCards() {
        return $this->cards;
    }
    public function addCard($card) {
        $this->cards[] = $card;
    }
    public function deleteCard($cardId) {
        foreach ($this->cards as $key => $card) {
            if ($card->getId() == $cardId) {
                unset($this->cards[$key]);
                break;
            }
        }
    }
    public function setAddresses($addresses){
        $this->addresses = $addresses;

        return $this;
    }
    public function getAddresses() {
        return $this->addresses;
    }
    public function setOrders($orders){
        $this->orders = $orders;

        return $this;
    }
    public function getOrders() {
        return $this->orders;
    }
    /**
     * Get the value of created_at
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
    /**
     * Get the value of accountAge
     */
    public function getAccountAge()
    {
        return $this->accountAge;
    }

    /**
     * Set the value of accountAge
     *
     * @return  self
     */
    public function setAccountAge($accountAge)
    {
        $this->accountAge = $accountAge;

        return $this;
    }
    /**
     * Get the value of accountAgeUnitLabel
     */
    public function getAccountAgeUnitLabel()
    {
        return $this->accountAgeUnitLabel;
    }

    /**
     * Set the value of accountAgeUnitLabel
     *
     * @return  self
     */
    public function setAccountAgeUnitLabel($accountAgeUnitLabel)
    {
        $this->accountAgeUnitLabel = $accountAgeUnitLabel;

        return $this;
    }

    public function calcularTiempoCuenta() {
        $fechaCreacion = new DateTime($this->created_at);
        $fechaActual = new DateTime();
        $intervalo = $fechaCreacion->diff($fechaActual);
        if ($intervalo->y > 0) {
            $this->accountAge = $intervalo->y;
            $this->accountAgeUnitLabel = $intervalo->y > 1 ? 'años' : 'año';
        } else {
            $this->accountAge = $intervalo->m == 0 ? 1 : $intervalo->m;
            $this->accountAgeUnitLabel = $intervalo->m > 1 ? 'meses' : 'mes';
        } 
    }
    public function getFormattedEmail()
    {
        $email = $this->getEmail(); 
        $firstChar = substr($email, 0, 1);
        $emailParts = explode('@', $email);
        return $firstChar . "***@" . $emailParts[1]; 
    }
    public function getPrimaryCard() {
        foreach ($this->cards as $card) {
            if ($card->getIsPrimary()) {
                return $card;
            }
        }
        return null;
    }
}