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
    public function saveSlideshow()
    {
        $slideshow = new Slideshow();
        $em = $this->getDoctrine()->getEntityManager();
        
        $request      = $this->get('request');
        $id           = $request->request->get('id');
        $name         = $request->request->get('name');
        $slides       = $request->request->get('slides');
        $creationdate = date("Y-m-d H:i:s", time());
        $modifieddate = date("Y-m-d H:i:s", time());
        foreach($slides as $i => $value)
        {
            $slide = new Slide();
            $slide->setId(rand(0,9000));
            $slide->setSlidenumber($i);
            $slide->setContent($value);
            $slide->setSlideshowid($id);
            $slide->setCreationdate(date("Y-m-d H:i:s", time()));
            $slide->setModifieddate(date("Y-m-d H:i:s", time()));
            $slide->setDeleted(0);
            $slide->setShow(1);
            $slideshow->addSlide($slide);
        }
        $slideshow->setName($name);
        $slideshow->setId($id);
        $slideshow->setCreationdate($creationdate);
        $slideshow->setModifieddate($modifieddate);
        $slideshow->setPublished(1);
                
        $em->persist($slideshow);
        $em->flush();
        return new Response('moi olen pena with id = ' . $id);
    }
}
?>
