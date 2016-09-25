<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Form\Army\FigurineArmyType;
use AppBundle\Form\Army\EditFigurineArmyType;

class FigurineController extends Controller
{
    public function addAction(Request $request, Army $army)
    {
        $em = $this->getDoctrine()->getManager();
        $figurineArmy = new FigurineArmy();
        $figurineArmy->setArmy($army);

        $form = $this->createForm(FigurineArmyType::class, $figurineArmy, array('race' => $army->getRace()));

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('info', 'Votre figurine a bien été ajouté!');

            $figurineArmy->getArmy()->setPoints($figurineArmy->getPoints());
            $figurineArmy->setPhotos($figurineArmy->getPhotos());
            $em->persist($figurineArmy);
            $em->flush();

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Figurine:add.html.twig', array('form' => $form->createView(), 'slugArmy' => $army->getSlugArmy(), 'armyName' => $army->getName()));
    }

    public function editAction(Request $request, FigurineArmy $figurineArmy)
    {
        if ($figurineArmy->getFigurine()->getEquipements()->count() == 0) {
            $request->getSession()->getFlashBag()->add('info', 'La figurine '.$figurineArmy->getFigurine()->getName().' ne dispose pas d\'options');

            return $this->redirectToRoute('app_army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
        } else {
            $em = $this->getDoctrine()->getManager();

            $points = $figurineArmy->getPoints();

            $form = $this->createForm(EditFigurineArmyType::class, $figurineArmy, array('figurine' => $figurineArmy->getFigurine()));

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $points = $figurineArmy->getFigurine()->getPoints();
                foreach ($figurineArmy->getEquipements() as $equipement) {
                    $points += $equipement->getPoints();
                }

                $request->getSession()->getFlashBag()->add('info', 'Vous figurine a bien été mise à jour!');
                $figurineArmy->getArmy()->setPoints(($points - $figurineArmy->getPoints()));
                $figurineArmy->setPoints($points);
                $em->flush();

                return $this->redirectToRoute('army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
            }

            return $this->render('AppBundle:Figurine:edit.html.twig', array('form' => $form->createView(), 'slugArmy' => $figurineArmy->getArmy()->getSlugArmy(), 'figurineArmy' => $figurineArmy));
        }
    }

    public function deleteAction(Request $request, FigurineArmy $figurine)
    {
        $em = $this->getDoctrine()->getManager();

        $army = $figurine->getArmy();
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $army->setPoints('-'.$figurine->getPoints());
            $em->remove($figurine);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'La figurine '.$figurine->getFigurine()->getName().' a bien été retirée de la liste de l\'armée.');

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Figurine:delete.html.twig', array('form' => $form->createView(), 'figurine' => $figurine, 'slugArmy' => $army->getSlugArmy()));
    }
}
