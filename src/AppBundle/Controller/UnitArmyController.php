<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Army\PhotoUnit;
use AppBundle\Form\Type\Army\EquipementUnitArmytype;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\UnitArmy;
use AppBundle\Form\Type\Army\UnitArmyType;
use AppBundle\Form\Type\Army\EditUnitArmyType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UnitArmyController extends Controller
{
    // Ajout d'une unit dans une armée
    public function createAction(Request $request, Army $army)
    {
        if($army->getUser() !== $this->getUser()){
            $this->createAccessDeniedException('Vous ne pouvez modifier une armée ne vous apartenant pas');
        }

        $em = $this->getDoctrine()->getManager();

        // On crée une instance de Unit et l'associe à l'armée
        $unitArmy = new UnitArmy();
        $unitArmy->setArmy($army);

        $form = $this->createForm(UnitArmyType::class, $unitArmy, ['race' => $army->getRace()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

//            $files = $form->get('files')->getData();
//            foreach ($files as $file)
//            {
//                $photo = new PhotoUnit();
//                $photo->setFile($file)
//                    ->setUnit($unitArmy);
//
//                $unitArmy->addPhoto($photo);
//            }
            $em->persist($unitArmy);
            $em->flush();

            $this->addFlash('info', 'Votre unit a bien été ajouté!');
            return $this->redirectToRoute('unit_army_adding_figurines', ['id' => $unitArmy->getId()]);
        }

        return $this->render('AppBundle:UnitArmy:create.html.twig', array('form' => $form->createView(), 'slug' => $army->getSlug(), 'armyName' => $army->getName()));
    }

    // Gestion de modification d'une unit
    public function editAction(Request $request, UnitArmy $unitArmy)
    {
        // On vérifie si le visiteur possède l'armée de la unit
        if($unitArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }
        $oldUnit = clone $unitArmy;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EditUnitArmyType::class, $unitArmy);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
        {
            $files = $form->get('files')->getData();
            foreach ($files as $file) {
                $photo = new PhotoUnit();
                $photo->setFile($file)
                    ->setUnit($unitArmy);
                $unitArmy->addPhoto($photo);
                $em->persist($photo);
            }
            $em->flush();
            $photosUnit = $em->getRepository("AppBundle:Army\PhotoUnit")->findBy(array('unit' => $unitArmy));

            foreach ($photosUnit as $photo){
                if(!$unitArmy->getPhotos()->contains($photo))
                {
                    $em->remove($photo);
                }
            }

            $em->flush();
            $this->addFlash('info', 'Vous unit a bien été mise à jour!');
            return $this->redirectToRoute('army_view', array('slug' => $unitArmy->getArmy()->getSlug()));
        }

        return $this->render('AppBundle:UnitArmy:edit.html.twig', array('form' => $form->createView(), 'slug' => $unitArmy->getArmy()->getSlug(), 'unitArmy' => $unitArmy));
    }

    // gestion de suppression d'une unit
    public function deleteAction(Request $request, UnitArmy $unitArmy)
    {
        // On vérifie si le visiteur possède l'armée de la unit
        if($unitArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($unitArmy);
        $em->flush();
        $this->addFlash('info', 'La unit '.$unitArmy->getUnit()->getName().' a bien été retirée de la liste de l\'armée.');

        return $this->redirectToRoute('army_view', array('slug' => $unitArmy->getArmy()->getSlug()));
    }

    public function addingFigurinesAction(UnitArmy $unit, Request $request)
    {
        // On ajoute les figuirines
        foreach ($unit->getUnit()->getFigurines() as $figurine)
        {
            $unit->addFigurine($figurine);
        }

        $form = $this->createForm(EquipementUnitArmytype::class, $unit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em  = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();
            $this->addFlash('success', 'Votre unité a bien été enregistrée !');

            return $this->redirectToRoute('army_view', ['slug' => $unit->getArmy()->getSlug()]);
        }
        return $this->render('@App/UnitArmy/adding.figurines.html.twig', ['form' => $form->createView()]);
    }
}
