<?php

namespace goulu\notpowerpointBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 *@ORM\Entity(repositoryClass="goulu\notpowerpointBundle\Repository\SlideRepository")
 * @ORM\Table(name="slide") 
 */
class Slide
{
     /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;
  
     /**
     * @ORM\Column(type="string")
     */
    protected $slideshowid;
    
     /**
     * @ORM\Column(type="integer")
     */
    protected $slidenumber;    
    
     /**
     * @ORM\Column(type="datetime")
     */
    protected $creationdate;
    
     /**
     * @ORM\Column(type="datetime")
     */    
    protected $modifieddate;
    
     /**
     * @ORM\Column(type="text")
     */    
    protected $content;
    
     /**
     * @ORM\Column(type="boolean")
     */    
    protected $showable;

     /**
     * @ORM\Column(type="boolean")
     */    
    protected $deleted;            
              

    /**
     * Set id
     *
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set slideshowid
     *
     * @param string $slideshowid
     */
    public function setSlideshowid($slideshowid)
    {
        $this->slideshowid = $slideshowid;
    }

    /**
     * Get slideshowid
     *
     * @return string 
     */
    public function getSlideshowid()
    {
        return $this->slideshowid;
    }

    /**
     * Set slidenumber
     *
     * @param integer $slidenumber
     */
    public function setSlidenumber($slidenumber)
    {
        $this->slidenumber = $slidenumber;
    }

    /**
     * Get slidenumber
     *
     * @return integer 
     */
    public function getSlidenumber()
    {
        return $this->slidenumber;
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
     * Set content
     *
     * @param text $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * Get content
     *
     * @return text 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set show
     *
     * @param boolean $show
     */
    public function setShow($show)
    {
        $this->showable = $show;
    }

    /**
     * Get show
     *
     * @return boolean 
     */
    public function getShow()
    {
        return $this->showable;
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
}