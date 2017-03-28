<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Form\Army\ArmyType;

class ArmyController extends Controller
{
    // Accueil de la zone armée
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $armies = $em->getRepository("AppBundle:Army\Army")->findAll();
        $users = $em->getRepository("AppBundle:User\User")->findAllOrder();

        return $this->render('AppBundle:Army:index.html.twig', array('armies' => $armies, 'users' => $users));
    }

    // Page de vue d'une armée
    public function viewAction(Request $request, Army $army)
    {
        $repo = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Army\FigurineArmy');

        $figsQG = $repo->findByGroup('1', $army->getId());
        $figsTroupe = $repo->findByGroup('2', $army->getId()) ;
        $figsElite = $repo->findByGroup('3', $army->getId()) ;
        $figsTransport = $repo->findByGroup('4', $army->getId()) ;
        $figsAttaque = $repo->findByGroup('5', $army->getId()) ;
        $figsSoutien = $repo->findByGroup('6', $army->getId()) ;
        $figsSeigneur = $repo->findByGroup('7', $army->getId()) ;


        return $this->render('AppBundle:Army:view.html.twig', array('army' => $army,
            'figsQG' => $figsQG, 'figsTroupe' => $figsTroupe, 'figsElite' => $figsElite, 'figsTransport' => $figsTransport, 'figsAttaque' => $figsAttaque, 'figsSoutien' => $figsSoutien, 'figsSeigneur' => $figsSeigneur ));
    }

    //Page de création d'une armée
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $army = new Army();
        $army->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(ArmyType::class, $army);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($army);
            $em->flush();

            return $this->redirectToRoute('army_list');
        }

        return $this->render('AppBundle:Army:add.html.twig', array('form' => $form->createView()));
    }

    // Page de modifiaction de l'armée
    public function editAction(Request $request, Army $army)
    {
        // Vérification si $army existe
        if(null === $army)
        {
            throw new NotFoundHttpException('Armée inexistant.');
        }

        // On s'assure que l'utilisateur est le propriétaire de l'armée
        if( $army->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous ne pouvez pas supprimer cette armée !');
            return $this->redirectToRoute('army_list');
        }
        $em = $this->getDoctrine()->getManager();

        // On utilise le même formulaire que pour la création d'une armée mais on enleve le champ race qui ne peut être modifier
        $form = $this->createForm(ArmyType::class, $army);

        $form->remove('race');

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashbag()->add('info', 'Votre armée a bien été modifier');

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Army:edit.html.twig', array('form' => $form->createView(), 'army' => $army));
    }

    // Page de suppresion d'armée
    public function deleteAction(Request $request, Army $army)
    {
        // Vérification si $army existe
        if(null === $army)
        {
            throw new NotFoundHttpException('Armée inexistant');
        }
        // On s'assure que l'utilisateur est le propriétaire de l'armée
        if( $army->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous ne pouvez pas supprimer cette armée !');
            return $this->redirectToRoute('army_list');
        }
        // On crée un form pour supprimer l'armée
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($army);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre armée a bien été supprimé !');

            return $this->redirectToRoute('army_list');
        }

        return $this->render('AppBundle:Army:delete.html.twig', array('form' => $form->createView(), 'army' => $army));
    }
}
