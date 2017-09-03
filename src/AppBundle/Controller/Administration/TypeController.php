<?php


namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Unit\Type;
use AppBundle\Form\Type\Unit\TypeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TypeController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $types = $em->getRepository('AppBundle:Unit\Type')->findAll([], ['name' =>'ASC']);
        return $this->render('@App/Administration/Type/index.html.twig', ['types' => $types]);
    }

    public function createAction(Request $request)
    {
        $type = new Type();
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            $this->addFlash('success', 'Le type a bien été enregistré');
            return $this->redirectToRoute('admin_type_index');
        }
        return $this->render('@App/Administration/Type/create.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(Type $type, Request $request)
    {
        $form = $this->createForm(TypeType::class, $type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($type);
            $em->flush();
            $this->addFlash('success', 'Le type a bien été modifié');
            return $this->redirectToRoute('admin_type_index');
        }
        return $this->render('@App/Administration/Type/edit.html.twig', ['form' => $form->createView(), 'type' => $type]);
    }

    public function deleteAction(Type $type, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($type);
        $em->flush();
        $this->addFlash('success', 'Le type a bien été supprimé');
        return $this->redirectToRoute('admin_type_index');
    }
}
