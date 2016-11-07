<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AppController extends Controller
{
    // Page d'accueil
    public function indexAction()
    {
        return $this->render('AppBundle:App:index.html.twig');
    }
}
