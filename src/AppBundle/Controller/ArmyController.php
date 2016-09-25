<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Army\Army;
use AppBundle\Form\Army\ArmyType;

class ArmyController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listArmies = $em->getRepository("AppBundle:Army\Army")->findAll();
        $listUsers = $em->getRepository("AppBundle:User\User")->findAllOrder();

        return $this->render('AppBundle:Army:index.html.twig', array('listArmies' => $listArmies, 'listUsers' => $listUsers));
    }

    public function viewAction($slugArmy)
    {
        $em = $this->getDoctrine()->getManager();

        $army = $em->getRepository('AppBundle:Army\Army')->FindOneWithAll($slugArmy);

        if ($army === null) {
            throw new NotFoundHttpException('Armée inexistante');
        }

        $listGroupes = $this->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Army\Groupe')->findAll();

        return $this->render('AppBundle:Army:view.html.twig', array('army' => $army,
            'listgroupes' => $listGroupes, ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $army = new Army();
        $army->setUser($this->get('security.token_storage')->getToken()->getUser());

        $form = $this->createForm(ArmyType::class, $army);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($army);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre armée a été créé avec succès.');

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Army:add.html.twig', array('form' => $form->createView()));
    }
    public function editAction(Request $request, Army $army)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ArmyType::class, $army);

        $form->remove('race');

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->flush();
            $request->getSession()->getFlashbag()->add('info', 'Votre armée a été modifié avec succès.');

            return $this->redirectToRoute('army_view', array('slugArmy' => $army->getSlugArmy()));
        }

        return $this->render('AppBundle:Army:edit.html.twig', array('form' => $form->createView(), 'army' => $army));
    }

    public function deleteAction(Request $request, Army $army)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($army);
            $em->flush();

            $request->getSession()->getFlashBag()->add('info', 'Votre armée a été supprimé avec succès.');

            return $this->redirectToRoute('armies');
        }

        return $this->render('AppBundle:Army:delete.html.twig', array('form' => $form->createView(), 'army' => $army));
    }
}
