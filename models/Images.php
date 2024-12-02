<?php
class Images{
    private $id;
    private $product_id;
    private $photo_archive_name;

    


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
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of photo_archive_name
     */ 
    public function getPhoto_archive_name()
    {
        return $this->photo_archive_name;
    }

    /**
     * Set the value of photo_archive_name
     *
     * @return  self
     */ 
    public function setPhoto_archive_name($photo_archive_name)
    {
        $this->photo_archive_name = $photo_archive_name;

        return $this;
    }
}