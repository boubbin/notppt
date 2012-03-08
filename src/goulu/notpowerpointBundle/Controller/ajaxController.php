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
        if($id == 'null' || empty($id))
        {
            $id = $this->saveNewSlideshow();
            if (empty($id)) {
                return new Response("Persisting new slideshow failed", 500);
            }
            $response = 201;
        }
        else
        {
            if (!$this->updateExistingSlideshow($id)) {
                return new Response("Saving existing slideslow failed", 500);
            }
            $response = 200;
        }
        return new Response($id, $response);
    }
    function saveNewSlideshow()
    {
        $request      = $this->get('request');
        $name         = $request->request->get('name');
        $slides       = $request->request->get('slides');
        if (empty($slides)) { return false; }
        $slideshow    = new Slideshow();
        $em           = $this->em();
        $creationdate = new \DateTime();
        $modifieddate = new \DateTime();
        $uuid = $this->gen_uuid();
        foreach($slides as $slide)
        {
            $this->saveNewSlide($uuid, $slide);
        }
        $slideshow->setName($name);
        $slideshow->setId($uuid);
        $slideshow->setCreationdate($creationdate);
        $slideshow->setModifieddate($modifieddate);
        $slideshow->setPublished(1);
        $slideshow->setDeleted(0);   
        $em->persist($slideshow);
        $em->flush();
        return $uuid;
    }
    function updateExistingSlideshow($id)
    {
        $em           = $this->em();
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
            $slideshow->setName($name);
            $slideshow->setModifieddate($modifieddate);
            $slideshow->setPublished(1);
            $slideshow->setDeleted(0);
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
        $em      = $this->em();
        $dbslide = $em->getRepository('goulunotpowerpointBundle:Slide')->find($slide['id']);
        if(!$dbslide)
        {
            $this->saveNewSlide($slide);
        }
        else
        {
            $dbslide->setSlidenumber($slide['ord']);
            $dbslide->setContent($slide['content']);
            $dbslide->setShow($slide['showable']);
            $em->persist($dbslide);
        }
    }
    
    function saveNewSlide($slideShowId, $slide)
    {
        $em           = $this->em();
        $modifieddate = new \DateTime();
        $creationdate = new \DateTime();
        $dbslide      = new Slide();
        $dbslide->setId($this->gen_uuid());
        $dbslide->setSlidenumber($slide['ord']);
        $dbslide->setContent($slide['content']);
        $dbslide->setSlideshowid($slideShowId);
        $dbslide->setCreationdate($creationdate);
        $dbslide->setModifieddate($modifieddate);
        $dbslide->setDeleted(0);
        $dbslide->setShow($slide['showable']);
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
    private function em() {
        return $this->getDoctrine()->getEntityManager();
    }
}
?>
