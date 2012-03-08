<?php

namespace goulu\notpowerpointBundle\Entity;
use Doctrine\ORM\Mapping as ORM;


class Contact
{

    protected $id;
    
    protected $creationdate;
   
    protected $modifieddate;
    
    protected $deleted;
    
    protected $name;

    protected $email;


    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
}

