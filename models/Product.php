<?php
class Product
{

    const TYPE_HAMBURGUESA = 1;
    const TYPE_BOCATA = 2;
    private $id;
    private $name;
    private $description;
    private $base_price;
    private $category_id;
    private $images;
    private $category;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /*public function __construct($name, $description, $base_price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->base_price = $base_price;
    }*/

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getBase_price()
    {
        return $this->base_price;
    }

    public function setBase_price($base_price)
    {
        $this->base_price = $base_price;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


    /**
     * Get the value of images
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set the value of images
     *
     * @return  self
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get the value of category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set the value of category
     *
     * @return  self
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get the value of category_id
     */
    public function getCategory_id()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @return  self
     */
    public function setCategory_id($category_id)
    {
        $this->category_id = $category_id;

        return $this;
    }
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'base_price' => $this->getBase_price(),
            'category_id' => $this->getCategory_id(),
            'images' => $this->getImages(), // Asegúrate de que las imágenes sean un array o serializables
            'category' => $this->getCategory() // Asegúrate de que la categoría sea un array o tenga un método toArray
        ];
    }
}
