<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Battle\PhotoBattle;
use AppBundle\Form\Battle\ParticipantType;
use AppBundle\Form\Battle\PhotoBattleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Participant;
use AppBundle\Entity\Battle\Resume;
use AppBundle\Form\Battle\BattleType;
use AppBundle\Form\Battle\ResumeType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BattleController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listBattlesPast = $em->getRepository('AppBundle:Battle\Battle')->findBattlesPast();

        $listBattlesFuture = $em->getRepository('AppBundle:Battle\Battle')->findBattlesFuture();

        return $this->render('AppBundle:Battle:index.html.twig',
                  array('listBattlesPast' => $listBattlesPast,
                        'listBattlesFuture' => $listBattlesFuture,
                  ));
    }
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $visiteur = $this->get('security.token_storage')->getToken()->getUser();
        $battle = new Battle();
        $battle->setCreateur($visiteur);

        $listUsers = $em->getRepository('AppBundle:User\User')->findAll();
        $form = $this->createForm(BattleType::class, $battle);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $presence = $em->getRepository('AppBundle:Battle\Presence')->find(4);

            foreach ($listUsers as $user) {
                $participant = new Participant();

                $participant->setPresence($presence)
            ->setParticipant($user);
                $battle->addParticipant($participant);
            }

            $em->persist($battle);
            $em->flush();

            $now = new \DateTime();

            if ($battle->getDate() > $now) {
                foreach ($battle->getParticipants() as $participant) {
                    $message = \Swift_Message::newInstance()
                ->setSubject('Invitation à une battle')
                ->setFrom('site.projet.oc@gmail.com')
                ->setTo($participant->getParticipant()->getEmail())
                ->setBody($this->renderView('AppBundle:Email:battle.html.twig', array('battle' => $battle)), 'text/html')
                ->addPart($this->renderView('AppBundle:Email:battle.txt.twig', array('battle' => $battle)), 'text/plain');

                    $this->get('mailer')->send($message);
                }
                $request->getSession()->getFlashBag()->add('info', 'La bataille a bien été créée et les invitations ont bien été envoyées.');

                return $this->redirectToRoute('app_battles');
            } else {
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

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid());
        {
            if ($resume->getResume() === null) {
                return $this->render('AppBundle:Resume:add.html.twig', array('form' => $form->createView(), 'photos' => $listPhotos, 'battle' =>$battle));
            }
              $em->persist($resume);
              $em->flush();

            return $this->redirectToRoute('app_battle_view', array('slugBattle' => $battle->getSlugBattle()));
        }
        return $this->render('AppBundle:Resume:add.html.twig', array('form' => $form->createView(),'photos' => $listPhotos,'battle' => $battle));
    }

    public function editViewAction(Request $request, Resume $resume)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ResumeType::class, $resume);
        $listPhotos = $em->getRepository('AppBundle:Battle\PhotoBattle')->findAll();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->update($resume);
            $em->flush();
        }

        return $this->render('AppBundle:Resume:edit.html.twig', array('form' => $form->createView(), 'photos' => $listPhotos));
    }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction(Request $request, Battle $battle)
  {
      $em = $this->getDoctrine()->getManager();

      $form = $this->get('form.factory')->create();

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em->remove($battle);
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'La bataille '.$battle->getName().' a bien été supprimer.');

          return $this->redirectToRoute('app_battles');
      }

      return $this->render('AppBundle:Battle:delete.html.twig', array('form' => $form->createView(), 'battle' => $battle));
  }

    public function canceledAction(Request $request, Battle $battle)
    {
        if ($this->get('security.token_storage')->getToken()->getUser() != $battle->getCreateur()) {
            return $this->redirectToRoute('app_battles');
        } else {
            $em = $this->getDoctrine()->getManager();

            $form = $this->get('form.factory')->create();

            if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
                $battle->setCanceled(true);
                $em->flush();

                $request->getSession()->getFlashBag()->add('success', 'La bataille '.$battle->getName().' a bien été annulée');

                return $this->redirectToRoute('app_battles');
            }

            return $this->render('AppBundle:Battle:canceled.html.twig', array('form' => $form->createView(), 'battle' => $battle));
        }
    }

    public function viewAction(Battle $battle)
    {
        $em = $this->getDoctrine()->getManager();

        $resumeBattle = $em->getRepository('AppBundle:Battle\Resume')->findOneBy(array('battle' => $battle));

        return $this->render('AppBundle:Battle:view.html.twig', array('battle' => $battle, 'resumeBattle' => $resumeBattle));
    }

    public function viewFutureAction(Request $request, Battle $battle)
    {
        if($battle === null){
            throw  new NotFoundHttpException("Cette bataille n'existe pas !");
        }

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $listParticipants = $em->getRepository('AppBundle:Battle\Participant')->findWithoutVisitor($battle, $user);
        $participant = $em->getRepository('AppBundle:Battle\Participant')->findOneBy(array('battle' => $battle, 'participant' => $user));

        $form = $this->createForm(ParticipantType::class, $participant,array('user' => $user));

        if($request->isMethod("POST") && $form->handleRequest($request)->isValid())
        {
            $em->refresh($participant);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Votre réponse à bien été pris en compte !');
        }
        return $this->render('AppBundle:Battle:view_futur.html.twig', array('form' => $form->createView(),'listParticipants' => $listParticipants , 'battle' =>$battle));
    }

    public function addPhotoAction(Request $request, Battle $battle)
    {
        $em = $this->getDoctrine()->getManager();
        $photo = new PhotoBattle();
        $photo->setBattle($battle);
        $form = $this->createForm(PhotoBattleType::class, $photo);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($photo);
            $em->flush();
            if($battle->getResume() === null )
            {
                return $this->redirectToRoute('app_battle_add_view', array('slugBattle' => $battle->getSlugBattle()));
            }else{
                return $this->redirectToRoute('app_battle_edit_view', array('id' => $battle->getResume()->getId()));
            }


        }
        return $this->render('AppBundle:PhotoBattle:add.html.twig', array('form' => $form->createView()));
    }
}
