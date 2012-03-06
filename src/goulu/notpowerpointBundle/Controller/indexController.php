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
        $em = $this->getDoctrine()->getEntityManager();
        $slideshows = $em->getRepository('goulunotpowerpointBundle:Slideshow')->getAllSlideshows();
        if (!$slideshows) 
        {
            throw $this->createNotFoundException('Unable to find Slideshows.');
        }
        return $this->render('goulunotpowerpointBundle:index:index.html.twig', array('slideshows' => $slideshows));
    }
}
