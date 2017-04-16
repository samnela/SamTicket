<?php
 namespace TicketBundle\Controller\Admin;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use TicketBundle\Form\Type\CreateUserType;
use TicketBundle\Entity\User;

/**
 * @author Samuel NELA <hello@samnela.com>
 * @Route("/staff/admin")
 */
class AdminController extends Controller
{

    /**
     * @Route("/account/create",name="staff_createuser")
     */
    public function createUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(CreateUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $encoder = $this->get('security.password_encoder');
            $plainPassword = $form->get('password')->getData();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("staff_dashboard");
        }
        return $this->render('admin/createuser.html.twig', array('form' => $form->createView()));
    }
}
