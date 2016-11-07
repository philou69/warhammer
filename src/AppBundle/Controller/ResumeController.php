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
    public function addAction(Request $request, Battle $battle)
    {
        // On vérifie l'existance de la battle et si le visiteur est le créateur
        if(null === $battle){
            throw new NotFoundHttpException('Cette figurine d\'armée n\existe pas !');
        }
        if($battle->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour ajouter unrésumé à cette bataille !');
        }
        $em = $this->getDoctrine()->getManager();

        // On crée une instance de résumé et on le lie à la battle
        $resume = new Resume();
        $resume->setBattle($battle);

        // On liste les photos de battle
        $listPhotos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findAll();

        $form = $this->createForm(ResumeType::class, $resume);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid());
        {
            if ($resume->getResume() === null) {
                return $this->render('AppBundle:Resume:add.html.twig', array('form' => $form->createView(), 'photos' => $listPhotos, 'battle' =>$battle));
            }
            $em->persist($resume);
            $em->flush();

            return $this->redirectToRoute('battle_view', array('slugBattle' => $battle->getSlugBattle()));
        }
        return $this->render('AppBundle:Resume:add.html.twig', array('form' => $form->createView(),'photos' => $listPhotos,'battle' => $battle));
    }

    // gestion de modification de résumé de battle
    public function editAction(Request $request, Resume $resume)
    {
        // On vérifie l'existance de la battle et si le visiteur est le créateur
        if(null === $resume){
            throw new NotFoundHttpException('Cette figurine d\'armée n\existe pas !');
        }
        if($resume->getBattle()->getUser() !== $this->get('security.token_storage')->getToken()->getUser()){
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas les droits suffisants pour modifier le résumé de cette bataille !');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResumeType::class, $resume);
        $listPhotos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findAll();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($resume);
            $em->flush();
            return $this->redirectToRoute('battle_view', array('slugBattle' => $resume->getBattle()->getSlugBattle()));
        }

        return $this->render('AppBundle:Resume:edit.html.twig', array('form' => $form->createView(), 'photos' => $listPhotos, 'battle' => $resume->getBattle()));
    }
}