<?php

namespace goulu\notpowerpointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class slideshowController extends Controller
{
    
     /**
     * @Route("/slideshow/show/{id}")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $slideshow = $em->getRepository('goulunotpowerpointBundle:Slideshow')->find($id);
        if (!$slideshow) 
        {
            throw $this->createNotFoundException('Unable to find Slideshow.');
        }
        else
        {
            $slides = $em->getRepository('goulunotpowerpointBundle:Slide')
                ->getBySlideshowId($slideshow->getId());
        }

        return $this->render('goulunotpowerpointBundle:slideshow:edit.html.twig', 
                array('slideshow' => $slideshow,
                      'slides' => $slides));
        return $this->render('goulunotpowerpointBundle:slideshow:new.html.twig', array('slideshow', $slideshow));
    }
    
    /**
     * @Route("/slideshow/new")
     * @Template()
     */
    public function newAction()
    {
        return $this->render('goulunotpowerpointBundle:slideshow:new.html.twig');
    }
    
    /**
     *@Route("/slideshow/edit/{id}")
     *@Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $slideshow = $em->getRepository('goulunotpowerpointBundle:Slideshow')->find($id);
        if (!$slideshow) 
        {
            throw $this->createNotFoundException('Unable to find Slideshow.');
        }
        else
        {
            $slides = $em->getRepository('goulunotpowerpointBundle:Slide')
                ->getBySlideshowId($slideshow->getId());
        }

        return $this->render('goulunotpowerpointBundle:slideshow:edit.html.twig', 
                array('slideshow' => $slideshow,
                      'slides' => $slides));
    }
}
