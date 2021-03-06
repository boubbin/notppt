<?php

namespace goulu\notpowerpointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use goulu\notpowerpointBundle\Entity\Slideshow;
use goulu\notpowerpointBundle\Entity\Slide;
use goulu\notpowerpointBundle\Entity\Contact;



class ajaxController extends Controller
{

    /**
     * @Route("/ajax/slideshow/save")
     */
    public function saveSlideshowAction()
    {   
        $request = $this->get('request');
        $id      = $request->request->get('id', 'null');
        $resp    = "";
        if($id == 'null' || empty($id))
        {
            $resp = $this->saveNewSlideshow();
            if (empty($resp)) {
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
        return new Response($resp, $response);
    }
    
    /**
     * @Route("/ajax/contact/save")
     */
    public function saveContactAction()
    {
        $request = $this->get('request');
        $name = $request->request->get('name');
        $phone = $request->request->get('phone');
        $email = $request->request->get('email');
        
        $em = $this->em();
        $contact = new Contact();
        $contact->setCreationdate(new \DateTime());
        $contact->setModifieddate(new \DateTime());
        $contact->setId($this->gen_uuid());
        $contact->setEmail($email);
        $contact->setName($name);
        $contact->setPhone($phone);
        $contact->setDeleted(false);
        $em->persist($contact);
        $em->flush();
        
        return new Response("contact saved!", 201);
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
        $uuid         = $this->gen_uuid();
        $slideids     = array();
        foreach($slides as $slide)
        {
            $slideids[] = $this->saveNewSlide($uuid, $slide);
        }
        $slideshow->setName($name);
        $slideshow->setId($uuid);
        $slideshow->setCreationdate($creationdate);
        $slideshow->setModifieddate($modifieddate);
        $slideshow->setPublished(1);
        $slideshow->setDeleted(0);   
        $em->persist($slideshow);
        $em->flush();
        return json_encode(array($uuid => $slideids));
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
        $uuid         = $this->gen_uuid();
        $dbslide->setId($uuid);
        $dbslide->setSlidenumber($slide['ord']);
        $dbslide->setContent($slide['content']);
        $dbslide->setSlideshowid($slideShowId);
        $dbslide->setCreationdate($creationdate);
        $dbslide->setModifieddate($modifieddate);
        $dbslide->setDeleted(0);
        $dbslide->setShow($slide['showable']);
        $em->persist($dbslide);
        return $uuid;
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
