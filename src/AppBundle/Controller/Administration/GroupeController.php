<?php


namespace AppBundle\Controller\Administration;


use AppBundle\Entity\Unit\Groupe;
use AppBundle\Form\Type\Unit\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GroupeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $groupes = $em->getRepository('AppBundle:Unit\Groupe')->findAll([], ['name' =>'ASC']);

        return $this->render('@App/Administration/Groupe/index.html.twig', ['groupes' => $groupes]);
    }

    public function createAction(Request $request)
    {
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();
            $this->addFlash('success', "L groupe a bien été créée");
            return $this->redirectToRoute('admin_groupe_index');
        }
        return $this->render('@App/Administration/Groupe/create.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(Groupe $groupe, Request $request)
    {
        $form = $this->createForm(GroupeType::class, $groupe);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($groupe);
            $em->flush();
            $this->addFlash('success', "Le groupe a bien été modifiée ");
            return $this->redirectToRoute('admin_groupe_index');
        }
        return $this->render('@App/Administration/Groupe/edit.html.twig', ['form' => $form->createView(), 'groupe' => $groupe]);
    }

    public function deleteAction(Groupe $groupe)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($groupe);
        $em->flush();
        $this->addFlash('success', "Le groupe a bien été supprimée");
        return $this->redirectToRoute('admin_groupe_index');
    }
}