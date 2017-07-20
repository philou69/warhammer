<?php


namespace AppBundle\Controller\Administration;

use AppBundle\Entity\Unit\Figurine;
use AppBundle\Entity\Unit\Unit;
use AppBundle\Form\Type\Unit\UnitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UnitController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $units = $em->getRepository('AppBundle:Unit\Unit')->findByFilter();
        $races = $em->getRepository('AppBundle:Unit\Race')->findAll( [],['name' => 'ASC'] );
        return $this->render('@App/Administration/Unit/index.html.twig', ['units' => $units, 'races' => $races]);
    }

    public function createAction(Request $request)
    {
        $unit = new Unit();
        $figurine = new Figurine();
        $unit->addFigurine($figurine);
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();
            $this->addFlash('success', "L'unité a bien été créé !");
            return $this->redirectToRoute('admin_unit_create');
        }

        return $this->render('@App/Administration/Unit/create.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Unit $unit, Request $request)
    {
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($unit);
            $em->flush();
            $this->addFlash('success', "L'unité a bien été modifier !");

            return $this->redirectToRoute('admin_unit_index');
        }

        return $this->render("@App/Administration/Unit/edit.html.twig", [ 'form' => $form->createView(), 'unit' => $unit ]);
    }

    public function deleteAction(Unit $unit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($unit);
        $em->flush();
        $this->addFlash('success', "L'unité a bien été supprimer");
        return $this->redirectToRoute('admin_unit_index');
    }

    public function filterAction(Request $request)
    {
        if($request->isXmlHttpRequest()){
            $race = $request->query->get('race') === '' ? null : htmlspecialchars($request->query->get('race'));
            $em = $this->getDoctrine()->getManager();

            $units = $em->getRepository('AppBundle:Unit\Unit')->findByFilter($race);

            return $this->render('@App/Administration/Unit/rendering.html.twig', array('units' => $units));
        }else{
            return $this->createAccessDeniedException('Vous ne pouvez acceder à cette page');
        }
    }
}