<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Participant;
use AppBundle\Entity\Battle\Resume;
use AppBundle\Form\Battle\BattleType;
use AppBundle\Form\Battle\ResumeType;

class BattleController extends Controller
{
  public function indexAction()
  {
    $em = $this->getDoctrine()->getManager();

    $listBattlesPast = $em->getRepository('AppBundle:Battle\Battle')->findBattlesPast();

    $listBattlesFuture = $em->getRepository('AppBundle:Battle\Battle')->findBattlesFuture();

    return $this->render('AppBundle:Battle:index.html.twig',
                  array('listBattlesPast' => $listBattlesPast,
                        'listBattlesFuture' => $listBattlesFuture
                  ));
  }
  public function addAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $battle = new Battle();
    $battle->setCreateur($this->get('security.token_storage')->getToken()->getUser());
    $listUsers = $em->getRepository('AppBundle:User\User')->findAll();
    $form = $this->createForm(BattleType::class, $battle);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    {
      foreach ($listUsers as $user) {
        $participant = new Participant();

        $battle->addParticipant($participant);

        $participant->setPresence($em->getRepository('AppBundle:Battle\Presence')->findOneBy(array('id' => 4)));
        $participant->setParticipant($user);

      }

      $em->persist($battle);
      $em->flush();

      $now = new \DateTime();

      if ($battle->getDate() > $now )
      {
        foreach ($battle->getParticipants() as $participant)
        {
            $message = \Swift_Message::newInstance()
                ->setSubject('Invitation à une battle')
                ->setFrom('site.projet.oc@gmail.com')
                ->setTo($participant->getParticipant()->getEmail())
                ->setBody($this->renderView('AppBundle:Email:battle.html.twig', array('battle' => $battle)), 'text/html')
                ->addPart($this->renderView('AppBundle:Email:battle.txt.twig', array('battle' => $battle)), 'text/plain');

            $this->get('mailer')->send($message);
        }
        $request->getSession()->getFlashBag()->add('info','La bataille a bien été créée et les invitations ont bien été envoyées.');

        return $this->redirectToRoute('app_battles');
      }
      else
      {
        $request->getSession()->getFlashBag()->add('info', 'Votre battle a bien été enregistrer.');

        return $this->redirectToRoute('app_battles');
      }
    }

    return $this->render('AppBundle:Battle:add.html.twig', array('form' => $form->createView()));
  }

  public function addviewAction(Request $request, Battle $battle)
  {
    $em = $this->getDoctrine()->getManager();

    $resume = new Resume();
    $resume->setBattle($battle);
    $listPhotos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findAll();

    $form = $this->createForm(ResumeType::class, $resume);

    $form->handleRequest($request);
    if($form->isSubmitted() && $form->isValid());
    {
      $em->persist($resume);
      $em->flush();
      return $this->redirectToRoute('app_battles');
    }

    return $this->render('AppBundle:Resume:add.html.twig',array('form' => $form->createView(), 'photos' => $listPhotos));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction(Request $request, Battle $battle)
  {
    $em = $this->getDoctrine()->getManager();

    $form = $this->get('form.factory')->create();

    if($request->isMethod('POST') && $form->handleRequest($request)->isValid())
    {
      $em->remove($battle);
      $em->flush();

      $request->getSession()->getFlashBag()->add('success','La bataille'.$battle->getName().' a bien été supprimer.');

      return $this->redirectToRoute('app_battles');
    }

    return $this->render('AppBundle:Battle:delete.html.twig', array('form' => $form->createView(), 'battle' => $battle));
  }

  public function canceledAction(Request $request, Battle $battle)
  {
    if( $this->get('security.token_storage')->getToken()->getUser() != $battle->getCreateur())
    {
      return $this->redirectToRoute('app_battles');
    }
    else
    {
      $em = $this->getDoctrine()->getManager();

      $form = $this->get('form.factory')->create();

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid())
      {
        $battle->setCanceled(true);
        $em->flush();

        $request->getSession()->getFlashBag()->add('success','La bataille '.$battle->getName().' a bien été annulée');

        return $this->redirectToRoute('app_battles');
      }

      return $this->render('AppBundle:Battle:canceled.html.twig', array('form' => $form->createView(), 'battle' => $battle));
    }
  }

  public function viewAction(Battle $battle)
  {
    $em = $this->getDoctrine()->getManager();

    $resumeBattle = $em->getRepository('AppBundle:Battle\Resume')->findOneBy(array('battle' =>$battle));
    return $this->render('AppBundle:Battle:view.html.twig', array('battle' => $battle, 'resumeBattle' => $resumeBattle));
  }
}
