<?php
class User{
    private $id;
    private $username;
    private $name;
    private $surnames;
    private $email;
    private $pasword_hash;
    private $role;
    private $img_profile;

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
    public function getPasword_hash()
    {
        return $this->pasword_hash;
    }

    /**
     * Set the value of pasword_hash
     *
     * @return  self
     */ 
    public function setPasword_hash($pasword_hash)
    {
        $this->pasword_hash = $pasword_hash;

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
}