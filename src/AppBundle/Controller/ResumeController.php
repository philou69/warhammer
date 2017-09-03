<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Resume;
use AppBundle\Form\Type\Battle\ResumeType;

class ResumeController extends Controller
{
    // gestion d'ajout de resumé
    public function createAction(Request $request, Battle $battle)
    {
        // On vérifie si le visiteur est le créateur
        if($battle->getCreateur() !== $this->getUser()){
            throw $this->createAccessDeniedException("Vous ne pouvez acceder à cette espace !");
        }
        $em = $this->getDoctrine()->getManager();

        // On crée une instance de résumé et on le lie à la battle
        $resume = new Resume();
        $resume->setBattle($battle);

        $form = $this->createForm(ResumeType::class, $resume);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($resume);
            $em->flush();

            return $this->redirectToRoute('battle_view', array('slug' => $battle->getSlug()));
        }
        return $this->render('AppBundle:Resume:create.html.twig', array('form' => $form->createView(),'battle' => $battle));
    }

    // gestion de modification de résumé de battle
    public function editAction(Request $request, Resume $resume)
    {
        // On vérifie si le visiteur est le créateur
        if($resume->getBattle()->getCreateur() !== $this->getUser()){
            throw $this->createAccessDeniedException("Vous ne pouvez acceder à cette espace !");
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResumeType::class, $resume);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($resume);
            $em->flush();
            return $this->redirectToRoute('battle_view', array('slug' => $resume->getBattle()->getSlug()));
        }

        return $this->render('AppBundle:Resume:edit.html.twig', array('form' => $form->createView(), 'battle' => $resume->getBattle()));
    }
}
