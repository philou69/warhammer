<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Form\Army\FigurineArmyType;
use AppBundle\Form\Army\EditFigurineArmyType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FigurineController extends Controller
{
    // Ajout d'une figurine dans une armée
    public function addAction(Request $request, Army $army)
    {
        // On vérifie l'existance de l'armée et si le visiteur possède l'armée
        if(null === $army){
            throw new NotFoundHttpException('Cette armée n\'existe pas');
        }
        if($army->getUser() !== $this->get('security.token_storage')-getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        // On crée une instance de Figurine et l'associe à l'armée
        $figurineArmy = new FigurineArmy();
        $figurineArmy->setArmy($army);

        $form = $this->createForm(FigurineArmyType::class, $figurineArmy, array('race' => $army->getRace()));

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $request->getSession()->getFlashBag()->add('info', 'Votre figurine a bien été ajouté!');


            $em->persist($figurineArmy);
            $em->flush();

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Figurine:add.html.twig', array('form' => $form->createView(), 'slugArmy' => $army->getSlugArmy(), 'armyName' => $army->getName()));
    }

    // Gestion de modification d'une figurine
    public function editAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie l'existance dela figurine et si le visiteur possède l'armée de la figurine
        if(null === $figurineArmy){
            throw new NotFoundHttpException('Cette armée n\'existe pas');
        }
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')-getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EditFigurineArmyType::class, $figurineArmy, array('figurine' => $figurineArmy->getFigurine()));

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {


            $request->getSession()->getFlashBag()->add('info', 'Vous figurine a bien été mise à jour!');
            $em->flush();

            return $this->redirectToRoute('army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
        }

        return $this->render('AppBundle:Figurine:edit.html.twig', array('form' => $form->createView(), 'slugArmy' => $figurineArmy->getArmy()->getSlugArmy(), 'figurineArmy' => $figurineArmy));
    }

    // gestion de suppression d'une figurine
    public function deleteAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie l'existance dela figurine et si le visiteur possède l'armée de la figurine
        if(null === $figurineArmy){
            throw new NotFoundHttpException('Cette armée n\'existe pas');
        }
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')-getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->remove($figurineArmy);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'La figurine '.$figurineArmy->getFigurine()->getName().' a bien été retirée de la liste de l\'armée.');

            return $this->redirectToRoute('army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
        }

        return $this->render('AppBundle:Figurine:delete.html.twig', array('form' => $form->createView(), 'figurineArmy' => $figurineArmy, 'slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
    }
}
