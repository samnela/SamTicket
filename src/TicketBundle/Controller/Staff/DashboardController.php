<?php 
namespace TicketBundle\Controller\Staff;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/staff") 
 */
class DashboardController extends Controller
{

    /**
     * list all ticket 
     * @Route("/dashboard",name="staff_dashboard")
     */
    public function indexAction(Request $request)
    {
        $tickets = $this->get('ticket_repository')->findAll();
        return $this->render('dashboard/index.html.twig', array('tickets' => $tickets));
    }

    /**
     * summary  One ticket
     * @param type $id
     * @Route("/ticket/{id}", name="staff_ticket_summary")
     */
    public function summaryAction($id)
    {
        $ticket = $this->get('ticket_repository')->find($id);
        return $this->render('dashboard/ticket.html.twig', ['ticket' => $ticket]);
    }
}
