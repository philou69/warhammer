<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Army\FigurineArmy;
use AppBundle\Entity\Army\PictureUnit;
use AppBundle\Entity\Unit\Unit;
use AppBundle\Form\Type\Army\EquipementUnitArmyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Entity\Army\UnitArmy;
use AppBundle\Form\Type\Army\UnitArmyType;

class UnitArmyController extends Controller
{
    // Ajout d'une unit dans une armée
    public function selectUnitAction(Request $request, Army $army)
    {
        if ($army->getUser() !== $this->getUser()) {
            $this->createAccessDeniedException('Vous ne pouvez modifier une armée ne vous apartenant pas');
        }
        // On crée une instance de Unit et l'associe à l'armée
        $unitArmy = new UnitArmy();
        $unitArmy->setArmy($army);

        $form = $this->createForm(UnitArmyType::class, $unitArmy, ['race' => $army->getRace()]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Le formulaire est enregistrer, on envoye le slug de l'armée et l'id de l'unité séléctionné à la route de redirection
            return $this->redirectToRoute(
                'unit_army_adding_figurines',
                ['slug' => $army->getSlug(), 'id' => $unitArmy->getUnit()->getId()]
            );
        }

        return $this->render(
            'AppBundle:UnitArmy:choice.unit.html.twig',
            array('form' => $form->createView(), 'slug' => $army->getSlug(), 'armyName' => $army->getName())
        );
    }

    /**
     * @ParamConverter("army", options={"mapping": {"slug": "slug"}})
     * @ParamConverter("unit", options={"mapping": {"id": "id"}} )
     * @param Unit $unit
     * @param Army $army
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addingFigurinesAction(Unit $unit, Army $army, Request $request)
    {
        if ($army->getUser() !== $this->getUser()) {
            $this->createAccessDeniedException(
                "Vous ne poceder pas les droits pour ajouter une unité à cette armée !"
            );
        }
        // On va créer l'unité army souhaité par le visiteur et lui passé les figurines possibles
        $unitArmy = new  UnitArmy();
        $unitArmy->setArmy($army)
            ->setUnit($unit);
        foreach ($unit->getFigurines() as $figurine) {
            $figurineArmy = new  FigurineArmy();
            $figurineArmy->setFigurine($figurine);
            $unitArmy->addFigurine($figurineArmy);
        }
        $form = $this->createForm(EquipementUnitArmyType::class, $unitArmy);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            // Recuperation de la photo et ajout à l'unité.
            $file = $form->get('file')->getData();
            if ($file instanceof UploadedFile) {
                $photo = new PictureUnit();
                $photo->setFile($file)
                    ->setUnit($unitArmy);
                $unitArmy->setPhoto($photo);
            }
            $em->persist($unitArmy);
            $em->flush();
            $this->addFlash('success', 'Votre unité a bien été enregistrée !');

            return $this->redirectToRoute('army_view', ['slug' => $unitArmy->getArmy()->getSlug()]);
        }

        return $this->render(
            '@App/UnitArmy/adding.figurines.html.twig',
            ['form' => $form->createView(), 'unitArmy' => $unitArmy]
        );
    }

    // Gestion de modification d'une unit
    public function editAction(UnitArmy $unitArmy, Request $request)
    {
        // On vérifie si le visiteur possède l'armée de la unit
        if ($unitArmy->getArmy()->getUser() !== $this->getUser()) {
            $this->createAccessDeniedException("Vous ne poceder pas les droits pour modifier cette unité!");
        }
        $oldUnit = clone $unitArmy;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(EquipementUnitArmyType::class, $unitArmy);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Recuperation de la photo et ajout à l'unité.
            $file = $form->get('file')->getData();
            if ($file instanceof UploadedFile) {
                $photo = new PictureUnit();
                $photo->setFile($file)
                    ->setUnit($unitArmy);
                $unitArmy->setPhoto($photo);
            }

            foreach ($oldUnit->getFigurines() as $oldFigurine)
            {
                foreach ($unitArmy->getFigurines() as $figurine)
                {
                    if($figurine->getId() === $oldFigurine->getFigurine()){

                        foreach ($oldFigurine->getEquipements() as $equipement)
                        {
                            if($figurine->getEquipements()->contains($equipement) === false){
                                $unitArmy->getFigurines()->get($oldFigurine)->removeEquipement($equipement);
                            }
                        }
                    }
                }
            }
            $em->flush();
            $this->addFlash('info', 'Vous unit a bien été mise à jour!');

            return $this->redirectToRoute('army_view', array('slug' => $unitArmy->getArmy()->getSlug()));
        }

        return $this->render(
            'AppBundle:UnitArmy:edit.html.twig',
            array('form' => $form->createView(), 'slug' => $unitArmy->getArmy()->getSlug(), 'unitArmy' => $unitArmy)
        );
    }

    // gestion de suppression d'une unit
    public function deleteAction(Request $request, UnitArmy $unitArmy)
    {
        // On vérifie si le visiteur possède l'armée de la unit
        if ($unitArmy->getArmy()->getUser() !== $this->getUser()) {
            $this->createAccessDeniedException('Vous ne disposer pas des droits sur cette armée !');
        }

        $em = $this->getDoctrine()->getManager();

        $em->remove($unitArmy);
        $em->flush();
        $this->addFlash(
            'info',
            'La unit '.$unitArmy->getUnit()->getName().' a bien été retirée de la liste de l\'armée.'
        );

        return $this->redirectToRoute('army_view', array('slug' => $unitArmy->getArmy()->getSlug()));
    }

}

