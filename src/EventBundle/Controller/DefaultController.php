<?php

namespace EventBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($firstname, $count)
    {

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('EventBundle:Event');

        $event = $rep->findOneBy(['name' => 'first']);


        return $this->render(
            'EventBundle:Default:index.html.twig',
            ['name' => $firstname, 'count' => $count, 'event' => $event]
        );
    }

    /**
     * @Route("/test/{name}", name="test")
     */
    public function testAction($name)
    {

        $this->get('translator')->setLocale('ru');
        return $this->render('EventBundle:Default:test.html.twig', ['name' => $name]);
    }

}
