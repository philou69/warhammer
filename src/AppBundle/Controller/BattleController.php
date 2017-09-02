<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Battle\PhotoBattle;
use AppBundle\Form\Type\Battle\EditBattleType;
use AppBundle\Form\Type\Battle\ParticipantType;
use AppBundle\Form\Type\Battle\PhotoBattleType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Battle\Battle;
use AppBundle\Entity\Battle\Participant;
use AppBundle\Entity\Battle\Resume;
use AppBundle\Form\Type\Battle\BattleType;
use AppBundle\Form\Type\Battle\ResumeType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BattleController extends Controller
{
    // Page d'accueil des battles
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();

        $battles = $em->getRepository('AppBundle:Battle\Battle')->findBy([], ['date' => 'DESC']);

        return $this->render(
            'AppBundle:Battle:list.html.twig',
            array(
                'battles' => $battles,
            )
        );
    }

    // Page de vue de la battle passé
    public function viewAction(Battle $battle, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $now = new \DateTime();
        if ($battle->getDate() > $now) {
            $participant = $battle->getOneParticipant($this->getUser());
            $form = $this->createForm(ParticipantType::class, $participant);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($participant);
                $em->flush();
                $this->addFlash('info', 'Votre réponse à bien été pris en compte !');

                return $this->redirectToRoute('battle_view', ['slug' => $battle->getSlug()]);
            }
        }

        return $this->render(
            'AppBundle:Battle:view.html.twig',
            array('battle' => $battle, 'form' => isset($form) ? $form->createView() : null)
        );
    }

    // Création d'une battle
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        // On crée une nouvelle battle et on l'associe au visiteur
        $battle = new Battle();
        $battle->setCreateur($this->getUser());

        $form = $this->createForm(BattleType::class, $battle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
                $this->addFlash('info', 'La bataille a bien été créée et les invitations ont bien été envoyées.');

            } else {
                $this->addFlash('info', 'Votre battle a bien été enregistrer.');

            }

            return $this->redirectToRoute('battle_list');
        }

        return $this->render('AppBundle:Battle:create.html.twig', array('form' => $form->createView()));
    }

    public function editAction(Request $request, Battle $battle)
    {
        // On vérifie si le visiteur est le créateur de la battle
        if ($battle->getCreateur() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas accedez à cette espace !");
        }

        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(EditBattleType::class, $battle);

        $now = new \DateTime();

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em->persist($battle);
            $em->flush();
            if ($battle->getDate() > $now) {
                $mailer = $this->get('battle.send_mail');
                $mailer->sendModifiedBattle($battle);
            }


            return $this->redirectToRoute('battle_list');
        }

        return $this->render(
            'AppBundle:Battle:edit.html.twig',
            array('form' => $form->createView(), 'battle' => $battle)
        );
    }

    // Page d'annulation
    public function canceledAction(Battle $battle)
    {
        // On vérifie si le visiteur est le créateur de la battle
        if ($this->getUser() != $battle->getCreateur()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas acceder à cette espace !");
        }

        $em = $this->getDoctrine()->getManager();

        $battle->setCanceled(true);
        $em->flush();
        if ($battle->getDate() < new \DateTime()) {
            $mailer = $this->get('battle.send_mail');
            $mailer->sendCancelBattle($battle);
        }
        $this->addFlash('success', 'La bataille '.$battle->getName().' a bien été annulée');

        return $this->redirectToRoute('battle_list');
    }

    // Page de suppresion accecible uniquement par l'admin

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Battle $battle, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($battle);
        $em->flush();

        $this->addFlash('success', 'La bataille '.$battle->getName().' a bien été supprimer.');

        return $this->redirectToRoute('battle_list');
    }


}
