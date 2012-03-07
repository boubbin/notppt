<?php

namespace goulu\notpowerpointBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity(repositoryClass="goulu\notpowerpointBundle\Repository\ContactRepository")
 * @ORM\Table(name="contact") 
 */
class Contact
{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
    
     /**
     * @ORM\Column(type="datetime")
     */
    protected $creationdate;
    
     /**
     * @ORM\Column(type="datetime")
     */    
    protected $modifieddate;

     /**
     * @ORM\Column(type="boolean")
     */    
    protected $deleted;
    
    /**
     * @ORM\Column(type="string") 
     */
    protected $name;
    
    /**
     *@ORM\Column(type="string") 
     */
    protected $email;
    
    /*
     * @ORM\Column(type="string")
     */
    protected $phone;

    /**
     * Set id
     *
     * @param int $id
     */
    public function setId(\int $id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return int 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creationdate
     *
     * @param datetime $creationdate
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;
    }

    /**
     * Get creationdate
     *
     * @return datetime 
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set modifieddate
     *
     * @param datetime $modifieddate
     */
    public function setModifieddate($modifieddate)
    {
        $this->modifieddate = $modifieddate;
    }

    /**
     * Get modifieddate
     *
     * @return datetime 
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}