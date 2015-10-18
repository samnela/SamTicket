<?php

namespace TicketBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use TicketBundle\Form\Type\TicketType;
use TicketBundle\Entity\Ticket;
class TicketController extends Controller
{
     /**
     * @Route("/", name="ticket_index")
     */
    public function indexAction(Request $req)
    {
            $ticket = new Ticket();
        $form =$this->createForm(new TicketType(), $ticket);
        return $this->render("index/index.html.twig",array('form'=>$form->createView()));
    }
}
