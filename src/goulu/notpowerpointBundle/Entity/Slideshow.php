<?php
namespace goulu\notpowerpointBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 *@ORM\Entity(repositoryClass="goulu\notpowerpointBundle\Repository\SlideshowRepository")
 * @ORM\Table(name="slideshow") 
 */
class Slideshow
{
     /**
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;
            
     /**
     * @ORM\Column(type="string", length=30)
     */
    protected $name;
    
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
    protected $published;
    
     /**
     * @ORM\Column(type="boolean")
     */    
    protected $deleted;
    
    /**
     * @var ArrayCollection $slides
     */
    protected $slides;  
            
    
    public function __construct()
    {
        $this->slides = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set published
     *
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }

    /**
     * Get published
     *
     * @return boolean 
     */
    public function getPublished()
    {
        return $this->published;
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
     * Add slides
     *
     * @param goulu\notpowerpointBundle\Entity\Slide $slides
     */
    public function addSlide(\goulu\notpowerpointBundle\Entity\Slide $slides)
    {
        $this->slides[] = $slides;
    }

    /**
     * Get slides
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSlides()
    {
        return $this->slides;
    }
}