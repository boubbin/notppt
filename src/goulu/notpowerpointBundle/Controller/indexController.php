<?php

namespace goulu\notpowerpointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class indexController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    
    public function indexAction()
    {
        //return array('name' => $name);
        return $this->render('goulunotpowerpointBundle:index:index.html.twig');
    }
}
