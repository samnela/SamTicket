<?php

namespace TicketBundle\Controller\Front;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TicketBundle\Form\Type\TicketType;
use TicketBundle\Entity\Ticket;

class TicketController extends Controller
{
    /**
     * @Route("/", name="ticket_index")
     */
    public function indexAction(Request $request)
    {
        $ticket = new Ticket();
        $form = $this->createForm(TicketType::class, $ticket);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $repPriority = $this->getDoctrine()->getRepository('TicketBundle:Priority');
            $repStatus = $this->getDoctrine()->getRepository('TicketBundle:Status');
            $priority = $repPriority->findOneByPriority('normal');
            $status = $repStatus->findOneByStatus('open');
            $ticket->setPriority($priority);
            $ticket->setStatus($status);
            $ticket->setCreatedDate(new \DateTime('now'));
            $em->persist($ticket);
            $em->flush();
            $this->addFlash('user', $ticket->getLastname());

            return $this->redirectToRoute('ticket_thankyou');
        }

        return $this->render('index/index.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/thank-you", name="ticket_thankyou")
     */
    public function thankyouAction(Request $request)
    {
        $session = $request->getSession();
        $user = $session->getBag('flashes')->get('user');
        if (empty($user)) {
            throw $this->createNotFoundException('This page does not exist');
        }

        return $this->render('index/thankyou.html.twig', array('user' => $user));
    }
}
