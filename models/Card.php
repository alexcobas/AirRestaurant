<?php
class Card
{
    private $id;
    private $user_id;
    private $cardNumber;
    private $cvv;
    private $expirationDate;
    private $codPostal;
    private $country;
    private $isPrimary;



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
     * Get the value of user_id
     */
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * Get the value of cardNumber
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set the value of cardNumber
     *
     * @return  self
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get the value of cvv
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set the value of cvv
     *
     * @return  self
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * Get the value of expirationDate
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set the value of expirationDate
     *
     * @return  self
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get the value of codPostal
     */
    public function getCodPostal()
    {
        return $this->codPostal;
    }

    /**
     * Set the value of codPostal
     *
     * @return  self
     */
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    /**
     * Get the value of country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set the value of country
     *
     * @return  self
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }
    /**
     * Get the value of isPrimary
     */
    public function getIsPrimary()
    {
        return $this->isPrimary;
    }

    /**
     * Set the value of isPrimary
     *
     * @return  self
     */
    public function setIsPrimary($isPrimary)
    {
        $this->isPrimary = $isPrimary;

        return $this;
    }
    public function getCardBrand()
    {
        $cardNumber = $this->getCardNumber();

        if (preg_match("/^4/", $cardNumber)) {
            return "VISA";
        } elseif (preg_match("/^5[1-5]/", $cardNumber) || preg_match("/^2[2-7]/", $cardNumber)) {
            return "MasterCard";
        } elseif (preg_match("/^3[47]/", $cardNumber)) {
            return "American Express";
        } elseif (preg_match("/^6/", $cardNumber)) {
            return "Discover";
        } elseif (preg_match("/^35/", $cardNumber)) {
            return "JCB";
        } else {
            return "Unknown";
        }
    }
    public function getCardImage()
    {
        $cardImages = [
            "VISA" => "https://upload.wikimedia.org/wikipedia/commons/thumb/0/04/Visa.svg/1200px-Visa.svg.png",
            "MasterCard" => "https://upload.wikimedia.org/wikipedia/commons/a/a4/Mastercard_2019_logo.svg",
            "American Express" => "https://upload.wikimedia.org/wikipedia/commons/f/fa/American_Express_logo_%282018%29.svg",
            "Discover" => "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e5/DiscoverCard.svg/1920px-DiscoverCard.svg.png",
            "JCB" => "https://upload.wikimedia.org/wikipedia/commons/4/40/JCB_logo.svg",
        ];

        $brand = $this->getCardBrand();

        return $cardImages[$brand] ?? "default";
    }
    public function getFormattedCardNumber()
    {
        $cardNumber = $this->getCardNumber();
        $lastFour = substr($cardNumber, -4);
        return "•••• " . $lastFour;
    }
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUser_id(),
            'cardNumber' => $this->getCardNumber(),
            'cvv' => $this->getCvv(),
            'expirationDate' => $this->getExpirationDate(),
            'codPostal' => $this->getCodPostal(),
            'country' => $this->getCountry(),
            'isPrimary' => $this->getIsPrimary(),
            'cardBrand' => $this->getCardBrand(),
            'cardImage' => $this->getCardImage(),
            'formattedCardNumber' => $this->getFormattedCardNumber()
        ];
    }
}
