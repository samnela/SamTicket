<?php

namespace TicketBundle\Controller\Staff;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/staff")
 */
class SecurityController extends Controller
{
    /**
     * @Route("/",name="staff_staff")
     * @todo create homepage 
     */
    public function staffAction()
    {
        return new Response('<html><body> staff staff </html></body>');
    }

    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('staff_dashboard');
        }
        $authentification = $this->get('security.authentication_utils');
        $error = $authentification->getLastAuthenticationError();
        $lastUsername = $authentification->getLastUsername();

        return $this->render('security/login.html.twig', array(
                'last_username' => $lastUsername,
                'error' => $error,
                )
        );
    }
}
