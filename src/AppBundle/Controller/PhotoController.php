<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\FigurineArmy;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Army\PhotoFigurine;
use AppBundle\Form\Army\PhotoFigurineType;

class PhotoController extends Controller
{
    public function addAction(Request $request, FigurineArmy $figurineArmy)
    {
        $em = $this->getDoctrine()->getManager();

        $photo = new PhotoFigurine();
        $photo->setFigurine($figurineArmy);

        $form = $this->createForm(PhotoFigurineType::class, $photo);

        $form->add('save', SubmitType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)) {
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('app_army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
        }

        return $this->render('AppBundle:Photo:add.html.twig', array('form' => $form->createView(), 'slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
    }

    public function deleteAction(Request $request, PhotoFigurine $photoFigurine)
    {
        $em = $this->getDoctrine()->getManager();

        $army = $photoFigurine->getFigurine()->getArmy();
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($photoFigurine);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre photo a bien été supprimée.');

            return $this->redirectToRoute('app_army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Photo:delete.html.twig', array('form' => $form->createView(), 'photoFigurine' => $photoFigurine, 'slugArmy' => $army->getSlugArmy()));
    }
}
