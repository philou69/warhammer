<?php


namespace AppBundle\Controller;


use AppBundle\Entity\Unit\Unit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UnitController extends Controller
{
    public function viewAction(Unit $unit)
    {
        return $this->render('AppBundle:Unit:view.html.twig', array('unit' => $unit));
    }
}