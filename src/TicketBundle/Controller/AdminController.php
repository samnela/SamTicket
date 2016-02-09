<?php
 namespace TicketBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TicketBundle\Form\Type\CreateUserType;
use TicketBundle\Entity\User;

/**
 * @Route("/staff")
 */
class AdminController extends Controller
{

    /**
     * @Route("/admin/account/create",name="staff_createuser")
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new CreateUserType(), $user);
        $form->handleRequest($request);
        return $this->render('admin/createuser.html.twig', array('form' => $form->createView()));
    }
}
