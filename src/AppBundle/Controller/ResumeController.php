<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Resume;
use AppBundle\Form\Battle\ResumeType;

class ResumeController extends Controller
{
    // gestion d'ajout de resumé
    public function createAction(Request $request, Battle $battle)
    {
        // On vérifie si le visiteur est le créateur
        if($battle->getCreateur() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter unrésumé à cette bataille !');
        }
        $em = $this->getDoctrine()->getManager();

        // On crée une instance de résumé et on le lie à la battle
        $resume = new Resume();
        $resume->setBattle($battle);

        // On liste les photos de battle
        $photos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findByDesc($battle->getCreateur());

        $form = $this->createForm(ResumeType::class, $resume);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid());
        {
            if ($resume->getResume() === null) {
                return $this->render('AppBundle:Resume:create.html.twig', array('form' => $form->createView(), 'photos' => $photos, 'battle' =>$battle));
            }
            $em->persist($resume);
            $em->flush();

            return $this->redirectToRoute('battle_view', array('slug' => $battle->getSlug()));
        }
        return $this->render('AppBundle:Resume:create.html.twig', array('form' => $form->createView(),'photos' => $photos,'battle' => $battle));
    }

    // gestion de modification de résumé de battle
    public function editAction(Request $request, Resume $resume)
    {
        // On vérifie si le visiteur est le créateur
        if($resume->getBattle()->getCreateur() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour modifier le résumé de cette bataille !');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResumeType::class, $resume);
        $photos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findByDesc($resume->getBattle()->getCreateur());
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($resume);
            $em->flush();
            return $this->redirectToRoute('battle_view', array('slug' => $resume->getBattle()->getSlug()));
        }

        return $this->render('AppBundle:Resume:edit.html.twig', array('form' => $form->createView(), 'photos' => $photos, 'battle' => $resume->getBattle()));
    }
}