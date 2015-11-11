<?php
 namespace TicketBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    /**
     * @Route("/staff/login", name="login_route")
     */
    public function loginAction(Request $request)
    {
        $authentification = $this->get('security.authentication_utils');
        $error = $authentification->getLastAuthenticationError();
        $lastUsername = $authentification->getLastUsername();
        return $this->render('security/login.html.twig', array(
                'last_name' => $lastUsername,
                'error' => $error
                )
        );
    }

    /**
     * @Route("/staff/login_check",name="login_check")
     */
    public function loginCheckAction()
    {
        
    }
}
