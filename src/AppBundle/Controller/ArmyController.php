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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listArmies = $em->getRepository("AppBundle:Army\Army")->findAll();
        $listUsers = $em->getRepository("AppBundle:User\User")->findAllOrder();

        return $this->render('AppBundle:Army:index.html.twig', array('listArmies' => $listArmies, 'listUsers' => $listUsers));
    }
    // Page de vue d'une armée
    public function viewAction(Army $army)
    {
        // On vérifie si $army existe
        if ($army === null) {
            throw new NotFoundHttpException('Armée inexistante');
        }
        // On récupere la liste des groupes
        $listGroupes = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('AppBundle:Army\Groupe')->findAll();

        return $this->render('AppBundle:Army:view.html.twig', array('army' => $army,
            'listgroupes' => $listGroupes, ));
    }

    //Page de création d'une armée
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $army = new Army();
        $army->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(ArmyType::class, $army);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($army);
            $em->flush();

            return $this->redirectToRoute('armies');
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
            return $this->redirectToRoute('armies');
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
            return $this->redirectToRoute('armies');
        }
        // On crée un form pour supprimer l'armée
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($army);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre armée a bien été supprimé !');

            return $this->redirectToRoute('armies');
        }

        return $this->render('AppBundle:Army:delete.html.twig', array('form' => $form->createView(), 'army' => $army));
    }
}
