<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Army\Race;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RaceController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $races = $em->getRepository('AppBundle:Army\Race')->findAll();

        return $this->render('AppBundle:Race:list.html.twig', array('races' => $races));
    }

    public function viewAction(Race $race)
    {
        return $this->render('AppBundle:Race:view.html.twig', array('race' => $race));
    }
}