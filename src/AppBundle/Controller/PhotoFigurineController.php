<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\FigurineArmy;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Army\PhotoFigurine;
use AppBundle\Form\Army\PhotoFigurineType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PhotoFigurineController extends Controller
{
    // Gestion d'ajout d'une photo Figurine
    public function addAction(Request $request, FigurineArmy $figurineArmy)
    {
        // On vérifie l'existance de la figurine et si le visiteur est le proprio de la figurine
        if(null === $figurineArmy){
            throw new NotFoundHttpException('Cette figurine d\'armée n\existe pas !');
        }
        if($figurineArmy->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter une photo à cette figurine !');
        }
        $em = $this->getDoctrine()->getManager();

        // On crée une instance de photoFigurine lié à la figurine
        $photo = new PhotoFigurine();
        $photo->setFigurine($figurineArmy);

        $form = $this->createForm(PhotoFigurineType::class, $photo);

        $form->add('save', SubmitType::class);

        if ($request->isMethod('POST') && $form->handleRequest($request)) {
            $em->persist($photo);
            $em->flush();

            return $this->redirectToRoute('army_view', array('slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
        }

        return $this->render('AppBundle:Photo:add.html.twig', array('form' => $form->createView(), 'slugArmy' => $figurineArmy->getArmy()->getSlugArmy()));
    }

    // Gestion de suppresion des photos de figurine
    public function deleteAction(Request $request, PhotoFigurine $photoFigurine)
    {
        // On vérifie l'existance de la figurine et si le visiteur est le proprio de la figurine
        if(null === $photoFigurine){
            throw new NotFoundHttpException('Cette figurine d\'armée n\existe pas !');
        }
        if($photoFigurine->getFigurineArmy()->getArmy()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter une photo à cette figurine !');
        }
        $em = $this->getDoctrine()->getManager();

        $army = $photoFigurine->getFigurine()->getArmy();
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($photoFigurine);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre photo a bien été supprimée.');

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Photo:delete.html.twig', array('form' => $form->createView(), 'photoFigurine' => $photoFigurine, 'slugArmy' => $army->getSlugArmy()));
    }
}
