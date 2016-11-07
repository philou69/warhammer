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
    // Page d'accueil des battles
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        // On récupere la liste des battles futurs et des battles passées
        $listBattlesPast = $em->getRepository('AppBundle:Battle\Battle')->findBattlesPast();

        $listBattlesFuture = $em->getRepository('AppBundle:Battle\Battle')->findBattlesFuture();

        return $this->render('AppBundle:Battle:index.html.twig',
                  array('listBattlesPast' => $listBattlesPast,
                        'listBattlesFuture' => $listBattlesFuture,
                  ));
    }

    // Création d'une battle
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // On crée une nouvelle battle et on l'associe au visiteur
        $visiteur = $this->get('security.token_storage')->getToken()->getUser();
        $battle = new Battle();
        $battle->setCreateur($visiteur);

        $form = $this->createForm(BattleType::class, $battle);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // On appelle et utilise le service qui lie les gens à la battle
            $adder = $this->get('battle.add_participants');
            $adder->addParticipants($battle);

            $em->persist($battle);
            $em->flush();

            $now = new \DateTime();
            // On regard la date de la battle. Si c'est futur on envoie un mail.
            if ($battle->getDate() > $now) {
                $mailer = $this->get('battle.send_mail');
                $mailer->sendMailBattle($battle);
                $request->getSession()->getFlashBag()->add('info', 'La bataille a bien été créée et les invitations ont bien été envoyées.');

                return $this->redirectToRoute('app_battles');
            } else {
                $request->getSession()->getFlashBag()->add('info', 'Votre battle a bien été enregistrer.');

                return $this->redirectToRoute('battles');
            }
        }

        return $this->render('AppBundle:Battle:add.html.twig', array('form' => $form->createView()));
    }


    // Page de suppresion accecible uniquement par l'admin
    /**
    * @Security("has_role('ROLE_ADMIN')")
    */
    public function deleteAction(Request $request, Battle $battle)
    {
        // On vérifie si la battle existe
        if(null === $battle){
            throw new NotFoundHttpException('Cette battle n\'existe pas !');
        }
        $em = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
          $em->remove($battle);
          $em->flush();

          $request->getSession()->getFlashBag()->add('success', 'La bataille '.$battle->getName().' a bien été supprimer.');

          return $this->redirectToRoute('battles');
        }

        return $this->render('AppBundle:Battle:delete.html.twig', array('form' => $form->createView(), 'battle' => $battle));
    }

    // Page d'annulation
    public function canceledAction(Request $request, Battle $battle)
    {
        // On cérifie l'existance de la battle
        if(null === battle){
        throw new NotFoundHttpException('Cette battle n\'existe pas');
        }
        // On vérifie si le visiteur est le créateur de la battle
        if ($this->get('security.token_storage')->getToken()->getUser() != $battle->getCreateur()) {
            $request->getSession()->getFlashBag()->add('danger', 'Vous n\'avez pas le droit d\'annuler cette bataille !');
            return $this->redirectToRoute('battles');
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->get('form.factory')->create();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            // On passe la battle a canceled et on mail les gens
            $battle->setCanceled(true);
            $em->flush();
            $mailer = $this->get('battle.send_mail');
            $mailer->sendCancelBattle($battle);
            $request->getSession()->getFlashBag()->add('success', 'La bataille '.$battle->getName().' a bien été annulée');

            return $this->redirectToRoute('battles');
        }

        return $this->render('AppBundle:Battle:canceled.html.twig', array('form' => $form->createView(), 'battle' => $battle));

    }

    // Page de vue de la battle passé
    public function viewAction(Battle $battle)
    {
        if($battle === null){
            throw  new NotFoundHttpException("Cette bataille n'existe pas !");
        }
        $em = $this->getDoctrine()->getManager();

        $resumeBattle = $em->getRepository('AppBundle:Battle\Resume')->findOneBy(array('battle' => $battle));

        return $this->render('AppBundle:Battle:view.html.twig', array('battle' => $battle, 'resumeBattle' => $resumeBattle));
    }

    // Page de vue de la battle future
    public function viewFutureAction(Request $request, Battle $battle)
    {
        if($battle === null){
            throw  new NotFoundHttpException("Cette bataille n'existe pas !");
        }

        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        // On liste les gens sans le visiteur qu'on récupere à part
        $listParticipants = $em->getRepository('AppBundle:Battle\Participant')->findWithoutVisitor($battle, $user);
        $participant = $em->getRepository('AppBundle:Battle\Participant')->findOneBy(array('battle' => $battle, 'participant' => $user));
        // on crée un fiormulaire de présence contenant les armées du visiteur
        $form = $this->createForm(ParticipantType::class, $participant,array('user' => $user));

        if($request->isMethod("POST") && $form->handleRequest($request)->isValid())
        {
            $em->persist($participant);
            $em->flush();
            $request->getSession()->getFlashBag()->add('info', 'Votre réponse à bien été pris en compte !');
        }
        return $this->render('AppBundle:Battle:view_futur.html.twig', array('form' => $form->createView(),'listParticipants' => $listParticipants ,'visiteur' => $participant, 'battle' =>$battle));
    }


}
