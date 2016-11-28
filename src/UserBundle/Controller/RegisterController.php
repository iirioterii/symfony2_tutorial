<?php

namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\RegisterFormType;


class RegisterController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @Template()
     */
    public function registerAction(Request $request)
    {

        $user = new User();

        $form = $this->createForm(new RegisterFormType(), $user);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $user = $form->getData();
            $user->setPassword($this->encodePassword($user, $user->getPlainPassword()));

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('event_index'));
        }

        return $this->render('UserBundle:Register:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    private function encodePassword(User $user, $plainPassword)
    {
        return $this
            ->container
            ->get('security.encoder_factory')
            ->getEncoder($user)
            ->encodePassword($plainPassword, $user->getSalt());
    }
}
