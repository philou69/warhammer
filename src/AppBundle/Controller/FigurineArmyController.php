<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Army\PhotoFigurine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Form\Army\FigurineArmyType;
use AppBundle\Form\Army\EditFigurineArmyType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class FigurineArmyController extends Controller
{
    // Ajout d'une figurine dans une armée
    public function createAction(Request $request, Army $army)
    {
        if($army->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        // On crée une instance de Figurine et l'associe à l'armée
        $figurineArmy = new FigurineArmy();
        $figurineArmy->setArmy($army);

        $form = $this->createForm(FigurineArmyType::class, $figurineArmy, array('race' => $army->getRace()));

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $files = $form->get('files')->getData();
            foreach ($files as $file)
            {
                $photo = new PhotoFigurine();
                $photo->setFile($file)
                    ->setFigurine($figurineArmy);

                $figurineArmy->addPhoto($photo);
            }
            $em->persist($figurineArmy);
            $em->flush();

            $this->addFlash('info', 'Votre figurine a bien été ajouté!');
            return $this->redirectToRoute('army_view', array('slug' => $army->getSlug()));
        }

        return $this->render('AppBundle:FigurineArmy:create.html.twig', array('form' => $form->createView(), 'slug' => $army->getSlug(), 'armyName' => $army->getName()));
    }

    // Gestion de modification d'une figurine
    public function editAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie si le visiteur possède l'armée de la figurine
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }
        $oldFigurine = clone $figurineArmy;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EditFigurineArmyType::class, $figurineArmy);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $files = $form->get('files')->getData();
            foreach ($files as $file) {
                $photo = new PhotoFigurine();
                $photo->setFile($file)
                    ->setFigurine($figurineArmy);
                $figurineArmy->addPhoto($photo);
                $em->persist($photo);
            }
            $em->flush();
            $photosFigurine = $em->getRepository("AppBundle:Army\PhotoFigurine")->findBy(array('figurine' => $figurineArmy));

            foreach ($photosFigurine as $photo){
                if(!$figurineArmy->getPhotos()->contains($photo))
                {
                    $em->remove($photo);
                }
            }

            $em->flush();
            $this->addFlash('info', 'Vous figurine a bien été mise à jour!');
            return $this->redirectToRoute('army_view', array('slug' => $figurineArmy->getArmy()->getSlug()));
        }

        return $this->render('AppBundle:FigurineArmy:edit.html.twig', array('form' => $form->createView(), 'slug' => $figurineArmy->getArmy()->getSlug(), 'figurineArmy' => $figurineArmy));
    }

    // gestion de suppression d'une figurine
    public function deleteAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie si le visiteur possède l'armée de la figurine
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($figurineArmy);
        $em->flush();
        $this->addFlash('info', 'La figurine '.$figurineArmy->getFigurine()->getName().' a bien été retirée de la liste de l\'armée.');

        return $this->redirectToRoute('army_view', array('slug' => $figurineArmy->getArmy()->getSlug()));
    }
}