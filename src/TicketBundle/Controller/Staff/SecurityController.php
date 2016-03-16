<?php
 namespace TicketBundle\Controller\Staff;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/staff")
 */
class SecurityController extends Controller
{

    /**
     * @Route("/",name="staff_staff")
     */
    public function staffAction()
    {

        return new Response('<html><body> staff staff </html></body>');
    }

    /**
     * @Route("/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('staff_dashboard');
        }
        $authentification = $this->get('security.authentication_utils');
        $error = $authentification->getLastAuthenticationError();
        $lastUsername = $authentification->getLastUsername();
        return $this->render('security/login.html.twig', array(
                'last_username' => $lastUsername,
                'error' => $error
                )
        );
    }

    /**
     * @Route("/login_check",name="login_check")
     */
    public function loginCheckAction()
    {
        
    }

    /**
     * @Route("/logout",name="login_logout")
     */
    public function logoutAction()
    {
        return $this->redirectToRoute('ticket_index');
    }
}
