<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Army\Figurine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FigurineController extends Controller
{
    public function viewAction(Figurine $figurine)
    {
        return $this->render('AppBundle:Figurine:view.html.twig', array('figurine' => $figurine));
    }
}