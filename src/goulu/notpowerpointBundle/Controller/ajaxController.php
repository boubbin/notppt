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
        $request = $this->get('request');
        $id      = $request->request->get('id', 'null');
        if($id == 'null' | $id == '')
        {
            $this->saveNewSlideshow();
        }
        else
        {
            return new Response('id= ' . $id);
            $this->updateExistingSlideshow($id);
        }
    }
    function saveNewSlideshow()
    {
        $slideshow    = new Slideshow();
        $em           = $this->getDoctrine()->getEntityManager();
        $request      = $this->get('request');
        $name         = $request->request->get('name');
        $slides       = $request->request->get('slides');
        $creationdate = new \DateTime();
        $modifieddate = new \DateTime();
        foreach($slides as $slide)
        {
            $this->saveNewSlide($slide);
        }
        $slideshow->setName($name)
                  ->setId($this->gen_uuid())
                  ->setCreationdate($creationdate)
                  ->setModifieddate($modifieddate)
                  ->setPublished(1)
                  ->setDeleted(0);   
        $em->persist($slideshow);
        $em->flush();
    }
    function updateExistingSlideshow($id)
    {
        $em           = $this->getDoctrine()->getEntityManager();
        $request      = $this->get('request');
        $name         = $request->request->get('name');
        $modifieddate = new \DateTime();
        $slides       = $request->request->get('slides');
        $slideshow    = $em->getRepository('goulunotpowerpointBundle:Slideshow')->find($id);
        
        if(!$slideshow)
        {
            throw $this->createNotFoundException('Slideshow not found');
        }
        else
        {
            $slideshow->setName($name)
                      ->setModifieddate($modifieddate)
                      ->setPublished(1)
                      ->setDeleted(0);
            $em->persist($slideshow);
            foreach($slides as $slide)
            {
                $this->updateExistingSlide($slide);
            }
        }
        $em->flush();
    }
    
    function updateExistingSlide($slide)
    {
        $em      = $this->getDoctrine()->getEntityManager();
        $dbslide = $em->getRepository('goulunotpowerpointBundle:Slide')->find($slide['id']);
        if(!$dbslide)
        {
            $this->saveNewSlide($slide);
        }
        else
        {
            $dbslide->setSlidenumber($slide['ord'])
                    ->setContent($slide['content'])
                    ->setShow($slide['showable']);
            $em->persist($dbslide);
        }
    }
    
    function saveNewSlide($slide)
    {
        $em           = $this->getDoctrine()->getEntityManager();
        $modifieddate = new \DateTime();
        $creationdate = new \DateTime();
        $dbslide      = new Slide();
        $dbslide->setId($this->gen_uuid())
                ->setSlidenumber($slide['ord'])
                ->setContent($slide['content'])
                ->setSlideshowid($this->gen_uuid())
                ->setCreationdate($creationdate)
                ->setModifieddate($modifieddate)
                ->setDeleted(0)
                ->setShow($slide['showable']);
        $em->persist($dbslide);
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
