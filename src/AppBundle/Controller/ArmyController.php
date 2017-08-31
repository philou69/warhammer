<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Form\Type\Army\ArmyType;

class ArmyController extends Controller
{
    // Accueil de la zone armée
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository("AppBundle:User\User")->findAllOrder();

        return $this->render('AppBundle:Army:list.html.twig', array('users' => $users));
    }

    // Page de vue d'une armée
    public function viewAction(Request $request, Army $army)
    {
        return $this->render('AppBundle:Army:view.html.twig', array('army' => $army ));
    }

    //Page de création d'une armée
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $army = new Army();
        $army->setUser($this->getUser());

        $form = $this->createForm(ArmyType::class, $army);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($army);
            $em->flush();

            return $this->redirectToRoute('army_view', array('slug' => $army->getSlug()));
        }

        return $this->render('AppBundle:Army:create.html.twig', array('form' => $form->createView()));
    }

    // Page de modifiaction de l'armée
    public function editAction(Request $request, Army $army)
    {
        // On s'assure que l'utilisateur est le propriétaire de l'armée
        if( $army->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer cette armée !');
            return $this->redirectToRoute('army_list');
        }
        $em = $this->getDoctrine()->getManager();

        // On utilise le même formulaire que pour la création d'une armée mais on enleve le champ race qui ne peut être modifier
        $form = $this->createForm(ArmyType::class, $army);

        $form->remove('race');

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $this->addFlash('info', 'Votre armée a bien été modifier');

            return $this->redirectToRoute('army_view', array('slug' => $army->getSlug()));
        }

        return $this->render('AppBundle:Army:edit.html.twig', array('form' => $form->createView(), 'army' => $army));
    }

    // Page de suppresion d'armée
    public function deleteAction(Request $request, Army $army)
    {
        // On s'assure que l'utilisateur est le propriétaire de l'armée
        if( $army->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer cette armée !');
            return $this->redirectToRoute('army_list');
        }
        // On appelle l'entityManager et on supprime l'armée
        $em = $this->getDoctrine()->getManager();
        $em->remove($army);
        $em->flush();

        $this->addFlash('info', 'Votre armée a bien été supprimé !');

        return $this->redirectToRoute('army_list');
    }
}
