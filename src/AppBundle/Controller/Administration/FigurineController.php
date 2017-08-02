<?php


namespace AppBundle\Controller\Administration;


use AppBundle\Entity\Unit\Figurine;
use AppBundle\Form\Type\Unit\FigurineType;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FigurineController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $figurines = $em->getRepository('AppBundle:Unit\Figurine')->findAll([],['name' =>"ASC"]);

        return $this->render('@App/Administration/Figurine/index.html.twig', ['figurines' => $figurines]);
    }

    public function createAction(Request $request)
    {
        $figurine = new Figurine();
        $form = $this->createForm(FigurineType::class, $figurine);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $em->persist($figurine);
            $em->flush();

            $this->addFlash('success', "La figurine a bien été enregistrer !");
            return $this->redirectToRoute('admin_figurine_create');
        }

        return  $this->render("@App/Administration/Figurine/create.html.twig", ['form' => $form->createView()]);
    }

    public function editAction(Figurine $figurine, Request $request)
    {
        $originalEquipements = new ArrayCollection();
        foreach ($figurine->getEquipements() as $equipement){
            $originalEquipements->add($equipement);
        }
        $form = $this->createForm(FigurineType::class, $figurine);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            foreach ($originalEquipements as $equipement)
            {
                if(false === $figurine->getEquipements()->contains($equipement)){
                    $figurine->getEquipements()->removeElement($equipement);
                    $em->remove($equipement);
                }
            }
            $em->persist($figurine);
            $em->flush();

            $this->addFlash('success', "La figurine a bien été enregistrer !");
            return $this->redirectToRoute('admin_figurine_index');
        }

        return  $this->render("@App/Administration/Figurine/create.html.twig", ['form' => $form->createView()]);
    }

    public function deleteAction(Figurine $figurine, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($figurine);
        $em->flush();
        $this->addFlash('success', 'La figurine a bien été supprimé');

        return $this->redirectToRoute('admin_figurine_index');
    }
}