<?php

namespace goulu\notpowerpointBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;

class ajaxController extends Controller
{
     /**
     * @Route("/ajax/slideshow/save")
     */
    public function saveSlideshow()
    {
        $request = $this->get('request');
        $id = $request->request->get('id');
        $content = $request->request->get('content');
        return new Response('moi olen pena with id = ' . $id);
    }
}
?>
