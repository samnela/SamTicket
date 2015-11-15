<?php

 namespace TicketBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/staff") 
 */
class DashboardController extends Controller
{
    
    /**
     * @Route("/dashboard")
     */
    public function indexAction(Request $request)
    {
        $rep=$this->getDoctrine()->getRepository('TicketBundle:Ticket');
        $tickets=$rep->findAll();
       return  $this->render('dashboard/index.html.twig',array('tickets'=>$tickets));
    }
}
