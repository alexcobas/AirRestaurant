<?php
class Ingredient{
    private $id;
    private $name;
    private $extra_price;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getExtra_price()
    {
        return $this->extra_price;
    }

    public function setExtra_price($extra_price)
    {
        $this->extra_price = $extra_price;

        return $this;
    }

}