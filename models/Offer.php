<?php
class Offer{
    private $id;
    private $name;
    private $discount_percentage;
    private $start_date;
    private $end_date;
    

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
     * Get the value of discount_percentage
     */
    public function getDiscount_percentage()
    {
        return $this->discount_percentage;
    }

    /**
     * Set the value of discount_percentage
     *
     * @return  self
     */
    public function setDiscount_percentage($discount_percentage)
    {
        $this->discount_percentage = $discount_percentage;

        return $this;
    }

    /**
     * Get the value of start_date
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set the value of start_date
     *
     * @return  self
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Get the value of end_date
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set the value of end_date
     *
     * @return  self
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;

        return $this;
    }
}