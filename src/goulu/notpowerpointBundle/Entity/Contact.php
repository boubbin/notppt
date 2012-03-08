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

    protected $phone;
}
?>
