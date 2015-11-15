<?php
 namespace TicketBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller
{

    /**
     * @Route("/staff/account/create", name="staff_account_create")
     */
    public function createAction()
    {

        return new Response("hello you!");
    }
}
