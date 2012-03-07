<?php

namespace goulu\notpowerpointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use goulu\notpowerpointBundle\Entity\Slideshow;
use goulu\notpowerpointBundle\Entity\Slide;



class ajaxController extends Controller
{
     /**
     * @Route("/ajax/slideshow/save")
     */
    public function saveSlideshowAction()
    {   
        $request      = $this->get('request');
        $id           = $request->request->get('id', 'null');
        if($id == 'null')
        {
            saveNewSlideshow();
        }
        else
        {
            UpdateExistingSlideshow($id);
        }
    }
    
    function saveNewSlideshow()
    {
        $slideshow = new Slideshow();
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->get('request');
        $name         = $request->request->get('name');
        $slides       = $request->request->get('slides');
        $creationdate = new \DateTime();
        $modifieddate = new \DateTime();
        foreach($slides as $slide)
        {
            saveNewSlide($slide);
        }
        $slideshow->setName($name);
        $slideshow->setId(gen_uuid());
        $slideshow->setCreationdate($creationdate);
        $slideshow->setModifieddate($modifieddate);
        $slideshow->setPublished(1);
        $slideshow->setDeleted(0);   
        $em->persist($slideshow);
        $em->flush();
    }
    
    function updateExistingSlideshow($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->get('request');
        $name = $request->request->get('name');
        $modifieddate = new \DateTime();
        $slides = $request->request->get('slides');
        $slideshow = $em->getRepository('goulunotpowerpointBundle:Slideshow')->find($id);
        
        if(!$slideshow)
        {
            throw $this->createNotFoundException('Slideshow not found');
        }
        else
        {
            $slideshow->setName($name);
            $slideshow->setModifieddate($modifieddate);
            $slideshow->setPublished(1);
            $slideshow->setDeleted(0);
            $em->persist($slideshow);
            foreach($slides as $slide)
            {
                updateExistingSlide($slide);
            }
        }
        $em->flush();
    }
    
    function updateExistingSlide($slide)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $dbslide = $em->getRepository('goulunotpowerpointBundle:Slide')->find($slide['id']);
        if(!$dbslide)
        {
            saveNewSlide($slide);
        }
        else
        {
            $dbslide->setSlidenumber($slide['ord']);
            $dbslide->setContent($slide['content']);
            $dbslide->setShow($slide['showable']);
            $em->persist($dbslide);
        }
    }
    
    function saveNewSlide($slide)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $modifieddate = new \DateTime();
        $creationdate = new \DateTime();
        $slide = new Slide();
        $slide->setId(gen_uuid());
        $slide->setSlidenumber($slide['ord']);
        $slide->setContent($slide['content']);
        $slide->setSlideshowid(gen_uuid());
        $slide->setCreationdate($creationdate);
        $slide->setModifieddate($modifieddate);
        $slide->setDeleted(0);
        $slide->setShow($slide['showable']);
        $em->persist($slide);
    }
    
    function gen_uuid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
}
}
?>
