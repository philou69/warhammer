<?php


namespace AppBundle\Controller\Administration;


use AppBundle\Entity\Unit\Race;
use AppBundle\Form\Type\Unit\RaceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RaceController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $races = $em->getRepository('AppBundle:Unit\Race')->findAll([], ['name' =>'ASC']);

        return $this->render('@App/Administration/Race/index.html.twig', ['races' => $races]);
    }

    public function createAction(Request $request)
    {
        $race = new Race();
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($race);
            $em->flush();
            $this->addFlash('success', "La race a bien été créée");
            return $this->redirectToRoute('admin_race_index');
        }
        return $this->render('@App/Administration/Race/create.html.twig', ['form' => $form->createView()]);
    }

    public function editAction(Race $race, Request $request)
    {
        $form = $this->createForm(RaceType::class, $race);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($race);
            $em->flush();
            $this->addFlash('success', "La race a bien été modifiée ");
            return $this->redirectToRoute('admin_race_index');
        }
        return $this->render('@App/Administration/Race/edit.html.twig', ['form' => $form->createView(), 'race' => $race]);
    }

    public function deleteAction(Race $race)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($race);
        $em->flush();
        $this->addFlash('success', "La race a bien été supprimée");
        return $this->redirectToRoute('admin_race_index');
    }
}
