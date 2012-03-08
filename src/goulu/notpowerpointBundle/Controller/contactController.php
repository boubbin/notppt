<?php
namespace goulu\notpowerpointBundle\Controller;

use goulu\notpowerpointBundle\Entity\Contact;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class contactController extends Controller
{
    /**
     *
     * @Route("/contact/new")
     * @Template()
     */
    public function newAction()
    {
        //näytetään uuden kontaktin formin
        $contact = new Contact();
        
        $form = $this->createFormBuilder($contact)
                ->add('name','text')
                ->add('email','text')
                ->add('phone','text')
                ->getForm();
        return $this->render('notpowerpointBundle:contact:new.html.twig', array('form' => $form->createView()));
    }
    
    /**
     *
     * @Route("/contact/create")
     * @Template()
     */
    public function createAction()
    {
        //tallennetaan kantaan uusi kontakti
        return $this->render('notpowerpointBundle:contact:create.html.twig');
    }
}
?>
