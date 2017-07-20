<?php


namespace AppBundle\Controller\Administration;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrationController extends Controller
{
    public function indexAction()
    {
        return $this->render('@App/Administration/Admin/index.html.twig');
    }
}